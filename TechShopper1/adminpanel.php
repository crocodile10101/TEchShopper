<?php
// admin.php
$servername = "localhost";
$username = "root"; // ваш логин
$password = ""; // ваш пароль
$dbname = "Techbd";

session_start();

// Проверка, авторизован ли пользователь и является ли он администратором
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

echo "Добро пожаловать в админ панель, " . $_SESSION['username'];

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Функции для получения данных
function fetchContactRequests($conn) {
    return $conn->query("SELECT * FROM contact_requests");
}

function fetchCourses($conn) {
    return $conn->query("SELECT * FROM courses");
}

function fetchPromoCodes($conn) {
    return $conn->query("SELECT * FROM promo_codes");
}

// Получение данных
$contact_requests = fetchContactRequests($conn);
$courses = fetchCourses($conn);
$promo_codes = fetchPromoCodes($conn);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Админ Панель</title>
</head>
<body>
<div class="spinner-wrapper">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <h1>Запросы на контакты</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Имя</th>
            <th>Телефон</th>
            <th>Email</th>
            <th>Создано</th>
            <th>Действия</th>
        </tr>
        <?php while($row = $contact_requests->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['phone'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['created'] ?></td>
                <td>
                    <a href="edit_contact.php?id=<?= $row['id'] ?>">Редактировать</a>
                    <a href="delete_contact.php?id=<?= $row['id'] ?>">Удалить</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <h1>Курсы</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Название</th>
            <th>Описание</th>
            <th>Цена</th>
            <th>Длительность</th>
            <th>Категория</th>
            <th>Изображение</th>
            <th>URL</th>
            <th>Действия</th>
        </tr>
        <?php while($row = $courses->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['title'] ?></td>
                <td><?= $row['description'] ?></td>
                <td><?= $row['price'] ?></td>
                <td><?= $row['duration'] ?></td>
                <td><?= $row['category'] ?></td>
                <td><img src="<?= $row['image'] ?>" alt="<?= $row['title'] ?>" width="50"></td>
                <td><?= $row['url'] ?></td>
                <td>
                    <a href="edit_course.php?id=<?= $row['id'] ?>">Редактировать</a>
                    <a href="delete_course.php?id=<?= $row['id'] ?>">Удалить</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <h1>Промокоды</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Код</th>
            <th>Действия</th>
        </tr>
        <?php while($row = $promo_codes->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['code'] ?></td>
                <td>
                    <a href="edit_promo_code.php?id=<?= $row['id'] ?>">Редактировать</a>
                    <a href="delete_promo_code.php?id=<?= $row['id'] ?>">Удалить</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
