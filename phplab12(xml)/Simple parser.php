<!DOCTYPE html>
<html lang="ru">
<head>
    <title>лабораторная 12(xml-Simple) | Вариант общий</title>
    <meta charset="utf-8">
</head>
<body>
<?php

//region Вывод данных

$xml_Simple = simplexml_load_file("mv.xml");

echo "<table border='1px' style='border-collapse: collapse; text-align: center' cellpadding='5px'>
              <caption>Mvideo</caption>
              <tr bgcolor='#ffc0cb'><th>Каталог</th><th>Вид</th><th>Подвид</th><th>Производитель</th><th>Модель</th></tr>";

foreach ($xml_Simple->children() as $catalogue) {

    $catalog = $catalogue['catalog'];

    if($catalogue->children()[0]['vid'] === null){
            echo "<tr bgcolor='#d7d7d7'><td>$catalog</td><td></td><td></td><td></td><td>
                              </td></tr>";
            continue;
    }

    foreach ($catalogue->children() as $view) {

        $vid = $view['vid'];

        if($view->children()[0]['podvid'] === null){
            echo "<tr bgcolor='#d7d7d7'><td>$catalog</td><td>$vid</td><td></td><td></td><td>
                          </td></tr>";
            continue;
        }

        foreach ($view->children() as $subspecies) {

            $podvid = $subspecies['podvid'];

            if($subspecies->children()[0]['company'] === null){
                echo "<tr bgcolor='#d7d7d7'><td>$catalog</td><td>$vid</td><td>$podvid</td><td></td><td>
                          </td></tr>";
                continue;
            }

            foreach ($subspecies->children() as $marka) {

                $company = $marka['company'];

                if($marka->children()[0]['mod'] === null){
                    echo "<tr bgcolor='#d7d7d7'><td>$catalog</td><td>$vid</td><td>$podvid</td><td>$company</td><td>
                          </td></tr>";
                    continue;
                }

                foreach ($marka->children() as $model) {

                    $mod = $model['mod'];

                    echo "<tr bgcolor='#d7d7d7'><td>$catalog</td><td>$vid</td><td>$podvid</td><td>$company</td><td>$mod
                          </td></tr>";
                }
            }
        }
    }
}
echo "</table>";

$xml_Simple->asXML("mv.xml");

//endregion

?>
</body>
</html>