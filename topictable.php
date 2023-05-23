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
        $stmt = $db->prepare("SELECT * FROM tbl_users WHERE user_id=:uid");
        $stmt->execute(array(":uid"=>$_SESSION['user_session']));
        $row=$stmt->fetch(PDO::FETCH_ASSOC);


        $nick=$row['user_name'];

		?>
		
		
    </head>
    <body class="win pink centPoz under">
		<br />
		<div class="logi whitepink centPio">
			<br />
            
            
			<h4><b>Bazy tematów:</b></h4><br />
            
            
			<form action="newtable.php" method="post">
                <?php
                    $iloscbaz=0;
                    foreach (glob("topic/*!") as $filename) 
                    {
                        $nme=basename (substr($filename, 0, -1));
                        if(file_get_contents($filename)==$nick)
                        {
                            $iloscbaz++;
                        }
                    }                
                
                    if($iloscbaz<3)
				        echo("<input type='text' autocomplete='off' class='css-input' name='nam'>&nbsp");

                    echo("<span class='liczbabaz'>".$iloscbaz."/3</span>&nbsp");
                
                    if($iloscbaz>=3)
                        echo("<br />Wykorzystałeś wszystkie bazy tematów. Usuń jedną, by dodać nową.");
                    if($iloscbaz<3)
                        echo("<input type='submit' class='myButton' value='Nowa baza'>");
                    
                ?>
                
                
				
			</form>
            <br />
            <br />
        </div>
        
        <br />
        
        <div class="logi whitepink centPio">
            
			<br />
            
            
			<div >
				
				<?php
					//LISTA BAZ
                 
                    
                    foreach (glob("topic/*!") as $filename) 
                    {

                        $nme=basename (substr($filename, 0, -1));
                        echo("<a href='topicdatabase.php?table=".$nme."'><div class='myButton'>".$nme." by ".file_get_contents($filename)."</div></a><br />");
                    }
                
                    

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