<?php 
if(isset($_COOKIE['usuario']))
{
	setcookie("usuario", $_COOKIE['usuario'], time()+1800);
}
?>