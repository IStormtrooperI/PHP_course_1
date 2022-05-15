<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Работа со строками 11 вариант</title>
    <meta charset="utf-8">
</head>
<body>
<form method="POST">
    <label> Строка
        <input type="text" name="str">
    </label>
    <br>
    <input type="submit">
</form>

<?php
if (isset($_POST["str"]) === false || $_POST["str"] === "") {
    echo "Поле формы не заполнено";
    die;
}
$str = $_POST["str"];
if (strpos($str, '.') === false) {
    echo "Поле формы заполнено некорректно";
    die;
}
echo $str . "<br>";
$str = substr($str, 0, strpos($str, "."));
$arr = explode(" ", $str);
$str = "";

for ($i = 0; $i < count($arr); $i++) {
    if (is_numeric($arr[$i]) && strlen($arr[$i]) > 1) {
        $prov = true;
        for ($j = 0; $j < strlen($arr[$i]) - 1; $j++) {
            $s1 = substr($arr[$i], $j, 1);
            $s2 = substr($arr[$i], $j + 1, 1);
            if ((int) ($s1) > (int) ($s2)) {
                $prov = false;
                break;
            }
        }
        if ($prov === true) {
            $str = $str . $arr[$i] . " ";
        }
    } else {
        continue;
    }
}

echo "<br>" . $str;

?>

</body>
</html>