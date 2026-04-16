<?php 
       session_start();
    	if( !isset($_SESSION['login'])) {
    		 header("Location: ../index.php");
    		 exit;
    	}	
        // $_SESSION['admin'] = true;	
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin Dashboard</title>
</head>
<body>
    <h1>Admin Dashboard</h1>
    <a href="./barang.php">Data Barang</a>
    <a href="./logout.php">Logout!</a>
</body>
</html>