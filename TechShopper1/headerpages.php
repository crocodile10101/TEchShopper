<?php
// Страница профиля
session_start();

// Здесь вы можете вывести купленные курсы пользователя
?>


<header>
    <img src="./images/Group1.png" width="100%" alt=""> 
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">TechShopper <img src="./images/it_course_clicker_icon.png" width="30px" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <button class="btn btn-primary" aria-expanded="false">
                            <a class="dropdown-item" href="promo-klick.php">Накликай скидку</a>
                        </button>
                    </li>
                    <li class="nav-item dropdown">
                        <button class="btn btn-dark" aria-expanded="false">
                            <a class="dropdown-item" href="kurs.php">Выбрать курс</a>
                        </button>
                    </li>
                    <li class="nav-item dropdown">
                        <button class="btn btn-dark" aria-expanded="false">
                            <a class="dropdown-item" href="kinderpages.php">Для детей💟</a>
                        </button>
                    </li>
                    <li class="nav-item dropdown">
                        <button class="btn btn-dark" aria-expanded="false">
                            <a class="dropdown-item" href="media.php">Медиа📰</a>
                        </button>
                    </li>
                </ul>
            </div>
            <!-- Изменяем кнопку "Войти" на имя пользователя, если он авторизован -->
            <div class="d-flex justify-content-end">
                <?php if (isset($_SESSION['username'])): ?>
                   <a href="profile.php"><span class="navbar-text text-light">Привет, <?= htmlspecialchars($_SESSION['username']) ?>!</span></a> 
                <?php else: ?>
                    <a  href="login-user.php" class="btn btn-outline-light">Войти</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
</header>
