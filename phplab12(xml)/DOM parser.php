<!DOCTYPE html>
<html lang="ru">
<head>
    <title>лабораторная 12(xml-DOM) | Вариант общий</title>
    <meta charset="utf-8">
</head>
<body>
<?php

//region Работа с данными

$xml_DOM = new DOMDocument();
$xml_DOM->load("mv.xml");

$elems = ["mvideo", "catalogue", "view", "subspecies", "marka", "model"];
$elems_ru = ["mvideo", "каталог", "вид", "подвид", "прооизводитель", "модель"];
$attrs = ["", "catalog", "vid", "podvid", "company", "mod"];

if (isset($_POST['add']) || isset($_POST['edit']) || isset($_POST['delete']) || isset($_POST['add_new_object']) || isset($_POST['edit_old_object'])) {
    if(isset($_POST['add_new_object']) || isset($_POST['add']) || isset($_POST['delete'])) {
        $info = explode('.', $_POST['info']);
        $tag_name = $info[0];
        $index = $info[1];
    }

    if (isset($_POST['delete'])) {
        $xml_DOM->getElementsByTagName($tag_name)[$index]->parentNode->removeChild(
            $xml_DOM->getElementsByTagName($tag_name)[$index]
        );
    } elseif (isset($_POST['add']) || isset($_POST['add_new_object'])) {
        if (isset($_POST['new_object']) /* && preg_match('/^[A-Za-z,\s.\-\/0-9]{3,}$/u', $_POST['new_object'])*/ ) {

            foreach ($elems as $key => $item) {
                if ($tag_name == $item) {
                    $tag_name_parent = $elems[$key - 1];
                    $key_attr = $key;
                    break;
                }
            }

            $new_object = htmlspecialchars($_POST['new_object']);

            $attr = $attrs[$key_attr];

            $new_element = $xml_DOM->createElement($tag_name);
            $new_element->setAttribute($attr, $new_object);

            $parent = $xml_DOM->getElementsByTagName($tag_name_parent)[$index];
            $parent->appendChild($new_element);

            echo "<p>Объект добавлен</p>";
        } else {
            if (isset($_POST['new_object'])) {
                echo "Введено некорректное название объекта";
            }

            foreach ($elems as $key => $item) {
                if ($tag_name == $item) {
                    $tag_name = $elems[$key + 1];
                    $tag_name_ru = $elems_ru[$key + 1];
                    break;
                }
            }
            echo "";

            echo "<form method='POST'><div><label>Введите корректное название нового объекта [ $tag_name_ru ] : <input type='text' name='new_object'>
                  <input type='hidden' name='info' readonly value='$tag_name.$index'></label><input type='submit' name='add_new_object' value='Добавить'></div></form>";
        }
    } elseif (isset($_POST['edit']) || isset($_POST['edit_old_object'])) {
        $info_r = explode('.', $_POST['info_r']);
        $tag_name_r = $info_r[0];
        $index_r = $info_r[1];



        if (isset($_POST['edit_object']) /* && preg_match('/^[A-Za-z,\s.\-\/0-9]{3,}$/', $_POST['edit_object']) */) {

            foreach ($elems as $key => $item) {
                if ($tag_name_r == $item) {
                    $key_attr = $key;
                    break;
                }
            }

            $attr = $attrs[$key_attr];

            $edit_object = trim(htmlspecialchars($_POST['edit_object']));


            if($edit_object != "") {
                $xml_DOM->getElementsByTagName($tag_name_r)[$index_r]->setAttribute($attr, $edit_object);
            }

            if(isset($_POST['edit_object4'])){
                $_POST['edit_object4'] = trim($_POST['edit_object4']);
                if($_POST['edit_object4'] != ""){
                    $xml_DOM->getElementsByTagName($tag_name_r)[$index_r]->parentNode->setAttribute($attrs[4], $_POST['edit_object4']);
                }
            }
            if(isset($_POST['edit_object3'])){
                $_POST['edit_object3'] = trim($_POST['edit_object3']);
                if($_POST['edit_object3'] != ""){
                    $xml_DOM->getElementsByTagName($tag_name_r)[$index_r]->parentNode->parentNode->setAttribute($attrs[3], $_POST['edit_object3']);
                }
            }
            if(isset($_POST['edit_object2'])){
                $_POST['edit_object2'] = trim($_POST['edit_object2']);
                if($_POST['edit_object2'] != ""){
                    $xml_DOM->getElementsByTagName($tag_name_r)[$index_r]->parentNode->parentNode->parentNode->setAttribute($attrs[2], $_POST['edit_object2']);
                }
            }
            if(isset($_POST['edit_object1'])){
                $_POST['edit_object1'] = trim($_POST['edit_object1']);
                if($_POST['edit_object1'] != ""){
                    $xml_DOM->getElementsByTagName($tag_name_r)[$index_r]->parentNode->parentNode->parentNode->parentNode->setAttribute($attrs[1], $_POST['edit_object1']);
                }
            }



        } else {
            if (isset($_POST['edit_object'])) {
                echo "Введено некорректное название объекта";
            }

            echo "<div><form method='POST'>";

            foreach ($elems as $key => $item) {
                if($item == "mvideo") {
                    continue;
                }
                if ($tag_name_r == $item) {
                    $tag_name_ru = $elems_ru[$key];
                    break;
                }

                $tag_name_ru = $elems_ru[$key];

                echo "<div><label>Введите корректное название объекта [ $tag_name_ru ] : <input type='text' name='edit_object$key'></label></div>";

            }


            echo "<label>Введите корректное название объекта [ $tag_name_ru ] : <input type='text' name='edit_object'>
                  <input type='hidden' name='info_r' readonly value='$tag_name_r.$index_r'></label><input type='submit' name='edit_old_object' value='Изменить'></form></div>";
        }
    }
}

$xml_DOM->save("mv.xml");

//endregion

//region Вывод данных

$xml_DOM = new DOMDocument();
$xml_DOM->load("mv.xml");

$b_drop = "images/b_drop.png";
$b_edit = "images/b_edit.png";
$b_add = "images/b_table_add.png";

echo "<table border='2px' style='border-collapse: collapse' cellpadding='5px'>
              <caption>Mvideo</caption>
              <tr bgcolor='#ffc0cb'><th>Каталог</th><th>Вид</th><th>Подвид</th><th>Производитель</th><th>Модель</th></tr>";

foreach ($xml_DOM->getElementsByTagName('catalogue') as $key_c => $catalogue) {

    $catalog = $catalogue->getAttribute('catalog');

    if($catalogue->firstChild == null) {

        echo "<tr bgcolor='#d7d7d7'>
                  <form method='POST'><td><input name='info_r' type='hidden' readonly value='catalogue.$key_c'>
                  <input name='info' type='hidden' readonly value='catalogue.$key_c'>$catalog
                  <div><input type='submit' name='add' value='' title='Добавить Вид' style='background: transparent url(" . $b_add . "); width: 20px; height: 20px'>
                  <input type='submit' name='edit' value='' title='Изменить' style='background: transparent url(" . $b_edit . "); width: 20px; height: 20px'>
                  <input type='submit' name='delete' value='' title='Удалить' style='background: transparent url(" . $b_drop . "); width: 20px; height: 20px'></div>
                  </td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td></form></tr>";

        continue;

    }

    foreach ($xml_DOM->getElementsByTagName('view') as $key_v => $view) {

        if ($view->parentNode->getAttribute('catalog') != $catalog) {
            continue;
        }

        $vid = $view->getAttribute('vid');

        if($view->firstChild == null) {

            echo "<tr bgcolor='#d7d7d7'>
                      <td><form method='POST'><input name='info_r' type='hidden' readonly value='view.$key_v'>
                      <input name='info' type='hidden' readonly value='catalogue.$key_c'>$catalog
                      <div><input type='submit' name='add' value='' title='Добавить Вид' style='background: transparent url(" . $b_add . "); width: 20px; height: 20px'>
                      <input type='submit' name='edit' value='' title='Изменить' style='background: transparent url(" . $b_edit . "); width: 20px; height: 20px'>
                      <input type='submit' name='delete' value='' title='Удалить' style='background: transparent url(" . $b_drop . "); width: 20px; height: 20px'></div>
                      </form></td>
                      <td><form method='POST'><input name='info_r' type='hidden' readonly value='view.$key_v'>
                      <input name='info' type='hidden' readonly value='view.$key_v'>$vid
                      <div><input type='submit' name='add' value='' title='Добавить Подвид' style='background: transparent url(" . $b_add . "); width: 20px; height: 20px'>
                      <input type='submit' name='edit' value='' title='Изменить' style='background: transparent url(" . $b_edit . "); width: 20px; height: 20px'>
                      <input type='submit' name='delete' value='' title='Удалить' style='background: transparent url(" . $b_drop . "); width: 20px; height: 20px'></div>
                      </form></td>
                      <td></td>
                      <td></td>
                      <td></td></tr>";

            continue;

        }

        foreach ($xml_DOM->getElementsByTagName('subspecies') as $key_s => $subspecies) {

            if ($subspecies->parentNode->getAttribute('vid') != $vid) {
                continue;
            }

            $podvid = $subspecies->getAttribute('podvid');

            if($subspecies->firstChild == null) {

                echo "<tr bgcolor='#d7d7d7'>
                          <td><form method='POST'><input name='info_r' type='hidden' readonly value='subspecies.$key_s'>
                          <input name='info' type='hidden' readonly value='catalogue.$key_c'>$catalog
                          <div><input type='submit' name='add' value='' title='Добавить Вид' style='background: transparent url(" . $b_add . "); width: 20px; height: 20px'>
                          <input type='submit' name='edit' value='' title='Изменить' style='background: transparent url(" . $b_edit . "); width: 20px; height: 20px'>
                          <input type='submit' name='delete' value='' title='Удалить' style='background: transparent url(" . $b_drop . "); width: 20px; height: 20px'></div>
                          </form></td>
                          <td><form method='POST'><input name='info_r' type='hidden' readonly value='subspecies.$key_s'>
                          <input name='info' type='hidden' readonly value='view.$key_v'>$vid
                          <div><input type='submit' name='add' value='' title='Добавить Подвид' style='background: transparent url(" . $b_add . "); width: 20px; height: 20px'>
                          <input type='submit' name='edit' value='' title='Изменить' style='background: transparent url(" . $b_edit . "); width: 20px; height: 20px'>
                          <input type='submit' name='delete' value='' title='Удалить' style='background: transparent url(" . $b_drop . "); width: 20px; height: 20px'></div>
                          </form></td>
                          <td><form method='POST'><input name='info_r' type='hidden' readonly value='subspecies.$key_s'>
                          <input name='info' type='hidden' readonly value='subspecies.$key_s'>$podvid
                          <div><input type='submit' name='add' value='' title='Добавить Производителя' style='background: transparent url(" . $b_add . "); width: 20px; height: 20px'>
                          <input type='submit' name='edit' value='' title='Изменить' style='background: transparent url(" . $b_edit . "); width: 20px; height: 20px'>
                          <input type='submit' name='delete' value='' title='Удалить' style='background: transparent url(" . $b_drop . "); width: 20px; height: 20px'></div>
                          </form></td>
                          <td></td>
                          <td></td></tr>";

                continue;

            }

            foreach ($xml_DOM->getElementsByTagName('marka') as $key_m => $marka) {

                if ($marka->parentNode->getAttribute('podvid') != $podvid) {
                    continue;
                }

                $company = $marka->getAttribute('company');

                if($subspecies->firstChild == null) {

                    echo "<tr bgcolor='#d7d7d7'>
                          <td><form method='POST'><input name='info_r' type='hidden' readonly value='marka.$key_m'>
                          <input name='info' type='hidden' readonly value='catalogue.$key_c'>$catalog
                          <div><input type='submit' name='add' value='' title='Добавить Вид' style='background: transparent url(" . $b_add . "); width: 20px; height: 20px'>
                          <input type='submit' name='edit' value='' title='Изменить' style='background: transparent url(" . $b_edit . "); width: 20px; height: 20px'>
                          <input type='submit' name='delete' value='' title='Удалить' style='background: transparent url(" . $b_drop . "); width: 20px; height: 20px'></div>
                          </form></td>
                          <td><form method='POST'><input name='info_r' type='hidden' readonly value='marka.$key_m'>
                          <input name='info' type='hidden' readonly value='view.$key_v'>$vid
                          <div><input type='submit' name='add' value='' title='Добавить Подвид' style='background: transparent url(" . $b_add . "); width: 20px; height: 20px'>
                          <input type='submit' name='edit' value='' title='Изменить' style='background: transparent url(" . $b_edit . "); width: 20px; height: 20px'>
                          <input type='submit' name='delete' value='' title='Удалить' style='background: transparent url(" . $b_drop . "); width: 20px; height: 20px'></div>
                          </form></td>
                          <td><form method='POST'><input name='info_r' type='hidden' readonly value='marka.$key_m'>
                          <input name='info' type='hidden' readonly value='subspecies.$key_s'>$podvid
                          <div><input type='submit' name='add' value='' title='Добавить Производителя' style='background: transparent url(" . $b_add . "); width: 20px; height: 20px'>
                          <input type='submit' name='edit' value='' title='Изменить' style='background: transparent url(" . $b_edit . "); width: 20px; height: 20px'>
                          <input type='submit' name='delete' value='' title='Удалить' style='background: transparent url(" . $b_drop . "); width: 20px; height: 20px'></div>
                          </form></td>
                          <td><form method='POST'><input name='info_r' type='hidden' readonly value='marka.$key_m'>
                          <input name='info' type='hidden' readonly value='marka.$key_m'>$company
                          <div><input type='submit' name='add' value='' title='Добавить Модель' style='background: transparent url(" . $b_add . "); width: 20px; height: 20px'>
                          <input type='submit' name='edit' value='' title='Изменить' style='background: transparent url(" . $b_edit . "); width: 20px; height: 20px'>
                          <input type='submit' name='delete' value='' title='Удалить' style='background: transparent url(" . $b_drop . "); width: 20px; height: 20px'></div>
                          </form></td>
                          <td></td></tr>";

                    continue;

                }

                foreach ($xml_DOM->getElementsByTagName('model') as $key_mm => $model) {

                    if ($model->parentNode->getAttribute('company') != $company) {
                        continue;
                    }

                    $mod = $model->getAttribute('mod');

                    echo "<tr bgcolor='#d7d7d7'>
                          <td><form method='POST'><input name='info_r' type='hidden' readonly value='model.$key_mm'>
                          <input name='info' type='hidden' readonly value='catalogue.$key_c'>$catalog
                          <div><input type='submit' name='add' value='' title='Добавить Вид' style='background: transparent url(" . $b_add . "); width: 20px; height: 20px'>
                          <input type='submit' name='edit' value='' title='Изменить' style='background: transparent url(" . $b_edit . "); width: 20px; height: 20px'>
                          <input type='submit' name='delete' value='' title='Удалить' style='background: transparent url(" . $b_drop . "); width: 20px; height: 20px'></div>
                          </form></td>
                          <td><form method='POST'><input name='info_r' type='hidden' readonly value='model.$key_mm'>
                          <input name='info' type='hidden' readonly value='view.$key_v'>$vid
                          <div><input type='submit' name='add' value='' title='Добавить Подвид' style='background: transparent url(" . $b_add . "); width: 20px; height: 20px'>
                          <input type='submit' name='edit' value='' title='Изменить' style='background: transparent url(" . $b_edit . "); width: 20px; height: 20px'>
                          <input type='submit' name='delete' value='' title='Удалить' style='background: transparent url(" . $b_drop . "); width: 20px; height: 20px'></div>
                          </form></td>
                          <td><form method='POST'><input name='info_r' type='hidden' readonly value='model.$key_mm'>
                          <input name='info' type='hidden' readonly value='subspecies.$key_s'>$podvid
                          <div><input type='submit' name='add' value='' title='Добавить Производителя' style='background: transparent url(" . $b_add . "); width: 20px; height: 20px'>
                          <input type='submit' name='edit' value='' title='Изменить' style='background: transparent url(" . $b_edit . "); width: 20px; height: 20px'>
                          <input type='submit' name='delete' value='' title='Удалить' style='background: transparent url(" . $b_drop . "); width: 20px; height: 20px'></div>
                          </form></td>
                          <td><form method='POST'><input name='info_r' type='hidden' readonly value='model.$key_mm'>
                          <input name='info' type='hidden' readonly value='marka.$key_m'>$company
                          <div><input type='submit' name='add' value='' title='Добавить Модель' style='background: transparent url(" . $b_add . "); width: 20px; height: 20px'>
                          <input type='submit' name='edit' value='' title='Изменить' style='background: transparent url(" . $b_edit . "); width: 20px; height: 20px'>
                          <input type='submit' name='delete' value='' title='Удалить' style='background: transparent url(" . $b_drop . "); width: 20px; height: 20px'></div>
                          </form></td>
                          <td><form method='POST'><input name='info_r' type='hidden' readonly value='model.$key_mm'>
                          <input name='info' type='hidden' readonly value='model.$key_mm'>$mod
                          <div><input type='submit' name='edit' value='' title='Изменить' style='background: transparent url(" . $b_edit . "); width: 20px; height: 20px'>
                          <input type='submit' name='delete' value='' title='Удалить' style='background: transparent url(" . $b_drop . "); width: 20px; height: 20px'></div>
                          </form></td></tr>";
                }
            }
        }
    }
}

echo "<tr bgcolor='#6e6e6e'>
        <td><form method='POST'><input name='info' type='hidden' readonly value='mvideo.0'>
        <input type='submit' name='add' value='' title='Добавить Каталог' style='background: transparent url(" . $b_add . "); width: 20px; height: 20px'>
        </form></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td></tr>";

echo "</table>";

$xml_DOM->save("mv.xml");

//endregion

?>
</body>
</html>