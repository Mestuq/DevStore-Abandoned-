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

    if(file_exists('public/'.$room.'.txt')==false)
    {
        echo("pokój nie istnieje");
        exit();
    }

	//CHAT
	echo("<span class='contrast'>Witamy na chacie \"".$room."\"</span><br />");
			
	if($file=fopen('public/'.$room.'.txt','r'))
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
