<?php
	require('connect.php');
	
	if(isset($_GET['episode']))
	{	
		$episode = filter_input(INPUT_GET, 'episode', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		
		$query = "SELECT * FROM movies WHERE episode = :episode";
		
		$statement = $db->prepare($query);
		
		$statement->bindValue(':episode', $episode);
		
		$statement->execute();
		
		$movie = $statement->fetch();
		
		if($_POST && isset($_POST['add']) && isset($_POST['planet']))
		{
			list($planet_id, $name) = explode("-", $_POST['planet']);
			
			$add_query = "INSERT INTO movie_planets (movie_id, planet_id, name) VALUES (:movie_id, :planet_id, :name)";
			
			$add_statement = $db->prepare($add_query);
			
			$add_statement->bindValue(':movie_id', $movie['movie_id']);
			$add_statement->bindValue(':planet_id', $planet_id);
			$add_statement->bindValue(':name', $name);
			
			$add_statement->execute();
		}
		
		if($statement->rowCount() == 1)
		{
			$movie_id = $movie['movie_id'];
			
			$planet_query = "SELECT * FROM movie_planets WHERE movie_id = :movie_id";
			
			$planet_statement = $db->prepare($planet_query);
			
			$planet_statement->bindValue(':movie_id', $movie_id);
			
			$planet_statement->execute();
		}
		
		$select_query = "SELECT * FROM planets";
		
		$select_statement = $db->prepare($select_query);
		
		$select_statement->execute();
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
			<h1>Star Wars Episode <?= $movie['episode'] ?>: <?= $movie['title'] ?></h1>
			<?php if($planet_statement->rowCount() > 0): ?>
				<h3>Featured Planets:</h3>
				<ul class="planet_list">
				<?php while($planet = $planet_statement->fetch()): ?>
					<li><button onClick="location.href='planet.php?name=<?= $planet['name'] ?>'"><?= $planet['name'] ?></button></li>
				<?php endwhile ?>
				</ul>
			<?php endif ?>
		<?php endif ?>
		<?php if(isset($_SESSION['user'])): ?>
			<form method="post" action="movie.php?episode=<?= $_GET['episode'] ?>">
				<select name="planet">
					<?php while($select_row = $select_statement->fetch()): ?>
						<option value="<?php $select_row['planet_id'] . "-" . $select_row['name']; ?>"><?= $select_row['name'] ?></option>
					<?php endwhile ?>
				</select>
				<input type="submit" name="add" value="Add Planet" />
			</form>
		<?php endif ?>
	</section>
<?php include("footer.php") ?>
</body>
</html>