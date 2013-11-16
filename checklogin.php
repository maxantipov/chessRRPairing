<?php
require('db/db_config.php');
// Connect to server and select databse.
mysql_connect("$host", "$mysql_username", "$mysql_password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");

// username and password sent from form 
$myusername=$_POST['myusername']; 
$mypassword=$_POST['mypassword'];

// To protect MySQL injection (more detail about MySQL injection)
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);

//md5
$mypassword = md5($mypassword);

$sql="SELECT * FROM $table_name WHERE usuario='$myusername' and contraseña='$mypassword'";
$result=mysql_query($sql);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);
// If result matched $myusername and $mypassword, table row must be 1 row

if($count==1){
// Register $myusername, $mypassword and redirect to file "login_success.php"
//session_register("myusername");
//session_register("mypassword"); 
header("location:login_success.php?usuario=$myusername");
}
else {
echo "Wrong Username or Password";
}
?>