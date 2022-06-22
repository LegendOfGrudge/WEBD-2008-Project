<?php
	require('connect.php');
	
	if($_POST && isset($_POST['search_term']) && isset($_POST['category']))
	{
		$search_term = filter_input(INPUT_POST, 'search_term', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		
		if(!empty(trim($search_term)))
		{
			if($category == 'ALL')
			{
				$like_term = "%" . $search_term . "%";
				
				$query = "SELECT name FROM planets WHERE name LIKE :like_term";
				
				$statement = $db->prepare($query);
				
				$statement->bindValue(':like_term', $like_term);
				
				$statement->execute();
			}
			else
			{
				$like_term = "%" . $search_term . "%";
				
				$query = "SELECT name FROM movie_planets WHERE movie_id = :movie_id AND name LIKE :like_term";
				
				$statement = $db->prepare($query);
				
				$statement->bindValue(':movie_id', $category);
				$statement->bindValue(':like_term', $like_term);
				
				$statement->execute();
			}
		}
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
		<?php if(isset($statement)): ?>
			<div class="search_results">
				<h2>Search Results:<h2>
				<?php while($row = $statement->fetch()): ?>
					<p><a href="planet.php?name=<?= $row['name'] ?>"><?= $row['name'] ?></a></p>
				<?php endwhile ?>
			</div>
		<?php else: ?>
			<h2>No search results</h2>
		<?php endif ?>
	</section>
<?php include("footer.php") ?>
</body>
</html>