<?php
	// Final Project - WEBD-2008 Web Development 2
	// Name: Nicholas Fletcher
	// Date: June 22, 2022
	// Description: Logs out a user and returns to the main home page of the website. 
	// ------------------------------------------------------------------------------

	session_start();
	
	$_SESSION = array();
	
	session_destroy();
	
	header("Location: index.php");
	exit;
?>