<?php
session_start();
session_destroy();

require_once "../connection.php";
$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));

if (isset($_POST['doctors'])) {
    header("Location: ../not_authorized/specializations.php");
}
if (isset($_POST['index'])) {
    header("Location: ../index.php");
}
if (isset($_POST['reg'])) {
    header("Location: ../not_authorized/registration.php");
}

if (isset($_POST['user_log_sub']) && isset($_POST['user_login']) && isset($_POST['user_pas'])) {
    session_start(['cookie_lifetime' => 1800]);
    $_SESSION['user_login'] = $_POST['user_login'];
    $_SESSION['user_pas'] = md5($_POST['user_pas']);

    include("auto_log.php");
}
?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>login_not_authorized</title>
        <meta charset="utf-8">
    </head>
    <body style="border: black 3px solid; border-radius: 20px; width: 500px; min-height: 100px; padding: 5px 10px; margin: 10px auto">
    <form method="POST" style="margin: 5px 0px 0px 10px">
        <input type="submit" name="index" value="На главную">
        <input type="submit" name="reg" value="Регистрация">
        <input type="submit" name="doctors" value="Специализации врачей">
    </form>

    <div style="margin: auto; width: 150px; font-weight: bold; font-size: 20pt">
        Авторизация
    </div>

    <?php
    if (isset($_SESSION['user_login']) && isset($_SESSION['user_pas'])) {
        echo "<span>Неверный логин или пароль</span>";
    }
    ?>

    <form method="POST" style="margin: 10px 0px 0px 80px">
        <label> Логин:
            <input type="text" name="user_login">
        </label>
        <br>
        <label> Пароль:
            <input type="text" name="user_pas">
        </label>
        <br>
        <input type="submit" name="user_log_sub" value="Вход">
    </form>

    </body>
    </html>

<?php
mysqli_close($link);
?>