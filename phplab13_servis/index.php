<?php
if (isset($_POST['doctors'])) {
    header("Location: not_authorized/specializations.php");
}
if (isset($_POST['login'])) {
    header("Location: not_authorized/login.php");
}
if (isset($_POST['reg'])) {
    header("Location: not_authorized/registration.php");
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>index_not_authorized</title>
    <meta charset="utf-8">
</head>
<body style="border: black 3px solid; border-radius: 20px; width: 500px; min-height: 100px; padding: 5px 10px; margin: 10px auto">
<form method="POST" style="margin: 5px 0px 0px 10px">
    <input type="submit" name="login" value="Вход">
    <input type="submit" name="reg" value="Регистрация">
    <input type="submit" name="doctors" value="Специализации врачей">
</form>
</body>
</html>