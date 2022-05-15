<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Работа со строками 11 вариант</title>
    <meta charset="utf-8">
</head>
<body>
<?php
if (is_readable("input.txt") === false) {
    echo "Файл не обнаружен, либо не доступен для чтения";
    die;
}
if (mb_detect_encoding(file_get_contents("input.txt"), 'utf-8', true) === false) {
    echo "Кодировка входного файла не UTF-8";
    die;
}
$input = fopen("input.txt", "r");
$output = fopen("output.txt", "w+");
$alph = [
    'а',
    'б',
    'в',
    'г',
    'д',
    'е',
    'ё',
    'ж',
    'з',
    'и',
    'й',
    'к',
    'л',
    'м',
    'н',
    'о',
    'п',
    'р',
    'с',
    'т',
    'у',
    'ф',
    'х',
    'ц',
    'ч',
    'ш',
    'щ',
    'ъ',
    'ы',
    'ь',
    'э',
    'ю',
    'я',
    'a',
    'b',
    'c',
    'd',
    'e',
    'f',
    'g',
    'h',
    'i',
    'j',
    'k',
    'l',
    'm',
    'n',
    'o',
    'p',
    'q',
    'r',
    's',
    't',
    'u',
    'v',
    'w',
    'x',
    'y',
    'z',
];
while (! feof($input)) {
    $str = trim(strip_tags(fgets($input)));
    $arrW = explode(" ", $str);
    foreach ($arrW as $key1 => $item1) {
        if (isset($arrS)) {
            unset($arrS);
        }

        $prov = substr($item1, 0, 1);
        foreach ($alph as $t) {
            if ($t == $prov) {
                $zh = 1;
                break;
            }
        }
        if (isset($zh) && $zh === 1) {
        } else {
            $zh = 0;
            continue;
        }

        $i = 0;
        while ($i != strlen($item1)) {
            $arrS[] = substr($item1, $i, 1);
            $i++;
        }

        if (isset($arrS)) {
            $obr = array_count_values($arrS);
        } else {
            continue;
        }

        foreach ($obr as $key2 => $item2) {
            if (is_numeric($key2) === false && $item2 > 1) {
                $v = mb_strtoupper(substr($item1, 0, 1));

                $item1 = $v . substr($item1, 1);
                $arrW[$key1] = $item1;
                //не работает substr_replace($item1, $v, 0, 1);
                //не работает mb_strtoupper($item1);
                //echo "<br> $item1";
                break;
            }
        }
    }
    //print_r($arrW);
    $str = implode(" ", $arrW);
    $str = $str . "\n";
    fwrite($output, $str);
}

fclose($input);
fclose($output);
?>
</body>
</html>