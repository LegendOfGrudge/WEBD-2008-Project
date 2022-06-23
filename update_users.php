<?php
	// Final Project - WEBD-2008 Web Development 2
	// Name: Nicholas Fletcher
	// Date: June 22, 2022
	// Description: Updates a users privilege status so they can gain access to admin abilities. Only an admin can assign admin access to others. 
	// ------------------------------------------------------------------------------------------------------------------------------------------

	require('connect.php');
	
	if(!isset($_SESSION['privilege']) || $_SESSION['privilege'] != 1)
	{
		header("Location: index.php");
		exit;
	}
	
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