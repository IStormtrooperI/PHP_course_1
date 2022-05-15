<!DOCTYPE html>
<html lang="ru">
<head>
    <title>лабораторная 8</title>
    <meta charset="utf-8">
</head>
<body>
<a href="stat.php">Статистика</a><br>

<?php
// 1 строка - кто увидел баннер
// 2 строка - кто перешел по баннеру
// 3 строка - кто перешел не по баннеру
// 4 строка - кто заказал

$r = rand(1, 5);
$pct = getcwd();
$pct = "../0$r.gif";
echo "<br> <a href='0$r.php'><img src='$pct' alt=''></a>";
if (! file_exists('../stat.txt')) {
    $f = fopen('../stat.txt', 'w+');
    fwrite($f, "0:0:0:0:0\n0:0:0:0:0\n0:0:0:0:0\n0:0:0:0:0");
    fclose($f);
}
$f = fopen('../stat.txt', 'r');
while (! feof($f)) {
    $stats[] = fgets($f);
}
fclose($f);
//print_r($stats);
if (! isset($stats) || count($stats) != 5) {
    $f = fopen('../stat.txt', 'w+');
    fwrite($f, "0:0:0:0:0\n0:0:0:0:0\n0:0:0:0:0\n0:0:0:0:0");
    fclose($f);
    $stats = ["0:0:0:0:0", "0:0:0:0:0", "0:0:0:0:0", "0:0:0:0:0"];
}
//$stats = explode('\\n', file_get_contents('../stat.txt'));
foreach ($stats as $key => $stat) {
    $stat = trim($stat);
    $c = explode(':', $stat);
    foreach ($c as $key1 => $item) {
        if ((! is_numeric($item) || (int)($item) <= -1) && $key != 4) {
            $c[$key1] = 0;
        }
    }
    if ($key == 0) {
        $c[$r - 1]++;
    }
    $stat = implode(":", $c);
    $stats[$key] = $stat;
}
$f = fopen('../stat.txt', 'w+');
for($i = 0; $i <4; $i++)
{
    fwrite($f,$stats[$i]. "\n");
}
fclose($f);
?>
</body>
</html>