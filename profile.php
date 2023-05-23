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
        $stmt = $db->prepare("SELECT * FROM tbl_users WHERE user_id=:uid");
		$stmt->execute(array(":uid"=>$_SESSION['user_session']));
		$row=$stmt->fetch(PDO::FETCH_ASSOC);
        
        
        $nick=$row['user_name'];
        
        
        $username=$_GET['username'];
        
		?>
	
    </head>
    <body class="win pink centPoz under">
        
        
		<br />
		<div class="logi whitepink centPio">
			<br />
			<h4><b>Dane użytkownika</b></h4>
            
			<br />
            
        

            <div class="upr lobbylist">
            
			<?php
            
            function napisz($a)
            {
                if($a==true)
                    return "<img src='src/check.png'>";
                else
                    return "";

            }
                
                //AVATAR
                echo("<img id='av' src='users/default.png'>");
                
                
            
            //echo($_SERVER['REQUEST_URI']);
				if($nick==$username)
                    echo("<h3>to TWOJE konto</h3><br />");
                else
                    echo("<h3>Konto: ".$username."<br />");
				
            
            $uprchanger=file_exists("permission/".$nick."_perm");
                
                
            $pathh="permission/".$username;
            
            echo("<h2>Uprawnienia:</h2>");
                
                
            if($uprchanger)
                echo("<a href='perm.php?user=".$username."&perm=mod'><button>Zmień</button></a>");
            $_mod=$_act=file_exists($pathh."_mod");
            echo("Moderator: ".napisz($_mod)."<br />");
            
            if($uprchanger)
                echo("<a href='perm.php?user=".$username."&perm=ban'><button>Zmień</button></a>");
            $_ban=$_act=file_exists($pathh."_ban");
            echo("Konto zbanowane: ".napisz($_ban)."<br />");
            
            if($uprchanger)
                echo("<a href='perm.php?user=".$username."&perm=perm'><button>Zmień</button></a>");
            $_perm=$_act=file_exists($pathh."_perm");
            echo("Zmiana uprawnień: ".napisz($_perm)."<br />");
            
            if($uprchanger)
                echo("<a href='perm.php?user=".$username."&perm=topic'><button>Zmień</button></a>");
            $_topic=$_act=file_exists($pathh."_topic");
            echo("Edytowanie tematów: ".napisz($_topic)."<br />");
                
            if($uprchanger)
                echo("<a href='perm.php?user=".$username."&perm=lobby'><button>Zmień</button></a>");
            $_lobby=$_act=file_exists($pathh."_lobby");
            echo("Tworzenie lobby: ".napisz($_lobby)."<br />");
            
            if($uprchanger)
                echo("<a href='perm.php?user=".$username."&perm=join'><button>Zmień</button></a>");
            $_join=$_act=file_exists($pathh."_join");
            echo("Branie udziału: ".napisz(!$_join)."<br />");
            
            if($uprchanger)
                echo("<a href='perm.php?user=".$username."&perm=chat'><button>Zmień</button></a>");
            $_chat=$_act=file_exists($pathh."_chat");
            echo("Pisanie na chacie: ".napisz(!$_chat)."<br />");
          
            if($uprchanger)
                echo("<a href='perm.php?user=".$username."&perm=file'><button>Zmień</button></a>");
            $_file=$_act=file_exists($pathh."_file");
            echo("Wysyłanie plików: ".napisz($_file)."<br />");
                
			?>
            </div>
            
			<br />

		</div>
		
        <br />
		
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>
</html>