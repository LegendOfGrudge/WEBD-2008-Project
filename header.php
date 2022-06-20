<?php
	$header_query = "SELECT * FROM movies";
	
	$header_statement = $db->prepare($header_query);
	
	$header_statement->execute();
?>
	<div id="login">
	<?php if(isset($_SESSION['user']) && isset($_SESSION['privilege'])): ?>
		<?php if($_SESSION['privilege'] == 0): ?>
			<div class="dropdown">
				<button class="dropbtn"><?= $_SESSION['user'] ?></button>
				<div class="dropdown-content">
					<a href="pages.php">Planets</a>
					<a href="logout.php">Logout</a>
				 </div>
			</div> 
		<?php elseif($_SESSION['privilege'] == 1): ?>
			<div class="dropdown">
				<button class="dropbtn"><?= $_SESSION['user'] ?></button>
				<div class="dropdown-content">
					<a href="pages.php">Planets</a>
					<a href="users.php">Users</a>
					<a href="logout.php">Logout</a>
				 </div>
			</div> 
		<?php endif ?>
	<?php else: ?>
		<a href="login.php">Login</a>
	<?php endif ?>
	</div>
	
	<div id="header_image">
		<h1><a href="index.php">Galaxy Far, Far Away Database</a></h1>
	</div>
	
	<nav>
		<ul>
			<?php while($row = $header_statement->fetch()): ?>
				<a href = "movie.php?episode=<?= $row['episode'] ?>"><li><?= $row['episode'] ?></li></a>
			<?php endwhile ?>
			<a href = "create_movie.php"><li>+</li></a>
		</ul>
	</nav>