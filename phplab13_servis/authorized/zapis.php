<?php
session_start();
if (isset($_POST['back'])) {
    header("Location: ../not_authorized/login.php");
}
if (! isset($_SESSION['user_login'])) {
    header("Location: ../not_authorized/login.php");
}
if (isset($_POST['profile'])) {
    header("Location: ../authorized/profile.php");
}

require_once "../connection.php";
$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));

if(isset($_POST['zap_sub'])) {
    $new_zap_id_doc = $_POST['zap_id_doc'];
    $new_zap_date = $_POST['zap_date'];
    $new_zap_user = $_SESSION['user_login'];

    $query_user = "SELECT * FROM users WHERE email='$new_zap_user'";
    $result_user = mysqli_query($link,$query_user);

    $row_user = mysqli_fetch_assoc($result_user);
    $new_zap_id_user = $row_user['id'];

    $query_appointments = "INSERT INTO appointments(id_doctors, id_users, date) VALUES($new_zap_id_doc,$new_zap_id_user,'$new_zap_date')";
    $result_appointments = mysqli_query($link, $query_appointments);

    $prov = 1;

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
        <input type="submit" name="profile" value="Профиль">
        <?php
        $login = $_SESSION['user_login'];
        echo "Логин: $login";
        ?>
    </form>
    <div style="margin: auto; width: 205px; font-weight: bold; font-size: 20pt">
        Запись на прием
    </div>

    <?php

    $query = "SELECT * FROM specializations";
    $result = mysqli_query($link, $query);

    if (mysqli_num_rows($result) == 0) {

        echo "Данные не найдены";
        mysqli_close($link);
        die;
    }

    ?>

    <form method="POST">
        <select name="zapis_spec">
            <option selected disabled>Выберите специалиста</option>

            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                $specialization = $row['specializations'];
                echo "<option>$specialization</option>";
            }
            ?>

        </select>
        <input type="date" name="zapis_date">
        <div style="margin-left: 330px"><input type="submit" name="zapis" value="Выбрать"></div>
    </form>

    <?php

    if(isset($prov)) {
        $new_zap_date_exp = explode("-",$new_zap_date);
        $query_zapis = "SELECT * FROM doctors WHERE id=$new_zap_id_doc";
        $result_zapis = mysqli_query($link,$query_zapis);

        $row_zapis = mysqli_fetch_assoc($result_zapis);
        $id_spec = $row_zapis['id_specializations'];
        $fio_doc_zapis = $row_zapis['surname'] . " " . $row_zapis['name'] . " " . $row_zapis['patronymic'];

        $query_zapis = "SELECT * FROM specializations WHERE id=$id_spec";
        $result_zapis = mysqli_query($link,$query_zapis);

        $row_zapis2 = mysqli_fetch_assoc($result_zapis);
        $spec_zapis = $row_zapis2['specializations'];

        echo "Вы были записаны к специалисту [$spec_zapis] ФИО [$fio_doc_zapis] дата приема [$new_zap_date_exp[2].$new_zap_date_exp[1].$new_zap_date_exp[0]]";
    }

    if (isset($_POST['zapis'])) {
        if (! isset($_POST['zapis_spec']) || $_POST['zapis_date'] == "" || $_POST['zapis_date'] < date("Y-m-d")) {
            echo "Ошибка! Некоторые поля заполнены некорректно";
        } else {

            $zapis_spec = $_POST['zapis_spec'];
            $zapis_date_cel = $_POST['zapis_date'];
            $zapis_date = explode("-", $_POST['zapis_date']);

            echo "<table border='1px' style='border-collapse: collapse; margin: 10px auto'>
                  <caption>Запись к специалисту [$zapis_spec] на дату [$zapis_date[2].$zapis_date[1].$zapis_date[0]]</caption>
                  <tr><th>ФИО</th><th>Свободные номерки</th></tr>";

            $query_doc = "SELECT * FROM doctors WHERE id_specializations=(SELECT id FROM specializations WHERE specializations='$zapis_spec')";
            $result_doc = mysqli_query($link, $query_doc);

            while ($row_doc = mysqli_fetch_assoc($result_doc)) {

                $id_doc = $row_doc['id'];
                $fio_doc = $row_doc['surname'] . " " . $row_doc['name'] . " " . $row_doc['patronymic'];

                $query_appointments = "SELECT * FROM appointments WHERE id_doctors=$id_doc AND date='$zapis_date_cel'";
                $result_appointments = mysqli_query($link, $query_appointments);

                $free_num_doc = 5 - mysqli_num_rows($result_appointments);

                echo "<tr>
                      <td>$fio_doc</td><td>$free_num_doc</td>
                      <td><form method='POST'>
                      <input type='hidden' readonly value='$id_doc' name='zap_id_doc'>
                      <input type='hidden' readonly value='$zapis_date_cel' name='zap_date'>";

                if ($free_num_doc < 1) {
                    echo "<input type='submit' name='zap_sub' disabled value='Записаться'>";
                } else {
                    echo "<input type='submit' name='zap_sub' value='Записаться'>";
                }

                echo "</form></td></tr>";
            }

            echo "</table>";
        }
    }
    ?>

    </body>
    </html>

<?php
mysqli_close($link);
?>