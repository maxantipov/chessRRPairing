<?php require("cookieTimeCheck.php");?>
<?php require("checkPermission.php");
if(!comprobarPermiso(2)) header("location:mensajesAcceso/prohibido.html");?>

<?php
include ("db/db_config.php");
$con = mysql_connect($host,$mysql_username,$mysql_password) or die ("Error al conectar con la base de datos; ".mysql_error());
mysql_select_db($db_name,$con);

$cantidadResutados = count($_POST);
$claves = array();
$values = array();
foreach($_POST as $key => $value)
{
	array_push($claves,$key);
	array_push($values,$value);
}

for($i=0;$i<$cantidadResutados;$i++)
{
	if($values[$i]!=0)
	{
		if ($values[$i]==1) $parte_resultados = "SET resultado_B = '1', resultado_N = '0'";
		if ($values[$i]==2) $parte_resultados = "SET resultado_B = '0', resultado_N = '1'";
		if ($values[$i]==3) $parte_resultados = "SET resultado_B = '0.5', resultado_N = '0.5'";
		if ($values[$i]==4) $parte_resultados = "SET resultado_B = '0', resultado_N = '0'";
		$id = $claves[$i];
		$sql="UPDATE torneos ".$parte_resultados." WHERE game_id = '$id'";
		if (!mysql_query($sql,$con))
		{
			die("Error: ".mysql_error());
		}
		else
		{
			header("location:{$_SERVER['HTTP_REFERER']}");
		}
	}
}
mysql_close($con);

?>