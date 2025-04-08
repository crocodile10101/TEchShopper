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
<?php require 'cont_top.php' ?>
<div class="spinner-wrapper">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden"></span>
        </div>
    </div>
    <header>
    <div class="logo">
      <h1>TechShopper Медиа</h1>
    </div>
    <div class="nav-links">
      <a href="kurs.php">Онлайн-курсы</a>
      <a href="index.php">Главная TechShopper</a>
    </div>
  </header>

  <main>
  <aside>
  <ul class="sidebar">
    <li><a href="#" data-category="Все">Все 🌐</a></li>                                 
    <li><a href="#" data-category="history">История 📜</a></li>
    <li><a href="#" data-category="design">Дизайн 🎨</a></li>
    <li><a href="#" data-category="kod">Код 💻</a></li>
    <li><a href="#" data-category="game">Гейминг 🎮</a></li>
    <li><a href="#" data-category="business">Бизнес 📈</a></li>
    <li><a href="#" data-category="Маркетинг">Маркетинг 📊</a></li>
    <!-- Добавь больше категорий по необходимости -->
  </ul>
</aside>

    <section class="content">
      <div class="featured-article">
        <img src="images\QR-code_url_21_Sep_2024_21-21-5.svg" alt="Изображение статьи">
        <div class="article-info">
          <h2>Мы создали телеграмм бота для оплаты!</h2>
          <p>20 сентября 2024 | Оплата | Статья</p>
        </div>
      </div>

      <div class="articles">
        <h3>Что происходит?</h3>
        <div class="article-card" data-category="design">
  <h4>Фотограф заснял объекты с Burning Man 2024</h4>
  <p>Дизайн | 18 сентября</p>
</div>
<div class="article-card" data-category="business">
  <h4>Как компания сделала ребрендинг</h4>
  <p>Бизнес | 15 сентября</p>
</div>
        <div class="article-card" data-category="history">
          <h4>Фотограф заснял объекты с Burning Man 2024</h4>
          <p>Дизайн | 18 сентября</p>
        </div>
        <div class="article-card" data-category="kod">
          <h4>Музей провёл ребрендинг к годовщине</h4>
          <p>Дизайн | 18 сентября</p>
        </div>
        <div class="article-card" data-category="game">
          <h4>Агентство разработа ло идентику для Пушкинского музея</h4>
          <p>Дизайн | 18 сентября</p>
        </div>
      </div>
    </section>
  </main>

    
</body>
</html>


<script>
document.addEventListener('DOMContentLoaded', function () {
  // Получаем ссылки категорий
  const categoryLinks = document.querySelectorAll('.sidebar li a');
  const articles = document.querySelectorAll('.article-card');

  // Функция фильтрации
  function filterArticles(category) {
    articles.forEach(article => {
      // Проверяем категорию у статей
      const articleCategory = article.getAttribute('data-category');
      if (category === 'Все' || articleCategory === category.toLowerCase()) {
        article.style.display = 'block'; // Показываем статьи, которые соответствуют категории
      } else {
        article.style.display = 'none'; // Скрываем остальные
      }
    });
  }

  // Добавляем событие нажатия на каждую ссылку
  categoryLinks.forEach(link => {
    link.addEventListener('click', function (e) {
      e.preventDefault(); // Отменяем стандартное поведение ссылки
      const selectedCategory = link.getAttribute('data-category'); // Используем атрибут data-category
      filterArticles(selectedCategory);
    });
  });

  // При загрузке показываем все статьи
  filterArticles('Все');
});

</script>



<style>
    /* General Styling */
body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  background-color: #f4f4f4 !important;

}

header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 20px;
  background-color: #fff !important;
  border-bottom: 1px solid #ccc;
}

.logo h1 {
  font-size: 24px;
  color: #333 !important;
}

.nav-links a {
  text-decoration: none;
  margin: 0 15px;
  color: #007BFF !important;
}

main {
  display: flex;
}

aside {
  width: 20%;
  background-color: #f9f9f9 !important;
  padding: 20px;
}

.sidebar {
  list-style: none;
  padding: 0;
}

.sidebar li {
  margin-bottom: 10px;
}

.sidebar a {
  text-decoration: none;
  color: #333 !important;
  font-size: 18px;
}

.sidebar a:hover {
  color: #007BFF !important;
}

.content {
  width: 80%;
  padding: 20px;
}

.featured-article {
  display: flex;
  align-items: center;
  background-color: #fff !important;
  padding: 20px;
  margin-bottom: 20px;
  border-radius: 8px;
}

.featured-article img {
  max-width: 150px;
  margin-right: 20px;
}

.article-info h2 {
  font-size: 24px;
  color: #333 !important;
}

.articles {
  background-color: #fff !important;
  padding: 20px;
  border-radius: 8px;
}

.articles h3 {
  font-size: 20px;
  color: #333 !important;
}

.article-card {
  margin-bottom: 15px;
}

.article-card h4 {
  font-size: 18px;
  color: #007BFF !important;
}

.article-card p {
  font-size: 14px;
  color: #777 !important ;
}

</style>