<?php require("../cookieTimeCheck.php");?>
<?php require("../checkPermission.php");
if(!comprobarPermiso(2)) header("location:mensajesAcceso/prohibido.html");?>
<html>
<head>
<meta charset="utf-8">
<script language="javascript">
//variables globales
var num = 0; //numero de jugadores del torneo
var jugadores = new Array(); //posicion 0->Nombre del torneo; posiciones 1..n ->Lista de jugadores del torneo
var impares = false;//controla para ver si habia jugadores imapres

function esImpar($numero) 
{
	return $numero & 1; // 0 = es par, 1 = es impar
}

function makeRounds()
{
	var numPlayers = num;
	if(num%2!=0) jugadores[numPlayers++]="BYE";
	var rows = numPlayers-1;
	var cols = numPlayers/2;
	
	var cuadroRondas = new Array(rows);
	for (var i=0;i<rows;i++)
	{
		cuadroRondas[i] = new Array(cols);
	}
	//declaracion del cuadro
	for (var i=0;i<rows;i++)
	{
		for(var j=0;j<cols;j++)
		{
			cuadroRondas[i][j]=new Array(2);
		}
	}
	
	//insercion de valores
	//1) poner el ultimo en la primera columna
	for(var i=0;i<rows;i++)
		{
			if(i%2!=0) cuadroRondas[i][0][0]=numPlayers;
			if(i%2==0) cuadroRondas[i][0][1]=numPlayers;
		}
	
	//2) rellenar desde el principio
	var x = 1;
	var maximo = numPlayers-1;
	for (var i=0;i<rows;i++)
	{
		if (i%2!=0) //primera col
		{
			cuadroRondas[i][0][1] = x;
			if (x==maximo) x=1;
			else x++;
		}
		else if (i%2==0)
		{
			cuadroRondas[i][0][0] = x;
			if (x==maximo) x=1;
			else x++;
		}
		for(var j=1;j<cols;j++) //el resto
		{
			cuadroRondas[i][j][0] = x;
			if (x==maximo) x=1;
			else x++;
		}
	}
	
	//3) Volver desde el final
	x = 1;	
	for (var i=rows-1;i>=0;i--)
	{
		for(var j=cols-1;j>=1;j--) 
		{
			cuadroRondas[i][j][1] = x;
			if (x==maximo) x=1;
			else x++;
		}
	}
	
	//print rounds
	document.getElementById("form_div").innerHTML += "</br>";
	for (var i=0;i<rows;i++)
	{
		var numRonda = i+1;
		document.getElementById("form_div").innerHTML += "Round "+numRonda+": ";
		for(var j=0;j<cols;j++)
		{
			document.getElementById("form_div").innerHTML += cuadroRondas[i][j][0];
			document.getElementById("form_div").innerHTML += ":";
			document.getElementById("form_div").innerHTML += cuadroRondas[i][j][1];
			document.getElementById("form_div").innerHTML += "  ";
		}
		document.getElementById("form_div").innerHTML += "</br>";
	}
	
	var pass_cuadroRondas = cuadroRondas.toString();
	var pass_jugadores = jugadores.toString();
	
	
	var ref = "torneo.php?datos=";
	ref += pass_cuadroRondas;
	ref += "&jugadores=";
	ref += pass_jugadores;
	location.href=ref;
}

function printPlayers()
{
	for(var i=1;i<=num;i++)//rellena el array de jugadores con los introducidos
	{
		var textBoxId = "player"+i;
		var valor = document.getElementById(textBoxId).value;
		jugadores[i] = valor;
	}
	if(num%2!=0)//si eran impares añade un bye
	{
		num++;
		jugadores.push("BYE");
	}
	//tabla de jugadores para el torneo
	var players_table = '<table border="1"><caption>'+jugadores[0]+'</caption>';
	var cant = jugadores.length-1;
	for(var i=1;i<=cant;i++)
	{
		players_table += '<tr><td>'+i+'</td><td>'+jugadores[i]+'</td></tr>';
	}
	players_table += '</table>';
	document.getElementById("form_div").innerHTML = players_table;
	
	//botones Correcto->continuar Incorrecto->volver
	document.getElementById("form_div").innerHTML += '<img src="../img/ok.png" onclick="makeRounds()" height="50" width="50" />';
	document.getElementById("form_div").innerHTML += '<img src="../img/notok.png" onclick="backToNamesInput()" height="50" width="50" />';
}

function backToNamesInput()
{
	document.getElementById("form_div").innerHTML = '';
	for(var i=1;i<=num;i++)
	{
		document.getElementById("form_div").innerHTML += 'Player '+i+': <input type="text" id="player'+i+'" value="'+jugadores[i]+'" /><br />';
	}
	document.getElementById("form_div").innerHTML += '<img src="../img/peon.png" onclick="printPlayers()" height="40" width="40" />';
}

function setPlayerNames()
{
	if(isNaN(num))
	{
		alert("El valor debe ser un numero");
	}
	else
	{
		num = document.getElementById("numPlayers").value;
		jugadores[0] = document.getElementById("TournamentName").value;
		
		document.getElementById("form_div").innerHTML = '';
		for(var i=1;i<=num;i++)
		{
			document.getElementById("form_div").innerHTML += 'Player '+i+': <input type="text" id="player'+i+'" /><br />';
		}
	/*	if(num%2==1)
		{
			num = num+1;
			jugadores[num] = "BYE";
		}	*/
		document.getElementById("form_div").innerHTML += '<img src="../img/peon.png" onclick="printPlayers()" height="40" width="40" />';	
	}
}
</script>
<meta charset="utf-8">
<title>TITULO</title>
<link rel="stylesheet" href="../estilos.css">
</head>
<body>
<?php include("../header.php");?>
<div id="form_div">
Tournamente name: <input type="text" id="TournamentName" /><br />
Number of players: <input type="text" id="numPlayers" /><br />
<button onClick="setPlayerNames()">Create</button>
</div>
<div id="form_div2">
</div>
</body>
</html>