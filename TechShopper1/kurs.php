<?php
// Подключение к базе данных
$servername = "localhost";
$username = "root"; // Ваше имя пользователя
$password = ""; // Ваш пароль
$dbname = "Techbd"; // Название вашей базы данных

$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получение курсов из базы данных (теперь с присоединенной таблицей category)
$sql = "SELECT courses.id, courses.title, courses.description, courses.price, courses.duration, category.name AS category_name, courses.image_url 
        FROM courses 
        INNER JOIN category ON courses.category_id = category.id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechShopper</title>
    <link rel="stylesheet" href="./styles/spiner.css">
    <link rel="stylesheet" href="./styles/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script defer src="./spiner.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <link rel="icon" href="./images/it_course_clicker_icon.png" type="image/x-icon">
    <style>
        .containerg {
            display: flex;
            background-color: #fff;
            width: 100%;
        }
        .filters {
            width: 25%;
            padding: 20px;
            border-right: 1px solid #ddd;
            background-color: #f9f9f9;
        }
        .courses {
            width: 75%;
            display: flex;
            flex-wrap: wrap;
            padding: 20px;
        }
        .course-card {
            width: 30%;
            border: 1px solid #ddd;
            margin: 10px;
            padding: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 5px;
            transition: transform 0.2s;
        }
        .course-card:hover {
            transform: scale(1.05);
        }
        .course-card img {
            width: 100%;
            height: auto;
        }
        .price-range, .duration-range {
            margin: 15px 0;
        }
    </style>
</head>
<body>
<div class="spinner-wrapper">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <div class="content">
        <?php require 'headerpages.php' ?>
        <?php require 'cont_top.php' ?>

        <div class="containerg">
            <div class="filters">
                <h3>Фильтры</h3>
                <form id="filter-form">
                    <label for="category">Категория:</label>
                    <div class="categories mb-3">
                        <label><input type="radio" name="category" value="all" checked> Все категории</label><br>
                        <label><input type="radio" name="category" value="Программирование"> Программирование</label><br>
                        <label><input type="radio" name="category" value="Тестирование"> Тестирование</label><br>
                        <label><input type="radio" name="category" value="Кибербезопасность"> Кибербезопасность</label><br>
                        <label><input type="radio" name="category" value="Детские курсы"> Детские курсы</label><br>
                    </div>

                    <div class="price-range mb-3">
                        <label for="price">Цена:</label>
                        <div class="price-values">
                            <span id="price-min">0</span> <span id="price-max">100000</span>
                        </div>
                        <input type="range" id="price" name="price" min="0" max="100000" value="50000" step="1000">
                    </div>

                    <div class="duration-range mb-3">
                        <label for="duration">Длительность (месяцев):</label>
                        <div class="duration-values">
                            <span id="duration-min">0</span> <span id="duration-max">24</span>
                        </div>
                        <input type="range" id="duration" name="duration" min="0" max="24" value="12" step="1">
                    </div>

                    <button type="button" id="apply-filters" class="btn btn-primary">Применить фильтры</button>
                </form>
            </div>

           <div class="courses" id="courses">
           <?php
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<div class="course-card" data-id="' . $row["id"] . '" data-category="' . $row["category_name"] . '" data-price="' . $row["price"] . '" data-duration="' . $row["duration"] . '">';
        echo '<img src="' . $row["image_url"] . '" alt="Course Image">';
        echo '<h4>' . $row["title"] . '</h4>';
        echo '<p>' . $row["description"] . '</p>';
        echo '<p>Категория: ' . $row["category_name"] . '</p>';
        echo '<p>Цена: ' . $row["price"] . ' руб.</p>';
        echo '<p>Длительность: ' . $row["duration"] . ' месяцев</p>';
        echo '</div>';
    }
}
                ?>
            </div>
        </div>

        <?php require 'footerpages.php' ?>
    </div>
    <script>
document.querySelectorAll('.course-card').forEach(card => {
    card.addEventListener('click', function() {
        const courseId = this.getAttribute('data-id');
        <?php if (isset($_SESSION['username'])) { ?>
            window.location.href = 'payment.php?course_id=' + courseId;
        <?php } else { ?>
            window.location.href = 'login-user.php';
        <?php } ?>
    });
});
</script>
    <script>


// Логика для обновления значений ползунка цены
const priceRange = document.getElementById('price');
const priceMin = document.getElementById('price-min');
const priceMax = document.getElementById('price-max');

priceRange.addEventListener('input', function() {
    priceMax.textContent = priceRange.value;
});

// Логика для обновления значений ползунка длительности
const durationRange = document.getElementById('duration');
const durationMin = document.getElementById('duration-min');
const durationMax = document.getElementById('duration-max');

durationRange.addEventListener('input', function() {
    durationMax.textContent = durationRange.value;
});

// Обработчик клика
document.getElementById('apply-filters').addEventListener('click', function() {
    const selectedCategory = document.querySelector('input[name="category"]:checked').value;
    const maxPrice = parseInt(priceRange.value);
    const maxDuration = parseInt(durationRange.value);
    const courses = document.querySelectorAll('.course-card');

    courses.forEach(course => {
        const courseCategory = course.getAttribute('data-category');
        const coursePrice = parseInt(course.getAttribute('data-price'));
        const courseDuration = parseInt(course.getAttribute('data-duration'));

        const categoryMatch = (selectedCategory === 'all' || courseCategory === selectedCategory);
        const priceMatch = (coursePrice <= maxPrice);
        const durationMatch = (courseDuration <= maxDuration);

        if (categoryMatch && priceMatch && durationMatch) {
            course.style.display = 'block';
        } else {
            course.style.display = 'none';
        }
    });
});
    </script>
</body>
</html>

<?php
$conn->close();
?>
