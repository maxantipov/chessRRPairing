<html>
<head>
<?php require("cookieTimeCheck.php");?>
<meta charset="utf-8">
<title>Demo</title>

<link rel="stylesheet" href="estilos.css">

</head>
<body>

PERFORM DATABASE ACTIONS <form action="db/databaseScript.php"><input type="submit"></form> 
<?php	include("header.php"); ?>


<a href="register.php"> <img src="img/peon.png" border="0" onClick="header(register.php)" height="50px" width="50px" class="menu_item" /></a>
<a href="main_login.php"> <img src="img/pacman.png" border="0" onClick="header(register.php)" height="50px" width="50px" class="funny" /></a>
<div id="register_text">

</div>

    <script src="jquery.js"></script>
    <script>
	
//resize image	
 $(document).ready(function(){
   $("img.menu_item").hover(
   function()
   {
	 $(this).animate({height:'100px', width:'100px',opacity: 1},1000);
   },function()
   {
	 $(this).animate({height:'50px', width:'50px',opacity: 1},1000);
   }
   );
 });
 
 $(document).ready(function(){
   $("img.funny").hover(
   function()
   {
	 $(this).hide("slow");
   }
   );
 });
 
 </script>
 
 
 

</div>




<div id="div_footer" class="footer">
</div>



</body>
</html>