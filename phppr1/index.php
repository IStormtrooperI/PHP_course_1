<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Практика двумерные массивы 11 вариант</title>
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
    <input type="submit">
</form>

<?php
if (isset($_POST["N"]) === true && isset($_POST["M"]) === true && (int) ($_POST["N"]) > 0 && (int) ($_POST["M"]) > 0) {
    $N = (int) ($_POST["N"]);
    $M = (int) ($_POST["M"]);
} else {
    echo "Поля формы заполнены некорректно";
    die;
}
$arr[][] = 0;
$first[] = 0;
echo "<br> Сгенерированный массив";
echo "<table border=\"1\">";
for ($i = 0; $i < $N; $i++) {
    echo "<tr>";
    for ($j = 0; $j < $M; $j++) {
        echo "<td>";
        $arr[$i][$j] = mt_rand(1, 999);
        echo $arr[$i][$j] . "</td>";
        if ($j === 0) {
            $first[$i] = $arr[$i][$j];
        }
    }
    echo "</tr>";
}
echo "</table>";

$arr1 = $arr;
$arr2 = $arr;
$arr3 = $arr;
$arr4 = $arr;

for ($i = 0; $i < $M; $i++) {
    $pr[] = false;
}
echo "<br> Замена первого элемента в столбце кратного трем на нуль";
echo "<table border=\"1\">";
for ($i = 0; $i < $N; $i++) {
    echo "<tr>";
    for ($j = 0; $j < $M; $j++) {
        if ($pr[$j] === false && $arr1[$i][$j] % 3 === 0) {
            $arr1[$i][$j] = 0;
            $pr[$j] = true;
            echo "<td style='background-color:#6ef33e'>";
        } else {
            echo "<td>";
        }
        echo $arr1[$i][$j] . "</td>";
    }
    echo "</tr>";
}
echo "</table>";

echo "<br> Вставить после каждого столбца, начиная со второго первый столбец";
echo "<table border=\"1\">";
for ($i = 0; $i < $N; $i++) {
    echo "<tr>";
    for ($j = 0; $j < (($M * 2) - 1); $j++) {
        if ($i == 0 && $arr2[$i][$j] != $first[$i]) {
            for ($g = 0; $g < $N; $g++) {
                array_splice($arr2[$g], $j + 1, 0, $first[$g]);
            }
        }
        if ($arr2[$i][$j] == $first[0]) {
            echo "<td style='background-color:#6ef33e'>";
        } else {
            echo "<td>";
        }
        echo $arr2[$i][$j] . "</td>";
    }
    echo "</tr>";
}
echo "</table>";

for ($i = 0; $i < $N; $i++) {
    echo "<tr>";
    for ($j = 1; $j < $M; $j++) {
        if (isset($arr3[$i][$j]) && $arr3[$i][$j] != 0 && $arr3[$i][$j] % 5 == 0) {
            for ($g = 0; $g < $M * 2; $g++) {
                unset($arr3[$g][$j]);
            }
        }
    }
}

echo "<br> Удаление столбцов с элементами кратными 5";
echo "<table border=\"1\">";
for ($i = 0; $i < $N; $i++) {
    echo "<tr>";
    for ($j = 0; $j < $M; $j++) {
        if (isset($arr3[$i][$j])) {
            echo "<td>";
            echo $arr3[$i][$j] . "</td>";
        }
    }
    echo "</tr>";
}
echo "</table>";

echo "<br> Поменять местами третий и последний столбец";
for ($i = 0; $i < $M; $i++) {
    if (isset($arr4[$i]) && count($arr4[$i]) < 3) {
        echo "<br> В массиве меньше трех столбцов";
        die;
    }
}

$sh = 0;
echo "<table border=\"1\">";
for ($i = 0; $i < $N; $i++) {
    echo "<tr>";
    for ($j = 0; $j < $M; $j++) {
        if ($sh < 3) {
            $sh++;
        }
        if ($sh == 3) {
            for ($g = 0; $g < $N; $g++) {
                $zam[] = $arr4[$g][$j];
                $arr4[$g][$j] = $arr4[$g][$M - 1];
                $arr4[$g][$M - 1] = $zam[$g];
            }
            $sh = 4;
        }
        if ($j == 2 || $j == ($M - 1)) {
            echo "<td style='background-color:#6ef33e'>";
        } else {
            echo "<td>";
        }
        echo $arr4[$i][$j] . "</td>";
    }
    echo "</tr>";
}
echo "</table>";

?>

</body>
</html>