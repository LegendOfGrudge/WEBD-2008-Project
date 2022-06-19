	<div id="login">
	<?php if(isset($_SESSION['user']) && isset($_SESSION['privilege'])): ?>
		<?php if($_SESSION['privilege'] == 0): ?>
			<div class="dropdown">
				<button class="dropbtn"><?= $_SESSION['user'] ?></button>
				<div class="dropdown-content">
					<a href="logout.php">Logout</a>
				 </div>
			</div> 
		<?php elseif($_SESSION['privilege'] == 1): ?>
			<div class="dropdown">
				<button class="dropbtn"><?= $_SESSION['user'] ?></button>
				<div class="dropdown-content">
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
			<a href = "movie.php"><li>I</li></a>
			<a href = "movie.php"><li>II</li></a>
			<a href = "movie.php"><li>III</li></a>
			<a href = "movie.php"><li>IV</li></a>
			<a href = "movie.php"><li>V</li></a>
			<a href = "movie.php"><li>VI</li></a>
		</ul>
	</nav>