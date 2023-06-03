<?php
	session_start();
	if(!isset($_SESSION['user_session']))
	{
		echo("<script>window.location.replace('login.php');</script>");
		exit();
	}
	include_once 'login/dbconfig.php';

?>
<?php
	$stmt = $db->prepare("SELECT * FROM tbl_users WHERE user_id=:uid");
	$stmt->execute(array(":uid"=>$_SESSION['user_session']));
	$row=$stmt->fetch(PDO::FETCH_ASSOC);

	$nick=$row['user_name'];

    $upr=file_exists("permission/".$nick."_chat");
    if($upr==true)
    {
        echo("Nie masz uprawnień do pisania na chacie!");
        exit();
    }
    

	$room=$_GET["room"];
	$mess=$_GET["message"];
    $loc='gamejams/chat/'.$room.'.txt';

    if(file_exists($loc)==false)
    {
        echo("pokój nie istnieje");
        exit();
    }

    if(strlen($mess)>200)
        exit();


	$mess=str_replace("<"," jest mniejszy od ",$mess);
	$mess=str_replace(">"," jest większy od ",$mess);
    $mess=str_replace("&"," and ",$mess);
	
    
	//EMOTKI
	$mess=str_replace(":active:","<img src='emo/active.png'>",$mess);
	$mess=str_replace(":adam:","<img src='emo/adam.png'>",$mess);
	$mess=str_replace(":chleb:","<img src='emo/chleb.png'>",$mess);
	$mess=str_replace(":chopin:","<img src='emo/chopin.png'>",$mess);
	$mess=str_replace(":counter:","<img src='emo/counter.png'>",$mess);
	$mess=str_replace(":julek:","<img src='emo/julek.png'>",$mess);
	$mess=str_replace(":kappa:","<img src='emo/kappa.png'>",$mess);
	
	$mess=str_replace(":kasztany:","<img src='emo/kasztany.png'>",$mess);
	$mess=str_replace(":pepe:","<img src='emo/pepe.png'>",$mess);
	$mess=str_replace(":pirat:","<img src='emo/pirat.png'>",$mess);
	$mess=str_replace(":slaz:","<img src='emo/slaz.png'>",$mess);
	$mess=str_replace(":trap:","<img src='emo/trap.png'>",$mess);
	$mess=str_replace(":wrr:","<img src='emo/wrr.png'>",$mess);
	$mess=str_replace(":wystraszony:","<img src='emo/wystraszony.png'>",$mess);
	
	$odp="";
	if($mess=="!los")
	{
		function make_seed()
		{
		  list($usec, $sec) = explode(' ', microtime());
		  return $sec + $usec * 1000000;
		}
		srand(make_seed());
		
		$liczba=rand(0,11);
		if($liczba==0)
			$odp="Myślę, że nie.";
		if($liczba==1)
			$odp="Pytasz się o pierdoły, jasne, że tak!";
		if($liczba==2)
			$odp="To nie tak, że 'tak' czy 'nie', gdbym miał powiedzieć co cenie w tym pytaniu najbardziej powiedział bym, że ciebie <3";
		if($liczba==3)
			$odp="Sprawdziłem dziesięć tysięcy możliwych przyszłości. Tylko w jednym z nich zadane pytanie jest prawdziwe.";
		if($liczba==4)
			$odp="Zamknij RYJ śmieciu!";
		if($liczba==5)
			$odp="Co??? W żadnym wypadku!";
		if($liczba==6)
			$odp="Obawiam się, że to prawda.";
		if($liczba==7)
			$odp="Kisnę z tego pytania xDDDD. NIE";
		if($liczba==8)
			$odp="Zadajesz trudne pytania. Raczej tak, ale jak coś to nie miej do mnie pretensji.";
		if($liczba==9)
			$odp="Nie wiem, poszukam w Google, poczekaj chwilkę \n<b>BOT: </b> Sprawdziłem! Google twierdzi, że nie.";
		if($liczba==10)
			$odp="Śmiem wątpić.";
		if($liczba==11)
			$odp="KAT. Oj, przepraszam napisałem od tył.";
	}
	


	if($mess=="!cls")
	{
        unlink($loc);
        if($file=fopen($loc,'a'))
        {
            fclose($file);
        }
	}		
	if($mess!="")
	if($file=fopen($loc,'a'))
	{
		echo("Wysłano wiadomość!");
		//$content = file_get_contents('topic.txt');

		fwrite($file, "<b>".$nick.": </b>".$mess."\n");
                
		if($mess=="!los")
		{
			fwrite($file, "<b>BOT: </b>".$odp."\n");
		}
		
		fclose($file);
	}

    // SKRACANIE
    // SKRACANIE
    // SKRACANIE


    $file = file($loc);
    while(count($file)>15)
    {
        unset($file[0]);
        file_put_contents($loc, $file);     
        $file = file($loc);
    }

    //      SAFETY
    //      SAFETY
    //      SAFETY

    $safetypath='safety/gamejam/'.$room.'.txt';
    $istnieje=true;
    if (!file_exists($safetypath))
        $istnieje=false;

	if($file=fopen($safetypath,'a'))
	{
        if($istnieje==false)
           fwrite($file, "UWAGA, odtwarzasz kopię zapasową z dnia ".date_default_timezone_get()." pokoju ". $room  ."Pamiętaj o zasadach prywatnośći, oraz RODO. Safety zostało utworzone w celu monitorowania nękania, hejtu i łamaniu prawa. Nie ma na celu nikogo szpiegować. \n Jesteś na początku chatu! \n");
        
        
		fwrite($file, "<b>".$nick.": </b>".$mess."\n");
                
		if($mess=="!los")
		{
			fwrite($file, "<b>BOT: </b>".$odp."\n");
		}
		
		fclose($file);
	}


?>
<script>
//window.location.replace("chat.php?room=<?php echo($room); ?>");
</script>