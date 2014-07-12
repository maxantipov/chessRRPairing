<?php
if(isset($_GET['datos']))
{
include ("../db/db_config.php");

$aux_datos = $_GET['datos'];
$aux_jugadores = $_GET['jugadores'];

$jugadores = explode(",",$aux_jugadores);//array con los datos, [0]->nombre del torneo, [1..n]->jugadore
$nombreTorneo = $jugadores[0];
$numPlayers = count($jugadores)-1;
$numRounds = $numPlayers-1;
$numTables = $numPlayers/2;

echo $jugadores[0]."</br></br>";
//creacion del cuadro de emparejamiento
$lista_emparejamientos = explode(",",$aux_datos);

$pointer = 0;
for($i=1;$i<=$numRounds;$i++)
{
	echo "Round ".$i.":  ";
	for($j=0;$j<$numTables;$j++)
	{
		echo $lista_emparejamientos[$pointer];
		$pointer++;
		echo ":";
		echo $lista_emparejamientos[$pointer];
		$pointer++;
		echo "  ";
	}
	echo "</br>";
}

//meter torneo en la bd

$con = mysql_connect($host,$mysql_username,$mysql_password) or die ("Error al conectar con la base de datos; ".mysql_error());
mysql_select_db($db_name,$con);


$posi = 0;
$jugador_B = "";
$jugador_N = "";
for($i=1;$i<=$numRounds;$i++)
{
	for($j=0;$j<$numTables;$j++)
	{
		$jugador_B = $jugadores[$lista_emparejamientos[$posi]];
		$jugador_N = $jugadores[$lista_emparejamientos[$posi+1]];
		$sql="INSERT INTO torneos (torneo,ronda,blancas,negras) VALUES ('$nombreTorneo','$i','$jugador_B','$jugador_N')";
		if (!mysql_query($sql,$con))
		{
			die("Error al crear el torneo: ".mysql_error());
		}
		$posi++;
		$posi++;
	}
}


mysql_close($con);

}
else
{
	echo "no funciona";
}
?>