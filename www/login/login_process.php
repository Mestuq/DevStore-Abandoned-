<?php
	session_start();
	require_once 'dbconfig.php';

	if(isset($_POST['btn-login']))
	{
		//$user_name = $_POST['user_name'];
		$user_email = trim($_POST['user_email']);
		$user_password = trim($_POST['password']);
		
		$password = md5($user_password);
		
		try
		{	
		
			$stmt = $db->prepare("SELECT * FROM tbl_users WHERE user_email=:email");
			$stmt->execute(array(":email"=>$user_email));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$count = $stmt->rowCount();
            
        
			
			if($row['user_password']==$password){
				
                $nick=$row['user_name'];
                
                $pathh="../permission/".$nick;
                if(file_exists($pathh."_ban"))
                {
                    echo "<h2>Konto zbanowane</h2>";
                    
                    
                }else
                {
                    echo "ok"; // log in
				    $_SESSION['user_session'] = $row['user_id'];
                }
                
			}
			else{
				
				echo "email or password does not exist."; // wrong details 
			}
				
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}

?>