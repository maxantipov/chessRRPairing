<?php
if(isset($_COOKIE['usuario']))
{
	setcookie("usuario","",time()-10);
}
header("location:index.php");
?>