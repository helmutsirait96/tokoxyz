<?php 
   // Hapus semua data session
   session_start();
   $_SESSION = [];
   session_unset();
   session_destroy();
   // Hapus cookie dengan menentukan path yang sama saat dibuat
   setcookie('kode', '', time() - 3600, '/');
   setcookie('value', '', time() - 3600, '/');

   // Redirect ke halaman login
   header("Location: ../index.php");
   exit;
 ?>