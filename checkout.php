<?php
require_once "database/config.php";
$order_success_message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $region = $_POST['region'];
    $city = $_POST['city'];
    $street = $_POST['street'];
    $email = $_POST['email'];
    $sql = "INSERT INTO orders (name, phone, region, city, street) VALUES (:name, :phone, :region, :city, :street)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':region', $region);
    $stmt->bindParam(':city', $city);
    $stmt->bindParam(':street', $street);
    if ($stmt->execute()) {
        $last_id = $conn->lastInsertId();
        $order_success_message = "<p class='order-success-message'>Ваш заказ успешно создан! ID заказа: <strong>" . htmlspecialchars($last_id) . "</strong></p>";
    } else {
        $order_success_message = "<p class='order-error-message'>Произошла ошибка при оформлении заказа. Попробуйте еще раз.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
   <meta charset="UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
   <title>Оформление заказа</title>
   <link rel="stylesheet" href="styles/checkout.css" />
    <style>
        .order-success-message {
            color: green;
            font-weight: bold;
            text-align: center;
            margin-top: 15px;
            padding: 10px;
            border: 1px solid green;
            background-color: #e6ffe6;
            border-radius: 5px;
        }
        .order-error-message {
            color: red;
            font-weight: bold;
            text-align: center;
            margin-top: 15px;
            padding: 10px;
            border: 1px solid red;
            background-color: #ffe6e6;
            border-radius: 5px;
        }
    </style>
</head>
<body>
   <?php require_once "components/header.php"; ?>
   <main class="checkout-container">
      <h1 class="page-title">Оформление заказа</h1>

      <div class="checkout-wrapper">
            <form class="customer-info" id="checkoutForm" method="POST" action="checkout.php">
                  <h3>Личные данные</h3>
                  <div class="form-grid">
                        <div class="input-group">
                              <label for="fullName">Ваше имя</label>
                              <input type="text" id="fullName" name="name" placeholder="Иван Петров" required>
                        </div>
                        <div class="input-group">
                              <label for="phone">Телефон</label>
                              <input type="tel" id="phone" name="phone" placeholder="+7 996 999 65 56" required>
                        </div>
                        <div class="input-group full-width">
                              <label for="email">Почта</label>
                              <input type="email" id="email" name="email" placeholder="petrov@ya.ru" required>
                        </div>
                        <div class="input-group">
                              <label for="region">Регион доставки</label>
                              <input type="text" id="region" name="region" placeholder="Самарская область" required>
                        </div>
                        <div class="input-group">
                              <label for="city">Город доставки</label>
                              <input type="text" id="city" name="city" placeholder="Самара" required>
                        </div>
                        <div class="input-group full-width">
                              <label for="street">Улица</label>
                              <input type="text" id="street" name="street" placeholder="Пушкина" required>
                        </div>
                  </div>
            </form>

            <div class="order-summary-block">
                  <div class="product-summary-list">
                        <div class="product-item">
                              <div class="product-details">
                                    <p class="product-name">New Balance 2002R</p>
                                    <p class="product-size">EU 36</p>
                              </div>
                              <div class="product-price-control">
                                    <p class="product-price">36 990 ₽</p>
                                    <div class="quantity-control">
                                          <button type="button" class="quantity-btn decrease-btn">-</button>
                                          <span class="item-quantity">1</span>
                                          <button type="button" class="quantity-btn increase-btn">+</button>
                                    </div>
                              </div>
                        </div>
                  </div>

                  <div class="promo-section">
                        <p>Если у вас есть промокод<br>введите его сюда</p>
                        <div class="promo-input-group">
                              <input type="text" placeholder="ПРОМОКОД" aria-label="Введите промокод" />
                              <button type="button" class="apply-promo-btn">ПРИМЕНИТЬ</button>
                        </div>
                  </div>

                  <div class="total-section">
                        <span class="total-label">Общая стоимость</span>
                        <span class="total-price">36 990 ₽</span>
                  </div>

            <?php if (!empty($order_success_message)): ?>
                <div id="order-status-message">
                    <?php echo $order_success_message; ?>
                </div>
            <?php endif; ?>

                  <button type="submit" form="checkoutForm" class="proceed-to-payment-btn">ОПЛАТИТЬ</button>
            </div>
      </div>
   </main>
<?php require_once "components/footer.php"; ?>
</body>
</html>