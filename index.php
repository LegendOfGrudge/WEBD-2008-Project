<?php
	// Final Project - WEBD-2008 Web Development 2
	// Name: Nicholas Fletcher
	// Date: June 22, 2022
	// Description: Personal Home Page of the website that will display all planets that have an image in the uploads attribute of the planets table.
	// ----------------------------------------------------------------------------------------------------------------------------------------------

	require('connect.php');
	
	$query = "SELECT * FROM planets WHERE image <> '' ORDER BY name";
	
	$statement = $db->prepare($query);
	
	$statement->execute();
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
		<div class="image_container">
			<?php while($row = $statement->fetch()): ?>
				<a href="planet.php?name=<?= $row['name'] ?>">
				<img src="<?= $row['image'] ?>" alt="<?= $row['name'] ?>" height="150" width="150" />
				</a>
			<?php endwhile ?>
		</div>
	</section>
<?php include("footer.php") ?>
</body>
</html>