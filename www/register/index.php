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
        <meta charset="UTF-8">
        <title>Registration Form using jQuery Ajax and PHP MySQL</title>

        <!--This is a CDN link to the jQuery Library-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!--This is a link to a jQuery script to validate form data-->
        <script type="text/javascript" src="validation.min.js"></script>
        <!--This is a CDN link to bootstrap 4 JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
        <!--This is a CDN link to bootstrap 4 JS-->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
        <!--This is a link to custom styles within the project-->

		<link rel="stylesheet" type="text/css" href="../style.css">
		<link rel="stylesheet" type="text/css" href="../button.css">

        <!--This is a link to the custom JavaScript within the project-->
        <script type="text/javascript" src="script.js"></script>
        <script src="https://use.fontawesome.com/ee309940e2.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Titillium+Web&display=swap" rel="stylesheet">
        <script>
            function noerror(){
                document.getElementById("error").innerHTML=" ";
            }
        </script>
        
    </head>

    <body class="win pink centPoz">
	

	
        <div class="logi whitepink centPio">
			<form action="../login.php">
				<input class="myButton" type='submit' value="Cofnij">
			</form>
            <div >
               <form method="post" id="register-form">
                <h2 >Zarejestruj się!</h2>
				
                <div id="error" class="erlebel">
                <!-- error will be showen here ! -->
                </div>

                <div >
                    <input type="text" class="css-input"  placeholder="Login" name="user_name" id="user_name" onclick="noerror()"/>
                </div>

                <div >
                    <input type="email" class="css-input" placeholder="Adres E-mail" name="user_email" id="user_email" onclick="noerror()"/>
                    <span id="check-e"></span>
                </div>

                <div >
					<input type="password" class="css-input" placeholder="Hasło" name="password" id="password" onclick="noerror()"/>
                </div>

                <div>
					<input type="password" class="css-input" placeholder="Powtórz hasło" name="cpassword" id="cpassword" onclick="noerror()"/>
                </div>

                <div>
                    <button type="submit" class="myButton"  name="btn-save" id="btn-submit">
                        Załóż konto!
                    </button> 
                </div>  

              </form>

            </div>

        </div>

    </body>
</html>