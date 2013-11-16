<?php
//session_start();
//$_SESSION['conectado']= 1;
//$_SESSION['lastActionTime']= time();

$nombre = $_GET['usuario'];
setcookie("usuario", $nombre, time()+5);
header("location:index.php");
?>

<html>
<body>
Login Successful
</body>
</html>