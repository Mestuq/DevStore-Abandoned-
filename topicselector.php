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
		
    </head>
    <body class="win whitepink centPoz centPio under">
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
			//$roomname=trim(preg_replace('/\s+/', ' ',$roomname));//dziura w zabezpieczeniach
		

        
        
			//if($file=fopen('gamejams/chat/'.$roomname.'.txt','a'))
			//{
				//$content = file_get_contents('topic.txt');
				//fwrite($file, "<b>Do chatu dołączył ".$nick."!</b>\n");
			//	fclose($file);
			//}
		
		?>
		<h3 id="przh">Lista tematów, skreśl jedną pozycje!<br /></h3>
		<span id="dec"></span><br />
		<div id="prz">
			<input type="text" name="room"  value="<?php echo($roomname); ?>" style="display: none;"><br />

			<?php
            if(file_exists('gamejams/'.$roomname.'.txt'))
				if($file=fopen('gamejams/'.$roomname.'.txt','r'))
				{
					while(!feof($file))
					{
						$line=fgets($file);
						if($line!="")
						{
							$line=trim(preg_replace('/\s+/', ' ',$line));
							
							echo("<button class='remi' name='topic' onclick=\"chan('".$line."');\">".$line."</button> \n");
							echo('<br />');	
						}
					}
					fclose($file);
				}
				
			?>
		</div >
		<br /><h5>Tematem GameJamu jest:</h5>
		<h1><span id="fle">
		</span></h1>
		<br /><br />
		<div class="pink" style="color:#fff0f2;">
			<br />
			<div id="ucz" class="user">
			</div>
			<div id="maksi">
			</div>

			<br />
		</div>
		<script>
		
			function chan(lin)
			{
				<?php
					echo("var roomname='".$roomname."';");
				?>		
				var urll="topicselect.php?room="+roomname+"&topic="+lin;
						
				//iframe.src = "send.php?room="+roomname+"&message="+inpu.value;	
						
				$.ajax({                                      
				url: urll,       
				type: "POST"
				})
				uczest();
			}
			var ref=true;
			
			$(function()
			{
				setInterval(reload, 4000);
			});

			function reload()
			{
				if(ref==true)
					uczest();
			}
			
		
			function loadFile(filePath) {
			  var result = null;
			  var xmlhttp = new XMLHttpRequest();
			  xmlhttp.open("GET", filePath, false);
			  xmlhttp.send();
			  if (xmlhttp.status==200) {
				result = xmlhttp.responseText;
			  }
			  return result;
			}
			
			function calculate()
			{
				var roomname="<?php echo($roomname); ?>";
				var file=loadFile("showtopics.php?room="+roomname);
				return file;
				//document.getElementById("fle").innerHTML=file;
			}
					
			function finalize()
			{
				var tname=true;
				var act="";
				
				var arr=new Array();
				<?php
					$max=0;
					
					if($file=fopen('gamejams/'.$roomname.'.txt','r'))
					{
						while(!feof($file))
						{
							$line=fgets($file);
							if($line!="")
							{
								$line=trim(preg_replace('/\s+/', ' ',$line));
								echo("arr[".$max."]='".$line."';");
								$max++;
							}
						}
						fclose($file);
					}
					echo("var maxi=".$max.";");
					echo("var ran=");
					if($file=fopen('gamejams/rand/'.$roomname.'.txt','r'))
					{
						while(!feof($file))
						{
							$line=fgets($file);
							if($line!="")
							{
								$line=trim(preg_replace('/\s+/', ' ',$line));
								echo($line.";");
							}
						}
						fclose($file);
					}
					
				?>
				
				var loo=0;
				var fin=false;
				
				
				while(ran>=maxi)
					ran=(ran-(maxi-1))+1;		
				ran++;
				while(true)
				{

					
					if(loo==maxi)
					{
						//alert("Wszystkie tematy zostały wykreślone!");
						document.getElementById("fle").innerHTML="Wszystkie tematy wykreślone!";
						return;
					}
					if(topicIsSelected(arr[ran-1])==true)
					{
						//alert("temat zajęty: "+arr[ran] );
						ran++;
						loo++;
						
						//if(ran==maxi)
						//	ran=1;
						if(ran>=maxi)
							ran=(ran-(maxi));		
						
					}
					else
					{
						ran-=1;
						//alert("Tematem gamejamu jest: "+arr[ran]);
						document.getElementById("fle").innerHTML="nr. "+(ran+1)+" "+arr[ran];
						return arr[ran];
					}
					

				}

				
			}
			function userinfo()
			{
				var username="<?php echo($nick) ?>";
				var last=findlast(username);
				var tex="";
				if(last=="")
					tex="Nie wybrałeś jeszcze żadnego tematu do wykluczenia! Wybierz jeden z poniższych:";
				else 
					tex="Wykluczyłeś <b>"+last+"</b>, ale jeszcze możesz zmienić zdanie:"
				
				document.getElementById('dec').innerHTML=tex;
			}
			
			//finalize();
			function findlast(nam)
			{
				var tname=true;
				var act="";
				var user="";
				
				var topic="";
				var src=calculate();
				
				//alert(src);
				
				for(var j=0;j<src.length;j++)
				{
					//alert("porównanie: "+src[j]);
					if(src[j]=='$')
					{
						if(tname==true)
							user=act;
						if(tname==false)
							if(nam==user)
								topic=act;
							
						
						
						tname=!tname;
						act="";
					}else
					{
						act+=src[j];
					}
					
					
					
				}
				topic=topic.trim();
				return topic;
			}

			function topicIsSelected(remov)
			{
				var tname=true;
				var act="";
				var user="";
				var src=calculate();
				
				
				for(var i=0;i<src.length;i++)
				{
					if(src[i]=='$')
					{
						if(tname==true)
							if(findlast(act)==remov)
								return true;
							
						tname=!tname;
						act="";
						
					}else
					{
						act+=src[i];
					}
				}
				return false;
			}
			uczest();
			function uczest()
			{
				var roomname="<?php echo($roomname); ?>";
				var end=parseInt(loadFile("showend.php?room="+roomname));
				
				document.getElementById('ucz').innerHTML="";
				document.getElementById('maksi').innerHTML="Wylosować musi "+end+ " użytkowników!";
				
				var tname=true;
				var act="";
				var user="";
				var uczest=0;
				
				var topic="";
				var src=calculate();
				
				//alert(src);
				
				for(var j=0;j<src.length;j++)
				{
					//alert("porównanie: "+src[j]);
					if(src[j]=='$')
					{
						if(tname==true)
							user=act;
						if(tname==false)
							topic=act;
							
						if(been(src,j-1,user)==false)
						{
							document.getElementById('ucz').innerHTML+="<img src='users/default.png' style='width:48px;height:48px;'>&nbsp &nbsp<b>"+user+"</b><br />";
							uczest++;
						}
						
						tname=!tname;
						act="";
					}else
					{
						act+=src[j];
					}
					
					
					
				}
				if(uczest==end)
				{
					finalize();
					document.getElementById('prz').innerHTML="";
					document.getElementById('przh').innerHTML="Wszyscy wykluczyli temat : ";
					ref=false;
					
				}else
				{
					userinfo();
				}
				document.getElementById('ucz').innerHTML+="<b>Bierze udział : "+uczest+" użytkowników</b><br />";
				
				//topic=topic.trim();
				//return topic;
			}
			function been(src,maks,nic)
			{
				if(maks<=0)
					return false;
				var tname=true;
				var act="";
				var user="";
				var topic="";
				
				//alert(src);
				
				for(var j=0;j<maks ;j++)
				{
					//alert("porównanie: "+src[j]);
					if(src[j]=='$')
					{
						if(tname==true)
							user=act;
						if(tname==false)
							topic=act;
							
						if(user==nic)
							return true;
						
						tname=!tname;
						act="";
					}else
					{
						act+=src[j];
					}
					
				}
				return false;
			}			
			
		</script>	
		
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>
</html>