<?php
	require('connect.php');
	
	if(!isset($_SESSION['privilege']) || $_SESSION['privilege'] != 1)
	{
		header("Location: index.php");
		exit;
	}
	
	if(isset($_GET['comment']))
	{
		$comment_id = filter_input(INPUT_GET, 'comment', FILTER_SANITIZE_NUMBER_INT);
		
		$name_query = "SELECT planet_name FROM comments WHERE comment_id = :comment_id";
		
		$name_statement = $db->prepare($name_query);
		
		$name_statement->bindValue(':comment_id', $comment_id);
		
		$name_statement->execute();
		
		$row = $name_statement->fetch();
		$name = $row['planet_name'];
		
		$query = "DELETE FROM comments WHERE comment_id = :comment_id";
		
		$statement = $db->prepare($query);
		
		$statement->bindValue(':comment_id', $comment_id);
		
		if($statement->execute())
		{
			header("Location: planet.php?name={$name}");
			exit;
		}
	}
?>