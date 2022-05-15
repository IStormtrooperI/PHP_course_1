<!DOCTYPE html>
<html lang="ru">
<head>
    <title>лабораторная 9</title>
    <meta charset="utf-8">
</head>
<body>
<form method="get">
    <label>Выберите область страны
    <select name="nazv">
        <option selected disabled>Выберите область:</option>
        <option value="AL">Алабама</option>
        <option value="AK">Аляска</option>
        <option value="AZ">Аризона</option>
        <option value="AR">Арканзас</option>
        <option value="CA">Калифорния</option>
        <option value="CO">Колорадо</option>
        <option value="CT">Коннектикут</option>
        <option value="DE">Делавэр</option>
        <option value="DC">округ Колумбия</option>
        <option value="FL">Флорида</option>
        <option value="GA">Джорджия</option>
        <option value="HI">Гавайи</option>
        <option value="ID">Айдахо</option>
        <option value="IL">Иллинойс</option>
        <option value="IN">Индиана</option>
        <option value="IA">Айова</option>
        <option value="KS">Канзас</option>
        <option value="KY">Кентукки</option>
        <option value="LA">Луизиана</option>
        <option value="ME">Мэн</option>
        <option value="MD">Мэриленд</option>
        <option value="MA">Массачусетс</option>
        <option value="MI">Мичиган</option>
        <option value="MN">Миннесота</option>
        <option value="MS">Миссисипи</option>
        <option value="MO">Миссури</option>
        <option value="MT">Монтана</option>
        <option value="NE">Небраска</option>
        <option value="NV">Невада</option>
        <option value="NH">Нью-Гэмпшир</option>
        <option value="NJ">Нью-Джерси</option>
        <option value="NM">Нью-Мексико</option>
        <option value="NY">Нью-Йорк</option>
        <option value="NC">Северная Каролина</option>
        <option value="ND">Северная Дакота</option>
        <option value="OH">Огайо</option>
        <option value="OK">Оклахома</option>
        <option value="OR">Орегон</option>
        <option value="PA">Пенсильвания</option>
        <option value="RI">Род-Айленд</option>
        <option value="SC">Южная Каролина</option>
        <option value="SD">Южная Дакота</option>
        <option value="TN">Теннесси</option>
        <option value="TX">Техас</option>
        <option value="UT">Юта</option>
        <option value="VT">Вермонт</option>
        <option value="VA">Виргиния</option>
        <option value="WA">Вашингтон</option>
        <option value="WV">Западная Виргиния</option>
        <option value="WI">Висконсин</option>
        <option value="WY">Вайоминг</option>
        <option value="AS">Американское Самоа</option>
        <option value="FM">Федеративные Штаты Микронезии</option>
        <option value="GU">Гуам</option>
        <option value="MH">Маршалловы Острова</option>
        <option value="MP">Северные Марианские Острова</option>
        <option value="PW">Палау</option>
        <option value="PR">Пуэрто-Рико</option>
        <option value="UM">Внешние малые острова США</option>
        <option value="VI">Виргинские Острова</option>
    </select>
    </label>
<!--    <input type="text" name="nazv">-->
    <input type="submit" value="Отправить название области">
</form>
<?php
$vr = microtime(true);
$array = [
    "Алабама"                       => "AL",
    "Аляска"                        => "AK",
    "Аризона"                       => "AZ",
    "Арканзас"                      => "AR",
    "Калифорния"                    => "CA",
    "Колорадо"                      => "CO",
    "Коннектикут"                   => "CT",
    "Делавэр"                       => "DE",
    "округ Колумбия"                => "DC",
    "Флорида"                       => "FL",
    "Джорджия"                      => "GA",
    "Гавайи"                        => "HI",
    "Айдахо"                        => "ID",
    "Иллинойс"                      => "IL",
    "Индиана"                       => "IN",
    "Айова"                         => "IA",
    "Канзас"                        => "KS",
    "Кентукки"                      => "KY",
    "Луизиана"                      => "LA",
    "Мэн"                           => "ME",
    "Мэриленд"                      => "MD",
    "Массачусетс"                   => "MA",
    "Мичиган"                       => "MI",
    "Миннесота"                     => "MN",
    "Миссисипи"                     => "MS",
    "Миссури"                       => "MO",
    "Монтана"                       => "MT",
    "Небраска"                      => "NE",
    "Невада"                        => "NV",
    "Нью-Гэмпшир"                   => "NH",
    "Нью-Джерси"                    => "NJ",
    "Нью-Мексико"                   => "NM",
    "Нью-Йорк"                      => "NY",
    "Северная Каролина"             => "NC",
    "Северная Дакота"               => "ND",
    "Огайо"                         => "OH",
    "Оклахома"                      => "OK",
    "Орегон"                        => "OR",
    "Пенсильвания"                  => "PA",
    "Род-Айленд"                    => "RI",
    "Южная Каролина"                => "SC",
    "Южная Дакота"                  => "SD",
    "Теннесси"                      => "TN",
    "Техас"                         => "TX",
    "Юта"                           => "UT",
    "Вермонт"                       => "VT",
    "Виргиния"                      => "VA",
    "Вашингтон"                     => "WA",
    "Западная Виргиния"             => "WV",
    "Висконсин"                     => "WI",
    "Вайоминг"                      => "WY",
    "Американское Самоа"            => "AS",
    "Федеративные Штаты Микронезии" => "FM",
    "Гуам"                          => "GU",
    "Маршалловы Острова"            => "MH",
    "Северные Марианские Острова"   => "MP",
    "Палау"                         => "PW",
    "Пуэрто-Рико"                   => "PR",
    "Внешние малые острова США"     => "UM",
    "Виргинские Острова"            => "VI",
];
$tag = ["<", ">"];

if (! is_readable("OLDBASE.TXT")) {
    echo "Файл базы данных не найден";
    die;
}
$file = trim(file_get_contents("OLDBASE.TXT"));
$strs = explode("\n", $file);
foreach ($strs as $key => $item) {
    str_replace($tag, "", $item);
    if ((isset($strs[$key + 1]) && strlen($strs[$key + 1]) == 0) || (isset($strs[$key - 1]) && strlen(
                $strs[$key - 1]
            ) == 0) || strlen($strs[$key]) == 0) {
        continue;
    }
    $tstrs[] = $item;
}
unset($strs, $tag);

$male = 0;
$female = 0;
$srrostm = (float) 0;
$srrostf = (float) 0;
$srvesm = (float) 0;
$srvesf = (float) 0;
$srvozm = (float) 0;
$srvozf = (float) 0;

$MaxVoz = 0;
$MinVoz = 200;
$strMaxVoz = "";
$strMinVoz = "";

$PrDate = ["1.1", "7.1", "14.2", "23.2", "8.3", "1.5", "31.12"];
$PrDateN = [];
$errors = [0, 0, 0, 0];//почта,пол,номер телефона,адрес
foreach ($tstrs as $key => $item) {
    $zap = explode(",", $item);
    {//номер записи
        $zap[0] = str_pad($zap[0], 6, "0", STR_PAD_LEFT);
    }
    {//номер телефона
        $zap[8] = str_replace("-", "", $zap[8]);
        if (! is_numeric($zap[8])) {
            $errors[2]++;
            $zap[8] = preg_replace('/\D/', "", $zap[8]);
        }
        if (strlen($zap[8]) == 10) {
            $zap[8] = substr($zap[8], 0, 3) . "-" . substr($zap[8], 3, 3) . "-" . substr($zap[8], 6, 4);
        } elseif (strlen($zap[8]) == 9) {
            $zap[8] = substr($zap[8], 0, 2) . "-" . substr($zap[8], 2, 3) . "-" . substr($zap[8], 5, 4);
        } elseif (strlen($zap[8]) == 8) {
            $zap[8] = substr($zap[8], 0, 1) . "-" . substr($zap[8], 1, 3) . "-" . substr($zap[8], 4, 4);
        }
    }
    {//Email
        if (! preg_match("/^[a-zA-Z0-9]+@[a-zA-Z]+\.[a-zA-Z]+$/", $zap[7])) {
            $errors[0]++;
            $zap[7] = str_replace("@@", "@", $zap[7]);
            $zap[7] = preg_replace("/[^A-Za-z0-9@\.]/", "", $zap[7]);
        }
        if (preg_match("/@[a-zA-Z]+\.[a-zA-Z]+$/", $zap[7])) {
            $strD = substr($zap[7], strpos($zap[7], "@") + 1);
            if (! isset($Pserv[$strD])) {
                $Pserv[$strD] = 1;
            } else {
                $Pserv[$strD]++;
            }
        }
    }
    {//Адрес
        $s = explode(" ", $zap[14]);
        foreach ($s as $key1 => $item1) {
            if ($key1 != 0) {
                $s[$key1] = preg_replace("/[^A-Za-z]/", "", $item1);
            }
            if ($key1 == 0) {
                $st1 = $item1;
            }
        }
        $st = implode(" ", $s);
        if (strlen($st) != strlen($zap[14])) {
            $errors[3]++;
        }
        $zap[14] = substr($st, strlen($st1) + 1) . ", $st1";
    }
    {//Вес
        $zap[12] = round((float) $zap[12], 0);
    }
    {//Дата рождения
        $date = explode("/", $zap[9]);
        $zap[9] = "$date[1].$date[0].$date[2]";
        foreach ($PrDate as $item1) {
            if ("$date[1].$date[0]" == $item1) {
                $PrDateN[] = [$item1 => $zap[1]];
            }
        }
    }
    $t = floor((strtotime(date("d.m.Y")) - strtotime($zap[9])) / (60 * 60 * 24 * 365));
    if ($MaxVoz < $t) {
        $MaxVoz = $t;
        $strMaxVoz = "$zap[1] $zap[8] $zap[14]";
    }
    if ($MinVoz > $t) {
        $MinVoz = $t;
        $strMinVoz = "$zap[1] $zap[8] $zap[14]";
    }

    {//пол
        if ($zap[4] != "male" && $zap[4] != "female") {
            $errors[1]++;
            unset($zap[4]);
        } elseif ($zap[4] == "male") {
            if ($srrostm != 0) {
                $srrostm = ($srrostm + $zap[13]) / 2;
            } else {
                $srrostm = $srrostm + $zap[13];
            }
            if ($srvesm != 0) {
                $srvesm = ($srvesm + $zap[12]) / 2;
            } else {
                $srvesm = $srvesm + $zap[12];
            }
            if ($srvozm != 0) {
                $srvozm = ($srvozm + $t) / 2;
            } else {
                $srvozm = $t;
            }
            $male++;
            $zap[4] = "1";
        } else {
            if ($srrostf != 0) {
                $srrostf = ($srrostf + $zap[13]) / 2;
            } else {
                $srrostf = $srrostf + $zap[13];
            }
            if ($srvesf != 0) {
                $srvesf = ($srvesf + $zap[12]) / 2;
            } else {
                $srvesf = $srvesf + $zap[12];
            }
            if ($srvozf != 0) {
                $srvozf = ($srvozf + $t) / 2;
            } else {
                $srvozf = $t;
            }
            $female++;
            $zap[4] = "0";
        }
    }

    $tstrs[$key] = implode(";", $zap);
    // echo "<p>$tstrs[$key]</p>";
}
$srvozm = round($srvozm, 0);
$srvozf = round($srvozf, 0);
$srvesf = round($srvesf, 1);
$srvesm = round($srvesm, 1);
$srrostf = round($srrostf, 1);
$srrostm = round($srrostm, 1);

$Msrvozm = 0;
$Msrvozf = 0;
$Msrvesf = 0;
$Msrvesm = 0;
$Msrrostf = 0;
$Msrrostm = 0;

$Bsrvozm = 0;
$Bsrvozf = 0;
$Bsrvesf = 0;
$Bsrvesm = 0;
$Bsrrostf = 0;
$Bsrrostm = 0;

$Ssrvozm = 0;
$Ssrvozf = 0;
$Ssrvesf = 0;
$Ssrvesm = 0;
$Ssrrostf = 0;
$Ssrrostm = 0;

$f = fopen("NEWBASE.TXT", "w+");
foreach ($tstrs as $item) {
    $zap = explode(";", $item);
    $zap[12] = (float) $zap[12];
    $zap[13] = (float) $zap[13];
    $t = floor((strtotime(date("d.m.Y")) - strtotime($zap[9])) / (60 * 60 * 24 * 365));
    if ($zap[4] == "1") {
        if ($zap[12] > $srvesm) {
            $Msrvesm++;
        } elseif ($zap[12] < $srvesm) {
            $Bsrvesm++;
        } else {
            $Ssrvesm++;
        }
        if ($zap[13] > $srrostm) {
            $Msrrostm++;
        } elseif ($zap[13] < $srrostm) {
            $Bsrrostm++;
        } else {
            $Ssrrostm++;
        }
        if ($t > $srvozm) {
            $Msrvozm++;
        } elseif ($t < $srvozm) {
            $Bsrvozm++;
        } else {
            $Ssrvozm++;
        }
    } else {
        if ($zap[12] > $srvesf) {
            $Msrvesf++;
        } elseif ($zap[12] < $srvesf) {
            $Bsrvesf++;
        } else {
            $Ssrvesf++;
        }
        if ($zap[13] > $srrostf) {
            $Msrrostf++;
        } elseif ($zap[13] < $srrostf) {
            $Bsrrostf++;
        } else {
            $Ssrrostf++;
        }
        if ($t > $srvozf) {
            $Msrvozf++;
        } elseif ($t < $srvozf) {
            $Bsrvozf++;
        } else {
            $Ssrvozf++;
        }
    }
    fwrite($f, $item . "\n");
}
fclose($f);

foreach ($PrDateN as $item) {
    foreach ($item as $key => $item1) {
        if ($key == "1.1") {
            $r11[] = $item1;
        }
        if ($key == "7.1") {
            $r71[] = $item1;
        }
        if ($key == "14.2") {
            $r142[] = $item1;
        }
        if ($key == "23.2") {
            $r232[] = $item1;
        }
        if ($key == "8.3") {
            $r83[] = $item1;
        }
        if ($key == "1.5") {
            $r15[] = $item1;
        }
        if ($key == "31.12") {
            $r3112[] = $item1;
        }
    }
}

echo "Ошибок в email $errors[0] |Ошибок в поле $errors[1] | Ошибок в телефоне $errors[2] | Ошибок в адресе $errors[3] <br>";
echo "Мужчин - $male, Женщин - $female <br>";
echo "Средний рост: М = $srrostm, Ж = $srrostf <br>";
echo "Средний вес: М = $srvesm, Ж = $srvesf <br>";
echo "Средний возраст: М = $srvozm, Ж = $srvozf <br>";
echo "Мужчины <br>";
echo "Возраст: больше среднего $Bsrvozm, меньше среднего $Msrvozm, среднее $Ssrvozm <br>";
echo "Рост: выше среднего $Bsrrostm, ниже среднего $Msrrostm, среднее $Ssrrostm <br>";
echo "Вес: больше среднего $Bsrvesm, меньше среднего, $Msrvesm, среднее $Ssrvesm <br>";
echo "Женщины <br>";
echo "Возраст: больше среднего $Bsrvozf, меньше среднего $Msrvozf, среднее $Ssrvozf <br>";
echo "Рост: выше среднего $Bsrrostf, ниже среднего $Msrrostf, среднее $Ssrrostf <br>";
echo "Вес: больше среднего $Bsrvesf, меньше среднего, $Msrvesf, среднее $Ssrvesf <br>";
echo "Максимальный возраст: $strMaxVoz<br>";
echo "Минимальный возраст: $strMinVoz<br>";
echo "Почтовый сервер | Количество клиентов<br>";
foreach ($Pserv as $key => $item) {
    echo "$key | $item<br>";
}
//print_r($PrDateN);
echo "Родившиеся в праздничные дни:<br>";
echo "01.01<br>";
foreach ($r11 as $item) {
    echo "[$item]";
}
echo "<br>07.01<br>";
foreach ($r71 as $item) {
    echo "[$item]";
}
echo "<br>14.02<br>";
foreach ($r142 as $item) {
    echo "[$item]";
}
echo "<br>23.02<br>";
foreach ($r232 as $item) {
    echo "[$item]";
}
echo "<br>08.03<br>";
foreach ($r83 as $item) {
    echo "[$item]";
}
echo "<br>01.05<br>";
foreach ($r15 as $item) {
    echo "[$item]";
}
echo "<br>31.12<br>";
foreach ($r3112 as $item) {
    echo "[$item]";
}
echo "<br><br>";

if (isset($_GET["nazv"])) {
    $obl = $_GET["nazv"];
    foreach ($tstrs as $key => $item) {
        $zap = explode(";", $item);
        if ($zap[6] != $obl) {
            unset($tstrs[$key]);
            continue;
        }
        $tstrs[$key] = $zap[3] . ";" . $tstrs[$key];
    }
    sort($tstrs);
    foreach ($tstrs as $key => $item) {
        $zap = explode(";", $item);
        unset($zap[0]);
        if ($zap[5] == "1") {
            $zap[2] = "<span style='color: pink'>$zap[2]</span>";
        } else {
            $zap[2] = "<span style='color: #14cbe2'>$zap[2]</span>";
        }
        $zap[10] = floor((strtotime(date("d.m.Y")) - strtotime($zap[10])) / (60 * 60 * 24 * 365));
        $tstrs[$key] = implode(";", $zap);
        echo $tstrs[$key] . "<br>";
    }
}
echo microtime(true) - $vr;
?>


</body>
</html>