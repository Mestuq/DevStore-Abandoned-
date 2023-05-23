<?php
//Here is the registration code which takes the username, email, password and date. The code will check in the users table if the user email exists, if it does exist it will display in error using jQuery.	
	require_once 'dbconfig.php';

	if($_POST)
	{
		$user_name = $_POST['user_name'];
		$user_email = $_POST['user_email'];
		$user_password = $_POST['password'];
		$joining_date =date('Y-m-d H:i:s');
		
		$password = md5($user_password);
		
		$user_name_new=$user_name;
		$user_name_new = str_replace("/","", $user_name_new);
		$user_name_new = str_replace("\\","", $user_name_new);
		$user_name_new = str_replace(".","", $user_name_new);
		
		if($user_name!=$user_name_new)
		{
			echo("Login nie może posiadać znaków / \\ i . ");
			exit();
		}
		
		
		
		try
		{	
		
			$stmt = $db->prepare("SELECT * FROM tbl_users WHERE user_email=:email");
            $stmt->execute(array(":email"=>$user_email));
			$count = $stmt->rowCount();
            
            $stmt = $db->prepare("SELECT * FROM tbl_users WHERE user_name=:uname");
            $stmt->execute(array(":uname"=>$user_name));
			$count2 = $stmt->rowCount();
			
			if($count==0 and $count2==0 ){
				
			$stmt = $db->prepare("INSERT INTO tbl_users(user_name,user_email,user_password,joining_date) VALUES(:uname, :email, :pass, :jdate)");
			$stmt->bindParam(":uname",$user_name);
			$stmt->bindParam(":email",$user_email);
			$stmt->bindParam(":pass",$password);
			$stmt->bindParam(":jdate",$joining_date);
					
				if($stmt->execute())
				{
					if($file=fopen('../users/users.txt','a'))
					{
						fwrite($file, $user_name."\n");
						fclose($file);
					}
					echo("<script>");
					echo("window.location.replace('../login/index.php');");
					echo("</script>");
					echo "registered";
				}
				else
				{
					echo "Query could not execute !";
				}
			
			}
			else{
				if($count2!=0)
                    echo "Sorry this name is already taken";
                else if($count!=0)
				    echo "Sorry email already taken"; //  not available
			}
				
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}

?>