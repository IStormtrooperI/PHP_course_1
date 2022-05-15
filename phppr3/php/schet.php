<?php

$s = debug_backtrace();
if(count($s) == 0){
    echo "Этот файл подсчитывает количество открытий html-документов с текстом и 
    создает файл-счетчик по пути ../stat.txt , при открытии он ничего не делает";
    die;
}
$ind = $s[0]['file'];
$ind = (int)(substr($ind,strlen($ind)-6,2)) - 1;

if(!file_exists("../stat.txt")){
    $i=0;
    while($i<10){
        $stat[] = 0;
        $i++;
    }
    $stat[$ind]++;
    $stats = implode(":",$stat);
    $f = fopen("../stat.txt","w+");
    fwrite($f,$stats);
    fclose($f);
} else {
    $stats = trim(file_get_contents('../stat.txt'));
    $stat = explode(":", $stats);
    if(count($stat)==10) {
        for($i=0;$i<9;$i++){
            $stat[$i] = trim($stat[$i]);
            if(!is_numeric($stat[$i])){
                $stat[$i] = 0;
            }
        }
        $stat[$ind]++;
        $stats = implode(":",$stat);
        $f = fopen("../stat.txt", "w+");
        fwrite($f,$stats);
        fclose($f);
    }else {
        //функции мы вроде еще не изучали, так что так
        $i=0;
        while($i<10){
            $stat[] = 0;
            $i++;
        }
        $stat[$ind]++;
        $stats = implode(":",$stat);
        $f = fopen("../stat.txt","w+");
        fwrite($f,$stats);
        fclose($f);
    }
}

?>