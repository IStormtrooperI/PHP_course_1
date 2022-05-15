<?php

echo "<a href='0index.php'>Домой</a> <br>";


$f = fopen('../stat.txt', 'r');
while (! feof($f)) {
    $stats[] = fgets($f);
}
foreach ($stats as $key => $stat) {
    $stats[$key] = trim($stat);
    $c[$key] = explode(':', $stats[$key]);
}
echo "<br>CTR: ";
for($i=0;$i<5;$i++)
{
    $ctr[] = round(($c[1][$i] / $c[0][$i]) * 100, 0);
    echo $i+1 . " - [ $ctr[$i] % ]  | ";
}
echo "<br>CTI: ";
for($i=0;$i<5;$i++)
{
    $cti[] = round(($c[1][$i] / ($c[2][$i]+ $c[1][$i])) * 100, 0);
    echo $i+1 . " - [ $cti[$i] % ]  | ";
}
echo "<br>CTB: ";
for($i=0;$i<5;$i++)
{
    $ctb[] = round((($c[3][$i])/$c[1][$i]) * 100, 0);
    echo $i+1 . " - [ $ctb[$i] % ]  | ";
}

?>