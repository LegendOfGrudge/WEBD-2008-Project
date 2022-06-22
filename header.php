<?php
	$search_query = "SELECT * FROM movies";
	
	$search_statement = $db->prepare($search_query);
	
	$search_statement->execute();

	$header_query = "SELECT * FROM movies";
	
	$header_statement = $db->prepare($header_query);
	
	$header_statement->execute();
?>
	<div id="login">
		<form method="post" action="search.php">
			<input type="text" name="search_term" />
			<select name="category">
				<option value="ALL">All</option>
				<?php while($row = $search_statement->fetch()): ?>
					<option value="<?= $row['movie_id'] ?>"><?= $row['episode'] ?></option>
				<?php endwhile ?>
			</select>
			<input type="submit" name="search" value="Search" />
		</form>
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
			<?php if(isset($_SESSION['user'])): ?>
				<a href = "create_movie.php"><li>+</li></a>
			<?php endif ?>
		</ul>
	</nav>