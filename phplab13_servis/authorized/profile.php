<?php
session_start();
if (isset($_POST['back'])) {
    header("Location: ../not_authorized/login.php");
}
if (! isset($_SESSION['user_login'])) {
    header("Location: ../not_authorized/login.php");
}
if (isset($_POST['zapis'])) {
    header("Location: ../authorized/zapis.php");
}
require_once "../connection.php";
$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));

if(isset($_POST['otmena'])){
    $id_ap_otmena = $_POST['id_ap_otmena'];
    $query = "DELETE FROM appointments WHERE id=$id_ap_otmena";
    $result = mysqli_query($link,$query);
}
?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>profile_authorized</title>
        <meta charset="utf-8">
    </head>
    <body style="border: black 3px solid; border-radius: 20px; width: 500px; min-height: 100px; padding: 5px 10px; margin: 10px auto">
    <form method="POST" style="margin: 5px 0px 0px 10px">
        <input type="submit" name="back" value="Выход">
        <input type="submit" name="zapis" value="Записаться на прием">
        <?php
        $login = $_SESSION['user_login'];
        echo "Логин: $login";
        ?>
    </form>
    <div style="margin: auto; width: 150px; font-weight: bold; font-size: 20pt">
        Профиль
    </div>

    <div style="margin: auto;width: 150px;">
        Текущие записи
    </div>

    <?php

    $date_now = date("Y-m-d");

    $query_appointments = "SELECT id,id_doctors,date FROM appointments WHERE id_users=(SELECT id FROM users WHERE email='$login') AND date >='$date_now'";
    $result_appointments = mysqli_query($link, $query_appointments);

    if (mysqli_num_rows($result_appointments) == 0) {
        echo "<div style='margin: auto;width: 150px;'>Отсутствуют.</div>";
        mysqli_close($link);
        die;
    }

    echo "<table border='1px' style='border-collapse: collapse; margin: 10px auto'>
        <tr>
            <th>Специализация врача</th>
            <th>ФИО врача</th>
            <th>Дата</th>
        </tr>";

    while ($row_appointments = mysqli_fetch_assoc($result_appointments)) {
        $id_appointments = $row_appointments['id'];
        $id_doctor = $row_appointments['id_doctors'];
        $date_explode = explode("-",$row_appointments['date']);
        $date_ru = $date_explode[2] . "." . $date_explode[1] . "." . $date_explode[0];
        $date = $row_appointments['date'];

        $query_doctors = "SELECT specializations, surname, name, patronymic FROM doctors,specializations WHERE doctors.id=$id_doctor AND specializations.id=id_specializations";
        $result_doctors = mysqli_query($link, $query_doctors);

        $row_doctors = mysqli_fetch_assoc($result_doctors);
        $specialization = $row_doctors['specializations'];
        $fio_doc = $row_doctors['surname'] . " " . $row_doctors['name'] . " " . $row_doctors['patronymic'];

        echo "<tr>
              <td>$specialization</td><td>$fio_doc</td><td>$date_ru</td>
              
              <td><form method='POST'>
              <input type='hidden' readonly value='$id_appointments' name='id_ap_otmena'>";

        if($date == $date_now) {
            echo "<input disabled type='submit' value='Отмена записи' name='otmena'>";
        } else {
            echo "<input type='submit' value='Отмена записи' name='otmena'>";
        }

        echo  "</form></td>
              
              </tr>";
    }
    ?>
    </table>

    </body>
    </html>

<?php
mysqli_close($link);
?>