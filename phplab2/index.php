<!DOCTYPE html>
<html>
	<head>
		<title>Проверка ИНН</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<form method="POST" action="">
			<input type="number" name="inn">
			<input type="submit">
		</form>
		
		<?php
			if((strlen($_POST['inn']) != 12) && (strlen($_POST['inn']) !=10))
			{
				echo "Некорректный ИНН";
			}
			else
			{
				if(strlen($_POST['inn']) == 10)
				{//7830002293
					$array = array(2,4,10,3,5,9,4,6,8);
					for($i=0;$i<=9;$i++)
					{
						$g = substr($_POST['inn'],$i,1);
						if($g=="-")
						{
							echo("Некорректный ИНН");
							die;
						}
						$mas = $mas + $g*$array[$i];
					}
					$mas = $mas%11;
					echo $_POST['inn'];
					echo "<br>";
					if($mas != $g)
						echo 'Некорректный ИНН';
				}
				if(strlen($_POST['inn']) == 12)
				{//500100732259
					$array1 = array(7,2,4,10,3,5,9,4,6,8);
					$array2 = array(3,7,2,4,10,3,5,9,4,6,8);
					for($i=0;$i<=11;$i++)
					{
						$g = substr($_POST['inn'],$i,1);
						if($g=="-")
						{
							echo("Некорректный ИНН");
							die;
						}
						$mas1 = $mas1 + $g*$array1[$i];
						if($i<=10)
						{
							$mas2 = $mas2 + $g*$array2[$i];
						}
					}
					$g2 = substr($_POST['inn'],10,1);
					echo $_POST['inn'];
					echo "<br>";
					$mas1 = $mas1%11;
					$mas2 = $mas2%11;
					if($mas1 != $g2 || $mas2 != $g)
					{
						echo "Некорректный ИНН";
					}
				}
			}
		?>
	</body>
</html>