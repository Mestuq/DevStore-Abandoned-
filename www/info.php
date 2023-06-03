<?php
session_start();
if(!isset($_SESSION['user_session']))
{
    js("-");
    exit();
}
include_once 'login/dbconfig.php';

$stmt = $db->prepare("SELECT * FROM tbl_users WHERE user_id=:uid");
$stmt->execute(array(":uid"=>$_SESSION['user_session']));
$row=$stmt->fetch(PDO::FETCH_ASSOC);

$nick=$row['user_name'];
js($nick);

function js($nick){
    $al="var nick='".$nick."';";
    echo ($al);
	if($nick!="-")
	{
		echo("document.getElementById('menus').style.display = 'inline';");
		echo("\ndocument.getElementById('here').innerHTML='Witaj ".$nick."!';");
		echo("\ndocument.getElementById('wylo').innerHTML='Wyloguj';");
		//echo("\ndocument.getElementById('here').innerHTML+='<img src='users/default.png' class='user'>';");
	}else
	{
		echo("document.getElementById('wylo').innerHTML='Zaloguj się!';");
	}
		
	
}
?>