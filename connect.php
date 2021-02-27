<?php 
	$servername = "localhost";
	$username = "root"; # MySQL user
	$password = ""; # MySQL Server root password
	$dbname='crud'; # Database name
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
	    # Display an error mesage if the connection fails
	    die("Connection failed: " . $conn->connect_error);
	}
?>