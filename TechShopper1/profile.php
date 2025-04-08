<?php
// Страница профиля
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login-user.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechShopper - Профиль</title>
    <link rel="icon" href="./images/it_course_clicker_icon.png" type="image/x-icon">
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Основные стили для страницы профиля */
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(90deg, #f0f0f0, #d9d9d9);
            margin: 40px;
            padding: 0;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #007BFF;
        }
        h3 {
            margin-top: 20px;
            color: #555;
        }
        ul {
            list-style-type: none; /* Убираем маркеры списка */
            padding: 0;
        }
        li {
            background: #f9f9f9;
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1);
        }
        p {
            margin: 10px 0;
        }
        button {
            background-color: #007BFF;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin: 10px 5px;
        }
        button a {
            color: white;
            text-decoration: none; /* Убираем подчеркивание */
        }
        button:hover {
            background-color: #0056b3; /* Темнее при наведении */
        }
    </style>
</head>
<body>
<div class="spinner-wrapper">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <div class="container">
        <h2>Добро пожаловать, <?php echo $_SESSION['username']; ?>!</h2>
    </div>

    <?php

    // Подключение к базе данных
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "Techbd";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Проверка соединения с базой данных
    if ($conn->connect_error) {
        die("Ошибка подключения: " . $conn->connect_error);
    }

    // Получение user_id на основе username из сессии
    $query = "SELECT id FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("s", $_SESSION['username']);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user_id = $row['id'];

            // Извлекаем купленные курсы пользователя из таблицы purchased_courses
            $query = "SELECT courses.title, purchased_courses.price, purchased_courses.payment_time 
                      FROM purchased_courses 
                      JOIN courses ON purchased_courses.course_id = courses.id 
                      WHERE purchased_courses.buyer_id = ?";
            $stmt = $conn->prepare($query);

            if ($stmt) {
                $stmt->bind_param("i", $user_id);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result && $result->num_rows > 0) {
                    echo "<h3>Ваши купленные курсы:</h3>";
                    echo "<ul>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<li>Курс: " . htmlspecialchars($row['title']) . " — Цена: " . htmlspecialchars($row['price']) . " руб. — Оплачен: " . htmlspecialchars($row['payment_time']) . "</li>";
                    }
                    echo "</ul>";
                } else {
                    echo "<p>У вас пока нет купленных курсов.</p>";
                }
            } else {
                echo "<p>Ошибка подготовки запроса на получение купленных курсов.</p>";
            }

            // Извлекаем промокоды пользователя из таблицы promo_codes
            $query = "SELECT promo_code FROM promo_codes WHERE user_id = ?";
            $stmt = $conn->prepare($query);

            if ($stmt) {
                $stmt->bind_param("i", $user_id);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result && $result->num_rows > 0) {
                    echo "<h3>Ваши промокоды:</h3>";
                    echo "<ul>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<li>Промокод: " . htmlspecialchars($row['promo_code']) . "</li>";
                    }
                    echo "</ul>";
                } else {
                    echo "<p>У вас пока нет промокодов.</p>";
                }
            } else {
                echo "<p>Ошибка подготовки запроса на получение промокодов.</p>";
            }
        } else {
            echo "<p>Пользователь не найден.</p>";
        }
    } else {
        echo "<p>Ошибка подготовки запроса на получение пользователя.</p>";
    }

    // Закрытие соединения
    $stmt->close();
    $conn->close();
    ?>

    <div class="button-container">
        <button><a href="index.php">Назад</a></button>
        <button><a href="logout.php">Выйти из аккаунта</a></button>
    </div>
</body>
</html>
