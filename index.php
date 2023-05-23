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
		<link href="https://fonts.googleapis.com/css?family=Russo+One&display=swap" rel="stylesheet">
        <!-- STYLE -->
        <link rel="Stylesheet" type="text/css" href="animate.css" />
        <link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" type="text/css" href="button.css">
        <!-- JAVASCRIPT -->
        <script src="background.js"></script>
		
		
		<script type='text/javascript' src='info.php'></script>
    </head>
    <body class="whitepink">
		<!--<iframe class="barwindow" src="bar.php" frameBorder="0"></iframe>-->
		<div class="barwindow whitepink">
			&nbsp 
			<span class="logo">
			
				<img src="src/jamlogo.png">&nbsp
				DEVSTORE
				
			</span> 
			&nbsp
		
			<span id="menus" style="display: none;">
				<span class="menu" onclick="aktualnosci()">Aktualności</span>
				<span class="menu" onclick="lobby()">Lobby</span>
				<span class="menu" onclick="tematy()">Tematy</span>
				<span class="menu" onclick="uzytkownicy()">Użytkownicy</span>
                <span class="menu" onclick="pobrania()">Do pobrania</span>
                <span class="menu" onclick="public()">#public</span>
			</span>
			<span class="hello">
				<b>
				<span id="here" style="color:#f54260;"></span>&nbsp
				<!--<form action='login/logout.php' id="logout" style="display:none;" method='post'>
					<input type='submit' class='myButton' value='Wyloguj'>
				</form>-->
						<button class='myButton' id="wylo" onclick="logout()">Wyloguj</button>
				&nbsp &nbsp
                    
			</span>
		</div>
		
		
		<iframe class="win" src="login.php" id="page" frameBorder="0"></iframe>
		
		<script>
		function aktualnosci()
		{
			document.getElementById('page').src = "news.php";
		}
		function lobby()
		{
			document.getElementById('page').src = "lobby.php";
		}
		function tematy()
		{
			document.getElementById('page').src = "topictable.php";
		}
		function uzytkownicy()
		{
			document.getElementById('page').src = "users.php";
		}
		function logout()
		{
			document.getElementById('page').src = "login/logout.php";
		}	
        function pobrania()
		{
			document.getElementById('page').src = "downloadstore.php";
		}
        function public()
        {
            document.getElementById('page').src = "publicchat.php";  
        }
        
		</script>
		
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>
</html>