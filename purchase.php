<?php
include 'db.php'; // Подключаем файл с настройками соединения с базой данных

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Проверяем, что запрос был отправлен методом POST
    $product_name = $_POST['product_name']; // Получаем имя товара из POST-запроса
    $quantity = $_POST['quantity']; // Получаем количество товара из POST-запроса

    // Получаем текущее количество товара на складе
    $sql = "SELECT quantity FROM products WHERE name = '$product_name'";
    $result = $conn->query($sql); // Выполняем запрос к базе данных

    if ($result->num_rows > 0) { // Проверяем, что товар с указанным именем существует
        $row = $result->fetch_assoc(); // Извлекаем данные о товаре
        $current_quantity = $row['quantity']; // Получаем текущее количество товара на складе

        // Проверяем, достаточно ли товара на складе для выполнения заказа
        if ($current_quantity >= $quantity) {
            $new_quantity = $current_quantity - $quantity; // Вычисляем новое количество товара
            $update_sql = "UPDATE products SET quantity = $new_quantity WHERE name = '$product_name'"; // Формируем запрос для обновления количества товара
            if ($conn->query($update_sql) === TRUE) { // Выполняем запрос на обновление
                echo "Покупка успешно завершена. Остаток на складе: " . $new_quantity; // Сообщаем об успешной покупке
            } else {
                echo "Ошибка обновления записи: " . $conn->error; // Сообщаем об ошибке при обновлении
            }
        } else {
            echo "Недостаточно товара на складе."; // Сообщаем, что товара недостаточно
        }
    } else {
        echo "Товар не найден."; // Сообщаем, что товар не найден
    }

    $conn->close(); // Закрываем соединение с базой данных
}
?>
