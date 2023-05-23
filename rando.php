<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <!-- JQUERY -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!-- CZCIONKI -->
        <link href="https://fonts.googleapis.com/css?family=Arimo" rel="stylesheet">
        <!-- STYLE -->
        <link rel="Stylesheet" type="text/css" href="animate.css" />
        <link rel="stylesheet" type="text/css" href="style.css">
        <!-- JAVASCRIPT -->
        <script src="background.js"></script>
		<?php
		session_start();
		if(!isset($_SESSION['user_session']))
		{
			echo("<script>window.location.replace('login.php');</script>");
			exit();
		}
		include_once 'login/dbconfig.php';

        $stmt = $db->prepare("SELECT * FROM tbl_users WHERE user_id=:uid");
        $stmt->execute(array(":uid"=>$_SESSION['user_session']));
        $row=$stmt->fetch(PDO::FETCH_ASSOC);
        $nick=$row['user_name'];
        
        
        $upr=file_exists("permission/".$nick."_lobby");
        if($upr==false)
        {
            echo("Nie masz uprawnień do tworzenia lobby!");
            exit();
        }
        
        $uprdd=file_exists("permission/".$nick."_join");
        if($uprdd==true)
        {
            echo("Nie masz uprawnień do dołączenia do lobby, więc nie możesz tworzyć lobby!");
            exit();
        }
        
		?>
		
		
    </head>
	<body>
		<form action="lobby.php">
			<input type='submit' value="Wróć do Lobby">
		</form>

<?php 
function rom()
{
	echo("");	
	$Qdata = file("lobby.txt");
	$Qline = $Qdata[count($Qdata)-1];
	$Qline= trim(preg_replace('/\s+/', ' ',$Qline));
	return $Qline;

}


function make_seed()
{
  list($usec, $sec) = explode(' ', microtime());
  return $sec + $usec * 1000000;
}
srand(make_seed());
		
function been($newitem,$ids,&$rray)
{

	
	if($ids==0)
	{
		echo("***********pierwszy<br />");
		return false;
	}
	
	if(is_array($rray))
	{
		if(in_array($newitem, $rray)==false)
		{
			return false;
		}	
	}else
	{
		if($rray!=$newitem)
		{
			return false;
		}
	}
	

	
	echo("byłoooooo<br />");
	return true;
	
	
}

	if(isset($_POST['countw'])||isset($_POST['namefile']))
	{
		$arr=array();


		$ile=$_POST['countw'];
		$dirr=$_POST['namefile'];
		$uczestnicy=$_POST['uczestnicy'];
		
		//$dirr=trim(preg_replace('/\s+/', ' ',$dirr));
		
		
		$dirr_new=$dirr;
		$dirr_new = str_replace("/","", $dirr_new);
		$dirr_new = str_replace("\\","", $dirr_new);
		$dirr_new = str_replace(".","", $dirr_new);
		
		if($dirr!=$dirr_new)
		{
			echo("Nazwa gamejamu nie może posiadać znaków / \\ i . ");
			exit();
		}
        if($dirr=="")
        {
            echo("wypełnij najpierw puste pola!");
            exit();
        }
		
		
		
        $dbtopic=$_POST['dbtopic'];
        if(file_exists("topic/".$dbtopic)==false)
        {
            echo("Błąd #404. Taka baza nie istnieje!");
            exit();
        }
        
        
		$f_contents = file("topic/".$dbtopic); 
		$maks=count($f_contents) - 1;
		
		if($uczestnicy<=0)
		{
			echo("Błędna liczba uczestników!");
			exit();
		}
		if($ile<=0)
		{
			echo("Błędna liczba tematów!");
			exit();
		}		
		
		if($ile<=$maks)
		{
			for($i=0;$i<$ile;$i++)
			{
				$once=$f_contents[rand(0,$maks-1)];
				echo($once.$i."<br />");
				
				if(!been($once,$i,$arr))
					array_push($arr,$once);
				else 
					$i--;
			}
		}else
		{
			echo("Wartość przekroczona! (więcej tematów niż całkowicie na liście)");
			exit();
			
		}		
		
		if($file=fopen('lobby.txt',"rb"))
		{
			while(!feof($file))
			{
				$line=fgets($file);
				if($line==$dirr."\n")
				{
					echo("Nazwa pokoju zajęta!");
					exit();
				}
			}
			fclose($file);
		}		
		if($file=fopen('lobby.txt','a'))
		{
			fwrite($file, $dirr."\n");
			fclose($file);
		}
		
		$preload=rom();
		echo("Preload session: ".$preload."<br />");

		
		if($file=fopen('gamejams/end/'.$preload.'.txt','a'))
		{
			fwrite($file, $uczestnicy);
			fclose($file);
		}
		
		if($file=fopen("gamejams/".$preload.'.txt','a'))
		{
			//echo(rom());
			echo("wynik:");
			print_r($arr);
			
			foreach($arr as $item)
			{
				//echo($item."<br />");
				fwrite($file, $item);
			}
			fclose($file);
		}
		
		if($file=fopen("gamejams/rand/".$preload.'.txt','a'))
		{
			$los=rand(0,$maks-1);
			fwrite($file, $los);
			
			fclose($file);
		}
		if($file=fopen("gamejams/chat/".$preload.'.txt','a'))
        {
            fclose($file);
        }
		
		
	}
	
?>
		<script>
			window.location.replace("join.php?room=<?php echo(rom()); ?>");
		</script>
	</body>
</html>