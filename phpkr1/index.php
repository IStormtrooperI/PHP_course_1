<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Контрольная №1 | Вариант 3</title>
    <meta charset="utf-8">
</head>
<body>
<form method="POST">
    <div>
        <label>
            Выберите файл
            <input type="file" name="name">
        </label>
    </div>
    <div>
        <label>
            Выберите режим сортировки:
            <select name="sort">
                <option value="0">
                    Год рождения по возрастанию в строку через точку с запятой
                </option>
                <option value="1">
                    ФИО в столбик
                </option>
                <option value="2">
                    ФИО и год рождения в столбик
                </option>
            </select>
        </label>
    </div>
    <div>
        <input type="submit" value="Обработать">
    </div>
</form>
</body>
</html>

<?php
setlocale(LC_ALL, "ru_RU.UTF-8");
if(isset($_POST["name"]) && $_POST["name"] != ""){
    $dir = __DIR__ . "/" . $_POST["name"];
    if(is_readable($dir)){
        $file = file_get_contents($dir);
        $strs = explode("\n",$file);
        $bz = [ "age" => array(), "fio" => array()];
        foreach($strs as $item){
            if(preg_match("/[\d]{4,4}/",$item,$age) && preg_match("/[А-ЯЁ][а-яё]+\s[А-ЯЁ][а-яё]+\s[А-ЯЁ][а-яё]+/u",$item,$fio)){
                $bz["age"][] = $age[0];
                $bz["fio"][] = $fio[0];
            }
        }
        echo "«Список студентов» <div>";
        if($_POST["sort"] == 0){
            sort($bz["age"]);
            foreach($bz["age"] as $key => $item){
                if($key == count($bz["age"]) - 1) {
                    echo "<p style='font-style: italic; display: inline-block'>$item</p>";
                } else{
                    echo "<p style='font-style: italic; display: inline-block'>$item</p>;";
                }
            }
        }elseif($_POST["sort"] == 1){
            foreach($bz["fio"] as $key => $item){
                echo "<p style='font-weight: bold'>$item</p>";
            }
        } elseif ($_POST["sort"] == 2){
            for($i=0;$i<count($bz["age"])-1;$i++){
                $fio = $bz["fio"][$i];
                $age = $bz["age"][$i];
                echo "<p><span style='font-weight: bold'>$fio</span> <span style='font-style: italic'>$age</span></p>";
            }
        }
        echo "</div>";
    } else{
        echo "Некорректное имя файла, либо файл недоступен для чтения";
    }
} else {
    echo "Файл не выбран";
}
?>