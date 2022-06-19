<?php
	require('connect.php');
	
	if($_POST && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['confirm']))
	{
		// Validating username
		if(empty(trim($_POST['username'])))
		{
			$username_err = "Please enter a username.";
		}
		elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"])))
		{
			$username_err = "Username can only contain letters, numbers, and underscores.";
		} 
		else
		{
			$query = "SELECT * FROM users";
	
			$statement = $db->prepare($query);
	
			$statement->execute();
			
			while($row = $statement->fetch()) {
				if($row['username'] == trim($_POST['username']))
				{
					$username_err = "Username already exists.";
				}
			}
		}
		
		// Validating password
		if(empty(trim($_POST['password'])))
		{
			$password_err = "Please enter a password.";
		}
		else
		{
			$password = trim($_POST['password']);
		}
		
		// Validating confirm password
		if(empty(trim($_POST['confirm'])))
		{
			$password_err = "Please confirm password.";
		}
		else
		{
			$confirm = trim($_POST['confirm']);
			if(empty($password_err) && ($password != $confirm))
			{
				$password_err = "Password did not match.";
			}
		}
		
		if(empty($username_err) && empty($password_err))
		{
			$username = trim($_POST['username']);
			$password_hashed = password_hash($password, PASSWORD_DEFAULT);
			
			$query = "INSERT INTO users (username, password) VALUES (:username, :password)";
			$statement = $db->prepare($query);
			
			$statement->bindValue(':username', $username);
			$statement->bindValue(':password', $password_hashed);
			
			if($statement->execute())
			{
				header("Location: login.php");
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
		<?php if(!empty($username_err)): ?>
			<p class="error"><?= $username_err ?></p>
		<?php endif ?>
		<?php if(!empty($password_err)): ?>
			<p class="error"><?= $password_err ?></p>
		<?php endif ?>
		<form method="post" action="create_account.php" id="login_form">
			<label for="username">Username:</label>
			<input type="text" id="username" name="username" required />
			<br />
			<label for="password">Password:</label>
			<input type="password" id="password" name="password" required />
			<br />
			<label for="confirm">Re-Enter Password:</label>
			<input type="password" id="confirm" name="confirm" required />
			<br />
			<input type="submit" id="submit" value="Create Account" />
		</form>
	</section>
<?php include("footer.php") ?>
</body>
</html>