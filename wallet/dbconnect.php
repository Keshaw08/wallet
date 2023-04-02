<?php

	$servername = "localhost:3306";
	$username = "root";
	$password = "";

	$database = "wallet";

	// Create a connection
	$conn = mysqli_connect($servername,
		$username, $password, $database);

	// Code written below is a step taken
	// to check that our Database is
	// connected properly or not. If our
	// Database is properly connected we
	// can remove this part from the code
	// or we can simply make it a comment
	// for future reference.

	if($conn) {
		echo "success welldone Keshaw";
	}
	else {
		die("Error". mysqli_connect_error());
	}
?>
