<?php

echo '
<div id="div_header" class="header">

<div id="login" class="login_box">';

if (isset($_COOKIE['usuario']))
{
	echo "Hola ".$_COOKIE['usuario'];
	echo '<form method="post" action="logout.php"><input type="submit" value="Salir"></form><br/>';
}
else
{
	echo '	<table width="300" border="0" align="center" cellpadding="0" cellspacing="1">	
		<tr>
		<form name="form1" method="post" action="checklogin.php">
		<td>
		<table width="100%" border="0" cellpadding="3" cellspacing="1">
		<tr>
		<td width="78">Usuario</td>
		<td width="6">:</td>
		<td width="294"><input name="myusername" type="text" id="myusername"></td>
		</tr>
		<tr>
		<td>Contrase�a</td>
		<td>:</td>
		<td><input name="mypassword" type="password" id="mypassword"></td>
		</tr>
		<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><input type="submit" name="Submit" value="Entrar"></td>
		</tr>
		</table>
		</td>
		</form>
		</tr>
	</table>  ';
}	

echo '
</div>

<div id="menu" class="mainMenu"></div>
	<ul class="mainMenu">
	
	
	<li class="menuItem"><a href="torneos.php" class="menuItem">Ver torneos</a></li>
	<li class="menuItem"><a href="funciones/crear_torneo.php" class="menuItem">CREAR TORNEO</a></li>
	
	</ul>
</div>';
?>