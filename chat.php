<?php
	session_start();
	if(isset($_SESSION['user_session'])=="")
	{
		header("Location: ../login.php");
	}

	$room=$_GET["room"];
    if($room=="")
    {
        echo("ERROR");
        exit();
    }

    if(file_exists('gamejams/chat/'.$room.'.txt')==false)
    {
        echo("pokój nie istnieje");
        exit();
    }

	//CHAT
	echo("<i>Witamy w pokoju \"".$room."\"</i><br />");
			
	if($file=fopen('gamejams/chat/'.$room.'.txt','r'))
	{
		while(!feof($file))
		{
			$line=fgets($file);
			if($line!="")
			{
				echo($line);
				echo('<br />');	
			}
		}
		fclose($file);
	}
?>
