<?php 
    session_start();
     // koneksi database 
    require './function/functions.php';
    // admin
       // cek cookie 
    if( isset($_COOKIE['kode']) && isset($_COOKIE['value'])) {
           $kode = $_COOKIE['kode'];
           $value = $_COOKIE['value'];

           // username berdasarkan kodenya
           $result = mysqli_query($db, "SELECT username FROM users WHERE id = $kode");
           $row = mysqli_fetch_assoc($result);
           // cek cookie dan username
           if( $value === hash('sha256', $row['username']) ) {
           	   $_SESSION['login'] = true;
           }
    }     

    if( isset($_SESSION['login'])) {
    	  header("Location: ./page/admin.php");
    	  exit; 
    }
 
     if( isset($_POST['login']) ) {
     	   $email = $_POST['email'];
     	   $password = $_POST['password'];

     	   $result = mysqli_query($db, "SELECT * FROM users WHERE email = '$email'");

            // cek username 
     if( mysqli_num_rows($result) === 1) {
              // cek password
     	        $row = mysqli_fetch_assoc($result); 
     	        if(password_verify($password, $row['password']) ) {
     	        	   // set session 
     	        	    $_SESSION['login'] = true;
     	        	    // cek remember me
     	        	    if( isset($_POST['remember']) ) {
     	        	    	   // set cookie
     	        	    	  setcookie('kode', $row['id'], time() + (60 * 60 * 24), '/');
     	        	    	  setcookie('value', hash('sha256', $row['username']), time() + (60 * 60 * 24), '/');
     	        	    }
     	        	   header("Location: ./page/admin.php");
     	        	   exit;
     	        }
      }
      $error = true;
     }



 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<link rel="stylesheet" href="./assets/css/reset.css">
	<link rel="stylesheet" href="./assets/css/styles.css">
	<link rel="stylesheet" href="./assets/css/login.css">
</head>
<body>
	<main>
	    <h1>Sign In</h1>
	    <?php if( isset($error) ) : ?>
              <p style="color: red; font-style: italic;">username / password salah</p>
	   <?php endif; ?> 	
	    <form action="" method="post" class="form-login">
	      <label>
		      Email
	            <input type="email" name="email">
	    </label>
             <label >
	   	    Password 
	   	    <input type="password" name="password">
	    	 </label>
	    	 <label>
             	    <input type="checkbox" name="remember">
             	    Remember Me
             	 </label>
              <button type="submit" name="login" class="btn fill">Login</button>
	    </form>
	   <a href="./page/signup.php">Register for an account</a>
	 </main>  
	 <script src="./assets/js/login.js"></script>

</body>
</html>