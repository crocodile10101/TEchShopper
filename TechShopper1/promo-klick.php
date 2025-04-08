<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Techbd";

// Подключение к базе данных
$conn = new mysqli($servername, $username, $password, $dbname);
session_start(); // Начало сессии

// Проверка на наличие ошибок подключения
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Проверка, авторизован ли пользователь
if (!isset($_SESSION['username'])) {
    header('Location: login-user.php'); // Перенаправление на страницу входа
    exit;
}

// Получение username из сессии
$username = $_SESSION['username'];

// Получение user_id на основе username
$query = "SELECT id, promo_code_status FROM users WHERE username = ?";
$stmt = $conn->prepare($query);

if ($stmt === false) {
    die("Ошибка подготовки запроса: " . htmlspecialchars($conn->error));
}

$stmt->bind_param("s", $username);

if (!$stmt->execute()) {
    die("Ошибка выполнения запроса: " . $stmt->error);
}

// Получаем результат
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    die("Пользователь не найден");
}

$row = $result->fetch_assoc();
$user_id = $row['id'];
$promo_code_status = $row['promo_code_status'];

$stmt->close(); // Закрываем предыдущее подготовленное выражение

$message = ""; // Переменная для сообщения

if ($promo_code_status === 1) {
    // Если статус промокода равен 1, пользователю уже был выдан промокод
    $message = "Вы уже получили промокод✔️ можете использовать его в своем профиле. <a href='profile.php' class='button'>Перейти в профиль</a>";
} else {
    // Вызов хранимой процедуры для генерации промокода
    $query = "CALL GeneratePromoCode(?)";
    $stmt = $conn->prepare($query);

    if ($stmt === false) {
        die("Ошибка подготовки запроса: " . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("i", $user_id);

    if (!$stmt->execute()) {
        die("Ошибка выполнения процедуры GeneratePromoCode: " . $stmt->error);
    }

    // Обновление статуса получения промокода на 1
    $update_query = "UPDATE users SET promo_code_status = 1 WHERE id = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("i", $user_id);
    $update_stmt->execute();

    // Закрытие соединения
    $stmt->close();
    $update_stmt->close();
    $conn->close();


}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechShopper</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="./images/it_course_clicker_icon.png" type="image/x-icon">
    <style>
        /* Добавляем стили для контейнера сообщений */
        .message-container {
            position: fixed; /* Фиксированное положение */
            top: 0; /* Прикрепляем к верхней части окна */
            left: 50%; /* Центрируем по горизонтали */
            transform: translateX(-50%); /* Сдвигаем влево на 50% ширины для центрирования */
            background-color: rgba(255, 255, 255, 0.9); /* Полупрозрачный белый фон */
            color: #333; /* Цвет текста */
            padding: 10px 20px; /* Отступы */
            border-radius: 5px; /* Закругленные углы */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Тень для глубины */
            z-index: 1000; /* Убедимся, что сообщение сверху других элементов */
            display: none; /* Скрываем по умолчанию */
        }

        /* Стиль для кнопки */
        .button {
            display: inline-block;
            padding: 10px 15px;
            margin-top: 10px;
            color: white;
            background-color: #007BFF; /* Синий фон */
            border: none;
            border-radius: 5px;
            text-decoration: none; /* Убираем подчеркивание */
            font-weight: bold;
        }

        .button:hover {
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
    <div class="message-container" id="message-container"></div>
    
    <div class="clicker-container">
        <img src="./images/it_course_clicker_icon.png" width="1000px" alt="Кликер" id="clicker-icon" class="clicker-icon">
        <p><span id="click-counter">0</span></p>
    </div>

    <div id="promo-modal" class="modal">
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <p>Ваш промокод: <span id="promo-code"></span></p>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const messageContainer = document.getElementById('message-container');
            messageContainer.innerHTML = "<?php echo addslashes($message); ?>"; // Установите сообщение
            if (messageContainer.innerHTML) {
                messageContainer.style.display = 'block'; // Показываем контейнер
            }

            let clickCount = 0;
            const clickerIcon = document.getElementById("clicker-icon");
            const clickCounter = document.getElementById("click-counter");
            const promoModal = document.getElementById("promo-modal");
            const promoCodeElement = document.getElementById("promo-code");
            const closeModal = document.querySelector(".close-btn");

            // Функция для отображения промокода
            function showPromoCode(promoCode) {
                promoCodeElement.textContent = promoCode;
                promoModal.style.display = "flex";
                navigator.clipboard.writeText(promoCode)
                    .then(() => {
                        alert('Промокод скопирован в буфер обмена: ' + promoCode);
                    })
                    .catch(err => {
                        alert('Не удалось скопировать промокод в буфер обмена.');
                    });
            }

            // Обработка клика по иконке
            clickerIcon.addEventListener("click", function() {
                clickCount++;
                clickCounter.textContent = clickCount;
                if (Math.random() < 0.05) {  // Вероятность 5%
                    fetchPromoCode();  // Получаем промокод
                }
            });

            // Закрытие модального окна
            closeModal.addEventListener("click", function() {
                promoModal.style.display = "none";
            });

            // Закрытие модального окна при клике вне его
            window.addEventListener("click", function(event) {
                if (event.target === promoModal) {
                    promoModal.style.display = "none";
                }
            });
        });

        // Функция для получения промокода через AJAX
        function fetchPromoCode() {
            console.log('Попытка загрузки промокода');
            fetch('fetch_promos.php') // Здесь должен быть скрипт для получения промокода
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Ошибка сети: ' + response.status);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.promo_code) {
                        showPromoCode(data.promo_code); // Показ промокода
                    } else {
                        alert('Промокод не найден');
                    }
                })
                .catch(error => {
                    console.error('Ошибка загрузки промокода:', error);
                    alert('Промокод находится в профиле)');
                    window.location.href = 'index.php';
                });
        }
    </script>

    <style>
        /* Ваши стили здесь */
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: linear-gradient(90deg, #480bf0, #7759f9, #a08ffd);
        }

        .clicker-container {
            text-align: center;
            font-size: 60px;
            color: white;
        }

        .clicker-icon {
            width: 400px;
            cursor: pointer;
        }

        #promo-modal {
            display: none;
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 20px;
            cursor: pointer;
            font-size: 20px;
        }

        #fireworks-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 9999;
        }

        .firework-pixel {
            position: absolute;
            width: 10px;
            height: 10px;
            background-color: red;
            border-radius: 50%;
            animation: explode 1s ease-out forwards;
        }

        @keyframes explode {
            from {
                transform: scale(1);
                opacity: 1;
            }
            to {
                transform: scale(0.5) translate(var(--x), var(--y));
                opacity: 0;
            }
        }
    </style>
</body>
</html>
