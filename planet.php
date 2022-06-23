<?php
	// Final Project - WEBD-2008 Web Development 2
	// Name: Nicholas Fletcher
	// Date: June 22, 2022
	// Description: Displays a planet that was clicked on or retrieved using GET. Shows an image if it is associated, and any comments that are linked.
	// ------------------------------------------------------------------------------------------------------------------------------------------------

	require('connect.php');
	
	if(isset($_GET['name']))
	{
		$name = filter_input(INPUT_GET, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		
		$query = "SELECT * FROM planets WHERE name = :name";
		
		$statement = $db->prepare($query);
		
		$statement->bindValue(':name', $name);
		
		$statement->execute();
		
		$comment_query = "SELECT * FROM comments WHERE planet_name = :planet_name ORDER BY date DESC";
		
		$comment_statement = $db->prepare($comment_query);
		
		$comment_statement->bindValue(':planet_name', $name);
		
		$comment_statement->execute();
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
				<?php if(!empty($row['api_url'])): ?>
					<h3>Known Residents:</h3>
					<?php
						$planet_json = file_get_contents($row['api_url']);
						$planet_data = json_decode($planet_json, true);
						
						$residents = $planet_data['residents'];
					?>
					<ul>
					<?php for($i = 0; $i < count($residents); $i++): ?>
						<?php
							$resident_json = file_get_contents($residents[$i]);
							$resident = json_decode($resident_json, true);
						?>
						<li><?= $resident['name'] ?></li>
					<?php endfor ?>
					</ul>
				<?php endif ?>
				<br />
				<?php if(isset($_SESSION['user'])): ?>
				<form method="post" action="update_planet.php">
					<input type="hidden" name="planet_id" value="<?= $row['planet_id'] ?>" />
				
					<input type="submit" name="update" value="Update" />
					<input type="submit" name="delete" value="Delete" />
				</form>
				<?php endif ?>
			<?php endwhile ?>
			<h1>Comments:</h1>
			<?php if($comment_statement->rowCount() == 0): ?>
				<h1>There are no comments.</h1>
			<?php else: ?>
				<?php while($comment = $comment_statement->fetch()): ?>
					<div class="comment">
						<h2><?= $comment['user'] ?></h2>
						<?php $date = date_create($comment['date']); ?>
						<?php if(isset($_SESSION['privilege']) && $_SESSION['privilege'] == 1): ?>
							<p><small><?= date_format($date, 'F d, Y, g:i a'); ?> - <a href="delete_comment.php?comment=<?= $comment['comment_id'] ?>">Delete</a></small></p>
						<?php else: ?>
							<p><small><?= date_format($date, 'F d, Y, g:i a'); ?></small></p>
						<?php endif ?>
						<div class="comment_content"><?= $comment['content'] ?></div>
					</div>
				<?php endwhile ?>
			<?php endif ?>
			<?php if(isset($_SESSION['user'])): ?>
				<form method="post" action="create_comment.php">
					<input type="hidden" name="name" value="<?= $name ?>" />
					<input type="hidden" name="user" value="<?= $_SESSION['user'] ?>" />
					
					<textarea name="content"></textarea>
					<br />
					<input type="submit" name="submit" value="Add Comment" />
				</form>
			<?php endif ?>
		<?php endif ?>
	</section>
<?php include("footer.php") ?>
</body>
</html>