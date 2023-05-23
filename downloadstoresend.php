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


$upr=file_exists("permission/".$nick."_file");
if($upr==false)
{
    echo("Nie masz uprawnień do wysyłania plików!");
    exit();
}

if(isset($_POST['nazwa']))
{
    if(isset($_POST['tagi']))
    {
            if(isset($_POST['opis']))
            {

                if(isset($_POST['link']))
                {
                    echo("Zaczynam <br />");



                    $tagi=$_POST['tagi'];
                    $opis=$_POST['opis'];
                    $link=$_POST['link'];
                    $name=$_POST['nazwa'];


                    if(strlen($tagi)-1>0)
                        if($tagi[strlen($tagi)-1]!="!")
                            $tagi=$tagi."!";

                    $tabela=array();
                    $acttags="";
                    for($i=0;$i<strlen($tagi);$i++)
                    {
                        if($tagi[$i]=="!"&&$acttags!="")
                        {

                            foreach ($tabela as &$value) {
                                if($value==$acttags)
                                {
                                    echo("System bezpieczeństwa wykrył problem. Nieprawidłowa składnia <br />");
                                    exit();
                                }
                            }


                            array_push($tabela,$acttags);
                            $acttags="";
                        }else 
                        {

                            if($tagi[$i]!="!")
                                $acttags=$acttags.$tagi[$i];
                        }
                    }
                    if(count($tabela)==0)
                    {
                        echo("Brak tagów");
                        exit();
                    }

                    echo("sukces <br />");
                    echo($tabela[0]);


                    
                    $opis=str_replace("<"," jest mniejszy od ",$opis);
                    $opis=str_replace(">"," jest większy od ",$opis);
                    $opis=str_replace("&"," and ",$opis);

                    $opis=str_replace(":active:","<img src='emo/active.png'>",$opis);
                    $opis=str_replace(":adam:","<img src='emo/adam.png'>",$opis);
                    $opis=str_replace(":chleb:","<img src='emo/chleb.png'>",$opis);
                    $opis=str_replace(":chopin:","<img src='emo/chopin.png'>",$opis);
                    $opis=str_replace(":counter:","<img src='emo/counter.png'>",$opis);
                    $opis=str_replace(":julek:","<img src='emo/julek.png'>",$opis);
                    $opis=str_replace(":kappa:","<img src='emo/kappa.png'>",$opis);

                    $opis=str_replace(":kasztany:","<img src='emo/kasztany.png'>",$opis);
                    $opis=str_replace(":pepe:","<img src='emo/pepe.png'>",$opis);
                    $opis=str_replace(":pirat:","<img src='emo/pirat.png'>",$opis);
                    $opis=str_replace(":slaz:","<img src='emo/slaz.png'>",$opis);
                    $opis=str_replace(":trap:","<img src='emo/trap.png'>",$opis);
                    $opis=str_replace(":wrr:","<img src='emo/wrr.png'>",$opis);
                    $opis=str_replace(":wystraszony:","<img src='emo/wystraszony.png'>",$opis);

                    $opis=str_replace("\n","<br />",$opis);

                    echo("<br />");
                    
                    $id=-1;
                    $countsrc="downloadstore/count";

                    if(file_exists( $countsrc ))
                    {
                        $id=file_get_contents( $countsrc );
                        $id+=1;
                        file_put_contents($countsrc, $id);
                    }
                    if($id==-1)
                    {
                        echo("System zabezpieczeń wykrył problem");
                        exit();
                    }

                    $priv=0;
                    
                    if(isset($_POST['private']))
                        if($_POST['private']==1)
                            $priv=rand ( 100000 , 999999 );
                    //if($priv==0)
                        //$priv=rand ( 100000 , 999999 );
                        

                    foreach ($tabela as &$value) {
                        $loc="taglist/".$value;
                        
                        if(!file_exists($loc))
                        {
                            $file=fopen($loc, 'a');
                            fwrite($file, "");
                            fclose($file);
                        }
                        
                        file_put_contents($loc, "\n".$id , FILE_APPEND);
                        
                    }
                    
                    $arr_data = array();
                    $formdata = array(
                        'id'=> $id,
                        'public'=> $priv,
                        'name'=> $name,
                        'author'=> $nick,
                        'desc'=> $opis,
                        'lin'=>  $link,
                        'tag'=>  $tagi                 
                    );
                    array_push($arr_data,$formdata);
                    $jsondata = json_encode($arr_data, JSON_PRETTY_PRINT);
                    
                    if(file_put_contents("downloadstore/".$id.".json", $jsondata)) {
                        
                        echo('Dane zostały nadpisane!');
                        
                    }else{
                        echo("Nie można było zapisać pliku!");
                        exit();
                    }




                }else echo("brak linku");
            }else echo("brak opisów");
    }else echo("brak tagów");
}else echo("brak nazwy");
?>
<script>
    window.location.replace("downloadstore.php");
</script>
