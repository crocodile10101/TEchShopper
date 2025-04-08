<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Techbd";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения с базой данных
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Получаем данные из формы
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Хеширование пароля для безопасности
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Подготовка запроса для вызова хранимой процедуры
    $stmt = $conn->prepare("CALL RegisterUser(?, ?, ?)");

    if ($stmt === false) {
        die("Ошибка подготовки запроса: " . htmlspecialchars($conn->error));
    }

    // Привязываем параметры
    $stmt->bind_param("sss", $username, $email, $hashed_password);

    // Выполняем запрос
    try {
        if ($stmt->execute()) {
            // Перенаправляем на страницу авторизации после успешной регистрации
            header('Location: login-user.php');
            exit;
        }
    } catch (mysqli_sql_exception $e) {
        // Обработка ошибок, если пользователь с таким именем уже существует
        if ($e->getCode() == 45000) {
            echo "<p>Ошибка: Пользователь с таким именем уже существует.</p>";
            header('Location: register-user.php');

        } else {
            echo "<p>Ошибка: " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    }

    // Закрытие запроса и соединения
    $stmt->close();
}

$conn->close();
?>

