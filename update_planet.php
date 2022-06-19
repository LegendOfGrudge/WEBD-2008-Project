<?php 
	require('connect.php');
	
	if(!isset($_SESSION['user']))
	{
		header("Location: index.php");
		exit;
	}
	
	if($_POST && isset($_POST['diameter']) && isset($_POST['climate']) && isset($_POST['terrain']) && isset($_POST['surface_water']) && isset($_POST['population']))
	{
		$planet_id = filter_input(INPUT_POST, 'planet_id', FILTER_SANITIZE_NUMBER_INT);
		$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$diameter = filter_input(INPUT_POST, 'diameter', FILTER_SANITIZE_NUMBER_INT);
		$climate = filter_input(INPUT_POST, 'climate', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$terrain = filter_input(INPUT_POST, 'terrain', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$surface_water = filter_input(INPUT_POST, 'surface_water', FILTER_SANITIZE_NUMBER_INT);
		$population = filter_input(INPUT_POST, 'population', FILTER_SANITIZE_NUMBER_INT);
		
		$query = "UPDATE planets SET diameter = :diameter, climate = :climate, terrain = :terrain, surface_water = :surface_water, population = :population WHERE planet_id = :planet_id";
		$statement = $db->prepare($query);
		$statement->bindValue(':diameter', $diameter);
		$statement->bindValue(':climate', $climate);
		$statement->bindValue(':terrain', $terrain);
		$statement->bindValue(':surface_water', $surface_water);
		$statement->bindValue(':population', $population);
		$statement->bindValue(':planet_id', $planet_id, PDO::PARAM_INT);
		
		if($statement->execute())
		{
			header("Location: planet.php?name={$name}");
			exit;
		}
	}
	else if($_POST && isset($_POST['planet_id']))
	{
		$user_updating_planet = isset($_POST['update']);
		$user_deleting_planet = isset($_POST['delete']);
		
		if($user_updating_planet)
		{
			$planet_id = filter_input(INPUT_POST, 'planet_id', FILTER_SANITIZE_NUMBER_INT);
			
			$query = "SELECT * FROM planets WHERE planet_id = :planet_id";
			
			$statement = $db->prepare($query);
			
			$statement->bindValue(':planet_id', $planet_id, PDO::PARAM_INT);
			
			$statement->execute();
			
			$planet = $statement->fetch();
		}
		
		if($user_deleting_planet)
		{
			$planet_id = filter_input(INPUT_POST, 'planet_id', FILTER_SANITIZE_NUMBER_INT);
			
			$query = "DELETE FROM planets WHERE planet_id = :planet_id";
			$statement = $db->prepare($query);
			$statement->bindValue(':planet_id', $planet_id, PDO::PARAM_INT);
			
			$statement->execute();
			
			header("Location: index.php");
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
		<?php if($planet_id): ?>
			<h1><?= $planet['name'] ?></h1>
		
			<form id="update_form" method="post" action="update_planet.php">
				<input type="hidden" name="planet_id" value="<?= $planet['planet_id'] ?>">
				<input type="hidden" name="name" value="<?= $planet['name'] ?>">
				
				<label for="diameter">Diameter:</label>
				<input type="text" id="diameter" name="diameter" value="<?= $planet['diameter'] ?>" />
				<br />
				<label for="climate">Climate:</label>
				<input type="text" id="climate" name="climate" value="<?= $planet['climate'] ?>" />
				<br />
				<label for="terrain">Terrain:</label>
				<input type="text" id="terrain" name="terrain" value="<?= $planet['terrain'] ?>" />
				<br />
				<label for="surface_water">Surface Water:</label>
				<input type="text" id="surface_water" name="surface_water" value="<?= $planet['surface_water'] ?>" />
				<br />
				<label for="population">Population:</label>
				<input type="text" id="population" name="population" value="<?= $planet['population'] ?>" />
				<br />
				<br />
				<input type="submit" name="submit" value="Submit" />
			</form>
		<?php endif ?>
	</section>
<?php include("footer.php") ?>
</body>
</html>