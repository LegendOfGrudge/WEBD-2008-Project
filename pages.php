<?php
	// Final Project - WEBD-2008 Web Development 2
	// Name: Nicholas Fletcher
	// Date: June 22, 2022
	// Description: Allows a user to see a full list of planets with three different ways to sort them with the ability to update or delete the planets from this page.
	// ----------------------------------------------------------------------------------------------------------------------------------------------------------------

	require('connect.php');
	
	if(!isset($_SESSION['user']))
	{
		header("Location: index.php");
		exit;
	}
	
	$sort_by_name = isset($_POST['nameSort']);
	$sort_by_climate = isset($_POST['climateSort']);
	$sort_by_population = isset($_POST['populationSort']);
	
	if($sort_by_name)
	{
		$query = "SELECT planet_id, name, climate, population FROM planets ORDER BY name ASC";
		$statement = $db->prepare($query);
		
		$statement->execute();
	}
	else if($sort_by_climate)
	{
		$query = "SELECT planet_id, name, climate, population FROM planets ORDER BY climate ASC";
		$statement = $db->prepare($query);
		
		$statement->execute();
	}
	else if($sort_by_population)
	{
		$query = "SELECT planet_id, name, climate, population FROM planets ORDER BY population DESC";
		$statement = $db->prepare($query);
		
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
		<table>
			<form method="post" action="pages.php">
				<tr>
					<td>Sort By:</td>
					<td><input type="submit" name="nameSort" value="Name"/></td>
					<td><input type="submit" name="climateSort" value="Climate"/></td>
					<td><input type="submit" name="populationSort" value="Population"/></td>
					<td>Update?</td>
					<td>Delete?</td>
				</tr>
			</form>
			<?php if($_POST): ?>
				<?php while($row = $statement->fetch()): ?>
					<form method="post" action="update_planet.php">
						<tr>
							<td><input type="hidden" name="planet_id" value="<?= $row['planet_id'] ?>" /></td>
							<td class="page_name"><a href="planet.php?name=<?= $row['name'] ?>"><?= $row['name'] ?></a></td>
							<td><?= $row['climate'] ?></td>
							<td><?= $row['population'] ?></td>
							<td><input type="submit" name="update" value="Update" /></td>
							<td><input type="submit" name="delete" value="Delete" /></td>
						<tr>
					</form>
				<?php endwhile ?>
			<?php endif ?>
		</table>
		<button onClick="location.href='create_planet.php';">Add Planet</button>
	</section>
<?php include("footer.php") ?>
</body>
</html>