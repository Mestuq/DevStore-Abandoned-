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
            <div id="crat" class="logi whitepink centPio" <?php 
                                                                $upr=file_exists("permission/".$nick."_file");
                                                                if($upr==false)
                                                                {
                                                                    echo("style='display: none ;'");
                                                                }
                                                            ?>>
                <button class="css-input" onclick="creat()">Dodaj swój plik!</button>
            </div>
        
            <div class="logi whitepink centPio" id="new" style="display:none;">
                <br />
                <h3>Jesteś zalogowany jako <?php echo($nick); ?></h3>
                    Posiadasz prawo do publikowania plików:

                    <form action="downloadstoresend.php" method="post">
                        <br /><br />
                        
                        Widok:
                        <button type="button" onclick="simple();">Prosty</button>
                        <button type="button" onclick="advanced();">Zaawansowany</button>
                        <br />
                        
                        <br />Tytuł pliku:<br />
                        <input id="nazwa" autocomplete="off" class="css-input" placeholder="nazwa" name="nazwa" type="text" ><br />
                        
                        <script>
                            function creat()
                            {
                                document.getElementById("crat").style.display = "none";
                                document.getElementById("new").style.display = "block";
                            }
                            function simple()
                            {
                                document.getElementById("tagss").style.display = "inline";
                                document.getElementById("addtag").style.display = "inline";
                                document.getElementById("taglists").style.display = "block";
                                document.getElementById("emotki").style.display = "block";
                                document.getElementById("tagsns").style.display = "none";
                                document.getElementById("check").style.display = "none";
                            }
                            function advanced()
                            {
                                document.getElementById("tagss").style.display = "none";
                                document.getElementById("addtag").style.display = "none";
                                document.getElementById("taglists").style.display = "none";
                                document.getElementById("emotki").style.display = "none";
                                document.getElementById("tagsns").style.display = "inline";
                                document.getElementById("check").style.display = "block";
                            }
                            
                        </script>
                        
                        
                        Tagi:<br />
                        <input id="tagss" list="tags" class="css-input" autocomplete="off" placeholder="Podaj tagi"> 
                        <button type="button" onclick="add();" id="addtag">Dodaj</button>
                        
                        <div id ="taglists">
                        </div>
                        <div><input id="tagsns" autocomplete="off" class="css-input" placeholder="składnia tagów" name="tagi" type="text" style="display:none; width:400px;"></div>
                        
                        
                        
                        
                        <br />Opis:<br /><textarea name="opis" id="opis" class="ta"></textarea><br />
                        
                        
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
                        <script>
                            function inputadd(txt)
                                {
                                    document.getElementById("opis").value += txt;
                                }
                        </script>
                        
                        
                        

                        Obraz:
                        <h4>Cooming Soon</h4>

                        
                        
                        <br />
                        <div style="text-align:center;display:none;" id="check">
                            <div class="pub">
                                <label class="control control-checkbox">
                                    Prywatny?
                                    <input type="checkbox" name="private"/>
                                    <div class="control_indicator"></div>
                                </label>
                            </div>
                        </div>
                        
                        
                        
                        Link:
                        <br /><input type="text" autocomplete="off" name="link" class="css-input" style="width:400px;" placeholder="wklej tutaj link">
                        <br /><input class='myButton' value="Opublikuj" autocomplete="off" type="submit" >
                    </form>
                
                
                    
                     
                    
                    <script>
                        var tags=[""];
                        
                        function add()
                        {
                            var tag= document.getElementById("tagss").value;
                            document.getElementById("tagss").value="";
                            //if(tag=="")
                            //    return;
                            var b=false;
                            tags.forEach(function(entry) {
                                if(tag==entry)
                                    b=true;
                            });
                            if(b==true)
                                return;
                            
                            document.getElementById("taglists").innerHTML+="<div class='css-input taglist' id='"+tag+"' >"+tag+"</div>";
                            tags.push(tag);    
                            init();
                            
                        }
                        
                        function init()
                        {
                            
                            var tag= document.getElementById("tagsns").value="";
                            tags.forEach(function(entry) {
                                document.getElementById("tagsns").value+=entry+"!";
                            });
                            document.getElementById("tagsns").value+="public";
                        }
                        

                    </script>
                    
                    
                    <datalist id="tags">
                        <?php
                            foreach (glob("taglist/*") as $filename) 
                            {
                                //$nme=basename (substr($filename, 0, -1));
                                if(basename($filename)!="public")
                                    echo("<option value='".basename($filename)."'>");
                            }
                        ?>
                    </datalist>
        
                
                <br />
            </div>
        <br />
        
        
        <div id="info">
            123
        </div>
        
        
    
        <div class="centPio downloadstore" style="width:1000px;">
            <div class="logi whitepink centPio" id="welcome" style="float:left; width:175px;">
                <br />
                    <h3>Lista tagów:</h3> 
                
                        <?php
                            foreach (glob("taglist/*") as $filename) 
                            {
                                echo("<button class='css-input' style='width:80%;' onclick=\"goo("."'".basename($filename)."'"." )\">".basename($filename)."</button><br />");
                            }
                        ?>

                <br />
            </div>
            <div class="logi whitepink centPio" id="store" style="float:right; width:800px;"></div>
        </div>
        <br />

        
        <script>
            $(document).on("click mousemove",".downloadloot",function(e){ 
                var x = e.clientX;
                var y = e.clientY;
                var newposX = x- 175;
                var newposY = y + window.pageYOffset; 
                $("#info").css("transform","translate3d("+newposX+"px,"+newposY+"px,0px)");
                document.getElementById("info").innerHTML=this.children[0].innerHTML;
                
            });
            
            $(document).on("mouseover",".downloadloot",function(e){ 
                jQuery('#info').css({ opacity: 0.9 });
                document.getElementById("info").style.display = "inline";
            });
                        
            $(document).on("mouseout",".downloadloot",function(e){ 
                jQuery('#info').css({ opacity: 0.0 });
                document.getElementById("info").style.display = "none";
            });
            
            function goo(tag)
            {
                window.location.href="downloadstore.php?tag="+tag;
            }
            function download(link)
            {
                var win = window.open(link, '_blank');
            }
            var tag='<?php    
                if(isset($_GET['tag']))
                    echo($_GET['tag']);
                else echo("public");
                ?>';
            
            function styles(arr)
            {
                var act="";
                
                
                act+="<div class='downloadloot' onclick='download(\""+arr[0].lin+"\");'>";
                    act+="<span class='desc' style='display:none'><div class='downloadstorename'>"+arr[0].name+" od: "+arr[0].author+"</div><br />"+arr[0].desc+"<br /><br />Tagi:"+arr[0].tag.replace(/!/g, " - ")+"<br />ID:"+arr[0].id+"</span>";
                
                
                
                    act+="<span class='name shadow'>"+arr[0].name+"<br />od:"+arr[0].author+"</span>";
                    act+="<img src='downloadstore/"+arr[0].id+".jpg' ";
                    act+= "  onerror=\"this.src='downloadstore/not.jpg';\"  "
                    act+=">";
                    
                act+="</div>";
                
                return act;
            }
            
            function additem(ids)
            {
                var xhttp = new XMLHttpRequest();
  
                xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) 
                {
                    if(this.responseText!="")
                    {
                        var arr = JSON.parse(this.responseText);
                        document.getElementById("store").innerHTML += styles(arr);
                        
                    }

                }
                };
                xhttp.open("GET", "downloadstoreGET.php?id="+ids, false);
                xhttp.send();
            }
            function loadtag()
            {
                var xhttp = new XMLHttpRequest();
                
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) 
                    {
                        var txt = this.responseText;
                        
                        var lines = txt.split('\n');
                        
                        for(var i = 0;i < lines.length;i++)
                        {
                            additem(lines[i]);
                        }

                    }
                };
                xhttp.open("GET", "taglist/"+tag, false);
                xhttp.send();
            }
            loadtag();
            
            
        </script>
        
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>
</html>