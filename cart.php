<?php
session_start();
$cart_items = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$total_price = 0;
$is_ajax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
      $action = $_POST['action'];
      if ($action === 'add_to_cart') {
          $product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
          $product_category = isset($_POST['product_category']) ? $_POST['product_category'] : '';
          $product_name = isset($_POST['product_name']) ? $_POST['product_name'] : '';
          $product_price = isset($_POST['product_price']) ? (float)$_POST['product_price'] : 0.0;
          $product_image = isset($_POST['product_image']) ? $_POST['product_image'] : '';
          $product_size = isset($_POST['product_size']) ? $_POST['product_size'] : '';
          if ($product_id <= 0 || $product_price < 0 || empty($product_name) || empty($product_size)) {
            exit();
          }
          $found = false;
          foreach ($cart_items as &$item) {
              if ($item['id'] == $product_id && $item['category'] == $product_category && $item['size'] == $product_size) {
                  $item['quantity']++;
                  $found = true;
                  break;
              }
          }
          unset($item);
          if (!$found) {
            $cart_items[] = ['id' => $product_id,'category' => $product_category,'name' => $product_name,'price' => $product_price,'image' => $product_image,'size' => $product_size,'quantity' => 1];
          }
          $_SESSION['cart'] = $cart_items;

        } elseif ($action === 'increase_quantity') {
            $item_index = isset($_POST['item_index']) ? (int)$_POST['item_index'] : -1;
            if ($item_index >= 0 && isset($cart_items[$item_index])) {
                $cart_items[$item_index]['quantity']++;
                $_SESSION['cart'] = $cart_items;
            }
        } elseif ($action === 'decrease_quantity') {
            $item_index = isset($_POST['item_index']) ? (int)$_POST['item_index'] : -1;
            if ($item_index >= 0 && isset($cart_items[$item_index])) {
                $cart_items[$item_index]['quantity']--;
                if ($cart_items[$item_index]['quantity'] <= 0) {
                    array_splice($cart_items, $item_index, 1);
                }
                $_SESSION['cart'] = array_values($cart_items);
            }
        } elseif ($action === 'remove_item') {
            $item_index = isset($_POST['item_index']) ? (int)$_POST['item_index'] : -1;
            if ($item_index >= 0 && isset($cart_items[$item_index])) {
                array_splice($cart_items, $item_index, 1);
                $_SESSION['cart'] = array_values($cart_items); 
            }
        }
    }
    $new_total_price = 0;
    foreach ($_SESSION['cart'] as $item) {
      $new_total_price += $item['price'] * $item['quantity'];
    }

    if ($is_ajax) {
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'cart_items' => $_SESSION['cart'],
            'total_price' => $new_total_price,
            'message' => 'Успесно добавить'
        ]);
        exit();
    } else {
        header('Location: cart.php');
        exit();
    }
}
foreach ($cart_items as $item) {
    $total_price += $item['price'] * $item['quantity'];
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Корзина</title>
  <link rel="stylesheet" href="styles/cart.css" />
</head>
<body>
  <?php require_once "components/header.php"; ?>
  <main class="cart-container">
    <h2 class="page-title">Корзина</h2>

    <div class="cart-wrapper">
      <div class="cart-items-list" id="cart-items-list">
        <?php if (!empty($cart_items)): ?>
            <?php foreach ($cart_items as $index => $item): ?>
                <div class="cart-item" data-item-index="<?php echo $index; ?>" data-item-id="<?php echo htmlspecialchars($item['id']); ?>" data-item-category="<?php echo htmlspecialchars($item['category']); ?>" data-item-size="<?php echo htmlspecialchars($item['size']); ?>" data-price="<?php echo htmlspecialchars($item['price']); ?>">
                    <img src="images/<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" class="cart-item-image" />
                    <div class="cart-item-details">
                        <div class="cart-item-title">
                            <div>
                                <p><?php echo htmlspecialchars($item['name']); ?></p>
                                <p class="cart-item-size"><?php echo htmlspecialchars($item['size']); ?></p>
                            </div>
                            <p class="cart-item-price"><?php echo number_format($item['price'] * $item['quantity'], 0, ',', ' '); ?> ₽</p>
                        </div>

                        <div class="cart-item-quantity-control">
                            <button type="button" class="quantity-button decrease-quantity" data-action="decrease_quantity" data-item-index="<?php echo $index; ?>">-</button>
                            <span class="item-quantity"><?php echo htmlspecialchars($item['quantity']); ?></span>
                            <button type="button" class="quantity-button increase-quantity" data-action="increase_quantity" data-item-index="<?php echo $index; ?>">+</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p id="empty-cart-message">Ваша корзина пустая</p>
        <?php endif; ?>
      </div>
      <div class="cart-summary">
        <div class="summary-total-row">
            <span class="summary-label">Общая сумма</span>
            <span class="summary-value" id="total-price"><?php echo number_format($total_price, 0, ',', ' '); ?> ₽</span>
        </div>
        <ul class="summary-items-list" id="summary-items-list">
            <?php foreach ($cart_items as $item): ?>
                <li class="summary-item">
                    <span class="summary-item-name"><?php echo htmlspecialchars($item['name']); ?> (<?php echo htmlspecialchars($item['size']); ?> x <?php echo htmlspecialchars($item['quantity']); ?>)</span>
                    <span class="summary-item-price"><?php echo number_format($item['price'] * $item['quantity'], 0, ',', ' '); ?> ₽</span>
                </li>
            <?php endforeach; ?>
        </ul>
        <button class="checkout-button" onclick="window.location.href='checkout.php'">ПЕРЕЙТИ К ОФОРМЛЕНИЮ</button>
      </div>
    </div>
  </main>
  <?php require_once "components/footer.php"; ?>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const cartItemsList = document.getElementById('cart-items-list'); 
    const totalPriceElement = document.getElementById('total-price');
    const summaryItemsList = document.getElementById('summary-items-list');
    const emptyCartMessage = document.getElementById('empty-cart-message'); 
    function renderCartItem(item, index) {
        let cartItemElement = document.querySelector(`.cart-item[data-item-id="${item.id}"][data-item-category="${item.category}"][data-item-size="${item.size}"]`);
        if (cartItemElement) {
            cartItemElement.querySelector('.item-quantity').textContent = item.quantity;
            cartItemElement.querySelector('.cart-item-price').textContent = `${(item.price * item.quantity).toLocaleString('ru-RU')} ₽`;
            cartItemElement.dataset.itemIndex = index; 
            cartItemElement.querySelector('.decrease-quantity').dataset.itemIndex = index;
            cartItemElement.querySelector('.increase-quantity').dataset.itemIndex = index;
            const removeButton = cartItemElement.querySelector('.remove-item-button');
            if (removeButton) removeButton.dataset.itemIndex = index;
        } else {
            cartItemElement = document.createElement('div');
            cartItemElement.classList.add('cart-item');
            cartItemElement.dataset.itemIndex = index;
            cartItemElement.dataset.itemId = item.id;
            cartItemElement.dataset.itemCategory = item.category;
            cartItemElement.dataset.itemSize = item.size;
            cartItemElement.dataset.price = item.price;
            cartItemElement.innerHTML = `
                <img src="images/${item.image}" alt="${item.name}" class="cart-item-image" />
                <div class="cart-item-details">
                    <div class="cart-item-title">
                        <div>
                            <p>${item.name}</p>
                            <p class="cart-item-size">${item.size}</p>
                        </div>
                        <p class="cart-item-price">${(item.price * item.quantity).toLocaleString('ru-RU')} ₽</p>
                    </div>
                    <div class="cart-item-quantity-control">
                        <button type="button" class="quantity-button decrease-quantity" data-action="decrease_quantity" data-item-index="${index}">-</button>
                        <span class="item-quantity">${item.quantity}</span>
                        <button type="button" class="quantity-button increase-quantity" data-action="increase_quantity" data-item-index="${index}">+</button>
                    </div>
                </div>
            `;
            cartItemsList.appendChild(cartItemElement);
        }
        return cartItemElement;
    }
    function updateAllCartDisplays(cartItems, newTotalPrice) {
        cartItemsList.innerHTML = ''; 
        if (cartItems.length === 0) {
            cartItemsList.innerHTML = '<p id="empty-cart-message">Ваша корзина пустая</p>';
        } else {
            cartItems.forEach((item, index) => {
                renderCartItem(item, index);
            });
        }
        totalPriceElement.textContent = `${newTotalPrice.toLocaleString('ru-RU')} ₽`;
        summaryItemsList.innerHTML = ''; 
        if (cartItems.length > 0) {
            cartItems.forEach(item => {
                const listItem = document.createElement('li');
                listItem.classList.add('summary-item');
                listItem.innerHTML = `
                    <span class="summary-item-name">${item.name} (${item.size} x ${item.quantity})</span>
                    <span class="summary-item-price">${(item.price * item.quantity).toLocaleString('ru-RU')} ₽</span>
                `;
                summaryItemsList.appendChild(listItem);
            });
        }
    }
    cartItemsList.addEventListener('click', async (event) => {
      const button = event.target.closest('.quantity-button, .remove-item-button');
      if (!button) return;
      const action = button.dataset.action;
      const itemIndex = button.dataset.itemIndex;
      button.disabled = true;
      const response = await fetch('cart.php', {
          method: 'POST',
          headers: {
              'Content-Type': 'application/x-www-form-urlencoded',
              'X-Requested-With': 'XMLHttpRequest'
          },
          body: `action=${action}&item_index=${itemIndex}`
      });
      if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status}`);
      }
      const data = await response.json();
      if (data.success) {
          updateAllCartDisplays(data.cart_items, data.total_price);
          
      }
    });
});
</script>
</body>
</html>