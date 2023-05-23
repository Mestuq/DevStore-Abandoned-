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
        
        

        


if(isset($_POST['nam']))
{
    $next="";
    $nam=$_POST['nam'];

    if(file_exists("topic/".$nam))
    {
        echo("Niestety nazwa jest już zajęta!");
        exit();
    }
    
    
    $iloscbaz=0;
    foreach (glob("topic/*!") as $filename) 
    {
        $nme=basename (substr($filename, 0, -1));
        if(file_get_contents($filename)==$nick)
        {
            $iloscbaz++;
            if($iloscbaz>=3)
            {
                echo("Możesz utworzyć jedynie 3 bazy tematów. Usuń niepotrzebną aby utworzyć nową!");
                exit();
            }
        }
    }
    
    
    if($file=fopen("topic/".$nam."!",'a'))
    {
        fwrite($file, $nick);
        fclose($file);
    }
    if($file=fopen("topic/".$nam,'a'))
    {
        fwrite($file, "");
        fclose($file);
    }
    $next="topicdatabase.php?table=".$nam;
}else 
    
    
    
    
    
    
    
if(isset($_POST['remov']))
{
    $next="topictable.php";
    $nam=$_POST['remov'];
    
    if(file_exists("topic/".$nam)==false)
    {
        echo("BAZA NIE ISTNIEJE");
        exit();
    }
    
    $pathh="permission/".$nick;
    if(file_get_contents("topic/".$nam."!")==$nick||file_exists($pathh."_topic"))
    {
        unlink("topic/".$nam."!");
        unlink("topic/".$nam);
    }else
    {
        echo("Nie posiadasz do tego uprawnień!");
        exit();
    }

    
}


?>
<script>
window.location.replace("<?php echo($next); ?>");
</script>