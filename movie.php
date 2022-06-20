<?php
	require('connect.php');
	
	if(isset($_GET['episode']))
	{
		$episode = filter_input(INPUT_GET, 'episode', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		
		$query = "SELECT * FROM movies WHERE episode = :episode";
		
		$statement = $db->prepare($query);
		
		$statement->bindValue(':episode', $episode);
		
		$statement->execute();
	}
?>
<!DOCTYPE html>
<html lang = "en">
<head>
	<meta charset = "utf-8" />
	<title>Galaxy Far, Far Away Database</title>
	<link rel="stylesheet" type="text/css" href="styles.css?d=<?php echo time(); ?>"/>
</head>
<body>
<?php include("header.php") ?>	
	<section>
		<?php if(!isset($_GET['episode']) || $statement->rowCount() == 0): ?>
			<h1>There are no results for that movie.</h1>
			<button onClick="location.href='create_movie.php';">Add Movie</button>
		<?php else: ?>
			<?php while($row = $statement->fetch()): ?>
				<h1>Star Wars Episode <?= $row['episode'] ?>: <?= $row['title'] ?></h1>
			<?php endwhile ?>
		<?php endif ?>
	</section>
<?php include("footer.php") ?>
</body>
</html>