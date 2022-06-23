<?php
	// Final Project - WEBD-2008 Web Development 2
	// Name: Nicholas Fletcher
	// Date: June 22, 2022
	// Description: Creates a planet with all non-link attributes able to be filled and can upload and link an image to the uploads folder and to the planet row in the mySQL database.
	// --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

	require('connect.php');
	
	if(!isset($_SESSION['user']))
	{
		header("Location: index.php");
		exit;
	}
	
	// file_upload_path() - Safely build a path String that uses slashes appropriate for our OS.
    // Default upload path is an 'uploads' sub-folder in the current folder.
    function file_upload_path($original_filename, $upload_subfolder_name = 'uploads') {
       $current_folder = dirname(__FILE__);
       
       // Build an array of paths segment names to be joins using OS specific slashes.
       $path_segments = [$current_folder, $upload_subfolder_name, basename($original_filename)];
       
       // The DIRECTORY_SEPARATOR constant is OS specific.
       return join(DIRECTORY_SEPARATOR, $path_segments);
    }

    // file_is_an_image() - Checks the mime-type & extension of the uploaded file for "image-ness".
    function file_is_an_image($temporary_path, $new_path) {
        $allowed_mime_types      = ['image/gif', 'image/jpeg', 'image/png'];
        $allowed_file_extensions = ['gif', 'jpg', 'jpeg', 'png'];
        
        $actual_file_extension   = pathinfo($new_path, PATHINFO_EXTENSION);
        $actual_mime_type        = getimagesize($temporary_path)['mime'];
        
        $file_extension_is_valid = in_array($actual_file_extension, $allowed_file_extensions);
        $mime_type_is_valid      = in_array($actual_mime_type, $allowed_mime_types);
        
        return $file_extension_is_valid && $mime_type_is_valid;
    }
    
    $image_upload_detected = isset($_FILES['image']) && ($_FILES['image']['error'] === 0);
    $upload_error_detected = isset($_FILES['image']) && ($_FILES['image']['error'] > 0);

    if ($image_upload_detected) { 
        $image_filename        = $_FILES['image']['name'];
        $temporary_image_path  = $_FILES['image']['tmp_name'];
        $new_image_path        = file_upload_path($image_filename);
        if (file_is_an_image($temporary_image_path, $new_image_path)) {
			move_uploaded_file($temporary_image_path, $new_image_path);
			$file_path = 'uploads/' . $image_filename;
        }
    }
	
	if($_POST && !empty($_POST['name']) && !empty($_POST['diameter']) && !empty($_POST['climate']) && !empty($_POST['terrain']) && !empty($_POST['surface_water']) && !empty($_POST['population']) && !isset($file_path))
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
	else if($_POST && !empty($_POST['name']) && !empty($_POST['diameter']) && !empty($_POST['climate']) && !empty($_POST['terrain']) && !empty($_POST['surface_water']) && !empty($_POST['population']) && isset($file_path))
	{
		$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$diameter = filter_input(INPUT_POST, 'diameter', FILTER_SANITIZE_NUMBER_INT);
		$climate = filter_input(INPUT_POST, 'climate', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$terrain = filter_input(INPUT_POST, 'terrain', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$surface_water = filter_input(INPUT_POST, 'surface_water', FILTER_SANITIZE_NUMBER_INT);
		$population = filter_input(INPUT_POST, 'population', FILTER_SANITIZE_NUMBER_INT);
		
		$query = "INSERT INTO planets (name, diameter, climate, terrain, surface_water, population, image) VALUES (:name, :diameter, :climate, :terrain, :surface_water, :population, :image)";
		$statement = $db->prepare($query);
		
		$statement->bindValue(':name', $name);
		$statement->bindValue(':diameter', $diameter);
		$statement->bindValue(':climate', $climate);
		$statement->bindValue(':terrain', $terrain);
		$statement->bindValue(':surface_water', $surface_water);
		$statement->bindValue(':population', $population);
		$statement->bindValue(':image', $file_path);
		
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
		<form id="update_form" method="post" enctype='multipart/form-data' action="create_planet.php">
			<label for='image'>Image Filename:</label>
			<input type='file' name='image' id='image'>
			<br />
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