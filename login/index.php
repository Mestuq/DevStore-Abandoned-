<?php

session_start();

if(isset($_SESSION['user_session'])!="")
{
	header("Location: ../lobby.php");
}

?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../style.css">
		<link rel="stylesheet" type="text/css" href="../button.css">
		
        <script type='text/javascript' src='vari.js'></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        
        <title>Login Form</title>
        <link href="https://fonts.googleapis.com/css?family=Titillium+Web&display=swap" rel="stylesheet">
    <script>
        function noerror(){
            document.getElementById("error").innerHTML=" ";
        }
    </script>
        
    </head>
	

	
	
    <body class="win pink centPoz">

        <div class="logi whitepink centPio">
		

			
            <div>
			
				<form action="../login.php" style="text-align:left;">
					<input type='submit' value="Cofnij" class="myButton">
				</form>

               <form method="post" id="login-form">

                <h2>Zaloguj się!</h2>

                <div id="error" class="erlebel">
                <!-- error will be shown here ! -->
                </div>

                <div>
                    <input type="email" class="css-input" placeholder="Adres E-mail" name="user_email" id="user_email" onclick="noerror()" />
                    <span id="check-e"></span>
                </div>

                <div>
                    <input type="password" class="css-input" placeholder="Hasło" name="password" id="password" onclick="noerror()" />
                </div>


                <div>
                    <button type="submit" class="myButton" name="btn-login" id="btn-login">
                        Zaloguj się!
                    </button> 
                </div>  

              </form>

            </div>

        </div>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://use.fontawesome.com/ee309940e2.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script type="text/javascript" src="validation.min.js"></script>
        <script type="text/javascript" src="script.js"></script>

    </body>
</html>