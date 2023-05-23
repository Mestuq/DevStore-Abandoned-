<?php


if(isset($_GET['room']))
{
	$room=$_GET["room"];
	
	$content=file_get_contents('gamejams/decide/'.$room.".txt");
	echo($content);
}

?>