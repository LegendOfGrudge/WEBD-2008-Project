<?php 
	require('connect.php');
	
	if($_POST && isset($_POST['user_id']))
	{
		$user_updated_privilege = isset($_POST['privilege']);
		$user_deleted_row = isset($_POST['delete']);
		
		if($user_updated_privilege)
		{
			$privilege = 1;
			$user_id = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_NUMBER_INT);
			
			$query = "UPDATE users SET privilege = :privilege WHERE user_id = :user_id";
			$statement = $db->prepare($query);
			$statement->bindValue(':privilege', $privilege);
			$statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
			
			$statement->execute();
			
			header("Location: users.php");
			exit;
		}
		
		if($user_deleted_row)
		{
			$user_id = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_NUMBER_INT);
			
			$query = "DELETE FROM users WHERE user_id = :user_id";
			$statement = $db->prepare($query);
			$statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
			
			$statement->execute();
			
			header("Location: users.php");
			exit;
		}
	}
?>