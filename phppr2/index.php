<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Практика 2 | Вариант 6</title>
    <meta charset="utf-8">
</head>
<body>
<form method="POST">
    <div>
        Рубрика <br>
        <label>
            Технологии
            <input type="radio" name="rub" value="tech">
        </label>
        <label>
            Спорт
            <input type="radio" name="rub" value="sport">
        </label>
    </div>

    <?php
    $dirs = scandir(getcwd());
    foreach ($dirs as $item) {
        if (is_numeric($item) && strlen($item) == 8) {
            $year = substr($item, 0, 4);
            $month = substr($item, 4, 2);
            $day = substr($item, 6, 2);
            if (checkdate((int) ($month), (int) ($day), (int) ($year)) === true) {
                if (! isset($pr)) {
                    $pr = true;
                    echo "<select name='data'> <option selected disabled>Выберите дату</option>";
                }
                echo "<option value='$item'>$year.$month.$day</option>";
            }
        }
    }
    if (isset($pr)) {
        echo "</select>";
        echo "<br> <input type='submit'>";
    } else {
        echo "Директорий не обнаружено";
    }
    echo "</form>";

    if (! isset($_POST["rub"]) || ! isset($_POST["data"])) {
        echo "Не все поля формы были выбраны";
        die;
    }
    $rub = $_POST["rub"];
    $data = $_POST["data"];
    echo "<br> Были выбраны следующие данные: <br> Рубрика - [ $rub ] <br>  Дата - [ $data ] <br>";
    $dir = getcwd() . "\\$data";
    if (!is_dir($dir)) {
        echo "<br> Выбранная директория была удалена";
        die;
    }
    $files = scandir($dir);
    foreach ($files as $item1) {
        if (strpos($item1, $rub) !== false) {
            $str = file_get_contents("$dir\\$item1");
            if (! mb_detect_encoding($str, 'utf-8', true)) {
                echo "Файл \"$item1\" имеет некорректную кодировку <br>";
                continue;
            }
            $words = explode(" ", $str);
            foreach ($words as $item2) {
                $item = trim(strip_tags($item2));
                if (is_numeric($item2) && (int) ($item2) > 1900 && (int) ($item2) < 2100) {
                    $zag[] = substr($str, 0, strpos($str, "\n"));
                    $f[] = $item1;
                    break;
                }
            }
        }
    }
    if (isset($zag) && isset($f)) {
        echo "<br> В тексте следующих статей содержится год: <br>";
        foreach ($zag as $item) {
            echo "$item <br> <br>";
        }
        foreach ($f as $item) {
            echo "[ $item ] ";
        }
    } else {
        echo "<br> Найдено 0 статей";
    }
    ?>
</body>
</html>