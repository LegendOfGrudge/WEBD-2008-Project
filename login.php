<?php
	require('connect.php');

	if($_POST)
	{
		$query = "SELECT * FROM users";
	
		$statement = $db->prepare($query);
	
		$statement->execute();
		
		while($row = $statement->fetch())
		{
			if($_POST['username'] == $row['username'] && password_verify($_POST['pass'], $row['password']))
			{
				$_SESSION['user'] = $row['username'];
				$_SESSION['privilege'] = $row['privilege'];
				
				header("Location: index.php");
				exit;
			}
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
		<?php if($_POST): ?>
			<p class="error">The username or password entered was incorrect</p>
		<?php endif ?>
		<form method="post" action="login.php" id="login_form">
			<label for="username">Username:</label>
			<input type="text" id="username" name="username" />
			<br />
			<label for="pass">Password:</label>
			<input type="password" id="pass" name="pass" required />
			<br />
			<input type="submit" id="submit" value="Log In" />
		</form>
		<a href="create_account.php">Create Account?</a>
	</section>
<?php include("footer.php") ?>
</body>
</html>