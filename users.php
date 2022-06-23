<?php
	// Final Project - WEBD-2008 Web Development 2
	// Name: Nicholas Fletcher
	// Date: June 22, 2022
	// Description: Displays a list of users for an admin account to assign admin privilege or to delete the user altogether.
	// ----------------------------------------------------------------------------------------------------------------------

	require('connect.php');
	
	if(!isset($_SESSION['privilege']) || $_SESSION['privilege'] != 1)
	{
		header("Location: index.php");
		exit;
	}
	
	$query = "SELECT * FROM users";
	
	$statement = $db->prepare($query);
	
	$statement->execute();
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
		<table>
			<tr>
				<td>Users:</td>
				<td>Privilege:</td>
				<td>Delete?</td>
			</tr>
			<?php while($row = $statement->fetch()): ?>
				<tr>
					<form method="post" action="update_users.php">
						<input type="hidden" name="user_id" value="<?= $row['user_id'] ?>" />
						<td><?= $row['username'] ?></td>
						<?php if($row['privilege']): ?>
							<td>Admin User</td>
						<?php else: ?>
							<td><input type="submit" name="privilege" value="Make Admin?" /></td>
						<?php endif ?>
						<td><input type="submit" name="delete" value="X" /></td>
					</form>
				</tr>
			<?php endwhile ?>
		</table>
	</section>
<?php include("footer.php") ?>
</body>
</html>