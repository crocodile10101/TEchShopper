<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Techbd";

$conn = new mysqli($servername, $username, $password, $dbname);
session_start();

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

if (!isset($_SESSION['username'])) {
    die(json_encode(['error' => 'Пользователь не авторизован']));
}

$username = $_SESSION['username'];

// Получение user_id по username
$query = "SELECT id FROM users WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);

if (!$stmt->execute()) {
    die(json_encode(['error' => 'Ошибка выполнения запроса: ' . $stmt->error]));
}

$result = $stmt->get_result();
$user_id = null;

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user_id = $row['id'];
} else {
    die(json_encode(['error' => 'Пользователь не найден']));
}

// Получение последнего промокода для пользователя
$query = "SELECT promo_code FROM promo_codes WHERE user_id = ? ORDER BY id DESC LIMIT 1";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);

if (!$stmt->execute()) {
    die(json_encode(['error' => 'Ошибка выполнения запроса: ' . $stmt->error]));
}

$result = $stmt->get_result();
$promo_code = null;

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $promo_code = $row['promo_code'];
}

$stmt->close();
$conn->close();

// Возвращаем промокод в формате JSON
echo json_encode(['promo_code' => $promo_code]);
?>
