<?php 
   // koneksi database 
  require '../function/functions.php'; 
  
  if( isset($_POST['register']) ) {
         
           if ( registerUser($_POST) > 0 ) {
           	    echo "<script>
                alert('Anda berhasil membuat akun');
                document.location.href = '../index.php';
   		      </script>";
           } else {
           	  echo mysqli_error($db);
           }

  }

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sign Up</title>
	<link rel="stylesheet" href="../assets/css/reset.css">
  <link rel="stylesheet" href="../assets/css/styles.css">

  <link rel="stylesheet" href="../assets/css/signup-styles.css">
</head>
<body>
	 
	<form action="" method="post" class="signup-form">
        <h1>Register to make it account</h1>
	  	  <label for="username">
	  	   Username
	  	  <input type="text" name="username" id="username" required>	
	  	</label>
      <label for="password">
               Password
               <div class="password-wrap">
                   <input type="password" name="password" id="password" required>
                  <button type="button" id="toggle-password" class="btn">Lihat Password</button>
               </div>
               <div class="password-rule">
                   <ul>
                       <li id="rule-8-char">Minimal 8 Karakter</li>
                       <li id="rule-upper">Minimal 1 huruf besar</li>
                       <li id="rule-lower">Minimal 1 huruf kecil</li>
                       <li id="rule-number">Minimal 1 angka</li>
                       <li id="rule-special">Minimal 1 karakter special</li>

                   </ul>
               </div>
              <div id="password-error"></div>
      </label>
     <label for="confirm">
         Confirm Your Password
      <input type="password" name="confirm" id="confirm" required>
     </label>
       <label for="email">
            Email
            <input type="email" id="email" name="email" required>
         </label>
        <button class="btn" name="register">Register</button>
        <p>Already have an account? <a href="../index.php">Sign</a></p>
	  </form> 

    <script src="../assets/js/script.js"></script>
</body>
</html>