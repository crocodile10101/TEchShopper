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
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script defer src="./spiner.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<link rel="icon" href="./images/it_course_clicker_icon.png" type="image/x-icon">
</head>
<body>
<div class="content">
<?php require 'headerpages.php' ?>
<?php require 'cont_top.php' ?>


<!-- Основной блок страницы -->
<section class="hero">
        <div class="hero-content">
            <h1>IT Курсы для Детей - Обучение Будущему!</h1>
            <p>Ваш ребенок может освоить программирование, дизайн и многое другое в увлекательной игровой форме!</p>
            <a href="#courses" class="cta-button">Посмотреть Курсы</a>
        </div>
    </section>

    <!-- Блок с курсами -->
    <section id="courses" class="courses-section">
        <h2>Наши Курсы</h2>
        <div class="courses-grid">
            <div class="course-card">
                <img src="https://cdn.prod.website-files.com/63fda77e5fd49598bbf00892/641613cf5c47c8d229d4e26f_%D0%A1%D0%BA%D1%80%D0%B8%D0%BD%D1%88%D0%BE%D1%82%2018-03-2023%20234020.jpg" alt="Курс Программирования для детей">
                <h3>Программирование для детей</h3>
                <p>Основы программирования для самых маленьких. Игровая форма и увлекательные задания.</p>
                <a href="kurs.php" class="cta-button">Подробнее</a>
            </div>
            <div class="course-card">
                <img src="https://cdn-user84060.skyeng.ru/uploads/635b7de1748f7617229106.png" alt="Курс Дизайна для детей">
                <h3>Дизайн и анимация</h3>
                <p>Ваш ребенок научится создавать графику и анимации с нуля.</p>
                <a href="kurs.php" class="cta-button">Подробнее</a>
            </div>
            <div class="course-card">
                <img src="https://cdn-user84060.skyeng.ru/uploads/62ac49f54b045396720751.png" alt="Курс Робототехники для детей">
                <h3>Робототехника</h3>
                <p>Увлекательные уроки по созданию и программированию роботов для детей.</p>
                <a href="kurs.php" class="cta-button">Подробнее</a>
            </div>
        </div>
    </section>

    <div class="spinner-wrapper">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

   <!-- Блок отзывов родителей с каруселью -->
<section class="testimonials-section">
    <h2>Что говорят родители</h2>
    <div class="testimonials-carousel">
        <div class="testimonial active">
            <p>“Мой сын с нетерпением ждет каждого занятия по программированию! Курсы вдохновили его на создание собственных проектов.”</p>
            <p class="author">- Ольга, мама 9-летнего Ивана</p>
        </div>
        <div class="testimonial">
            <p>“Уроки по дизайну помогли моей дочке раскрыть творческий потенциал. Теперь она рисует на компьютере и создает свои первые анимации.”</p>
            <p class="author">- Анна, мама 11-летней Лизы</p>
        </div>
        <div class="testimonial">
            <p>“Мы с мужем довольны курсами робототехники. Наш сын стал интересоваться технологиями, и это отлично мотивирует его учиться.”</p>
            <p class="author">- Наталья, мама 10-летнего Максима</p>
        </div>
    </div>
    <div class="carousel-controls">
        <button id="prev-testimonial" class="control-btn">&lt;</button>
        <button id="next-testimonial" class="control-btn">&gt;</button>
    </div>
</section>

<Script>
    // JavaScript для карусели отзывов
const testimonials = document.querySelectorAll('.testimonial');
let currentIndex = 0;

document.getElementById('next-testimonial').addEventListener('click', () => {
    testimonials[currentIndex].classList.remove('active');
    currentIndex = (currentIndex + 1) % testimonials.length;
    testimonials[currentIndex].classList.add('active');
});

document.getElementById('prev-testimonial').addEventListener('click', () => {
    testimonials[currentIndex].classList.remove('active');
    currentIndex = (currentIndex - 1 + testimonials.length) % testimonials.length;
    testimonials[currentIndex].classList.add('active');
});

</Script>

    <!-- Призыв к действию -->
    <section class="cta-section">
        <h2>Готовы начать обучение?</h2>
        <p>Присоединяйтесь к нашему сообществу юных программистов и дизайнеров уже сегодня!</p>
        <a href="#" class="cta-button">Записаться на курс</a>
    </section>




<?php require 'footerpages.php' ?>
</div>
</body>
</html>

<style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Arial', sans-serif;
    background-color: #f0f8ff;
    color: #333;
    line-height: 1.6;
}

/* Hero section */
.hero {
    background-image: url(https://s1.stc.all.kpcdn.net/putevoditel/projectid_379258/images/tild3338-6663-4964-b861-343030336437__shutterstock_1769673.jpg);
    background-size: 100%;
    height: 60vh;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    font-size: 30px;
    color: white;
    padding: 20px;
}

.hero-content h1 {
    font-size: 2.5rem;
}

.hero-content p {
    font-size: 1.2rem;
    margin: 15px 0;
}

.cta-button {
    background-color: #ff5722;
    color: white;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}
h2{
    color:White;
}

.cta-button:hover {
    background-color: #e64a19;
}

/* Courses section */
.courses-section {
    padding: 50px 20px;
    text-align: center;
}

.courses-section h2 {
    font-size: 2rem;
    margin-bottom: 30px;
}

.courses-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
}

.course-card {
    background-color: white;
    border: 1px solid #ddd;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.course-card img {
    max-width: 100%;
    border-radius: 10px;
}

.course-card h3 {
    font-size: 1.5rem;
    margin: 15px 0;
}

.course-card p {
    font-size: 1rem;
    color: #666;
}

.testimonials-section {
    background-color: #f7f7f7;
    padding: 50px 20px;
    text-align: center;
}

.testimonials-section h2 {
    font-size: 2rem;
    margin-bottom: 30px;
}

.testimonial {
    margin-bottom: 20px;
}

.cta-section {
    background-image: url( https://storage.yandexcloud.net/maximumtest-roditeli/poster/%D0%A0%D0%B5%D0%B1%D1%91%D0%BD%D0%BE%D0%BA_%D0%B2_%D0%B0%D0%B9%D1%82%D0%B8-03860.webp);
    background-size: 100%;
    height:400px ;
    text-align: center;
    padding: 50px 20px;
}

.cta-section h2 {
    font-size: 2rem;
    margin-bottom: 20px;
}

.cta-section p {
    font-size: 1.2rem;
    margin-bottom: 30px;
}

.testimonials-section {
    background-color: #f7f7f7;
    padding: 50px 20px;
    text-align: center;
    position: relative;
}

.testimonials-section h2 {
    font-size: 2.5rem;
    margin-bottom: 40px;
    color: #333;
}

.testimonials-carousel {
    max-width: 600px;
    margin: 0 auto;
    position: relative;
}

.testimonial {
    display: none;
    font-size: 1.2rem;
    color: #555;
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    transition: opacity 0.5s ease;
}

.testimonial.active {
    display: block;
    opacity: 1;
}

.testimonial p {
    margin-bottom: 10px;
}

.author {
    font-weight: bold;
    color: #ff5722;
}

.carousel-controls {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.control-btn {
    background-color: #ff5722;
    border: none;
    color: white;
    width: 80px;
    padding: 15px;
    margin: 0 20px;
    cursor: pointer;
    border-radius: 30%;
    font-size: 1.2rem;
    transition: background-color 0.3s ease;
}

.control-btn:hover {
    background-color: #e64a19;
}


</style>