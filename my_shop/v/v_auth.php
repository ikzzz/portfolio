 <title><?=$title?></title>
<body>
<div id="container">
    </div>
    <div class="content">
        <h1><?=$title?></h1>
<?=$text?>

<form method="post" >
    <p>Логин</p>
    <input type="text" name="login" value="<?= $_COOKIE['login']?>">
    <p>Пароль</p>
    <input type="password" name="pass" value="<?= $_COOKIE['pass']?>"><br><br>
    <input type="submit" name='auth' value="Вход">
</form>
</div>