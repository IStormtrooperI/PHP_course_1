<!DOCTYPE html>
<html lang="ru">
<head>
    <title>лабораторная 7 | Вариант 11</title>
    <meta charset="utf-8">
</head>
<body>
<form method="POST">
    <label>
        Введите имя каталога:
        <input type="text" name="dir">
    </label>
    <br>
    <label>
        Введите часть имени файлов *.txt:
        <input type="text" name="substr">
    </label>
    <br>
    <label>
        Создать файл txt со следующим именем:
        <input type="text" name="create">
    </label>
    <br>
    <input type="submit">
    <br>
</form>
<?php
if (! isset($_POST["dir"]) || $_POST["dir"] == "") {
    echo "Необходимо заполнить первое поле формы";
    die;
}
$dir = $_POST["dir"];
$dir = getcwd() . "$dir";
if (! is_dir($dir)) {
    echo "Заданной папки не существует <br>";
    die;
}
if (((isset($_POST["substr"]) || isset($_POST["create"])) === false) || ((! $_POST["substr"] == "" || ! $_POST["create"] == "") === false)) {
    echo "Второе и третье поля не заданы => никаких операций не происходит <br>";
    die;
}

echo "Выбран каталог - [ $dir ] <br>";
if (isset($_POST["substr"]) || $_POST["substr"] != "") {
    $substr = $_POST["substr"];
    echo "Производиться поиск файлов с именем [ *$substr*.txt ] <br>";
    $files = scandir($dir);
    foreach ($files as $file) {
        $r = substr($file, strlen($file) - 4);
        $file = substr($file, 0, strlen($file) - 4);
        if (strpos($file, $substr) !== false && isset($r) && $r == ".txt") {
            if(!isset($fs)){
                echo "-------------------------- <br>";
            }
                    $fs[] = $file . $r;
                    $str = htmlspecialchars_decode(file_get_contents($dir . "\\$file$r"),ENT_HTML5);
                    while(strpos($str,"\n") !== false)
                    {
                        $str = str_replace("\n","<br>",$str);
                    }
                    echo "$str <br>-------------------------- <br>";
        }
    }
    if(!isset($fs)){
        echo "Поиск завершен, файлов не обнаружено<br>";
    } else
    {
        echo "Поиск завершен, содержимое следующих файлов было выведено выше: <br>";
        foreach($fs as $f){
            echo "[ $f ] ";
        }
        echo "<br>";
    }
}
if (isset($_POST["create"]) || $_POST["create"] != ""){
    $cr = $_POST["create"];
    if(file_exists($dir."\\$cr.txt")){
        echo "Создание файла с именем [ $cr.txt ] прервано, такой файл уже существует";
    } else {
        $rf = fopen("$dir\\$cr.txt", 'w');
        fwrite($rf,date('l jS \of F Y'));
        fclose($rf);
        echo "Файл с именем [ $cr.txt ] был создан";
    }
}


?>
</body>
</html>