<?php
session_start(); // Начало сессии для сохранения информации о пользователе

// Подключение к базе данных
$host = 'localhost'; // Ваш хост
$db   = 'Techbd'; // Название вашей базы данных
$user = 'root'; // Ваше имя пользователя
$pass = ''; // Ваш пароль

// Создание подключения
$conn = new mysqli($host, $user, $pass, $db);

// Проверка соединения
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Проверка отправленных данных
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Подготовка SQL-запроса для поиска пользователя
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Если пользователь найден, получаем пароль
        $stmt->bind_result($stored_password);
        $stmt->fetch();

        // Проверяем введенный пароль
        if ($password === $stored_password) {
            // Если пароль верный, сохраняем информацию о пользователе в сессии
            $_SESSION['username'] = $username;
            header("Location: profile.php"); // Перенаправляем на страницу профиля
            exit();
        } else {
            // Неверный пароль
            echo "<p>Неверный пароль!</p>";
        }
    } else {
        // Пользователь не найден
        echo "<p>Пользователь не найден!</p>";
    }

    $stmt->close();
}

$conn->close();
?>