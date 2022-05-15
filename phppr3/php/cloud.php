<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Облако</title>
    <meta charset="utf-8">
</head>
<body>
<?php
if (! file_exists("../stat.txt")) {
    echo "Отсутствует файл с количеством открываний страниц";
    die;
} else {
    $schets = trim(file_get_contents("../stat.txt"));
    $schet = explode(":", $schets);
}
$f = fopen("../темы.txt", "r");
while (! feof($f)) {
    $strs[] = trim(fgets($f));
}
fclose($f);

$smax = -1;
foreach ($schet as $i => $item) {
    if ($smax < $item) {
        $smax = $item;
    }
}

$razmM = 40;

while (count($schet) != 0) {
    $max = -1;
    unset($key);
    foreach ($schet as $i => $item) {
        if ($max < $item) {
            $max = $item;
        }
    }
    foreach ($schet as $i => $item) {
        if ($item == $max) {
            $key[] = $i;
            unset($schet[$i]);
        }
    }
    if (isset($key)) {
        foreach ($key as $item) {
            $razm = round(($razmM * $max) / $smax, 0);
            if ($razm < 12) {
                $razm = 12;
            }
            $j = $razm . "pt";
            $link = ($item + 1) . ".php";
            if (strlen($link) == 5) {
                $link = "0" . $link;
            }
            if (isset($strs)) {
                $strs[$item] = "<div style='font-size:$j;'><a href='$link' style='color:black;text-decoration: none;'>" . substr(
                        $strs[$item],
                        7
                    ) . "</a></div>";
            }
        }
    }
}
if(isset($strs)){
    foreach ($strs as $item) {
        echo $item;
    }
}
?>
</body>
</html>
