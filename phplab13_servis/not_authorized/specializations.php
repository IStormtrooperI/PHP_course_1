<?php
if (isset($_POST['index'])) {
    header("Location: ../index.php");
}
if (isset($_POST['login'])) {
    header("Location: ../not_authorized/login.php");
}
if (isset($_POST['reg'])) {
    header("Location: ../not_authorized/registration.php");
}
require_once "../connection.php";
$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));
?>

<!DOCTYPE html>
<html>
<head>
    <title>specializations_not_authorized</title>
    <meta charset="utf-8">
</head>
<body style="border: black 3px solid; border-radius: 20px; width: 500px; min-height: 100px; padding: 5px 10px; margin: 10px auto">
<form method="POST" style="margin: 5px 0px 0px 10px">
    <input type="submit" name="login" value="Вход">
    <input type="submit" name="reg" value="Регистрация">
    <input type="submit" name="index" value="На главную">
</form>

<?php

$query = "SELECT * FROM specializations";
$result = mysqli_query($link, $query);

if (mysqli_num_rows($result) == 0) {
    mysqli_close($link);
    die("Данные не найдены");
}

echo "<br><table border='1px' style='border-collapse: collapse; margin: 10px auto'><tr><th>Специализации врачей</th></tr>";
while ($row = mysqli_fetch_assoc($result)) {
    $specializations = $row['specializations'];
    echo "<tr><td>$specializations</td></tr>";
}
echo "</table>";

mysqli_close($link);
?>

</body>
</html>