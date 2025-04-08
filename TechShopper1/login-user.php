<!-- login.php -->
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechShopper</title>
    <link rel="icon" href="./images/it_course_clicker_icon.png" type="image/x-icon">
    <link rel="stylesheet" href="styles.css">
   
    <style>
        /* Основные стили для страницы авторизации */
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(90deg, #f0f0f0, #d9d9d9);
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #007BFF;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .form-control:focus {
            border-color: #007BFF;
            outline: none; /* Убираем обводку */
        }
        .btn {
            background-color: #007BFF;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            transition: background-color 0.3s ease; /* Плавный переход */
        }
        .btn:hover {
            background-color: #0056b3; /* Темнее при наведении */
        }
        p {
            text-align: center;
        }
        a {
            color: #007BFF;
            text-decoration: none; /* Убираем подчеркивание */
        }
        a:hover {
            text-decoration: underline; /* Подчеркивание при наведении */
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
        <h2>Авторизация</h2>
        <form action="loginpr.php" method="POST">
            <div class="form-group">
                <label for="username">Логин</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Пароль</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn">Войти</button>
        </form>
        <p>Нет аккаунта? <a href="register-user.php">Зарегистрироваться</a></p>
    </div>
</body>
</html>
