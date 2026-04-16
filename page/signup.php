<script>
     function showModal(message) {
    return new Promise((resolve) => {
        // Buat elemen modal
        const modal = document.createElement('div');
        modal.id = 'custom-modal';
        modal.style.cssText = `
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.6);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        `;
        modal.innerHTML = `
            <div style="background: #fff; padding: 30px; border-radius: 12px; text-align: center; box-shadow: 0 4px 15px rgba(0,0,0,0.2); max-width: 400px; width: 90%;">
                <h2 style="margin-bottom: 20px; font-family: sans-serif; color: #333;">${message}</h2>
                <button id="tutup-modal" style="padding: 10px 25px; background: #333; color: white; border: none; border-radius: 5px; cursor: pointer; font-weight: bold;">OK</button>
            </div>
        `;

        document.body.appendChild(modal);

        // Tambahkan event click pada tombol
        document.getElementById('tutup-modal').addEventListener('click', function () {
            modal.remove(); // Hapus modal dari DOM
            resolve();      // Selesaikan promise
        });
    });
}
</script>

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
	<link rel="stylesheet" href="../assets/css/reset.css">
  <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
	<form action="" method="post" class="signup-form">
        <h1>Register to make it account</h1>
        <div class="group">
            <input type="text" name="username" id="username" required><span class="highlight"></span><span class="bar"></span>	
   	  	  <label for="username">
            Username</label>
        </div>

        <div class="password-wrap">
             <div class="group"
         >         
         <input type="password" name="password" id="password" required><span class="highlight"></span><span class="bar"></span>
                     <label for="password">
               Password </label> 
         </div>
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
     <div class="group">
      <input type="password" name="confirm" id="confirm" required><span class="highlight"></span><span class="bar"></span>
      <label for="confirm">Confirm Your Password</label>
     </div>
       
       <div class="group">
           
            <input type="email" id="email" name="email" required><span class="highlight"></span><span class="bar"></span>
              <label for="email">
            Email</label>
       </div>
        <button class="btn" name="register">Register</button>
        <p>Already have an account? <a href="../index.php">Sign</a></p>
	  </form> 
    
    <script src="../assets/js/script.js"></script>
    <script src="../assets/js/login.js"></script>
</body>
</html>