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
        
        $uprchanger=file_exists("permission/".$nick."_perm");
        if($uprchanger==false)
        {
            echo("NIE MASZ UPRAWNIEŃ DO ZMIANY UPRAWNIEŃ");
            exit();
        }

        
        $username=$_GET['user'];
        $perm=$_GET['perm'];

        $pathh="permission/".$username."_".$perm;

        if(file_exists($pathh))
        {
            unlink($pathh);
        }else
        {
            $myfile = fopen($pathh, "w");
        }
            
        
		?>
<script>
window.location.replace("profile.php?username=<?php echo($username); ?>");
</script>