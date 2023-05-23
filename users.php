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
		<div class="logi whitepink centPio">
			<br />
			<h4><b>Lista zarejestrowanych użytkowników!</b></h4>
			<br />
			<?php 
				
				if($file=fopen('users/users.txt','r'))
				{
					while(!feof($file))
					{
						$line=fgets($file);
						if($line!="")
						{
							echo("<div class='user'>");
                            
                            
                            
							echo("<img src='users/default.png'><b>&nbsp");
                            
                            echo("<a href='profile.php?username=".$line."'>");
							echo($line);
                            echo("</a>");
                            
							echo("</b></div>");
							//echo('<br />');	
						}

					}
					fclose($file);
				}
			?>
			<br />
		</div>
		
        <br />
		
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>
</html>