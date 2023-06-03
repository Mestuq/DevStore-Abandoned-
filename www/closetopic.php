<?php
session_start();
if(isset($_SESSION['user_session'])!="")
{
	header("Location: login.php");
}

if(isset($_GET['room']))
{
	$room=$_GET["room"];
	
	$content=file_get_contents('gamejams/end/'.$room.".txt");
	echo($content);
}

?>