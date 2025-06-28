<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>О магазине</title>
  <link rel="stylesheet" href="styles/about.css" />
</head>
<body>
  <?php require_once "components/header.php"; ?>
  <section class="about-section">
    <h1>О магазине</h1>

    <div class="store-cards">
      <div class="store-card">
        <img src="images/image 2.svg" alt="Санкт-Петербург" />
        <h3>САНКТ-ПЕТЕРБУРГ</h3>
        <div class="store-info">
          <div class="store-left">
            <p class="store-address">УЛИЦА ПУШКИНА</p>
            <p class="store-hours">С 11:00–23:00</p>
          </div>
          <div class="store-right">
            <p class="store-phone">8 (800) 743-34-11</p>
            <p class="store-email">shop.cart@mail.ru</p>
          </div>
        </div>
      </div>

      <div class="store-card">
        <img src="images/image 2.svg" alt="Москва" />
        <h3>МОСКВА</h3>
        <div class="store-info">
          <div class="store-left">
            <p class="store-address">УЛИЦА ПУШКИНА</p>
            <p class="store-hours">С 11:00–23:00</p>
          </div>
          <div class="store-right">
            <p class="store-phone">8 (800) 743-34-11</p>
            <p class="store-email">shop.cart@mail.ru</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php require_once "components/footer.php"; ?>
</body>
</html>
