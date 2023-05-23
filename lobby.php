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
        <link href="https://fonts.googleapis.com/css?family=Titillium+Web&display=swap" rel="stylesheet">
        <!-- STYLE -->
        <link rel="Stylesheet" type="text/css" href="animate.css" />
        <link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" type="text/css" href="button.css">

		<?php
		session_start();
		if(!isset($_SESSION['user_session']))
		{
			echo("<script>window.location.replace('login.php');</script>");
			exit();
		}
		include_once 'login/dbconfig.php';

		?>
		
		
    </head>
    <body class="win pink centPoz under">

		<br />
		
        <div class="logi whitepink centPio" id="welcome">
            <br /><h3>Witaj w Lobby!</h3>
            <button class='myButton' onclick="aktywny();">Mam aktywne zaproszenie</button><br />
            LUB<br />
            <button class='myButton' onclick="nowy();">Utwórz nowy pokój!</button><br /><br />
        </div>
        
        
        
		<div class="logi whitepink centPio" style="display:none;" id="nowy">
			<br /><b>Utwórz nowy pokój:</b><br />
			<form action="rando.php" method="post">
			
				<input class="css-input" autocomplete="off" placeholder="Nazwa" type="text" name="namefile"><br />
				<input class="css-input" autocomplete="off" placeholder="Liczba tematów" type="number" name="countw"><br />
				<input class="css-input" autocomplete="off" placeholder="Liczba uczestników" type="number" name="uczestnicy"><br /> 
                
                <input list="tematy" class="css-input" autocomplete="off" placeholder="Baza tematów" name="dbtopic">
                <datalist id="tematy">
                    <?php
                        foreach (glob("topic/*!") as $filename) 
                        {
                            $nme=basename (substr($filename, 0, -1));
                            echo("<option value='".$nme."'>");
                        }
                    ?>
                </datalist><br />
                
                <div style="text-align:center;">
                    <div class="pub">
                        <label class="control control-checkbox">
                            Prywatny?
                            <input type="checkbox" name="private"/>
                            <div class="control_indicator"></div>
                        </label>
                    </div>
                </div>
                
				<input class='myButton' value="Stwórz pokój" autocomplete="off" type="submit" >
				
			</form>
			<br /><br />
		
		</div>
        
        <div class="logi whitepink centPio" style="display:none;" id="zaproszenie">
            <br /><h4>Wprowadź tutaj kod zaproszenia:</h4>
            <input class="css-input" style="width:350px;" autocomplete="off" placeholder="Klucz" type="text" id="key" name="key">
            <input class='myButton' autocomplete="off" value="Dalej" onclick="zapro()" type="submit" ><br /><br />
            <script>
                function zapro()
                {

                    window.location="invite.php?v="+document.getElementById("key").value;
                }
            </script>
            
        </div>
        
        
        <script>
            function aktywny()
            {
                document.getElementById("welcome").style.display = "none";
                document.getElementById("zaproszenie").style.display = "block";
            }
            function nowy()
            {
                document.getElementById("welcome").style.display = "none";
                document.getElementById("nowy").style.display = "block";
            }
        </script>
		
		<br />
		<div class="logi whitepink centPio ">
			<br />
			<b>Dołącz do istniejącego pokoju:</b><br />
			<div class="lobbylist">
				
				<?php
					//LOBBY
					$nofirst=false;
					if($file=fopen('lobby.txt','r'))
					{
						while(!feof($file))
						{
							$line=fgets($file);
							if($line!="")
							{
								if($nofirst)
								{
									$line=trim(preg_replace('/\s+/', ' ',$line));
									//echo("<form action='changetopic.php' method='post' class='rem'>");
									//echo("<input type='submit' name='gameromov' value='".(string)$line."'>");
									//echo("</form> &nbsp");
									
									$abc="<button class='myButton' style='font-size: 13px;' onclick=\"window.location.replace('join.php?room=";
									echo($abc);
									echo($line);
									echo("');\">");
									echo("Dołącz");
									echo("</button>&nbsp&nbsp");
									//echo("<input type='submit' name='room' value='".(string)$line."'>");
									echo($line);
									echo('<br />');							
								}
									
								$nofirst=true;
							}
							}
						fclose($file);
					}
				?>
				<br />
			</div>
		</div>

		<br />
		
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>
</html>