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


	$next="lobby.php";

    $ttable=$_GET['topic'];

/*
    $importt=$_POST['topic'];
    $ttable="";
    $val="";
echo($importt);
    for($i=0;$i<strlen($importt);$i++)
    {
        if($importt!="!")
        {
            $importt+=$importt[$i];
        }
        else
        {
            $val=substr($importt,$i+1,strlen($importt)-1);
            break;
        }
    }
    
    echo("<br />");
    echo($ttable);
    echo("<br />");
    echo($val);
    echo("<br />");
*/

	if(isset($_POST['topic']))
	{
        $pathh="permission/".$nick;
        if(!file_exists($pathh."_topic")&&file_get_contents("topic/".$ttable."!")!=$nick)
        {
            echo("Nie masz uprawnień by to zrobić");
            exit();
        }
        
		$next="topicdatabase.php?table=".$ttable;
		$newtopic=$_POST['topic'];
		$flag=true;
		
		//$newtopic=trim( str_replace("/", "\\\\", $file););
		$newtopic=trim(preg_replace("$/$", ' ', $newtopic)); //USUWANIE BŁĘDÓW ($)
		
		if($newtopic=="")
		{
			echo("Wpisz nowy temat tutaj!");
			$flag=false;
		}
		else if($file=fopen('topic/'.$ttable,"rb"))
		{
			while(!feof($file))
			{
				$line=fgets($file);
				if($line==$newtopic."\n")
				{
					echo("Ten temat już jest na liście!");
					$flag=false;
				}
			}
			fclose($file);
		}
		if($flag)
		{
			if($file=fopen('topic/'.$ttable,'a'))
			{
				echo("Temat pomyślnie dodano!");
				//$content = file_get_contents('topic.txt');
				fwrite($file, $newtopic."\n");
				fclose($file);
			}
		}
		unset($_POST);
	}

	if(isset($_POST['remov']))
	{
        $pathh="permission/".$nick;
        if(!file_exists($pathh."_topic")&&file_get_contents("topic/".$ttable."!")!=$nick)
        {
            echo("Nie masz uprawnień by to zrobić");
            exit();
        }
        
		$next="topicdatabase.php?table=".$ttable;
		$remove=$_POST['remov'];
		$remove=trim(preg_replace('/\s+/', ' ', $remove));
		$dirf='topic/'.$ttable;
		

		$lines = file($dirf, FILE_IGNORE_NEW_LINES);
		foreach($lines as $key => $line) 
		{
			if($line==$remove) 
			{
				echo("Usunięto  ".$line);
				unset($lines[$key]);
			}
		}
		
		$data = implode(PHP_EOL, $lines)."\n";
		file_put_contents($dirf, $data);
		
		
		unset($_POST);
	}
	
	
	if(isset($_POST['gameromov']))
	{
        
        
		$next="lobby.php";
		$gameromov=$_POST['gameromov'];
		
		$gameromov_new=$gameromov;
		$gameromov_new = str_replace("/","", $gameromov_new);
		$gameromov_new = str_replace("\\","", $gameromov_new);
		$gameromov_new = str_replace(".","", $gameromov_new);
		
		if($gameromov!=$gameromov_new)
		{
			echo("Nie możesz usunąć tego pliku / \\ i . ");
			exit();
		}
		
		
		$dirf="lobby.txt";
		
		$lines = file($dirf, FILE_IGNORE_NEW_LINES);
		foreach($lines as $key => $line) 
		{
			if($line==$gameromov) 
			{
				echo("Usunięto:  ".$line);
				unset($lines[$key]);
			}
		}
		
		$data = implode(PHP_EOL, $lines)."\n";
		file_put_contents($dirf, $data);
		
		unlink("chat/".$gameromov.".txt");
		unlink("gamejams/".$gameromov.".txt");
		unlink("gamejams/rand/".$gameromov.".txt");
		unlink("gamejams/end/".$gameromov.".txt");
		unlink("gamejams/decide/".$gameromov.".txt");
		unset($_POST);
	}

echo("<script>");
echo("window.location.replace('".$next."');");
echo("</script>");
?>