<?php
session_start();
//function checkTimeout()
//{
	if(isset($_SESSION['lastActionTime']))
	{
		$logoutTime = 1800;
		$inactivo = time() - $_SESSION['lastActionTime'];
	
		if ($inactivo > $logoutTime)
		{
			session_destroy();
			header("location: index.php");
			$_SESSION["inactivo"] = $inactivo;
		}
		else
		{
			$_SESSION['lastActionTime']= time();
		}
	}
//}

?>