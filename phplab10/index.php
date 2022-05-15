<!DOCTYPE html>
<html lang="ru">
<head>
    <title>лабораторная 10 | Вариант 1</title>
    <meta charset="utf-8">
</head>
<body>
<form method="POST">
    <div>
        <labeL>Фамилия
            <input type="text" name="surname">
        </labeL>
    </div>
    <div>
        <label>Имя
            <input type="text" name="name">
        </label>
    </div>
    <div>
        <label>Отчество
            <input type="text" name="patronymic">
        </label>
    </div>
    <div>
        <label>Возраст
            <input type="text" name="age">
        </label>
    </div>
    <div>
        <input type="submit" value="Сохранить данные" name="save">
    </div>
    <br>
    <div>
        <label>Опции вывода сведений
            <select name="opt">
                <option value="1">в алфавитном порядке по фамилии</option>
                <option value="2">сортировка по возрасту</option>
            </select>
        </label>
    </div>
    <div>
        <input type="submit" value="Вывести данные" name="out">
    </div>
    <br>
</form>
</body>
</html>

<?php
if (isset($_POST["save"])) {
    if (! isset($_POST["name"]) || $_POST["name"] == "") {
        echo "Имя не задано<br>";
        $prov = 1;
    }
    if (! isset($_POST["surname"]) || $_POST["surname"] == "") {
        echo "Фамилия не задана<br>";
        $prov = 1;
    }
    if (! isset($_POST["patronymic"]) || $_POST["patronymic"] == "") {
        echo "Отчество не задано<br>";
        $prov = 1;
    }
    if (! isset($_POST["age"]) || $_POST["age"] == "") {
        echo "Возраст не задан<br>";
        $prov = 1;
    }
    if (isset($prov)) {
        die;
    }
    $name = trim($_POST["name"]);
    $surname = $_POST["surname"];
    $patronymic = $_POST["patronymic"];
    $age = $_POST["age"];
    if (! preg_match("/^[А-ЯA-Z][a-zа-яё]{2,}$/u", $name)) {
        echo "Имя задано некорректно<br>";
        $prov = 1;
    }
    if (! preg_match("/^[А-ЯA-Z][a-zа-яё]{2,}$/u", $surname)) {
        echo "Фамилия задана некорректно<br>";
        $prov = 1;
    }
    if (! preg_match("/^[А-ЯA-Z][a-zа-яё]{2,}$/u", $patronymic)) {
        echo "Отчество задано некорректно<br>";
        $prov = 1;
    }
    if (! is_numeric($age) || preg_match("/[.,-]/", $age)) {
        echo "Возраст задан некорректно<br>";
        $prov = 1;
    }
    if (isset($prov)) {
        die;
    }

    $link = mysqli_connect("localhost", "mysql", "mysql", "sql") or die("Ошибка " . mysqli_error($link));
    $query = "SELECT * from people WHERE surname='$surname' AND name='$name' AND patronymic='$patronymic'";
    $result = mysqli_query($link, $query);
    if (mysqli_affected_rows($link) == 0) {
        $query = "INSERT INTO people(surname,name,patronymic,age) VALUES('$surname','$name','$patronymic',$age)";
        $result = mysqli_query($link, $query);
        if ($result) {
            echo "В таблицу SQL добавлена следующая строка Имя - [$name] Фамилия - [$surname] Отчество - [$patronymic] Возраст - [$age] <br>";
        }
    } else {
        echo "В таблице SQL уже существует следующая строка Имя - [$name] Фамилия - [$surname] Отчество - [$patronymic] Возраст - [$age] <br>";
    }
    mysqli_close($link);
}
if(isset($_POST["out"])){
    $link = mysqli_connect("localhost", "mysql", "mysql", "sql") or die("Ошибка " . mysqli_error($link));
    $option = $_POST["opt"];
    $query = "SELECT * from people";
    $result = mysqli_query($link,$query);
    $array = array( "id" => array(), "name" => array(), "surname" => array(), "patronymic" => array(), "age" => array());
    while($arr = mysqli_fetch_array($result)){
        $array["id"][] = $arr["id"];
        $array["name"][] = $arr["name"];
        $array["surname"][] = $arr["surname"];
        $array["patronymic"][] = $arr["patronymic"];
        $array["age"][] = $arr["age"];
    }
    if($option == "1"){
        array_multisort($array["surname"],SORT_STRING,$array["name"],$array["patronymic"],$array["age"],$array["id"]);
    } elseif($option == "2"){
        array_multisort($array["age"],SORT_NUMERIC,$array["name"],$array["surname"],$array["patronymic"],$array["id"]);
    }
    echo "<div style='color: green; font-weight: bold; font-family: Arial'>Сведения о сотрудниках:</div>";
    foreach($array["id"] as $key => $item){
        $name = $array["name"][$key];
        $surname = $array["surname"][$key];
        $patronymic = $array["patronymic"][$key];
        $age = $array["age"][$key];
        $str = "<div style='font-weight: bold;font-family: Arial;padding: 5px 0px;'><span style='color: blue'>$name $patronymic</span> <span style='color: red'>$surname</span> <span style='font-style: italic;text-decoration: underline;font-weight: normal'>$age лет</span></div>";
        echo "$str";
    }
    mysqli_close($link);
}

// $link = mysqli_connect("localhost", "mysql", "mysql", "sql") or die("Ошибка " . mysqli_error($link));
// mysqli_close($link);
?>