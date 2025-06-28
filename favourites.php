<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SHOPCART - Избранное</title>
    <link rel="stylesheet" href="styles/favourites.css"> 
</head>
<body class="main-page">
    <?php require_once "components/header.php"; ?>
    <main>
        <section class="products">
            <div class="products-header">
                <h2 class="products-title">Избранное</h2>
            </div>
            <div class="product-list">
                <!-- Пример карточки товара без фильтра, названия и стоимости -->
                <div class="product-item">
                    <img src="images/IMG_1899.svg" alt="Off-White X Air Jordan 5" />
                </div>
                <div class="product-item">
                    <img src="images/IMG_1899.svg" alt="Off-White X Air Jordan 5" />
                </div>
                <div class="product-item">
                    <img src="images/IMG_1899.svg" alt="Off-White X Air Jordan 5" />
                </div>
                <div class="product-item">
                    <img src="images/IMG_1899.svg" alt="Off-White X Air Jordan 5" />
                </div>
            </div>
        </section>
    </main>
<?php require_once "components/footer.php"; ?>
</body>
</html>
