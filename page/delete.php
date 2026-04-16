<?php 
 session_start();
        if( !isset($_SESSION['login']) ) {
             header("Location: ../index.php");
             exit;
        }   
    // koneksi database 
  require '../function/functions.php';
   $no = $_GET["no"];
   if( hapusData($no) > 0  ) {
   	  echo "<script>
                alert('Data berhasil dihapus');
                document.location.href = 'barang.php';
   		    </script>";
   } else {
   	  "<script>
                alert('Data gagal dihapus');
                document.location.href = 'barang.php';
   		    </script>";
   }

 ?>