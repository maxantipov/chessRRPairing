var t = setTimeout("alertMsg()",1800000);

function alertMsg()
{
//alert("Has pasado 10 segundos inactivo, el tiempo de la sesion ha expirado.\nIntroduce de nuevo tu usuario y contraseña.");
var url="timeout_login.php";
window.open(url, "_self");
}
