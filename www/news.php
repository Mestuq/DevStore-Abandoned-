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

		?>
    </head>
    <body class="win pink centPoz under">

        <br />
		<div class="logi whitepink centPio sied">
			<br />
				<h3>Devstore v1.1</h3><br />
                <div style='text-align:left; margin-left:60px;'>
                    <h3>Oto lista zmian:</h3>
                    <ul class="zmiany">
                        <li><b>Karta profilu</b> dla każdego użytkownika</li>
                        <li><b>System uprawnień</b>, który pomoże utrzymać porządek na stronie</li>
                        <li><b>Nowe listy baz tematów</b></li>
                        <li><b>Znaczna optymalizacja</b></li>
                        <li>Dodano <b>czaty publiczne!</b></li>
                        <li>Wprowadzono <b>GameJamy prywatne</b> (na zaproszenie)</li>
                        <li>Nowa karta, <b>Do pobrania</b> z grami stworzonymi w gamejamach</li>
                        <li>Ulepszony panel administracyjny, dla moderatorów</li>
                        <li>Każda baza tematów posiadana jest teraz na własność...</li>
                        <li>... tak samo jak pokoje GameJamów.</li>
                        <li>Poprawiono zabezpieczenia</li>
                    </ul>
                </div>
                <br />
                Niestety- polepszenie wyglądu strony, modyfikowanie treści swojego profilu w tym własnego avatara pojawi się dopiero w kolejnej aktualizacji. Nie wyrobie się po prostu.

            
                <br />
			
			<br />
		</div>
        
        
        <br />
        <div class="logi whitepink centPio sied">
			<br />
				<h3>GameJam 4!</h3><br />
				<iframe class="film" width="500"  height="345" src="https://www.youtube.com/embed/FsOGM5hP0J4"></iframe>
			
			<br />
		</div>
        
        
		<br />
		<div class="logi whitepink centPio sied">
			<br />
				<h3>GameJam 3!</h3><br />
				<iframe class="film" width="500"  height="345" src="https://www.youtube.com/embed/c3ccjDrgqaQ"></iframe>
			
			<br />
		</div>
        
 		<br />
		<div class="logi whitepink centPio sied">
			<br />
				<h3>Devstore v1.0</h3><br />
				Pierwsza wersja Devstore :D
                <br />
			
			<br />
		</div>
        
        
		<br />
		<div class="logi whitepink centPio sied">
			<br />
				<h3>GameJam 2!</h3><br />
				<iframe class="film" width="500" height="345" src="https://www.youtube.com/embed/iNKeUhVxxwQ"></iframe>
			
			<br />
		</div>
        
        
		<br />
		<div class="logi whitepink centPio sied">
			<br />
				<h3>GameJam 1!</h3><br />
				<iframe class="film" width="500" class="piec" height="345" src="https://www.youtube.com/embed/OmMebqz5Ms8"></iframe>
			
			<br />
		</div>
        
        
		<br /><br /><br />
		
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>
</html>