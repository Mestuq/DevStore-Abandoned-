<?php

if(isset($_GET["v"]))
{
    $text = $_GET["v"]; 

    $text_new=$text;
    $text_new = str_replace("/","", $text_new);
    $text_new = str_replace("\\","", $text_new);
    $text_new = str_replace(".","", $text_new);
    if($text!=$text_new)
    {
        echo("Zły kod zaproszenia!");
        exit();
    }
    
    
    if(file_exists("gamejams/".$text.".txt"))
    {
        header('Location: '."join.php?room=".$text_new);

    }else
    {
        echo("Zaproszenie już wygasło");
    }
}


?>