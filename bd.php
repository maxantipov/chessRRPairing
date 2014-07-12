<?php
include ("db/db_config.php");

$user = $_POST['usuario'];
$pass = md5($_POST['pass']);
$auxlevel = $_POST['nivel'];
$level = 0;

if ($auxlevel == "miembro") $level = 1;
elseif ($auxlevel == "admin") $level = 2;


$con = mysql_connect($host,$mysql_username,$mysql_password) or die ("Error al conectar con la base de datos; ".mysql_error());

mysql_select_db($db_name,$con);
$sql="INSERT INTO socios (usuario,contrase�a,nivel) VALUES ('$user','$pass','$level')";
if (!mysql_query($sql,$con))
{
	die("Error: ".mysql_error());
}
else
{
	echo "Registration successful";
}

mysql_close($con);
?>
