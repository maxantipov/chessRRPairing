<?php require("cookieTimeCheck.php");?>
<?php require("checkPermission.php");
if(!comprobarPermiso(1)) header("location:mensajesAcceso/prohibido.html");?>
<html>
<head>
<meta charset="utf-8">
<title>TITULO</title>
<link rel="stylesheet" href="estilos.css">
</head>
<body>
ESTA PAGINA SOLO LA PUEDEN VER LOS SOCIOS DEL CLUB

- Torneos sociales
	- Clasificaciones, emparejamientos y calendario
- Ejercicio de la semana(?)
- Perfil socios del club
- Muro del club (comentarios para todos)

</body>
</html>