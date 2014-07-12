<html>
<head>
<?php require("cookieTimeCheck.php");?>
<meta charset="utf-8">
<title>Demo</title>

<link rel="stylesheet" href="estilos.css">

</head>
<body>

<?php require('db/db_config.php');

$link = mysql_connect("$host", "$mysql_username", "$mysql_password");
if (!$link) {
	die('Not connected : ' . mysql_error());
}

// make foo the current db
$db_selected = mysql_select_db("$db_name", $link);
if (!$db_selected) {
	echo 'PERFORM DATABASE ACTIONS <form action="db/databaseScript.php"><input type="submit"></form>';
}

?>
<?php	include("header.php"); ?>


<div id="div_footer" class="footer">
</div>
</body>
</html>