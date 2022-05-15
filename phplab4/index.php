<!DOCTYPE html>
<html>
<head>
    <title>Работа с двумерными массивами 10 вариант</title>
    <meta charset="utf-8">
</head>
<body>
<form method="POST">
    Размерность многомерного массива NxM
    <br>
    <label>N
        <input type="text" name="N">
    </label>
    <label>M
        <input type="text" name="M">
    </label>
    <br>
    <label>min
        <input type="text" name="min">
    </label>
    <label> max
        <input type="text" name="max">
    </label>
    <br>
    <input type="submit">
</form>

<?php
if ($_POST['N'] == "" || $_POST['M'] == "" || $_POST['min'] == "" || $_POST['max'] == "") {
    echo "Не все поля заполнены";
    die;
}

$N = (int) $_POST['N'];

if ($N <= 0) {
    echo "Значение N размерности массива задано некорректно";
    die;
}

$M = (int) $_POST['M'];

if ($M <= 0) {
    echo "Значение M размерности массива задано некорректно";
    die;
}

$min = (int) $_POST['min'];
$max = (int) $_POST['max'];

if ($min >= $max) {
    echo "min>=max";
    die;
}
echo "Исходный массив: <br>";
echo "___________________________________________________________________ <br>";
for ($i = 0; $i < $N; $i++) {
    for ($j = 0; $j < $M; $j++) {
        $arr[$i][$j] = mt_rand($min, $max);
        if ($i === $j) {
            echo " [ <strong>" . $arr[$i][$j] . "</strong> ] ";
        } else {
            echo " [ " . $arr[$i][$j] . " ] ";
        }
    }
    echo "<br>";
}
echo "___________________________________________________________________ <br>";
echo "Массив после преобразования: <br>";

for ($i = 0; $i < $N; $i++) {
    for ($j = 0; $j < $M; $j++) {
        if ($i - $j < 0 && $arr[$i][$j] > 0) {
            $arr[$i][$j] = round(sqrt($arr[$i][$j]), 3);
        }

        if ($i === $j) {
            echo " [ <strong>" . $arr[$i][$j] . "</strong> ] ";
        } else {
            echo " [ " . $arr[$i][$j] . " ] ";
        }
    }
    echo "<br>";
}
?>

</body>
</html>