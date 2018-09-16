<?php
// *** Logout the current user.
$logoutGoTo = "../home";
if (!isset($_SESSION)) 
{
	session_start();
}

unset($_SESSION['MM_Username']);
unset($_SESSION['MM_UserGroup']);
unset($_SESSION['PrevUrl']);
unset($_SESSION['logged']);
unset($_SESSION["USER_AUTHORIZED"]);

if ($logoutGoTo != "") 
{
	header("Location: $logoutGoTo");
	exit ;
}
?>
