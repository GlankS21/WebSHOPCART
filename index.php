<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SHOPCART</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body class="main-page">
    <?php require_once "components/header.php"; ?>
    <div class="container">
        <div class="main-block">
            <h1>SHOPCART — ВЫГОДНАЯ МОДА</h1>
            <div class="categories">
                <div class="left-block">
                    <div class="category-item left">
                        <a href="clothes.html">
                            <img src="images/Frame 52.svg" alt="Одежда" class="category-image">
                        </a>
                        <p>Одежда</p>
                    </div>
                </div>
                <div class="right-block">
                    <div class="category-item right">
                        <a href="accessories.html">
                            <img src="images/Frame 53.svg" alt="Аксессуары" class="category-image">
                        </a>
                        <p>Аксессуары</p>
                    </div>
                    <div class="category-item right">
                        <a href="shoes.html">
                            <img src="images/Frame 54.svg" alt="Обувь" class="category-image">
                        </a>
                        <p>Обувь</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="collections-block">
            <h1>Коллекции</h1>
            <div class="collection-item">
                <a href="collections.html">
                <img src="images/Frame 55.svg" alt="Коллекция" class="collection-image">
                </a>
            </div>
        </div>
        <div class="collections-block">
            <h1>Бренды</h1>
            <div class="collection-item">
                <a href="brends.html">
                <img src="images/Frame 56.svg" alt="Бренды" class="collection-image">
                </a>
            </div>
        </div>
    </div>
    <?php require_once "components/footer.php"; ?>
</body>
</html>