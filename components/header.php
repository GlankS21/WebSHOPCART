<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<header>
    <div class="top-level">
        <div class="mobile-menu">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="sub-mobile-menu">
            <ul class="menu-mb">
                <li><a href="clothes.php" class="<?php echo ($currentPage == 'clothes.php') ? 'current-page' : ''; ?>">Одежда</a></li>
                <li><a href="shoes.php" class="<?php echo ($currentPage == 'shoes.php') ? 'current-page' : ''; ?>">Обувь</a></li>
                <li><a href="accessories.php" class="<?php echo ($currentPage == 'accessories.php') ? 'current-page' : ''; ?>">Аксессуары</a></li>
                <li><a href="collections.php" class="<?php echo ($currentPage == 'collections.php') ? 'current-page' : ''; ?>">Коллекции</a></li>
                <li><a href="brends.php" class="<?php echo ($currentPage == 'brends.php') ? 'current-page' : ''; ?>">Бренды</a></li>
                <li><a href="about.php" class="<?php echo ($currentPage == 'about.php') ? 'current-page' : ''; ?>">О магазине</a></li>
            </ul>
        </div>
        <h1>SHOPCART</h1>
        <div class="icons">
            <a href="favourites.php">
                <img src="images/11-119407_font-awesome-heart-icon 1.svg" alt="Избранное" class="icon">
            </a>
            <a href="cart.php">
                <img src="images/i-Photoroom.svg" alt="Корзина" class="icon">
            </a>
        </div>
    </div>
    <div class="bottom-level">
        <nav>
            <ul>
                <li><a href="clothes.php" class="<?php echo ($currentPage == 'clothes.php') ? 'current-page' : ''; ?>">Одежда</a></li>
                <li><a href="shoes.php" class="<?php echo ($currentPage == 'shoes.php') ? 'current-page' : ''; ?>">Обувь</a></li>
                <li><a href="accessories.php" class="<?php echo ($currentPage == 'accessories.php') ? 'current-page' : ''; ?>">Аксессуары</a></li>
                <li><a href="collections.php" class="<?php echo ($currentPage == 'collections.php') ? 'current-page' : ''; ?>">Коллекции</a></li>
                <li><a href="brends.php" class="<?php echo ($currentPage == 'brends.php') ? 'current-page' : ''; ?>">Бренды</a></li>
                <li><a href="about.php" class="<?php echo ($currentPage == 'about.php') ? 'current-page' : ''; ?>">О магазине</a></li>
            </ul>
        </nav>
        <div class="search">
            <label for="search-input" class="visually-hidden"></label>
            <input id="search-input" type="text" placeholder="Поиск" aria-label="Поиск по сайту">
        </div>
    </div>
</header>