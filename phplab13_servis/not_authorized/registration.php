<?php
if (isset($_POST['doctors'])) {
    header("Location: ../not_authorized/specializations.php");
}
if (isset($_POST['login'])) {
    header("Location: ../not_authorized/login.php");
}
if (isset($_POST['index'])) {
    header("Location: ../index.php");
}
if (isset($_POST['registration'])) {
    require_once "../connection.php";
    $link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));

    $email = $_POST['reg_email'];

    $query = "SELECT email FROM users WHERE email='$email'";
    $result = mysqli_query($link, $query);

    if (mysqli_num_rows($result) == 0) {

        $fio = explode(" ", $_POST['reg_fio']);
        $password = md5($_POST['reg_pas']);

        $query = "INSERT INTO users(surname,name,patronymic,email,password) VALUES('$fio[0]','$fio[1]','$fio[2]','$email','$password')";

        $result = mysqli_query($link, $query);

        session_start(['cookie_lifetime' => 1800]);

        $_SESSION['user_login'] = $email;
        $_SESSION['user_pas'] = $password;

        header("Location: /index.php/phplab13_servis/authorized/profile.php");
    } else {
        $prov = 1;
    }

    mysqli_close($link);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>registration_not_authorized</title>
    <meta charset="utf-8">
    <script src="registration.js"></script>
</head>
<body style="border: black 3px solid; border-radius: 20px; width: 500px; min-height: 100px; padding: 5px 10px; margin: 10px auto">
<form method="POST" style="margin: 5px 0px 0px 10px">
    <input type="submit" name="login" value="Вход">
    <input type="submit" name="index" value="На главную">
    <input type="submit" name="doctors" value="Специализации врачей">
</form>

<div style="margin: auto; width: 150px; font-weight: bold; font-size: 20pt">
    Регистрация
</div>

<form method="POST" style="margin: 10px 0px 0px 80px">
    <div>
        Заполните все поля для регистрации
    </div>
    <?php

    if (isset($prov)) {
        echo "<div>Введенная почта [ $email ] уже используется, введите другую почту</div>";
    }

    ?>
    <div id="error" style="visibility: hidden; color:red">
        Некоторые поля заполнены неверно
    </div>
    <label> ФИО:
        <input style="border-color: black" type="text" name="reg_fio" placeholder="Иванов Иван Иванович" id="fio"
               onchange="js_fio(this)">
    </label>
    <br>
    <label> email:
        <input style="border-color: black" type="text" name="reg_email" id="mail" placeholder="1234567890@mail.ru"
               onchange="js_mail(this)">
    </label>
    <br>
    <label>
        Пароль:
        <input style="border-color: black" type="text" name="reg_pas" id="pas" placeholder="Пароль"
               onchange="js_pas(this)">
    </label>
    <br>
    <label>
        Подтверждение пароля:
        <input style="border-color: black" type="text" name="reg_pas_pod" id="pas_pod" placeholder="Пароль"
               onchange="js_pas_pod(this)">
    </label>
    <input type="button" name="registration" value="Зарегистрироваться" id="reg_but">
</form>


</body>
</html>