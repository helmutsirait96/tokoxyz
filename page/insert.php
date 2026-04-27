<?php 
  session_start();
    	if( !isset($_SESSION['login']) ) {
    		 header("Location: ../index.php");
    		 exit;
    	}	
 // koneksi database 
  require '../function/functions.php';

  // Tentukan nomor urut
  $noUrut = (int) substr(kodeOtomatis(), 4, 3);
  $noUrut++;

// Format kode baru
  $char = "BRG";
  $kodeBaru = $char."-".sprintf("%03s", $noUrut);

  //  cek apakah tombol submit sudah ditekan atau belum  
   if( isset($_POST["submit"]) ) {
        // cek apakah data berhasil ditambahkan atau tidak
   	if( tambahDataBarang($_POST) > 0 ) {
   		 echo "<script>
                alert('Data berhasil ditambakan');
                document.location.href = 'barang.php';
   		    </script>";
   	} else {
   		echo "<script>
                alert('Data gagal ditambakan');
                document.location.href = 'barang.php';
   		    </script>";
   	}

     }

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Insert</title>
	<link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body> 
	<main class="main-container">
	    <h1>Insert Data Barang</h1>
	    <form action="" method="post" enctype="multipart/form-data">
	    	         <div class="input-group">
	    	             <label for="kode">Kode</label>
                     <input type="text" id="kode" name="kode" value="<?= $kodeBaru; ?>" readonly="readonly" required>
	    	     	    </div>
	    	     	    
	    	     	      <div class="input-group">
	    	     	      	  <label for="nama">Nama</label>
                         <input type="text" id="nama" name="nama" required>
	    	     	      </div>
	    	     	      
	    	     	  <div class="input-group">
	    	     	  	   <label for="deskripsi">Deskripsi</label>
                     <input type="text" id="deskripsi" name="deskripsi" required>
	    	     	  	</div>
	    	     	    

	    	     	   <div class="input-group">
	    	     	  	   <label for="harga">Harga</label>
                      <input type="number" id="harga" name="harga" required>
	    	     	    </div>	
	    	     	    
	    	     	   <div class="input-group">	    	     	    
	    	     	  	   <label for="stock">Stock</label>
                     <input type="number" id="stock" name="stock" required>
	    	     	  </div>	 
	    	     	 
	    	     	   <div class="input-group">
	    	     	   	   <label for="kategori">Kategori</label>
                       <select name="kategori" id="kategori" required>
                       	   <option selected disabled value>Select Kategori</option>
                       	   <option value="Elektronik">Elektronik</option>
                       	   <option value="Pakaian">Pakaian</option>
                       	   <option value="Makanan">Makanan</option>
                       </select>
	    	     	   </div>
	    	     	  	  
	    	     	  	 <div class="input-group">
	    	     	  	 	     <label for="gambar">Gambar</label>
                       <input type="file" id="gambar" name="gambar" class="upload-gambar">
	    	     	  	 </div>
	    	     	 <button type="submit" name="submit" class="btn fill">Insert Data!</button>
	    </form>
	 </main>   
</body>
</html>