<title><?=$title?></title>
<body>
<div id="container">
    </div>
    <div class="content">
        <h1><?=$title?></h1>

        <?=$info?>
            <form method="post">
                <p>Имя: <input type="text" name="name" maxlength="30" placeholder="Введите Имя" autofocus required></p>
                <p>Логин: <input type="text" name="login" maxlength="30" placeholder="Введите Логин" required></p>
                <p>Email: <input type="email" name="email" maxlength="30" placeholder="Введите Email" required></p>
                <p>Пароль: <input type="password" minlength="2" name="pass" placeholder="Введите Пароль" required></p>
                <input type="submit" name="submit" value="Зарегистрироваться">
            </form>
    </div>
</div>
<script src='../js/my.js' defer></script>;
</body>
</html>