<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Techbd";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login-user.php');
    exit;
}

// Получаем данные пользователя
$username = $_SESSION['username'];
$query = "SELECT id FROM users WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $user_id = $user['id'];
} else {
    echo "Пользователь не найден.";
    exit();
}

// Получаем ID курса из запроса
if (isset($_GET['course_id']) && is_numeric($_GET['course_id'])) {
    $course_id = intval($_GET['course_id']);  // Приведение к числу для безопасности
} else {
    echo "Некорректный идентификатор курса.";
    exit();
}

// Проверяем, существует ли курс с таким ID
$sql = "SELECT * FROM courses WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $course_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $course = $result->fetch_assoc();
    $course_title = $course['title'];
    $course_price = $course['price'];
} else {
    echo "Курс не найден.";
    exit();
}

// Обработка промокода (если введен)
$discount = 0;
$promo_code = null;
$final_price = $course_price; // Изначальная цена курса

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['promo_code']) && !empty($_POST['promo_code'])) {
    $promo_code = $_POST['promo_code'];

    // Проверяем промокод в базе данных
    $sql = "SELECT * FROM promo_codes WHERE promo_code = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $promo_code);
    $stmt->execute();
    $promo_result = $stmt->get_result();

    if ($promo_result->num_rows > 0) {
        // Промокод верен, скидка 20%
        $discount = 0.20;
        $final_price = $course_price * (1 - $discount); // Применяем скидку
        echo "<p style='color: green;'>Промокод применён! Скидка 20%. Новая цена: " . number_format($final_price, 2) . " руб.</p>";
    } else {
        echo "<p style='color: red;'>Некорректный промокод.</p>";
    }
}

// Обработка клика на "Оплатить"
if (isset($_POST['pay']) && $_POST['pay'] == '1') {
    // Проверяем, купил ли пользователь уже этот курс
    $check_purchase_sql = "SELECT * FROM purchased_courses WHERE buyer_id = ? AND course_id = ?";
    $check_stmt = $conn->prepare($check_purchase_sql);
    $check_stmt->bind_param("ii", $user_id, $course_id);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        echo "<p style='color: red;'>Вы уже приобрели этот курс!</p>";
    } else {
        // Время оплаты
        $payment_time = date('Y-m-d H:i:s');

        // Генерация PDF-квитанции (для примера, здесь оставим пустым)
        $pdf_receipt = null; // Или путь к реальной квитанции, если вы создаете ее

        // Добавляем запись о покупке курса в таблицу purchased_courses
        $sql = "INSERT INTO purchased_courses (buyer_id, course_id, price, payment_time, pdf_receipt) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        // Используем обновленную цену после применения промокода
        $price_paid = number_format($final_price, 2, '.', ''); // Форматируем цену для хранения в БД
        $stmt->bind_param("iisss", $user_id, $course_id, $price_paid, $payment_time, $pdf_receipt);

        if ($stmt->execute()) {
            echo "<p>Оплата прошла успешно! Курс добавлен в ваш аккаунт.</p>";

            // Если использован промокод, отмечаем его как использованный
            if ($discount > 0) {
                // Здесь вы можете отметить промокод как использованный, если это необходимо
            }

            // Перенаправляем на страницу профиля
            header('Location: profile.php');
            exit();
        } else {
            echo "<p>Ошибка при записи покупки.</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Оплата курса</title>
    <style>
        /* Основные стили для страницы */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Контейнер для оплаты */
        .payment-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 500px;
            width: 100%;
            text-align: center;
        }

        /* Заголовок курса */
        .payment-container h1 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #333;
        }

        /* Цена курса */
        .payment-container .price {
            font-size: 22px;
            color: #4CAF50;
            margin-bottom: 20px;
        }

        /* Поле для ввода промокода */
        .payment-container input[type="text"] {
            padding: 10px;
            font-size: 16px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 80%;
            text-align: center;
        }

        /* Кнопки */
        .payment-container a, .payment-container input[type="submit"] {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 12px 24px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 18px;
            transition: background-color 0.3s;
            cursor: pointer;
        }

        .payment-container input[type="submit"]:hover {
            background-color: rgb(112, 47, 244);
        }

        /* Информация о курсе */
        .payment-container p {
            color: #666;
            margin-bottom: 20px;
        }

        /* Адаптивность */
        @media (max-width: 600px) {
            .payment-container {
                max-width: 90%;
                padding: 20px;
            }
        }
    </style>
</head>
<body>
<div class="spinner-wrapper">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <div class="payment-container">
        <h1>Оплата курса: <?php echo htmlspecialchars($course_title); ?></h1>
        <p class="price">Цена: <?php echo number_format($final_price, 2); ?> руб.</p>

        <!-- Форма для ввода промокода и оплаты -->
        <form method="POST">
            <input type="text" name="promo_code" placeholder="Введите промокод (опционально)" value="<?php echo isset($promo_code) ? htmlspecialchars($promo_code) : ''; ?>">
            <input type="hidden" name="pay" value="1">
            <input type="submit" value="Оплатить">
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>
