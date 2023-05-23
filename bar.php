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
        <!-- JAVASCRIPT -->
        <script src="background.js"></script>
		
		
		<script type='text/javascript' src='info.php'></script>
		
	</head>
	<body class="barwindow whitepink">
		<?php
		session_start();

		include_once 'login/dbconfig.php';

		?>
	
	
		Witaj <b>
		<?php 
			$stmt = $db->prepare("SELECT * FROM tbl_users WHERE user_id=:uid");
			$stmt->execute(array(":uid"=>$_SESSION['user_session']));
			$row=$stmt->fetch(PDO::FETCH_ASSOC);

			$nick=$row['user_name'];
			echo($nick);
		?>
		
		</b>! Zapraszamy Ciebie na GameJam!
		
        <form action="login/logout.php" method="post">
			<input type="submit" value="Wyloguj">
		</form>
	
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

	</body>
</html>