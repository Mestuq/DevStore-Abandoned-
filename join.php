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
		<link rel="stylesheet" type="text/css" href="button.css">
        <!-- JAVASCRIPT -->
        <script src="background.js"></script>
		
		
		<script type='text/javascript' src='info.php'></script>
    </head>
    <body class="win pink centPoz under">
		<br />
		
		<?php 
			session_start();
			if(!isset($_SESSION['user_session']))
			{
				exit();
			}
			include_once 'login/dbconfig.php';

			$stmt = $db->prepare("SELECT * FROM tbl_users WHERE user_id=:uid");
			$stmt->execute(array(":uid"=>$_SESSION['user_session']));
			$row=$stmt->fetch(PDO::FETCH_ASSOC);

			$nick=$row['user_name'];
			$roomname=$_GET['room'];
			$roomname=trim(preg_replace('/\s+/', ' ',$roomname));//dziura w zabezpieczeniach
        
        
            $upr=file_exists("permission/".$nick."_join");
            if($upr==true)
            {
                echo("Nie masz uprawnień do dołączania do tego lobby!");
                exit();
            }
        
		?>		
		
		<div class="centPio">
            

			<div class="logi whitepink centPio inline">
				<br />
				<h2>Chat</h2>
					<div id="chatt" class="lobbylist chatt">
                        <div style="text-align: center;"><h4>Czekaj trwa wczytywanie chatu...</h4></div>
					</div>
				
				
				    <?php
                        $uprsend=file_exists("permission/".$nick."_chat");
                        if(!$uprsend)
                        {
                            echo("<input type='text' maxlength='200' autocomplete='off' class='css-input' name='message' style='float:left;margin-left:5%;width:65%;' id='tekst'>");
					        echo("<button class='myButton' onclick='wyslij()' id='wyslijj' style='width:25%;transform: translate(0, -20%)'>Wyślij!</button>");
                        }else
                        {
                            echo("<h2 class='myButton'>Nie możesz pisać na tym chacie!</h2>");
                        }
                    ?>
					
				<br />
				<h4>Emotki:</h4>
				<div id="emotki">
					<img src="emo/active.png" class="emo" onclick="inputadd(':active:');"> 
					<img src="emo/adam.png" class="emo" onclick="inputadd(':adam:');"> 
					<img src="emo/chleb.png" class="emo" onclick="inputadd(':chleb:');"> 
					<img src="emo/chopin.png" class="emo" onclick="inputadd(':chopin:');"> 
					<img src="emo/counter.png" class="emo" onclick="inputadd(':counter:');"> 
					<img src="emo/julek.png" class="emo" onclick="inputadd(':julek:');"> 
					<img src="emo/kappa.png" class="emo" onclick="inputadd(':kappa:');"> 
					<br />
					<img src="emo/kasztany.png" class="emo" onclick="inputadd(':kasztany:');"> 
					<img src="emo/pepe.png" class="emo" onclick="inputadd(':pepe:');"> 
					<img src="emo/pirat.png" class="emo" onclick="inputadd(':pirat:');"> 
					<img src="emo/slaz.png" class="emo" onclick="inputadd(':slaz:');"> 
					<img src="emo/trap.png" class="emo" onclick="inputadd(':trap:');"> 
					<img src="emo/wrr.png" class="emo" onclick="inputadd(':wrr:');"> 
					<img src="emo/wystraszony.png" class="emo" onclick="inputadd(':wystraszony:');"> 
				</div>
				<h4>Polecenia BOT'a:</h4>
				<b>!los</b> - <i>odpowiada na twoje pytanie (TAK lub NIE)</i><br />
				<b>!cls</b> - <i>czyści cały chat!</i><br />
				<b>wkrótce będzie tego więcej!</b><br /><br />
                
                
                
				<script>
					function inputadd(txt)
					{
						document.getElementById("tekst").value += txt;
					}
					
					
					
			
					
					$(function()
					{						
						$(document).keypress(function (e) {
							if (e.which == 13) {
								wyslij();
							}
						});						
						setInterval(chatreload, 2000);
					})					
					elem.scrollTop = elem.scrollHeight;
					chatreload();
                    
					function chatreload()
					{
                        
                        var bott=false;
						var elem = document.getElementById('chatt');
						
						if (elem.scrollTop+20 >= (elem.scrollHeight - elem.offsetHeight)) {
							bott=true;
							
						}	
                        
                        
                       
                          var xhttp = new XMLHttpRequest();
  
                          xhttp.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                                document.getElementById("chatt").innerHTML = this.responseText;
                                elem.scrollTop = elem.scrollHeight+200;
                            }
                          };
                          xhttp.open("GET", "chat.php?room=<?php echo($roomname);?>", true);
                          xhttp.send();
                        
                        
                        
					
						if(bott==true)
						{
							elem.scrollTop = elem.scrollHeight+200;
						}

						
			
					}
					
					

				

					function wyslij()
					{
						<?php
							echo("var roomname='".$roomname."';");
						?>		
						
						//var iframe = document.getElementById("myFrame");
						var inpu = document.getElementById("tekst");
						
						var urll="send.php?room="+roomname+"&message="+inpu.value;
						
						//iframe.src = "send.php?room="+roomname+"&message="+inpu.value;	
						
						$.ajax({                                      
						url: urll,       
						type: "POST"
						})
						
						
						inpu.value="";						
						//document.getElementById("chatt").innerHTML+=loadFile("send.php?room="+roomname+"&message="+inpu.value);
						chatreload();
					}

				</script>
			</div>

			<div class="logi whitepink centPio inline" style="height:780px;width:500px;transform: translate(0, 7px)">
				<iframe id="myFrame" src="topicselector.php?room=<?php echo($roomname); ?>" style="margin:5%;height:600px;width:450px;"></iframe>
			</div>
			

		</div>
		
		<br />
		<div class="logi whitepink centPio" style="width:80%;">		
		
		<?php
			echo("<br />Bierzesz udział w GameJam jako: <b>".$nick."</b>"."<br />");
			echo("Nazwa GameJamu to: <b>".$roomname."</b><br />");
		
		    $loc='gamejams/chat/'.$roomname.'.txt';
            
            
            if(file_exists($loc)==true)
            {
                if($file=fopen($loc,'a'))
                {
                    //$content = file_get_contents('topic.txt');
                    fwrite($file, "<b>Do chatu dołączył ".$nick."!</b>\n");
                    fclose($file);
                }               
            }
			echo("<br /><b>Klucz zaproszenia:</b> <i>");
            


            
			echo($roomname."</i> <br />");
		
		?>
		
			
			<form action="lobby.php" style="float:left;">
				&nbsp <input type='submit' class='myButton' style="font-size:13px;" value="Wróć do Lobby">
			</form>
			
			
			<?php 
				echo("<form action='changetopic.php' style='float:right;margin-right:10px;' method='post' class='rem'><b>Usuń pokój</b>&nbsp&nbsp");
				echo("<input type='submit'name='gameromov' value='".$roomname."'>");
				echo("</form> &nbsp &nbsp"); 			
			?>
			<br /><br /><br />
		</div>		
		<br /><br /><br />
		
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>
</html>