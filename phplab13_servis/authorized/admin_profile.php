<?php
require_once "../connection.php";
$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));

if (isset($_POST['new_sub'])) {
    if (isset($_POST['new_doc']) && isset($_POST['new_spec']) && preg_match(
            "/^[А-Я][а-яё]+\s[А-Я][а-яё]+\s([А-Я][а-яё]+)?$/u",
            $_POST['new_doc']
        ) && preg_match("/^[а-яА-ЯёЁ\-\s]+$/u", $_POST['new_spec'])) {

        $new_doc = $_POST['new_doc'];
        $new_spec = $_POST['new_spec'];

        $fio = explode(" ", $_POST['new_doc']);

        $query = "SELECT * FROM specializations WHERE specializations='$new_spec'";
        $result = mysqli_query($link, $query);
        if (mysqli_num_rows($result) > 0) {

            $row = mysqli_fetch_assoc($result);
            $id_new_spec = $row['id'];

            $query = "INSERT INTO doctors(id_specializations, surname, name, patronymic) VALUES($id_new_spec,'$fio[0]','$fio[1]','$fio[2]')";
            $result = mysqli_query($link, $query);
        } else {

            $query = "INSERT INTO specializations(specializations) VALUES('$new_spec')";
            $result = mysqli_query($link, $query);

            $query = "SELECT * FROM specializations WHERE specializations='$new_spec'";
            $result = mysqli_query($link, $query);

            $row = mysqli_fetch_assoc($result);
            $id_new_spec = $row['id'];

            $query = "INSERT INTO doctors(id_specializations, surname, name, patronymic) VALUES($id_new_spec,'$fio[0]','$fio[1]','$fio[2]')";
            $result = mysqli_query($link, $query);
        }
    } else {
        $prov = 1;
    }
}

session_start();
if (isset($_POST['back'])) {
    header("Location: ../not_authorized/login.php");
}
if (! isset($_SESSION['user_login']) || $_SESSION['user_login'] != "admin") {
    header("Location: ../not_authorized/login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>admin_authorized</title>
    <meta charset="utf-8">
</head>
<body style="border: black 3px solid; border-radius: 20px; width: 500px; min-height: 100px; padding: 5px 10px; margin: 10px auto">
<form method="POST" style="margin: 5px 0px 0px 10px">
    <input type="submit" name="back" value="Выход">
    <?php
    $login = $_SESSION['user_login'];
    echo "Логин: $login";
    ?>
</form>
<div style="margin: auto; width: 150px; font-weight: bold; font-size: 20pt">
    Администратор
</div>
<?php

$query_spec = "SELECT * FROM specializations";
$result_spec = mysqli_query($link, $query_spec);

if (mysqli_num_rows($result_spec) == 0) {
    mysqli_close($link);
    die("Данные не найдены");
}

echo "<br><table border='1px' style='border-collapse: collapse; margin: 10px auto'><tr><th>Специализация врача</th><th>ФИО врача</th></tr>";
while ($row = mysqli_fetch_assoc($result_spec)) {

    $id_spec = $row['id'];
    $specialization = $row['specializations'];

    $query = "SELECT * FROM doctors WHERE id_specializations=$id_spec";
    $result_doc = mysqli_query($link, $query);

    while ($doc = mysqli_fetch_assoc($result_doc)) {

        $surname_doc = $doc['surname'];
        $name_doc = $doc['name'];
        $patronymic_doc = $doc['patronymic'];

        echo "<tr><td>$specialization</td><td>$surname_doc $name_doc $patronymic_doc</td></tr>";
    }
}
echo "</table>";

if (isset($prov)) {
    echo "<div>Ошибка! Некоторые поля заполнены некорректно, либо не были заполнены</div>";
}

$result_spec = mysqli_query($link, $query_spec);

echo "<table border='1px' style='border-collapse: collapse; margin: 10px auto'>
      <caption>Добавление нового врача</caption>
      <tr><th>Специализация врача</th><th>ФИО врача</th></tr>
      
      <form method='POST'>
      <tr>
      <td><input type='text' name='new_spec' style='width: 240px'></td>
      <td><input type='text' name='new_doc' style='width: 240px'></td>
      </tr>
      
      <tr>
      <td colspan='2'><input style='display:block; margin:auto' name='new_sub' type='submit' value='Добавить врача'></td>
      </tr>
      </form>";

echo "</table>";

mysqli_close($link);
?>
</body>
</html>