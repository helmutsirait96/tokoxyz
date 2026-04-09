<?php 
  // koneksi database 
    require './function/functions.php';
     if( isset($_POST['login']) ) {
     	   $email = $_POST['email'];
     	   $password = $_POST['password'];

     	   $result = mysqli_query($db, "SELECT * FROM users WHERE email = '$email'");

            // cek username 
     if( mysqli_num_rows($result) === 1) {
              // cek password
     	        $row = mysqli_fetch_assoc($result); 
     	        if(password_verify($password, $row['password']) ) {
     	        	   header("Location: ./page/main-page.php");
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
</head>
<body>
	    <h1>Login</h1>
	    <?php if( isset($error) ) : ?>
              <p style="color: red; font-style: italic;">username / password salah</p>
	   <?php endif; ?> 	
	    <form action="" method="post">
	    	   <div class="username-login">
	    	   	  <label for="email">
	    	   	  	   Username
	    	   	  	   <input type="email" id="email" name="email">
	    	   	  </label>
	    	   </div>
	    	   <div class="password-login">
	    	   	   <label for="password">
	    	   	    Password
                   <input type="password" id="password" name="password">
	    	   	  </label>
	    	   </div>
	    	   <button type="submit" name="login">Login</button>
	    </form>
	   <a href="./page/signup.php">Register for an account</a>
</body>
</html>