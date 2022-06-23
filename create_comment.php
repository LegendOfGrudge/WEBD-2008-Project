<?php
	// Final Project - WEBD-2008 Web Development 2
	// Name: Nicholas Fletcher
	// Date: June 22, 2022
	// Description: Creates a comment associated to a user and a planet page into the mySQL database then redirects back to the planet page.
	// -------------------------------------------------------------------------------------------------------------------------------------

	require('connect.php');
	
	if(!isset($_SESSION['user']))
	{
		header("Location: index.php");
		exit;
	}
	
	if($_POST && isset($_POST['name']) && isset($_POST['user']) && isset($_POST['content']))
	{
		$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$user = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		
		$query = "INSERT INTO comments (planet_name, user, content) VALUES (:planet_name, :user, :content)";
		
		$statement = $db->prepare($query);
		
		$statement->bindValue(':planet_name', $name);
		$statement->bindValue(':user', $user);
		$statement->bindValue(':content', $content);
		
		if($statement->execute())
		{
			header("Location: planet.php?name={$name}");
			exit;
		}
	}
	else
	{
		header("Location: index.php");
		exit;
	}
?>