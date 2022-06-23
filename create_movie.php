<?php
	// Final Project - WEBD-2008 Web Development 2
	// Name: Nicholas Fletcher
	// Date: June 22, 2022
	// Description: Creates a movie category for planets to be linked to and inserts it into the mySQL database.
	// ---------------------------------------------------------------------------------------------------------

	require('connect.php');
	
	if(!isset($_SESSION['user']))
	{
		header("Location: index.php");
		exit;
	}
	
	if($_POST && !empty($_POST['episode']) && !empty($_POST['title']))
	{
		$episode = filter_input(INPUT_POST, 'episode', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		
		$query = "INSERT INTO movies (episode, title) VALUES (:episode, :title)";
		$statement = $db->prepare($query);
		
		$statement->bindValue(':episode', $episode);
		$statement->bindValue(':title', $title);
		
		if($statement->execute())
		{
			header("Location: movie.php?episode={$episode}");
			exit;
		}
	}
?>
<!DOCTYPE html>
<html lang = "en">
<head>
	<meta charset = "utf-8" />
	<title>Galaxy Far, Far Away Database</title>
	<link rel="stylesheet" type="text/css" href="styles.css?d=<?php echo time(); ?>" />
</head>
<body>
<?php include("header.php") ?>	
	<section>
		<form method="post" action="create_movie.php" id="login_form">
			<label for="episode">Episode:</label>
			<input type="text" id="episode" name="episode" required />
			<br />
			<label for="title">Title:</label>
			<input type="text" id="title" name="title" required />
			<br />
			<input type="submit" id="submit" value="Create Movie" />
		</form>
	</section>
<?php include("footer.php") ?>
</body>
</html>