<?php
function comprobarPermiso($nivelRequerido)
{
	return true; //hard coded to test
	
if(isset($_COOKIE['usuario']))
{
$usuario = $_COOKIE['usuario'];

require("db/db_config.php");
$con = mysql_connect($host, $mysql_username, $mysql_password) or die ("No se pudo conectar ;".mysql_error());
mysql_select_db($db_name, $con);
$result = mysql_query("SELECT nivel FROM socios WHERE usuario = '$usuario'");
$row = mysql_fetch_array($result);

//return ($row['nivel'] >= $nivelRequerido);

}//if isset end
}//function end
?>