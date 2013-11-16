<?php require("cookieTimeCheck.php");?>
<?php require("checkPermission.php");
if(!comprobarPermiso(2)) header("location:mensajesAcceso/prohibido.html");?>
<html>
<head>
<meta charset="utf-8">
<title>TITULO</title>
<link rel="stylesheet" href="estilos.css">
</head>
<body>
ESTA PAGINA SOLO LA PUEDEN VER LOS ADMINISTRADORES

- Administracion usuarios de la pagina
- Creacion y seguimiento de torneos sociales

</body>
</html>