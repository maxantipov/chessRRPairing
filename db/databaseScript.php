<?php
include("db_config.php");

$con = mysql_connect($host, $mysql_username, $mysql_password) or die ("No se pudo conectar ;".mysql_error());

//create db
if (mysql_query("CREATE DATABASE ".$db_name, $con))
  {
  echo "Database created";
  }
else
  {
  echo "Error creating database: " . mysql_error();
  }
  
//create users table
mysql_select_db($db_name, $con);
$sql_socios_table_creation = "CREATE TABLE $table_name
(
usuario text,
password text,
nivel int,
user_id int NOT NULL AUTO_INCREMENT, 
PRIMARY KEY(user_id)
)";

$sql_torneos_table_creation = "CREATE TABLE torneos
(
torneo text,
ronda int,
blancas text,
negras text,
resultado_B float,
resultado_N float,
incomparecencia int, 
game_id int NOT NULL AUTO_INCREMENT, 
PRIMARY KEY(game_id)
)";

$sql_sample_user = "INSERT INTO $table_name (usuario,password,nivel) VALUES ('admin','admin',2)";

mysql_query($sql_socios_table_creation,$con) or die ("error creando la tabla socios. ".mysql_error());
mysql_query($sql_torneos_table_creation,$con) or die ("error creando la tabla torneos. ".mysql_error());
mysql_query($sql_sample_user,$con) or die ("error: ".mysql_error());


mysql_close($con);
?>