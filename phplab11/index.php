<!DOCTYPE html>
<html lang="ru">
<head>
    <title>лабораторная 11 | Вариант 2</title>
    <meta charset="utf-8">
</head>
<body>
<form method="POST">
    <div>
        <label> Используемая таблица
            <select name="table">
                <option selected disabled>
                    Выберите таблицу:
                </option>
                <option>
                    Таблица арендаторов
                </option>
                <option>
                    Таблица объектов
                </option>
                <option>
                    Таблица со сведениями об арендах
                </option>
            </select>
        </label>
    </div>
    <div>
        <input type="submit" value="Внести данные" name="create">
        <input type="submit" value="Редактировать/Удалить данные" name="edit_delete">
        <input type="submit" value="Запросы" name="zaprosi">
    </div>
    <?php
    $link = mysqli_connect("localhost", "mysql", "mysql", "rent") or die("Ошибка " . mysqli_error($link));

    if (isset($_POST['id'])) {
        $main_id = explode(".", $_POST['id']);
    }

    //region Удаление данных
    if (isset($_POST['delete'])) {
        $query = "DELETE FROM $main_id[0] WHERE id = $main_id[1]";
        mysqli_query($link, $query);
        if (mysqli_error($link) != "") {
            echo "<br> Для удаления необходимо вручную удалить связанные с выбранными данными записи из таблицы [ Таблица со сведениями об арендах ]";
        } else {
            echo "<br> Данные удалены";
        }
    }
    //endregion

    //region Создание форм
    if (isset($_POST["table"]) || isset($_POST['id'])) {
        if (isset($_POST["create"]) || isset($_POST["id"])) {
            if (isset($_POST["create"])) {
                echo "Производим команду" . " [ " . $_POST["create"] . " ] с объектом Базы Данных" . " [ " . $_POST["table"] . " ] <br> <br>";
            }
            if (isset($main_id) && $main_id[0] == "tenants" && !isset($_POST["delete"])) {
                echo "Производим команду" . " [ " . "Редактирование" . " ] с объектом Базы Данных" . " [ " . "Таблица арендаторов" . " ] <br> <br>";
            } elseif (isset($main_id) && $main_id[0] == "objects" && !isset($_POST["delete"])) {
                echo "Производим команду" . " [ " . "Редактирование" . " ] с объектом Базы Данных" . " [ " . "Таблица объектов" . " ] <br> <br>";
            } elseif (isset($main_id) && $main_id[0] == "rental_details" && !isset($_POST["delete"])) {
                echo "Производим команду" . " [ " . "Редактирование" . " ] с объектом Базы Данных" . " [ " . "Таблица со сведениями об арендах" . " ] <br> <br>";
            }

            if (((isset($_POST["table"]) && $_POST["table"] == "Таблица арендаторов") || (isset($main_id) && $main_id[0] == "tenants")) && !isset($_POST["delete"])) {

                if (isset($main_id)) {
                    $query = "SELECT * FROM tenants WHERE id = $main_id[1]";
                    $result = mysqli_query($link, $query);
                    $row = mysqli_fetch_assoc($result);
                    $surname = $row['surname'];
                    $passport = $row['passport'];
                    echo "<input type='text' name='main' readonly hidden value='$main_id[1]'>";
                } else {
                    $surname = "";
                    $passport = "";
                }

                echo "<div>Введите данные арендатора(необходимо заполнить все поля):</div>";
                echo "<div><label>Фамилия(с большой буквы): <input type='text' name='surname' value='$surname'></label></div>";
                echo "<div><label>Паспорт(серия и номер слитно): <input type='text' name='passport' value='$passport'></label></div>";
                echo "<input type='submit' value='Внести' name='tenantscr'>";
            } elseif ((isset($_POST["table"]) && $_POST["table"] == "Таблица объектов") || (isset($main_id) && $main_id[0] == "objects")) {

                if (isset($main_id)) {
                    $query = "SELECT * FROM objects WHERE id = $main_id[1]";
                    $result = mysqli_query($link, $query);
                    $row = mysqli_fetch_assoc($result);
                    $type = $row['type'];
                    $price_per_month = $row['price_per_month'];
                    echo "<input type='text' name='main' readonly hidden value='$main_id[1]'>";
                } else {
                    $type = "";
                    $price_per_month = "";
                }

                echo "<div>Введите данные объекта(необходимо заполнить все поля):</div>";
                echo "<div><label>Тип объекта: <input type='text' name='type' value='$type'></label></div>";
                echo "<div><label>Цена за месяц: <input type='text' name='price_per_month' value='$price_per_month'></label></div>";
                echo "<input type='submit' value='Внести' name='objectscr'>";
            } elseif ((isset($_POST["table"]) && $_POST["table"] == "Таблица со сведениями об арендах") || (isset($main_id) && $main_id[0] == "rental_details")) {

                $query_tenants = "SELECT * FROM tenants";
                $query_objects = "SELECT * FROM objects";
                $result_tenants = mysqli_query($link, $query_tenants);
                $result_objects = mysqli_query($link, $query_objects);

                if (mysqli_num_rows($result_tenants) == 0) {
                    echo "<p>Перед внесением данных в таблицу [ Таблица со сведениями об арендах ], необходимо заполнить таблицу [ Таблица арендаторов ]</p>";
                    $prov = 1;
                }

                if (mysqli_num_rows($result_objects) == 0) {
                    echo "<p>Перед внесением данных в таблицу [ Таблица со сведениями об арендах ], необходимо заполнить таблицу [ Таблица объектов ]</p>";
                    $prov = 1;
                }

                if (isset($prov)) {
                    mysqli_close($link);
                    die;
                }

                if (isset($main_id)) {
                    $query = "SELECT * FROM rental_details WHERE id = $main_id[1]";
                    $result = mysqli_query($link, $query);
                    $rental_details_edit = mysqli_fetch_assoc($result);
                    $id_objects_edit = $rental_details_edit['id_objects'];
                    $id_tenants_edit = $rental_details_edit['id_tenants'];
                    $rent_start_date_edit = $rental_details_edit['rent_start_date'];
                    $duration_month_edit = $rental_details_edit['duration_month'];

                    echo "<input type='text' readonly hidden name='main' value='$main_id[1]'>";
                } else {
                    $id_objects_edit = "";
                    $id_tenants_edit = "";
                    $rent_start_date_edit = "";
                    $duration_month_edit = "";
                }

                echo "<div>Введите данные(необходимо заполнить все поля):</div>";

                echo "<div><label>Выберите объект: <select name='id_objects'><option selected disabled></option>";
                while ($row = mysqli_fetch_assoc($result_objects)) {
                    $id_object = $row["id"];
                    $type = $row["type"];
                    $price_per_month = $row["price_per_month"];
                    if ($id_objects_edit == $id_object) {
                        echo "<option value='$id_object' selected>$type  цена: $price_per_month</option>";
                    } else {
                        echo "<option value='$id_object'>$type  цена: $price_per_month</option>";
                    }
                }
                unset($id_object);
                unset($type);
                echo "</select></label></div>";

                echo "<div><label>Выберите арендатора: <select name='id_tenants'><option selected disabled></option>";
                while ($row = mysqli_fetch_assoc($result_tenants)) {
                    $id_tenant = $row["id"];
                    $tenant = $row["surname"] . " " . $row["passport"];
                    if ($id_tenants_edit == $id_tenant) {
                        echo "<option value='$id_tenant' selected>$tenant</option>";
                    } else {
                        echo "<option value='$id_tenant'>$tenant</option>";
                    }
                }
                unset($id_tenant);
                unset($tenant);
                echo "</select></label></div>";

                echo "<div><label>Выберите дату начала аренды: <input type='date' value='$rent_start_date_edit' name='rent_start_date'></label></div>";

                echo "<div><label>Введите длительность аренды(в месяцах): <input type='text' value='$duration_month_edit' name='duration_month'></label></div>";

                echo "<div><input type='submit' value='Внести' name='rentaldetailscr'></div>";
            }
        } elseif (isset($_POST["edit_delete"]) || isset($_POST['id'])) {
            echo "</form>";

            //echo "Производим команду" . " [ " . $_POST["edit"] . " ] с объектом Базы Данных" . " [ " . $_POST["table"] . " ] <br> <br>";

            if ((isset($_POST['table']) && $_POST['table'] == "Таблица арендаторов") || (isset($main_id[0]) && isset($_POST['delete']) && $main_id[0] == "tenants")) {

                unset($surname, $passport);
                $query_tenants = "SELECT * FROM tenants";
                $result_tenants = mysqli_query($link, $query_tenants);
                if (mysqli_num_rows($result_tenants) == 0) {
                    mysqli_close($link);
                    die("Таблица не заполнена");
                }
                echo "<br><table border='1px' style='border-collapse: collapse'><tr><th>Фамилия</th><th>Паспорт</th></tr>";
                while ($row = mysqli_fetch_assoc($result_tenants)) {
                    $id = $row['id'];
                    $surname = $row['surname'];
                    $passport = $row['passport'];
                    echo "<tr><td>$surname</td><td>$passport</td><td><form method='POST'><input type='hidden' readonly name='id' value='tenants.$id'><input type='submit' name='edit' value='Редактировать'><input type='submit' name='delete' value='Удалить'></form></td></tr>";
                }
                echo "</table>";
            } elseif ((isset($_POST['table']) && $_POST['table'] == "Таблица объектов") || (isset($main_id[0]) && isset($_POST['delete']) && $main_id[0] == "objects")) {

                unset($type, $price_per_month);
                $query_objects = "SELECT * FROM objects";
                $result_objects = mysqli_query($link, $query_objects);
                if (mysqli_num_rows($result_objects) == 0) {
                    mysqli_close($link);
                    die("Таблица не заполнена");
                }
                echo "<br><table border='1px' style='border-collapse: collapse'><tr><th>Тип объекта</th><th>Цена за месяц</th></tr>";
                while ($row = mysqli_fetch_assoc($result_objects)) {
                    $id = $row['id'];
                    $type = $row['type'];
                    $price_per_month = $row['price_per_month'];
                    echo "<tr><td>$type</td><td>$price_per_month</td><td><form method='POST'><input type='hidden' readonly name='id' value='objects.$id'><input type='submit' name='edit' value='Редактировать'><input type='submit' name='delete' value='Удалить'></form></td></tr>";
                }
                echo "</table>";
            } elseif ((isset($_POST['table']) && $_POST['table'] == "Таблица со сведениями об арендах") || (isset($main_id[0]) && isset($_POST['delete']) && $main_id[0] == "rental_details")) {

                unset($objects, $tenants, $rent_start_date, $duration_month);
                $query_rental_details = "SELECT rd.id, o.type, t.surname, t.passport, rd.rent_start_date, rd.duration_month FROM rental_details rd, objects o, tenants t WHERE rd.id_objects = o.id AND rd.id_tenants = t.id";
                $result_rental_details = mysqli_query($link, $query_rental_details);

                if (mysqli_num_rows($result_rental_details) == 0) {
                    mysqli_close($link);
                    die("Таблица не заполнена");
                }

                echo "<br><table border='1px' style='border-collapse: collapse'><tr><th>Тип объекта</th><th>Арендатор</th><th>Начало аренды</th><th>Длительность аренды(месяц)</th></tr>";
                while ($row = mysqli_fetch_assoc($result_rental_details)) {
                    $id = $row['id'];
                    $tenants = $row['surname'] . " " . $row['passport'];
                    $objects = $row['type'];
                    $rent_start_date = $row['rent_start_date'];
                    $duration_month = $row['duration_month'];
                    echo "<tr><td>$objects</td><td>$tenants</td><td>$rent_start_date</td><td>$duration_month</td><td><form method='POST'><input type='hidden' readonly name='id' value='rental_details.$id'><input type='submit' name='edit' value='Редактировать'><input type='submit' name='delete' value='Удалить'></form></td></tr>";
                }
                echo "</table>";
            }
        }
    }
    //endregion

    //region Добавление/редактирование данных
    if (isset($_POST["tenantscr"])) {
        echo "Производим команду" . " [ " . "Внести данные" . " ] с объектом Базы Данных" . " [ " . "Таблица арендаторов" . " ] <br>";

        if (isset($_POST["surname"]) != "" || isset($_POST["passport"]) != "") {
            // if (! preg_match("/^\s*[А-ЯA-Z][a-zа-яё]{2,}\s*$/u", $_POST["surname"], $surname)) {
            //     $fsurname = $_POST["surname"];
            //     echo "<p>Фамилия задана некорректно, было введено: [$fsurname]</p>";
            //     $prov = 1;
            // }
            // if (! preg_match("/^\s*\d{10}\s*$/u", $_POST["passport"], $passport)) {
            //     $fpassport = $_POST["passport"];
            //     echo "<p>Паспорт задан некорректно, было введено: [$fpassport]</p>";
            //     $prov = 1;
            // }

            $surname = $_POST['surname'];
            $passport = $_POST['passport'];

            if(!is_numeric($passport)){
                echo "<p>Паспорт задан некорректно, было введено: [ $passport ]</p>";
                $prov = 1;
            }

            if (! isset($prov)) {

                $surname = htmlspecialchars($surname);
                $passport = htmlspecialchars($passport);

                $surname = trim($surname);
                $passport = (int) (trim($passport));

                $query = "SELECT * FROM tenants WHERE passport=$passport";
                $result = mysqli_query($link, $query);

                if(mysqli_affected_rows($link) != 0){
                    $row = mysqli_fetch_assoc($result);
                }

                if (mysqli_affected_rows($link) == 0 && ! isset($_POST['main'])) {
                    $query = "INSERT INTO tenants(surname,passport) VALUES('$surname',$passport)";
                    $result = mysqli_query($link, $query);

                    echo "<p>Данные Фамилия: [ $surname ], паспорт: [ $passport ] были добавлены в таблицу [ Таблица арендаторов ]</p>";
                } elseif (! isset($_POST['main']) && mysqli_affected_rows($link) > 1) {
                    echo "<p>Данные Фамилия: [ $surname ], паспорт: [ $passport ] уже существуют в таблице [ Таблица арендаторов ]</p>";
                } elseif (mysqli_affected_rows($link) == 1 && isset($_POST['main'])) {
                    $main_id = $_POST['main'];
                    $query = "UPDATE tenants SET id = id, surname = '$surname', passport = $passport WHERE id = $main_id";
                    $result = mysqli_query($link, $query);
                    echo "<p>Данные изменены</p>";
                }
            }
        }
    } elseif (isset($_POST["objectscr"])) {
        echo "Производим команду" . " [ " . "Внести данные" . " ] с объектом Базы Данных" . " [ " . "Таблица объектов" . " ] <br>";

        if (isset($_POST["type"]) != "" || isset($_POST["price_per_month"]) != "") {
            if ($_POST["type"] == "") {
                echo "<p>Тип объекта не задан</p>";
                $prov = 1;
            }
            if (! is_numeric($_POST["price_per_month"])) {
                $price_per_month = $_POST["price_per_month"];
                echo "<p>Цена объекта не является числом, было введено: [ $price_per_month ]</p>";
                $prov = 1;
            }
            if (! isset($prov)) {

                $type = trim($_POST["type"]);
                $price_per_month = (int) (trim($_POST["price_per_month"]));
                $query = "SELECT * FROM objects WHERE type='$type' AND price_per_month=$price_per_month";
                $result = mysqli_query($link, $query);

                if (mysqli_affected_rows($link) == 0 && ! isset($_POST['main'])) {
                    $query = "INSERT INTO objects(type,price_per_month) VALUES('$type',$price_per_month)";
                    $result = mysqli_query($link, $query);

                    echo "<p>Данные Тип объекта: [ $type ], цена за месяц: [ $price_per_month ] были добавлены в таблицу [ Таблица объектов ]</p>";
                } elseif (! isset($main_id[0]) && mysqli_affected_rows($link) != 0) {
                    echo "<p>Данные Тип объекта: [ $type ], цена за месяц: [ $price_per_month ] уже существуют в таблице [ Таблица объектов ]</p>";
                } elseif (mysqli_affected_rows($link) == 0 && isset($_POST['main'])) {
                    $main_id = $_POST['main'];
                    $query = "UPDATE objects SET type = '$type', price_per_month = $price_per_month WHERE id = $main_id";
                    $result = mysqli_query($link, $query);
                    echo "<p>Данные изменены</p>";
                }
            }
        }
    } elseif (isset($_POST["rentaldetailscr"])) {
        echo "Производим команду" . " [ " . "Внести данные" . " ] с объектом Базы Данных" . " [ " . "Таблица со сведениями об арендах" . " ] <br> <br>";

        if (! isset($_POST['id_objects'])) {
            echo "Объект не был выбран <br>";
            $prov = 1;
        }

        if (! isset($_POST['id_tenants'])) {
            echo "Арендатор не был выбран <br>";
            $prov = 1;
        }

        if (! preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/", $_POST['rent_start_date'])) {
            echo "Дата начала аренды не выбрана <br>";
            $prov = 1;
        }

        if (! is_numeric($_POST['duration_month']) || strpos($_POST['duration_month'], ".") || strpos(
                $_POST['duration_month'],
                ","
            )) {
            echo "Количество месяцев аренды задано некорректно <br>";
            $prov = 1;
        }

        if (! isset($prov)) {
            $id_objects = $_POST['id_objects'];
            $id_tenants = $_POST['id_tenants'];
            $rent_start_date = $_POST['rent_start_date'];
            $duration_month = (int) $_POST['duration_month'];

            $query_main_object = "SELECT * FROM objects WHERE id=$id_objects";
            $result_main_object = mysqli_query($link, $query_main_object);
            $main_object = mysqli_fetch_assoc($result_main_object);
            $type_main_object = $main_object['type'];

            $query_main_tenant = "SELECT * FROM tenants WHERE id=$id_tenants";
            $result_main_tenant = mysqli_query($link, $query_main_tenant);
            $main_tenant = mysqli_fetch_assoc($result_main_tenant);
            $surname_main_tenant = $main_tenant['surname'];
            $passport_main_tenant = $main_tenant['passport'];

            $query_date = "SELECT * FROM rental_details WHERE id_objects=$id_objects";
            $result_date = mysqli_query($link, $query_date);

            if (mysqli_num_rows($result_date) > 0) {
                $first_date = $rent_start_date;
                $second_date = date('Y-m-d', strtotime('+' . $duration_month . ' MONTH', strtotime($first_date)));

                while ($row = mysqli_fetch_assoc($result_date)) {

                    if (isset($_POST['main']) && $_POST['main'] == $row['id']) {
                        continue;
                    }

                    $row_first_date = $row['rent_start_date'];
                    $row_second_date = date(
                        'Y-m-d',
                        strtotime(
                            '+' . $row['duration_month'] . ' MONTH',
                            strtotime($row_first_date)
                        )
                    );

                    if (($first_date >= $row_first_date && $first_date <= $row_second_date || $second_date >= $row_first_date && $second_date <= $row_second_date || $row_first_date >= $first_date && $row_first_date <= $second_date || $row_second_date >= $first_date && $row_second_date <= $second_date)) {
                        $id_object = $row['id_objects'];
                        $query_object = "SELECT * FROM objects WHERE id=$id_object";
                        $result_object = mysqli_query($link, $query_object);
                        $object = mysqli_fetch_assoc($result_object);
                        $type_object = $object['type'];

                        $id_tenant = $row['id_tenants'];
                        $query_tenant = "SELECT * FROM tenants WHERE id=$id_tenant";
                        $result_tenant = mysqli_query($link, $query_tenant);
                        $tenant = mysqli_fetch_assoc($result_tenant);
                        $surname_tenant = $tenant['surname'];
                        $passport_tenant = $tenant['passport'];

                        $row_duration_month = $row['duration_month'];

                        echo "Выбранный временной период пересекается с другой арендой: Тип объекта [ $type_object ], Арендатор [ $surname_tenant $passport_tenant ], Дата начала аренды [ $row_first_date ], Длительность аренды в месяцах [ $row_duration_month ]";

                        echo "<p>Данные: Объект [ $type_main_object ], Арендатор [ $surname_main_tenant $passport_main_tenant ], Дата начала аренды [ $rent_start_date ], Длительность аренды(в месяцах) [ $duration_month ] не были добавлены в таблицу [ Таблица со сведениями об арендах ]</p>";
                        mysqli_close($link);
                        die;
                    }
                }
            }

            $query = "SELECT * FROM rental_details WHERE id_objects=$id_objects AND id_tenants=$id_tenants AND rent_start_date=$rent_start_date AND duration_month=$duration_month";
            $result = mysqli_query($link, $query);

            if (mysqli_affected_rows($link) == 0 && ! isset($_POST['main'])) {
                $query = "INSERT INTO rental_details(id_objects,id_tenants,rent_start_date,duration_month) VALUES($id_objects,$id_tenants,'$rent_start_date',$duration_month)";
                $result = mysqli_query($link, $query);

                echo "<p>Данные: Объект [ $type_main_object ], Арендатор [ $surname_main_tenant $passport_main_tenant ], Дата начала аренды [ $rent_start_date ], Длительность аренды(в месяцах) [ $duration_month ] добавлены в таблицу [ Таблица со сведениями об арендах ]</p>";
            } elseif (! isset($main_id[0]) && mysqli_affected_rows($link) != 0) {
                echo "<p>Данные: Объект [ $type_main_object ], Арендатор [ $surname_main_tenant $passport_main_tenant ], Дата начала аренды [ $rent_start_date ], Длительность аренды(в месяцах) [ $duration_month ] уже существуют в таблице [ Таблица со сведениями об арендах ]</p>";
            } elseif (mysqli_affected_rows($link) == 0 && isset($_POST['main'])) {
                $main_id = $_POST['main'];
                $query = "UPDATE rental_details SET id_objects = $id_objects, id_tenants = $id_tenants, rent_start_date = '$rent_start_date',duration_month = $duration_month WHERE id = $main_id";
                $result = mysqli_query($link, $query);
                echo "<p>Данные изменены</p>";
            }
        }
    }
    //endregion

    //region Запросы
    if (isset($_POST['zaprosi']) || isset($_POST['zapros'])) {
        echo "<br><select name='vibr_zapr'>
                    <option disabled selected>Выберите запрос:</option>
                    <option value='1'>1.Список объектов указанного типа, упорядоченный по убыванию по алфавиту или по возрастанию цены</option>
                    <option value='2'>2.Список арендаторов, которым сдавались объекты с указанием количества аренд</option>
                    <option value='3'>3.Список объектов, которые не сдавались</option>
                    <option value='4'>4.Список объектов, которые сдавались более 3 раз</option>
                    <option value='5'>5.Список объектов, которые сдавались в аренду больше 2 раз на срок более 1 года со столбцом количество таких аренд</option>
                    <option value='6'>6.Список объектов со столбцами, содержащими количество сдач каждого объекта и выплаченную общую сумму</option>
                    <option value='7'>7.Список арендаторов с указанием, сколько раз он арендовал объекты и среднего срока аренды</option>
                    <option value='8'>8.Список объектов (с указанием типа), сданных в аренду в заданном квартале определенного года. Упорядочить по дате начала аренды</option>
                    <option value='9'>9.Список арендаторов с указанием количества различных арендуемых объектов</option>
                    <option value='10'>10.Изменить цену аренды у объектов заданного типа: увеличить на 12%</option>
                  </select>";
        echo "<input type='submit' value='Выбрать' name='zapros'>";
    }

    if (isset($_POST['zapros']) && isset($_POST['vibr_zapr'])) {
        if ($_POST['vibr_zapr'] == "1") {
            echo "<p>Список объектов указанного типа, упорядоченный по убыванию по алфавиту или по возрастанию цены</p>";

            $query = "SELECT type FROM objects GROUP BY type";
            $result = mysqli_query($link, $query);

            if (mysqli_num_rows($result) == 0) {
                die("Данные не найдены");
            }

            echo "<select name='object_type'>";
            while ($row = mysqli_fetch_assoc($result)) {
                $type = $row['type'];
                echo "<option>$type</option>";
            }
            echo "</select>";
            echo "<select name='sort'>
                       <option>по убыванию по алфавиту</option>
                       <option>по возрастанию цены</option>
                  </select>";
            echo "<input type='submit' value='Запустить' name='zapr1'>";
        } elseif ($_POST['vibr_zapr'] == "2") {
            echo "<p>Список арендаторов, которым сдавались объекты с указанием количества аренд</p>";

            $query = "SELECT t.surname, t.passport, COUNT(rd.id_tenants) FROM rental_details rd, tenants t WHERE rd.id_tenants = t.id GROUP BY id_tenants";
            $result = mysqli_query($link, $query);

            if (mysqli_num_rows($result) == 0) {
                die("Данные не найдены");
            }

            echo "<br><table border='1px' style='border-collapse: collapse'><tr><th>Фамилия</th><th>Паспорт</th><th>Количество аренд</th></tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                $surname = $row['surname'];
                $passport = $row['passport'];
                $id_tenants = $row['COUNT(rd.id_tenants)'];
                echo "<tr><td>$surname</td><td>$passport</td><td>$id_tenants</td></tr>";
            }
            echo "</table>";
        } elseif ($_POST['vibr_zapr'] == "3") {
            echo "<p>Список объектов, которые не сдавались</p>";

            $query = "SELECT type, price_per_month FROM objects WHERE id NOT IN (SELECT id_objects FROM rental_details)";
            $result = mysqli_query($link, $query);

            if (mysqli_num_rows($result) == 0) {
                die("Данные не найдены");
            }

            echo "<br><table border='1px' style='border-collapse: collapse'><tr><th>Тип объекта</th><th>Цена за месяц</th></tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                $type = $row['type'];
                $price_per_month = $row['price_per_month'];
                echo "<tr><td>$type</td><td>$price_per_month</td></tr>";
            }
            echo "</table>";
        } elseif ($_POST['vibr_zapr'] == "4") {
            echo "<p>Список объектов, которые сдавались более 3 раз</p>";

            $query = "SELECT o.type, o.price_per_month, COUNT(rd.id_objects) FROM rental_details rd, objects o WHERE rd.id_objects = o.id AND (SELECT COUNT(id) FROM rental_details WHERE id_objects = rd.id_objects) > 3 GROUP BY id_objects";
            $result = mysqli_query($link, $query);

            if (mysqli_num_rows($result) == 0) {
                die("Данные не найдены");
            }

            echo "<br><table border='1px' style='border-collapse: collapse'><tr><th>Тип объекта</th><th>Цена за месяц</th></tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                $type = $row['type'];
                $price_per_month = $row['price_per_month'];
                echo "<tr><td>$type</td><td>$price_per_month</td></tr>";
            }
            echo "</table>";
        } elseif ($_POST['vibr_zapr'] == "5") {
            echo "<p>Список объектов, которые сдавались в аренду больше 2 раз на срок более 1 года со столбцом количество таких аренд</p>";

            $query = "SELECT o.type, o.price_per_month, (SELECT COUNT(id) FROM rental_details WHERE id_objects = rd.id_objects AND duration_month > 12) FROM rental_details rd, objects o WHERE rd.id_objects = o.id AND (SELECT COUNT(id) FROM rental_details WHERE id_objects = rd.id_objects AND duration_month > 12) > 2 GROUP BY id_objects";
            $result = mysqli_query($link, $query);

            if (mysqli_num_rows($result) == 0) {
                die("Данные не найдены");
            }

            echo "<br><table border='1px' style='border-collapse: collapse'><tr><th>Тип объекта</th><th>Цена за месяц</th><th>Количество аренд объекта с длительностью больше года</th></tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                $type = $row['type'];
                $price_per_month = $row['price_per_month'];
                $duration = $row['(SELECT COUNT(id) FROM rental_details WHERE id_objects = rd.id_objects AND duration_month > 12)'];
                echo "<tr><td>$type</td><td>$price_per_month</td><td>$duration</td></tr>";
            }
            echo "</table>";
        } elseif ($_POST['vibr_zapr'] == "6") {
            echo "<p>Список объектов со столбцами, содержащими количество сдач каждого объекта и выплаченную общую сумму</p>";

            $query = "SELECT o.type, o.price_per_month, COUNT(rd.id_objects), (SELECT SUM(rd2.duration_month * o2.price_per_month) FROM rental_details rd2, objects o2 WHERE o2.id = o.id AND rd.id_objects = rd2.id_objects) FROM rental_details rd, objects o WHERE rd.id_objects = o.id GROUP BY id_objects";
            $result = mysqli_query($link, $query);
            if (mysqli_num_rows($result) == 0) {
                die("Данные не найдены");
            }

            echo "<br><table border='1px' style='border-collapse: collapse'><tr><th>Тип объекта</th><th>Цена за месяц</th><th>Количество сдач</th><th>Общая выплата</th></tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                $type = $row['type'];
                $price_per_month = $row['price_per_month'];
                $Kolvo = $row['COUNT(rd.id_objects)'];
                $Sum = $row['(SELECT SUM(rd2.duration_month * o2.price_per_month) FROM rental_details rd2, objects o2 WHERE o2.id = o.id AND rd.id_objects = rd2.id_objects)'];
                echo "<tr><td>$type</td><td>$price_per_month</td><td>$Kolvo</td><td>$Sum</td></tr>";
            }
            echo "</table>";
        } elseif ($_POST['vibr_zapr'] == "7") {
            echo "<p>Список арендаторов с указанием, сколько раз он арендовал объекты и среднего срока аренды</p>";

            $query = "SELECT t.surname, t.passport, COUNT(rd.id_tenants), AVG(rd.duration_month) FROM rental_details rd, tenants t WHERE rd.id_tenants = t.id GROUP BY id_tenants";
            $result = mysqli_query($link, $query);
            if (mysqli_num_rows($result) == 0) {
                die("Данные не найдены");
            }

            echo "<br><table border='1px' style='border-collapse: collapse'><tr><th>Фамилия</th><th>Паспорт</th><th>Количество аренд</th><th>Среднее время аренды(в месяцах)</th></tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                $surname = $row['surname'];
                $passport = $row['passport'];
                $kolvo = $row['COUNT(rd.id_tenants)'];
                $avg = round($row['AVG(rd.duration_month)']);
                echo "<tr><td>$surname</td><td>$passport</td><td>$kolvo</td><td>$avg</td></tr>";
            }
            echo "</table>";
        } elseif ($_POST['vibr_zapr'] == "8") {
            echo "<p>Список объектов (с указанием типа), сданных в аренду в заданном квартале определенного года. Упорядочить по дате начала аренды</p>";

            $query = "SELECT type FROM objects GROUP BY type";
            $result = mysqli_query($link, $query);

            if (mysqli_num_rows($result) == 0) {
                die("Данные не найдены");
            }

            echo "<label>Выберите квартал:<select name='kvart'>
                       <option value='01-01.03-31.I Квартал'>I Квартал</option>
                       <option value='04-01.06-30.II Квартал'>II Квартал</option>
                       <option value='07-01.09-31.III Квартал'>III Квартал</option>
                       <option value='10-01.12-31.IV Квартал'>IV Квартал</option>
                  </select></label>";
            echo "<label>Выберите год:<select name='god'>";
            for ($i = 20; $i > -1; $i--) {
                $g = (string) $i;
                if (strlen($g) < 2) {
                    $g = "0" . $g;
                }
                echo "<option value='20$g-'>20$g</option>";
            }
            echo "</select></label>";
            echo "<input type='submit' value='Запустить' name='zapr2'>";
        } elseif ($_POST['vibr_zapr'] == "9") {
            echo "<p>Список арендаторов с указанием количества различных арендуемых объектов</p>";

            $query = "SELECT t.surname, t.passport, COUNT(DISTINCT rd.id_objects) as count FROM rental_details rd, tenants t WHERE rd.id_tenants = t.id GROUP BY id_tenants";
            $result = mysqli_query($link, $query);
            echo mysqli_error($link);
            if (mysqli_num_rows($result) == 0) {
                die("Данные не найдены");
            }

            echo "<br><table border='1px' style='border-collapse: collapse'><tr><th>Фамилия</th><th>Паспорт</th><th>Количество различных аренд</th></tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                $surname = $row['surname'];
                $passport = $row['passport'];
                $count = $row['count'];
                echo "<tr><td>$surname</td><td>$passport</td><td>$count</td></tr>";
            }
        } elseif ($_POST['vibr_zapr'] == "10") {
            echo "<p>Изменить цену аренды у объектов заданного типа: увеличить на 12%</p>";

            $query = "SELECT type FROM objects GROUP BY type";
            $result = mysqli_query($link, $query);

            if (mysqli_num_rows($result) == 0) {
                die("Данные не найдены");
            }

            echo "<select name='object_type'>";
            while ($row = mysqli_fetch_assoc($result)) {
                $type = $row['type'];
                echo "<option>$type</option>";
            }
            echo "</select>";
            echo "<input type='submit' value='Запустить' name='zapr3'>";
        }
    }

    if (isset($_POST['zapr1'])) {
        $object_type = $_POST['object_type'];
        $sort = $_POST['sort'];
        echo "<p>Список объектов [ $object_type ], упорядоченный [ $sort ]</p>";
        if ($sort == "по убыванию по алфавиту") {
            $query = "SELECT * FROM objects WHERE type = '$object_type' ORDER BY type DESC";
        } elseif ($sort == "по возрастанию цены") {
            $query = "SELECT * FROM objects WHERE type = '$object_type' ORDER BY price_per_month";
        }
        $result = mysqli_query($link, $query);
        echo "<br><table border='1px' style='border-collapse: collapse'><tr><th>Тип объекта</th><th>Цена за месяц</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            $type = $row['type'];
            $price_per_month = $row['price_per_month'];
            echo "<tr><td>$type</td><td>$price_per_month</td></tr>";
        }
        echo "</table>";
    } elseif (isset($_POST['zapr2'])) {

        $kvart = explode('.', $_POST['kvart']);
        $god = $_POST['god'];
        $kv = $kvart[2];
        $g = substr($god, 0, 4);

        echo "<p>Список объектов (с указанием типа), сданных в аренду в периоде [ $kv ] [ $g ] года. Упорядочить по дате начала аренды</p>";

        $first_d = $god . $kvart[0];
        $second_d = $god . $kvart[1];

        $query = "SELECT o.type, o.price_per_month FROM objects o, rental_details rd WHERE o.id = rd.id_objects AND rd.rent_start_date >= '$first_d' AND rd.rent_start_date <= '$second_d' ORDER BY rd.rent_start_date";
        $result = mysqli_query($link, $query);

        if (mysqli_num_rows($result) == 0) {
            die("Данные не найдены");
        }

        echo "<br><table border='1px' style='border-collapse: collapse'><tr><th>Тип объекта</th><th>Цена за месяц</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            $type = $row['type'];
            $price_per_month = $row['price_per_month'];
            echo "<tr><td>$type</td><td>$price_per_month</td></tr>";
        }
        echo "</table>";
    } elseif (isset($_POST['zapr3'])) {
        $object_type = $_POST['object_type'];
        echo "<p>Изменить цену аренды у объектов типа [ $object_type ] : увеличить на 12%</p>";

        $query = "UPDATE objects SET price_per_month = price_per_month * 1.12 WHERE type = '$object_type'";
        $result = mysqli_query($link, $query);

        echo "<p>Данные изменены</p>";
    }

    //endregion

    mysqli_close($link);

    ?>
</form>
</body>
</html>