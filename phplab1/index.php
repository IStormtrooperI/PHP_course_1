<!DOCTYPE html>
<html>
<head>
    <title>Таблица умножения</title>
    <meta charset="utf-8">
</head>
<body>

<p>Введите размерность таблицы</p>

<form name="forma" method="post" action="" autocomplete="off">
    <input type="text" name="shir">
    <input type="text" name="wis">
    <input type="submit" name="o">
</form>

<?php
$reg = '/\D/';
$v = $_POST["shir"] . $_POST["wis"];
$h = preg_match($reg, $v);
if ($h == 1) {
    echo("Введены некорректные данные");
} else
    if ($_POST["shir"] == "" || $_POST["wis"] == "") {
} else {

    (int) $_POST["shir"];
    (int) $_POST["wis"];

    echo '<table border="1" style="margin:20px auto 0 auto;">';

    for ($tr = 0; $tr <= $_POST["wis"]; $tr++) {
        echo '<tr>';

        for ($td = 0; $td <= $_POST["shir"]; $td++) {
            if ($tr == 0 && $td == 0) {
                echo '<td style="padding:15px; background-color:yellow; font-weight:bold;">' . "" . '</td>';
            } elseif ($tr == 0) {
                echo '<td style="padding:15px; background-color:yellow; font-weight:bold;">' . $td . '</td>';
            } elseif ($td == 0) {
                echo '<td style="padding:15px; background-color:yellow; font-weight:bold;">' . $tr . '</td>';
            } else {
                if ($tr * $td / $tr == $tr && $tr * $td % $tr == 0 && $_POST["shir"] == $_POST["wis"]) {
                    echo '<td style="padding:15px; background-color:pink;">' . $tr * $td . '</td>';
                } elseif ($tr * $td % 2 == 0) {
                    echo '<td style="padding:15px; background-color:green;">' . $tr * $td . '</td>';
                } else {
                    echo '<td style="padding:15px; background-color:blue;">' . $tr * $td . '</td>';
                }
            }
        }
        echo '</tr>';
    }

    echo '</table>';
}
?>

</body>
</html>