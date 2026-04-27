<?php 
    session_start();
     // koneksi database 
    require '../function/functions.php';
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
     	        	   header("Location: ./admin.php");
     	        	   exit;
     	        }
      }
      // $error = true;
       echo "<script>
              window.onload = async function() {
                  // Menunggu user klik OK pada modal
                  await showModal('Username atau password anda salah!');
                  // Setelah klik OK, baru pindah halaman
                  window.location.href = './login.php';
              };
          </script>"; 
     }
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
	<main class="main-container">
	    <h1>Sign In</h1>
	     <p class="subtitle">Welcome back! Please enter your details.</p>
	    <form action="" method="post" class="form-login">
	   <div class="input-group">
	      <label for="email">Email</label>
	      <input type="email" name="email" id="email">
	</div>
	   <div class="input-group">
              <label for="password">Password</label>
	       <input type="password" name="password" id="password">
	    </div>
           
	   <div class="options">
	     <label for="remember-me" class="remember-me">
             <input type="checkbox" name="remember" id="remember-me">
	       <span>Remember Me</span>
	     </label>
                <a href="#" class="forgot-pass">Forgot Password?</a>
           </div>  	   
             
           <button type="submit" name="login" class="btn fill">Login</button>
	    </form>
	    <p class="footer-text">
	    	   Don't have an account? <a href="./signup.php">Register for an account</a>
	    </p>
	 </main>  
	 <script src="./assets/js/script.js"></script>
</body>
</html>