<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
	</head>
	
	<body>
<?php
	session_start();
	if(!isset($_SESSION['user_session']))
	{
		echo("<script>window.location.replace('login.php');</script>");
		exit();
	}
	include_once 'login/dbconfig.php';
	
function correct_encoding($text) {
    $current_encoding = mb_detect_encoding($text, 'auto');
    $text = iconv($current_encoding, 'ASCII', $text);
    return $text;
}
	
	if(isset($_GET['topic']))
	{
		if(isset($_GET['room']))
		{
			$stmt = $db->prepare("SELECT * FROM tbl_users WHERE user_id=:uid");
			$stmt->execute(array(":uid"=>$_SESSION['user_session']));
			$row=$stmt->fetch(PDO::FETCH_ASSOC);

			
			$room=$_GET["room"];			
			$topic=$_GET['topic'];
			$nick=$row['user_name'];			
			
			$topic=str_replace("$"," ",$topic);
			$nick=str_replace("$"," ",$nick);
					
			
			function been($src,$maks,$nic)
			{
				$tname=true;
				$act="";
				$user="";
				$topic="";
				
				if($maks<=0)
				{
					return false;
				}
				for($j=0;$j<$maks;$j++)
				{
					//alert("porównanie: "+src[j]);
					if($src[$j]=='$')
					{
						if($tname==true)
							$user=$act;
						if($tname==false)
							$topic=$act;
							
						if($user==$nic)
							return true;
						
						if($tname==true)
							$tname=false;
						else
							$tname=true;
						$act="";
					}else
					{
						$act=$act.$src[$j];
					}
					
				}
				return false;
			}	
			function uczestnicy()
			{
				$end=(int)file_get_contents('gamejams/end/'.$_GET["room"].".txt");	
				$decid='gamejams/decide/'.$_GET["room"].'.txt';
				if($file=fopen($decid,'a'))
				{
					$tname=true;
					$act="";
					$user="";
					$uczest=0;
					
					$topic="";
					$src=file_get_contents($decid);
					
					//alert(src);
					
					for($j=0;$j<strlen($src);$j++)
					{
						//alert("porównanie: "+src[j]);
						//echo($src[$j]);
						if($src[$j]=='$')
						{
							if($tname==true)
								$user=$act;
							if($tname==false)
								$topic=$act;
							
							if(been($src,$j-1,$user)==false)
							{
								echo("użytkownik: ".$user."<br />");
								$uczest++;
							}
							
							$tname=!$tname;
							$act="";
						}else
						{
							$act=$act.$src[$j];
						}
						
					}
					//$topic=$topic.trim();
					//return $topic;
				}
				echo("Łącznie ".($uczest+1)." uczestników na " .$end." <br />");
				if($uczest>=$end)
				{
					echo("<br /> Przykro mi, ale limit użytkowników przekroczony! <br />");
					exit();
				}
			}
			uczestnicy();
			
			
			
			if($file=fopen('gamejams/decide/'.$room.'.txt','a'))
			{
				echo("Wysłano zgłoszenie!");
				fwrite($file,$nick."$".$topic."$");
				fclose($file);
			}
			
			if($file=fopen('chat/'.$room.'.txt','a'))
			{
				fwrite($file, "Użytkownik <b>".$nick." </b>zmienił temat do usunięcia! <br />");
				fclose($file);
			}
		}
	}
	
	
?>
		<script>
			//window.location.replace("topicselector.php?room=<?php echo($room); ?>");
		</script>
	</body>
</html>