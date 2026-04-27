<?php 
   // koneksi database 
  require '../function/functions.php'; 
  
  if( isset($_POST['register']) ) {
           if ( registerUser($_POST) > 0 ) {
           	  echo "<script>
              window.onload = async function() {
                  // Menunggu user klik OK pada modal
                  await showModal('Akun anda berhasil dibuat!');
                  // Setelah klik OK, baru pindah halaman
                  window.location.href = '../index.php';
              };
          </script>";
           } else {
           	  $errorMsg =  mysqli_error($db);
              echo "<script>window.onload = () => showModal('Gagal: $errorMsg');</script>";
           }

  }

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sign Up</title>
  <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
   <main class="main-container">
    <h1>Register to make it account</h1>
	 <form action="" method="post" class="signup-form">
       <div class="input-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required>
      </div>

       <div class="input-group">
           <label for="password">Password </label> 
           <div class="password-wrap">     
            <input type="password" name="password" id="password" required>
            <button type="button" id="toggle-password" class="btn-toggle">Lihat Password</button>
        </div>
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
      
   <div class="input-group">
           <label for="confirm">Confirm Your Password</label>
          <input type="password" name="confirm" id="confirm" required>
    </div>
   <div class="input-group">
             
               <label for="email">Email</label>
              <input type="email" id="email" name="email" required>
            </div>
             <button class="btn fill" name="register">Register</button>
            <p class="footer-text">Already have an account? <a href="./login.php">Sign In</a></p>
	  </form> 
    </main>
    <script src="../assets/js/script.js"></script>
</body>
</html>