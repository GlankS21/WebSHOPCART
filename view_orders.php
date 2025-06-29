<?php
require_once "database/config.php"; 
$orders = []; 
$error_message = "";
$sql = "SELECT order_id, name, phone, region, city, street FROM orders ORDER BY order_id DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Список заказов</title>
    <link rel="stylesheet" href="styles/checkout.css" /> <style>
        .order-table-container {
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 1000px;
        }
        .order-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .order-table th, .order-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        .order-table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .order-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .order-table tr:hover {
            background-color: #f1f1f1;
        }
        .no-orders-message, .error-message {
            text-align: center;
            font-size: 1.1em;
            color: #555;
            margin-top: 30px;
        }
        .error-message {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <?php require_once "components/header.php"; ?>

    <main class="checkout-container">
        <h1 class="page-title">Список заказов</h1>

        <div class="order-table-container">
            <?php if (!empty($error_message)): ?>
                <p class="error-message"><?php echo $error_message; ?></p>
            <?php elseif (empty($orders)): ?>
                <p class="no-orders-message">На данный момент заказов нет.</p>
            <?php else: ?>
                <table class="order-table">
                    <thead>
                        <tr>
                            <th>Идентификатор заказа</th>
                            <th>Имя</th>
                            <th>Телефон</th>
                            <th>Регион доставки</th>
                            <th>Город доставки</th>
                            <th>Улица</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $order): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($order['order_id']); ?></td>
                                <td><?php echo htmlspecialchars($order['name']); ?></td>
                                <td><?php echo htmlspecialchars($order['phone']); ?></td>
                                <td><?php echo htmlspecialchars($order['region']); ?></td>
                                <td><?php echo htmlspecialchars($order['city']); ?></td>
                                <td><?php echo htmlspecialchars($order['street']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </main>

    <?php require_once "components/footer.php"; ?>
</body>
</html>