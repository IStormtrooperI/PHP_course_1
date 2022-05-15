<?php
require_once "../connection.php";
$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));

$user_login = $_SESSION['user_login'];
$user_pas = $_SESSION['user_pas'];

$query = "SELECT * FROM users WHERE email = '$user_login' AND password = '$user_pas'";
$result = mysqli_query($link, $query);

if (mysqli_num_rows($result) == 1) {
    mysqli_close($link);
    if ($user_login == "admin") {
        header("Location: ../authorized/admin_profile.php");
    } else {
        header("Location: ../authorized/profile.php");
    }
} else {
    mysqli_close($link);
    header("Location: ../not_authorized/login.php");
}

mysqli_close($link);

?>