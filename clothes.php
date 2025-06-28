<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SHOPCART - Одежда</title>
    <link rel="stylesheet" href="styles/clothes.css">
</head>
<body class="main-page">
    <?php require_once "components/header.php"; ?>
    <main>
        <section class="products">
            <div class="products-header">
                <h2 class="products-title">Одежда</h2>
                <div class="filter-dropdown">
                    <button class="filter-toggle">
                        <span>Показать фильтр</span>
                        <img src="images/Vector.png" alt="" class="toggle-icon">
                    </button>
                    <ul class="filter-options">
                        <li><a href="?sort=popular" data-value="popular">Популярные</a></li>
                        <li><a href="?sort=cheaper" data-value="cheaper">Дешевле</a></li>
                        <li><a href="?sort=dearer" data-value="dearer">Дороже</a></li>
                    </ul>
                </div>
            </div>
            <div class="product-list">
                <?php 
                require_once "database/config.php";
                $orderBy = "";
                if (isset($_GET['sort'])) {
                    $sort = $_GET['sort'];
                    switch ($sort) {
                        case 'cheaper':
                            $orderBy = "ORDER BY price ASC";
                            break;
                        case 'dearer':
                            $orderBy = "ORDER BY price DESC";
                            break;
                        case 'popular':
                        default:
                            $orderBy = "ORDER BY clothes_id DESC"; 
                            break;
                    }
                } else {
                    $orderBy = "ORDER BY clothes_id DESC";
                }
                $sql = "SELECT clothes_id, name, price, image FROM clothes " . $orderBy;
                $stmt = $conn->query($sql); 
                if ($stmt->rowCount() > 0) {
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo '<div class="product-item" onclick="window.location.href=\'productcard.php?id=' . $row["clothes_id"] . '\'">';
                        echo '<img src="images/' . htmlspecialchars($row["image"]) . '" alt="' . htmlspecialchars($row["name"]) . '" />';
                        echo '<p>' . htmlspecialchars($row["name"]) . '</p>';
                        echo '<p class="price">от ' . number_format($row["price"], 0, ',', ' ') . ' ₽</p>';
                        echo '</div>';
                    }
                } else {
                    echo "<p>Нет товаров в категории 'Одежда'.</p>";
                }
                $conn = null; 
                ?>
            </div>
        </section>
    </main>
    <?php require_once "components/footer.php"; ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterToggle = document.querySelector('.filter-toggle');
            const filterOptions = document.querySelector('.filter-options');
            if (filterToggle && filterOptions) {
                filterToggle.addEventListener('click', function() {
                    filterOptions.classList.toggle('active'); 
                });
                document.addEventListener('click', function(event) {
                    if (!filterToggle.contains(event.target) && !filterOptions.contains(event.target)) {
                        filterOptions.classList.remove('active');
                    }
                });
            }
        });
    </script>
</body>
</html>