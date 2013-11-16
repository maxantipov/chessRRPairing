<?php require("cookieTimeCheck.php");?>
<?php require("checkPermission.php");
require('db/db_config.php');
if(!comprobarPermiso(1)) header("location:mensajesAcceso/prohibido.html");

function compara($a,$b)
{
	if($a[0]>$b[0]) return -1;
	if($a[0]<$b[0]) return 1;
	if($a[0]==$b[0]) return 0;
}


?>
<html>
<head>
<meta charset="utf-8">
<title>TITULO</title>
<link rel="stylesheet" href="estilos.css">
</head>
<body>
<?php include("header.php");?>
<div>
<?php
// Connect to server and select databse.
mysql_connect("$host", "$mysql_username", "$mysql_password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");
$sql="SELECT DISTINCT torneo FROM torneos";
$result=mysql_query($sql);

echo '<form action="torneos.php" method="get"><select name="torneo">';
while($row = mysql_fetch_array($result))
  {
  echo '<option value="'.$row['torneo'].'">'.$row['torneo'].'</option>';
  }
echo '</select><input type="submit" value="Ver Torneo" /></form>';

//boton version impimir
if(isset($_GET['torneo']))
{
	echo '<form action="print_torneo.php" method="GET">';
	echo '<input type="hidden" name="torneo" value="'.$_GET['torneo'].'"/>
			<input type="submit" value="Versión para imprimir"></form>';
}
?>
</div>
<div class="content">
<?php
if (isset($_GET['torneo']))
{
echo '<div class="tournament">';

	$torneo = $_GET['torneo'];
	echo '<a style="font-size:25">'.$torneo.'</a>';
	
	mysql_connect("$host", "$mysql_username", "$mysql_password")or die("cannot connect"); 
	mysql_select_db("$db_name")or die("cannot select DB");
	$sqlRondas="SELECT DISTINCT ronda FROM torneos WHERE torneo = '$torneo'";
	$resultRondas=mysql_query($sqlRondas);
	while($rowRondas = mysql_fetch_array($resultRondas))
	{
		
		$sqlPartidas="SELECT * FROM torneos WHERE torneo = '$torneo' AND ronda = '".$rowRondas['ronda']."'";
		$resultPartidas=mysql_query($sqlPartidas);
		
		echo '<table>';
		echo "<th colspan='4'><h3>Ronda ".$rowRondas['ronda']."</h3></th>";
		
		while($rowPartidas = mysql_fetch_array($resultPartidas))
		{
			if(comprobarPermiso(1) && !comprobarPermiso(2))
			{
				$guion = "";
				if(($rowPartidas['resultado_B'] != "") && ($rowPartidas['resultado_N'] != "")) $guion = "-";
				echo '<form action="introducirResultados.php" method="post">
				<tr><td>'.$rowPartidas['blancas'].'</td><td>-</td><td>'.$rowPartidas['negras']."</td>  <td style='text-align:center'>".$rowPartidas['resultado_B'].$guion.$rowPartidas['resultado_N'].'</td><td></td>';
			}
			elseif(comprobarPermiso(2))
			{//con introduccion de resultado
				$guion = "";
				if(($rowPartidas['resultado_B'] != "") && ($rowPartidas['resultado_N'] != "")) $guion = "-";
				echo '<form action="introducirResultados.php" method="post">
				<tr><td>'.$rowPartidas['blancas'].'</td><td>-</td><td>'.$rowPartidas['negras']."</td>  <td style='text-align:center'>".$rowPartidas['resultado_B'].$guion.$rowPartidas['resultado_N'].'</td><td>     
				<select name="'.$rowPartidas['game_id'].'">
				  <option value="0">'.$rowPartidas['resultado_B']."-".$rowPartidas['resultado_N'].'</option>
				  <option value="1">1-0</option>
				  <option value="2">0-1</option>
				  <option value="3">0.5-0.5</option>
				  <option value="4">0-0</option></select></td></tr>';
							
			}
		}//while partidas en la ronda
		echo '</table>';
		if(comprobarPermiso(2)) echo '<input type="submit" value="Introducir Resultados"/></form><br/>';
		echo '<br/><br/>';
	}//while rondas
	echo '</div>';
}
?>

<div class="clasificacion" style="float:right">
<?php
if (isset($_GET['torneo']))
{
$jugadores = array();//array con los jugadores
$resultados = array();//array con los resultados

mysql_connect("$host", "$mysql_username", "$mysql_password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");

//suma de resultados con blancas
$sqlResultados="SELECT blancas, resultado_B FROM torneos WHERE torneo = '$torneo'";
$resultResultados=mysql_query($sqlResultados);
while($rowResultados = mysql_fetch_array($resultResultados))
{
	$jug = $rowResultados['blancas'];
	$result = $rowResultados['resultado_B'];
	//si el jugador no está en el array de jugadores lo introduzco y le pongo su resultado
	if(!in_array($jug,$jugadores) && $result != "NULL")
	{
		array_push($jugadores,$jug);
		array_push($resultados,$result);
	}
	elseif($result!="NULL")//si ya estaba, busco su índice y al array de resultados en el mismo índice le sumo el resultado
	{
		$key = array_search($jug,$jugadores);
		$resultados[$key] = $resultados[$key]+$result;
	}
}

//suma de resultados con negras
$sqlResultados="SELECT negras, resultado_N FROM torneos WHERE torneo = '$torneo'";
$resultResultados=mysql_query($sqlResultados);
while($rowResultados = mysql_fetch_array($resultResultados))
{
	$jug = $rowResultados['negras'];
	$result = $rowResultados['resultado_N'];
	//si el jugador no está en el array de jugadores lo introduzco y le pongo su resultado
	if(!in_array($jug,$jugadores) && $result != "NULL")
	{
		array_push($jugadores,$jug);
		array_push($resultados,$result);
	}
	elseif($result!="NULL")//si ya estaba, busco su índice y al array de resultados en el mismo índice le sumo el resultado
	{
		$key = array_search($jug,$jugadores);
		$resultados[$key] = $resultados[$key]+$result;
	}
}

//creo un array bidimensional con [0]->resultado y [1]->jugador
$masterArray = array(array());
for($i=0;$i<count($jugadores);$i++)
{	
	$masterArray[$i][0]=$resultados[$i];
	$masterArray[$i][1]=$jugadores[$i];
}
//ordeno ese array
usort($masterArray, "compara");


echo '<table class="standings"><caption>CLASIFICACIÓN</caption>';
echo '<tr><th>Pos</th><th>Jugador/a</th><th>Puntos</th></tr>';
for($i=0;$i<count($jugadores);$i++)
{
//	echo $masterArray[$i][1]." -> ".$masterArray[$i][0]."</br>";
	$posicion = $i+1;
	echo '<tr><td>'.$posicion.')</td><td>'.$masterArray[$i][1].'</td><td>'.$masterArray[$i][0].'</td></tr>';
}
echo '</table>';

}//if isset get[torneo]
?>
</div>
</div>
</body>
</html>