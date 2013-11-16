<?php
session_start();
session_destroy();
?>
<html>
<head>
<link rel="stylesheet" href="estilos.css">
<script language="javascript">
function backToIndex()
{
window.open("index.php", "_self");
}
</script>
</head>
<body>
<h5 align="center">Has pasado demasiado tiempo inactivo, por favor vuelve a entrar.</h5>
	<table width="300" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
		<tr>
		<form name="form1" method="post" action="checklogin.php">
		<td>
		<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
		<tr>
		<td colspan="3"><strong>Vuelve a entrar para seguir navegando</strong></td>
		</tr>
		<tr>
		<td width="78">Usuario</td>
		<td width="6">:</td>
		<td width="294"><input name="myusername" type="text" id="myusername"></td>
		</tr>
		<tr>
		<td>Contraseña</td>
		<td>:</td>
		<td><input name="mypassword" type="password" id="mypassword"></td>
		</tr>
		<tr>
		<td width="6">&nbsp;</td>

		<td><input type="submit" name="Submit" value="Entrar"></form></td>
		<td><button onClick="backToIndex()" name="Cancel">Cancelar</button></td>
		</tr>
		</table>
		</td>
		</tr>
	</table>
</body>
</html>