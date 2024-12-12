<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shop";

// Создаем соединение с базой данных
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверяем соединение на наличие ошибок
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); // Если есть ошибка, выводим сообщение и прекращаем выполнение
}
?>
