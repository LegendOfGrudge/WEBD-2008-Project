<?php
	require('connect.php');
	
	if(!isset($_SESSION['user']))
	{
		header("Location: index.php");
		exit;
	}
	
	if($_POST && !empty($_POST['name']) && !empty($_POST['diameter']) && !empty($_POST['climate']) && !empty($_POST['terrain']) && !empty($_POST['surface_water']) && !empty($_POST['population']))
	{
		$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$diameter = filter_input(INPUT_POST, 'diameter', FILTER_SANITIZE_NUMBER_INT);
		$climate = filter_input(INPUT_POST, 'climate', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$terrain = filter_input(INPUT_POST, 'terrain', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$surface_water = filter_input(INPUT_POST, 'surface_water', FILTER_SANITIZE_NUMBER_INT);
		$population = filter_input(INPUT_POST, 'population', FILTER_SANITIZE_NUMBER_INT);
		
		$query = "INSERT INTO planets (name, diameter, climate, terrain, surface_water, population) VALUES (:name, :diameter, :climate, :terrain, :surface_water, :population)";
		$statement = $db->prepare($query);
		
		$statement->bindValue(':name', $name);
		$statement->bindValue(':diameter', $diameter);
		$statement->bindValue(':climate', $climate);
		$statement->bindValue(':terrain', $terrain);
		$statement->bindValue(':surface_water', $surface_water);
		$statement->bindValue(':population', $population);
		
		if($statement->execute())
		{
			header("Location: planet.php?name={$name}");
			exit;
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
		<form id="update_form" method="post" action="create_planet.php">
			<label for="name">Name:</label>
			<input type="text" id="name" name="name" value="" />
			<br />
			<label for="diameter">Diameter:</label>
			<input type="text" id="diameter" name="diameter" value="" />
			<br />
			<label for="climate">Climate:</label>
			<input type="text" id="climate" name="climate" value="" />
			<br />
			<label for="terrain">Terrain:</label>
			<input type="text" id="terrain" name="terrain" value="" />
			<br />
			<label for="surface_water">Surface Water:</label>
			<input type="text" id="surface_water" name="surface_water" value="" />
			<br />
			<label for="population">Population:</label>
			<input type="text" id="population" name="population" value="" />
			<br />
			<br />
			<input type="submit" name="submit" value="Create" />
		</form>
	</section>
<?php include("footer.php") ?>
</body>
</html>