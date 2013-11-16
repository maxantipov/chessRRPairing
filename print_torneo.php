<?php require("cookieTimeCheck.php");?>
<?php require("checkPermission.php");
require('db/db_config.php');
if(!comprobarPermiso(1)) header("location:mensajesAcceso/prohibido.html");
?>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="print_version.css">
</head>
<body>
<?php
if (isset($_GET['torneo']))
{
	$torneo = $_GET['torneo'];
	echo '<a style="font-size:25">'.$torneo.'</a>';
echo "<table>";	
	mysql_connect("$host", "$mysql_username", "$mysql_password")or die("cannot connect"); 
	mysql_select_db("$db_name")or die("cannot select DB");
	$sqlRondas="SELECT DISTINCT ronda FROM torneos WHERE torneo = '$torneo'";
	$resultRondas=mysql_query($sqlRondas);
	while($rowRondas = mysql_fetch_array($resultRondas))
	{
if($rowRondas['ronda']%3==1)
{//ronda primera columna
	echo '<tr><td class="round">';
}
else if($rowRondas['ronda']%3==2)
{//ronda columna del medio
	echo '<td width="30mm"></td><td class="round">';
}
else if($rowRondas['ronda']%3==0)
{//ronda ultima columna
	echo '<td class="round">';
}
		$sqlPartidas="SELECT * FROM torneos WHERE torneo = '$torneo' AND ronda = '".$rowRondas['ronda']."'";
		$resultPartidas=mysql_query($sqlPartidas);
		
		echo '<table>';
		echo "<th colspan='4'><h3>Ronda ".$rowRondas['ronda']."</h3></th>";
		
		while($rowPartidas = mysql_fetch_array($resultPartidas))
		{
			if(comprobarPermiso(1) && comprobarPermiso(2))
			{
				$guion = "";
				$separacion = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				if(($rowPartidas['resultado_B'] != "") && ($rowPartidas['resultado_N'] != ""))
				{
					$guion = "&nbsp;-&nbsp;";
					$separacion = "&nbsp;-&nbsp;";
				}
				echo "<tr><td>".$rowPartidas['blancas']."</td><td style='text-align:center'>".$rowPartidas['resultado_B'].$separacion.$rowPartidas['resultado_N']."</td><td>".$rowPartidas['negras'].'</td>';
			}	
		}//while partidas en la ronda
		echo '</table>';
		echo '<br/><br/>';	
if($rowRondas['ronda']%3==1)
{//ronda primera columna
	echo '</td>';
}
else if($rowRondas['ronda']%3==2)

{//ronda columna del medio
	echo '</td><td width="20mm"></td>';
}
else if($rowRondas['ronda']%3==0)
{//ronda ultima columna
	echo '</td></tr>';
}

	}//while rondas
	echo '</table>';
}
?>
</body>