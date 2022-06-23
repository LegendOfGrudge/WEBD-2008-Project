<?php
	// Final Project - WEBD-2008 Web Development 2
	// Name: Nicholas Fletcher
	// Date: June 22, 2022
	// Description: Connects the website to the mySQL database.
	// --------------------------------------------------------

	session_start();

	define('DB_DSN','mysql:host=localhost;dbname=serverside;charset=utf8');
    define('DB_USER','serveruser');
    define('DB_PASS','gorgonzola7!'); 
	 
	try 
	{
		$db = new PDO(DB_DSN, DB_USER, DB_PASS);
	}
	catch (PDOException $e)
	{
		print "Error: " . $e->getMessage();
		die();
	}
?>