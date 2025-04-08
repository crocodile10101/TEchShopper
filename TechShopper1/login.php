<?php
// Подключение к базе данных
$host = 'localhost';
$db = 'Techbd';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

// Установка кодировки соединения
$conn->set_charset("utf8mb4");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Поиск пользователя по имени и паролю (проверка будет простой строкой)
    $stmt = $conn->prepare("SELECT users.id, users.password, roles.role_name 
                            FROM users 
                            INNER JOIN roles ON users.role_id = roles.id 
                            WHERE users.username = ? AND users.password = ?");
    $stmt->bind_param("ss", $username, $password);  // Передаем имя и пароль как строку
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Если авторизация успешна, устанавливаем сессию
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $row['role_name'];

        // Если роль admin, перенаправляем на adminpanel.php
        if ($row['role_name'] == 'admin') {
            header("Location: adminpanel.php");
            exit;
        } else {
            echo "У вас нет доступа к административной панели.";
        }
    } else {
        echo "Неверный логин или пароль.";
    }
}
?>



<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        .login-container h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .login-container input[type="text"], 
        .login-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .login-container input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .login-container input[type="submit"]:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h1>Вход</h1>
        <form method="POST" action="login.php">
            <input type="text" name="username" placeholder="Логин" required>
            <input type="password" name="password" placeholder="Пароль" required>
            <input type="submit" value="Войти">
        </form>
    </div>
</body>
</html>
