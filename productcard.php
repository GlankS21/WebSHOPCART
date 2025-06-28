<?php
require_once "database/config.php";
$productId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$productCategory = isset($_GET['category']) ? $_GET['category'] : '';
$tableName = '';
$idColumnName = '';
$product = null;
switch ($productCategory) {
    case 'shoes':
        $tableName = 'shoes';
        $idColumnName = 'shoes_id';
        break;
    case 'clothes':
        $tableName = 'clothes';
        $idColumnName = 'clothes_id';
        break;
    case 'accessories':
        $tableName = 'accessories';
        $idColumnName = 'accessories_id';
        break;
    default:
        break;
}
if ($productId > 0 && !empty($tableName) && !empty($idColumnName)) {
    $sql = "SELECT * FROM " . $tableName . " WHERE " . $idColumnName . " = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $productId, PDO::PARAM_INT);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

}
if (isset($conn)) {
    $conn = null;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Карточка товара</title>
  <link rel="stylesheet" href="styles/productcard.css"/>
  <script src="https://kit.fontawesome.com/72956b8baa.js" crossorigin="anonymous"></script>
</head>
<body>
  <?php require_once "components/header.php"; ?>
    <main class="product-container">
    <?php if ($product): ?>
    <i onclick="window.location.href='<?php echo htmlspecialchars($productCategory); ?>.html'" class="fa-solid fa-arrow-left-long back-button"></i>
    <div class="product-wrapper">
        <div class="product-image">
            <img src="images/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" />
        </div>
        <div class="product-details">
            <div class="product-title-row">
                <h2 class="product-title"><?php echo htmlspecialchars($product['name']); ?></h2>
                <button class="favorite-button" aria-label="Добавить в избранное">
                  <i class="fa-regular fa-heart"></i>
                  <i class="fa-solid fa-heart favorite-icon"></i>
                </button>
            </div>
            <p class="price"><?php echo number_format($product['price'], 0, ',', ' '); ?> ₽</p>

            <div class="size-selection-area">
                <form action="cart.php" method="POST" id="addToCartForm">
                    <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product[$idColumnName]); ?>">
                    <input type="hidden" name="product_category" value="<?php echo htmlspecialchars($productCategory); ?>">
                    <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($product['name']); ?>">
                    <input type="hidden" name="product_price" value="<?php echo htmlspecialchars($product['price']); ?>">
                    <input type="hidden" name="product_image" value="<?php echo htmlspecialchars($product['image']); ?>">
                    <input type="hidden" name="product_size" id="selectedProductSize" value="">
                    <input type="hidden" name="action" value="add_to_cart">

                <button type="submit" class="selected-size-button" id="addToCartButton">
                    <span class="size-label">EU 36</span> <span class="cart-action-text">ДОБАВИТЬ В КОРЗИНУ</span>
                </button>

                <div class="size-grid">
                    <div class="size-box" data-size="EU 36">EU 36<span><?php echo number_format($product['price'], 0, ',', ' '); ?> ₽</span></div>
                    <div class="size-box" data-size="EU 37">EU 37<span><?php echo number_format($product['price'], 0, ',', ' '); ?> ₽</span></div>
                    <div class="size-box" data-size="EU 38">EU 38<span><?php echo number_format($product['price'], 0, ',', ' '); ?> ₽</span></div>
                    <div class="size-box" data-size="EU 39">EU 39<span><?php echo number_format($product['price'], 0, ',', ' '); ?> ₽</span></div>
                    <div class="size-box" data-size="EU 40">EU 40<span><?php echo number_format($product['price'], 0, ',', ' '); ?> ₽</span></div>
                    <div class="size-box" data-size="EU 41">EU 41<span><?php echo number_format($product['price'], 0, ',', ' '); ?> ₽</span></div>
                    <div class="size-box" data-size="EU 42">EU 42<span><?php echo number_format($product['price'], 0, ',', ' '); ?> ₽</span></div>
                    <div class="size-box" data-size="EU 43">EU 43<span><?php echo number_format($product['price'], 0, ',', ' '); ?> ₽</span></div>
                    <div class="size-box" data-size="EU 44">EU 44<span><?php echo number_format($product['price'], 0, ',', ' '); ?> ₽</span></div>
                    <div class="size-box" data-size="EU 45">EU 45<span><?php echo number_format($product['price'], 0, ',', ' '); ?> ₽</span></div>
                    <div class="size-box" data-size="EU 46">EU 46<span><?php echo number_format($product['price'], 0, ',', ' '); ?> ₽</span></div>
                    <div class="size-box" data-size="EU 47">EU 47<span><?php echo number_format($product['price'], 0, ',', ' '); ?> ₽</span></div>
                    <div class="size-box" data-size="EU 48">EU 48<span><?php echo number_format($product['price'], 0, ',', ' '); ?> ₽</span></div>
                    <div class="size-box" data-size="EU 49">EU 49<span><?php echo number_format($product['price'], 0, ',', ' '); ?> ₽</span></div>
                    <div class="size-box" data-size="EU 50">EU 50<span><?php echo number_format($product['price'], 0, ',', ' '); ?> ₽</span></div>
                    <div class="size-box" data-size="EU 51">EU 51<span><?php echo number_format($product['price'], 0, ',', ' '); ?> ₽</span></div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <?php endif; ?>
  </main>
  <?php require_once "components/footer.php"; ?>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const sizeBoxes = document.querySelectorAll('.size-box');
    const selectedProductSizeInput = document.getElementById('selectedProductSize');
    const addToCartButton = document.getElementById('addToCartButton');
    const sizeLabelSpan = addToCartButton.querySelector('.size-label');
    function setSelectedSize(sizeBox) {
      sizeBoxes.forEach(b => b.classList.remove('selected'));
      sizeBox.classList.add('selected');
      const selectedSize = sizeBox.dataset.size;
      selectedProductSizeInput.value = selectedSize;
      sizeLabelSpan.textContent = selectedSize;
      addToCartButton.removeAttribute('disabled');
    }

    if (sizeBoxes.length > 0) {
      setSelectedSize(sizeBoxes[0]);
    } 
    sizeBoxes.forEach(box => {
      box.addEventListener('click', function() {
        setSelectedSize(this);
      });
    });
  });
</script>
</body>
</html>