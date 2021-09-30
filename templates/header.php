<header>
    <nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Электронная библиотека</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 me-3">
                    <?php if(!isset($_COOKIE['username'])): ?>
                    <li class="nav-item">
                        <span class="nav-link">Гость</span>
                    </li>
                    <span class="nav-link">|</span>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php"> Вход</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="registration.php?">Регистрация</a>
                    </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <span class="nav-link"> <?=$_COOKIE['username']?> </span>
                        </li>
                        <span class="nav-link">|</span>
                        <li class="nav-item">
                            <a class="nav-link" href="exit.php">Выход</a>
                        </li>
                    <?php endif ?>
                </ul>
                <!-- <span class="navbar-text">
                    Navbar text with an inline element
                </span> -->
            </div>
        </div>
    </nav>
</header>