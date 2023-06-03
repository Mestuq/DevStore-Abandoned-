<?php
$ids=$_GET['id'];
$content=file_get_contents ("downloadstore/".$ids.".json");

 if(file_exists("downloadstore/".$ids.".json")==false)
     exit();


$array = json_decode($content, true);
if($array[0]['public']==0)
    echo($content);
?>