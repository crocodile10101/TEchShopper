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

<script>
        document.addEventListener('keydown', function (event) {
            if (event.altKey && event.key === 'Delete') {
                
                    window.location.href = "login.php";
               
            }
        });
    </script>

<div class="spinner-wrapper">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>


<div class="content">

<?php require 'headerpages.php' ?>

    <div class="container mt-5">
      <div class="row">
          <!-- Карточка 1: О компании -->
          <div class="col-md-4">
              <div class="card mb-4 shadow-sm">
                  <img src="https://s3-eu-central-1.amazonaws.com/news.pr-cy.ru/535312/6725.png" class="card-img-top" alt="О компании">
                  <div class="card-body">
                      <h5 class="card-title">О компании</h5>
                      <p class="card-text">TechShopper помогает осваивать современные IT-профессии и быть в курсе всех технологий будущего.</p>
                      <a href="company.html" class="btn btn-primary">Подробнее</a>
                  </div>
              </div>
          </div>
  
          <!-- Карточка 2: Профессия IT-специалист -->
          <div class="col-md-4">
              <div class="card mb-4 shadow-sm">
                  <img src="https://images.unsplash.com/photo-1591696205602-2f950c417cb9" class="card-img-top" alt="IT-специалист">
                  <div class="card-body">
                      <h5 class="card-title">IT-специалист</h5>
                      <p class="card-text">IT-специалист решает технические задачи и поддерживает работу IT-инфраструктуры компаний.</p>
                      <a href="it-specialist.html" class="btn btn-primary">Подробнее</a>
                  </div>
              </div>
          </div>
  
          <!-- Карточка 3: Профессия Веб-разработчик -->
          <div class="col-md-4">
              <div class="card mb-4 shadow-sm">
                  <img src="https://images.unsplash.com/photo-1516259762381-22954d7d3ad2" class="card-img-top" alt="Веб-разработчик">
                  <div class="card-body">
                      <h5 class="card-title">Веб-разработчик</h5>
                      <p class="card-text">Веб-разработчики создают и поддерживают сайты, делая их функциональными и удобными.</p>
                      <a href="web-developer.html" class="btn btn-primary">Подробнее</a>
                  </div>
              </div>
          </div>
      </div>
  
      <div class="row">
          <!-- Карточка 4: Профессия Графический дизайнер -->
          <div class="col-md-4">
              <div class="card mb-4 shadow-sm">
                  <img src="https://images.unsplash.com/photo-1504805572947-34fad45aed93" class="card-img-top" alt="Графический дизайнер">
                  <div class="card-body">
                      <h5 class="card-title">Графический дизайнер</h5>
                      <p class="card-text">Дизайнеры создают визуальные элементы, делая интерфейсы красивыми и удобными для пользователей.</p>
                      <a href="graphic-designer.html" class="btn btn-primary">Подробнее</a>
                  </div>
              </div>
          </div>
  
          <!-- Карточка 5: Профессия Аналитик данных -->
          <div class="col-md-4">
              <div class="card mb-4 shadow-sm">
                  <img src="https://images.unsplash.com/photo-1519389950473-47ba0277781c" class="card-img-top" alt="Аналитик данных">
                  <div class="card-body">
                      <h5 class="card-title">Аналитик данных</h5>
                      <p class="card-text">Аналитики данных анализируют большие объемы информации для помощи в принятии бизнес-решений.</p>
                      <a href="data-analyst.html" class="btn btn-primary">Подробнее</a>
                  </div>
              </div>
          </div>
  
          <!-- Карточка 6: Профессия DevOps-инженер -->
          <div class="col-md-4">
              <div class="card mb-4 shadow-sm">
                  <img src="https://rebrainme.com/blog/wp-content/uploads/2020/05/devops10.jpg" class="card-img-top" alt="DevOps-инженер">
                  <div class="card-body">
                      <h5 class="card-title">DevOps-инженер</h5>
                      <p class="card-text">DevOps-инженеры объединяют разработку и операционную деятельность, чтобы ускорить выпуск программного обеспечения.</p>
                      <a href="devops-engineer.html" class="btn btn-primary">Подробнее</a>
                  </div>
              </div>
          </div>
      </div>
  </div>
  



  <?php require 'cont_top.php' ?>




 <!-- ТЕСТ -->
 <div class="quiz-container">
  <h2>Какую IT-профессию выбрать?</h2>
  <form id="quizForm">
      <p>1. Что вам больше нравится?</p>
      <input type="radio" name="q1" value="1" required> Работать с данными<br>
      <input type="radio" name="q1" value="2"> Создавать приложения и сайты<br>
      <input type="radio" name="q1" value="3"> Работать с людьми и помогать решать их задачи<br><br>

      <p>2. Как вы предпочитаете решать задачи?</p>
      <input type="radio" name="q2" value="1" required> Анализируя большие объемы информации<br>
      <input type="radio" name="q2" value="2"> Погружаясь в технические детали и код<br>
      <input type="radio" name="q2" value="3"> Работая с людьми в команде<br><br>

      <p>3. Что для вас интереснее?</p>
      <input type="radio" name="q3" value="1" required> Исследовать новые технологии и методы<br>
      <input type="radio" name="q3" value="2"> Программировать и разрабатывать проекты<br>
      <input type="radio" name="q3" value="3"> Коммуникация с клиентами и организация процессов<br><br>

      <p>4. Как вы относитесь к техническим навыкам?</p>
      <input type="radio" name="q4" value="1" required> Люблю изучать и углубляться<br>
      <input type="radio" name="q4" value="2"> Готов к трудностям, но предпочитаю творческую работу<br>
      <input type="radio" name="q4" value="3"> Техническая часть не так важна, главное - результат<br><br>

      <p>5. Какой рабочий процесс вам ближе?</p>
      <input type="radio" name="q5" value="1" required> Аналитический и систематический<br>
      <input type="radio" name="q5" value="2"> Программирование и технические решения<br>
      <input type="radio" name="q5" value="3"> Организация работы и помощь клиентам<br><br>

      <button type="submit" class="btn btn-primary">Узнать результат</button>
  </form>
  <div id="quizResult" style="display: none; margin-top: 20px;"></div>
  </div>


  <script>
    document.getElementById('quizForm').addEventListener('submit', function(event) {
        event.preventDefault();
        
        const formData = new FormData(event.target);
        const answers = Array.from(formData.values());
        
        // Подсчёт количества ответов по каждому значению
        const counts = { '1': 0, '2': 0, '3': 0 };
        answers.forEach(answer => counts[answer]++);
        
        // Определение профессии по наиболее частому значению
        let maxCount = 0;
        let resultValue = '1';
        for (const [key, count] of Object.entries(counts)) {
            if (count > maxCount) {
                maxCount = count;
                resultValue = key;
            }
        }
        
        // Определение результата
        let resultText = '';
        switch (resultValue) {
            case '1':
                resultText = 'Вам подойдёт профессия аналитика данных или исследователя. Вы любите работать с данными и анализировать информацию.';
                break;
            case '2':
                resultText = 'Вам подойдёт профессия разработчика программного обеспечения. Вы предпочитаете погружаться в код и создавать приложения.';
                break;
            case '3':
                resultText = 'Вам подойдёт профессия менеджера по проектам или консультанта. Вы наслаждаетесь работой с людьми и организацией процессов.';
                break;
        }
        
        // Отображение результата
        const resultElement = document.getElementById('quizResult');
        resultElement.textContent = resultText;
        resultElement.style.display = 'block';
    });
</script>
 <!-- ТЕСТ -->








  
  <?php require 'footerpages.php' ?>
  
    </div>
</body>
</html>