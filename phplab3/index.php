<!DOCTYPE html>
<html>
	<head>
		<title>Работа с массивами 11 вариант</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<form method="POST">
			<label>
				<div>
					Введите размер массива
				</div>
				<input type="number" name="razm">
			</label>
			<br>
			<label>
				min
				<input type="number" name="min">
			</label>
			<label>
				max
				<input type="number" name="max">
			</label>
			<br>
			<label>
				a
				<input type="number" name="a">
			</label>
			<label>
				b
				<input type="number" name="b">
			</label>
			<br>
			<input type="submit">
		</form>
		
		<?php
		
			$razm = (int)$_POST['razm'];
			
			if($_POST['razm'] == "" || $_POST['min'] == "" || $_POST['max'] == "" || $_POST['a'] == "" || $_POST['b'] == "")
			{
				echo "Не все поля заполнены";
				die;
			} else
			if($razm <= 0)
			{
				echo "Введен некорректный размер массива";
				die;
			}	else
			{
				$min = (int)$_POST['min'];
				$max = (int)$_POST['max'];
				if($min - $max >=0)
				{
					echo "min >= max";
					die;
				}
			}
			$a = (int)$_POST['a'];
			$b = (int)$_POST['b'];
			if($a - $b >=0)
			{
				echo "a >= b";
				die;
			}
			
			
			
			$arr = [];
			
			$minE = $max;
			$minI = -1;
			
			$sum = 0;
			$provMinus = false;
			
			$vhod = false;
			
			
			echo "Размер массива - [ " . $razm . " ] <br>";
			echo "Минимальное значение - [ " . $min . " ] | " . " [ " . $max . " ] - Максимальное значение <br>";
			echo "Диапазон удаления [a,b] - [ " . $a . "," . $b . " ] <br>";
			
			echo "Сгенерированный массив - ";
			for($i=0; $i<$razm;$i++)
			{
				$randN = (string)mt_rand(0,999);
				$random = (double)((string)mt_rand($min+1,$max-1) . "." . $randN);
				array_push($arr, $random);
				echo "[ " . $arr[$i] . " ]" . " ";
				
				//Нахождение минимального по модулю элемента
				if($minE > abs($random))
				{
					$minE = abs($random);
					$minI = $i;
				}
				
				//Нахождение суммы по модулю после элемента с минусом
				if($provMinus === true)
				{
					$sum = $sum + abs($random);
				} else
				if($random < 0)
				{
					$provMinus = true;
				}
				
				if($vhod === false)
				if($random >= $a && $random <=$b)
				{
					$vhod = true;
				}
			}
			
			
			echo "<br>";
			
			echo "Минимальный по модулю элемент имеет индекс " . "[ " . ($minI+1) . " ] | [ " . $minE . " ]";
			
			echo "<br>";
			
			if($provMinus === false)
			{
				echo "Отрицательных элементов в массиве нет";
			} else
			echo "Сумма элементов по модулю после первого отрицательного элемента = " . "[ " . $sum . " ]";
			
			echo "<br>";
			
			
			
			if($vhod === true)
			{
				echo "Удаление элементов, входящих в интервал [a,b] - ";
				for($i=0;$i<=count($arr)-1;$i++)
				{
					if($arr[$i] >= $a && $arr[$i] <=$b)
					{
						for($j=$i;$j<=count($arr)-2;$j++)
						{
							$arr[$j] = 0;
							$vremP = $arr[$j+1];
							$arr[$j+1] = $arr[$j];
							$arr[$j] = $vremP;
						}
					}
					
					echo "[ " . $arr[$i] . " ]" . " ";
				}
			} else
			{
				echo "В массиве не было найдено элементов, входящих в интервал [a,b]";
			}
			
		?>
		
	</body>
</html>