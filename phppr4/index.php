<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Практика 4 | Вариант 6</title>
    <meta charset="utf-8">
</head>
<body>
</body>
</html>
<?php
$dir1 = __DIR__ . "/Лаб_Парсер.htm";
if(!is_readable($dir1)){
    die("Файл html не найден, либо недоступен для чтения");
}
$htm = iconv("windows-1251", "utf-8", file_get_contents("$dir1"));
$str = "";
$prov = ["<li>", "</li>"];
while (preg_match("/<li>.*<\/li>/sU",$htm,$ul) != "0") {
    $htm = str_replace($ul[0], " ", $htm);
        $ul[0] = trim(str_replace($prov,"",$ul[0]));
        $ul[0] = preg_replace("/[\s]{2,}/"," ",$ul[0]);
        $str = $str . $ul[0] . "\n";
    }
$schet = substr_count($str,"MySQL");
$str = $str . "\n" . "$schet";
$dir2 = __DIR__ . "/Вывод.txt";
if ($str != "") {
    echo "Done!";
}
file_put_contents($dir2, $str);
?>