<?php
	require('connect.php');
	
	if(isset($_GET['name']))
	{
		$name = filter_input(INPUT_GET, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		
		$query = "SELECT * FROM planets WHERE name = :name";
		
		$statement = $db->prepare($query);
		
		$statement->bindValue(':name', $name);
		
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
		<?php if(!isset($_GET['name']) || $statement->rowCount() == 0): ?>
			<h1>There are no results for that planet.</h1>
			<button onClick="location.href='create_planet.php';">Add Planet</button>
		<?php else: ?>
			<?php while($row = $statement->fetch()): ?>
				<h1><?= $row['name'] ?></h1>
				<?php if(!empty($row['image'])): ?>
					<div class="planet_image">
						<img src="<?= $row['image'] ?>" />
					</div>
				<?php endif ?>
				<table>
					<tr>
						<td>Diameter:</td>
						<?php if($row['diameter'] > 0): ?>
							<td><?= $row['diameter'] ?> km</td>
						<?php else: ?>
							<td>Unknown</td>
						<?php endif ?>
					</tr>
					<tr>
						<td>Climate:</td>
						<td><?= $row['climate'] ?></td>
					</tr>
					<tr>
						<td>Terrain:</td>
						<td><?= $row['terrain'] ?></td>
					</tr>
					<tr>
						<td>Surface Water:</td>
						<?php if($row['surface_water'] > 0): ?>
							<td><?= $row['surface_water'] ?>%</td>
						<?php else: ?>
							<td>Unknown</td>
						<?php endif ?>
					</tr>
					<tr>
						<td>Population:</td>
						<?php if($row['population'] > 0): ?>
							<td><?= $row['population'] ?> people</td>
						<?php else: ?>
							<td>Unknown</td>
						<?php endif ?>
					</tr>
				</table>
				<br />
				<?php if(isset($_SESSION['user'])): ?>
				<form method="post" action="update_planet.php">
					<input type="hidden" name="planet_id" value="<?= $row['planet_id'] ?>" />
				
					<input type="submit" name="update" value="Update" />
					<input type="submit" name="delete" value="Delete" />
				</form>
				<?php endif ?>
			<?php endwhile ?>
		<?php endif ?>
	</section>
<?php include("footer.php") ?>
</body>
</html>