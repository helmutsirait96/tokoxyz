<?php 
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
	    <h1>Insert Data Barang</h1>
	    <form action="" method="post" enctype="multipart/form-data">
	    	     <ul>
	    	     	  <li>
	    	     	  	   <label for="kode">
	    	     	  	   Kode
                       <input type="text" id="kode" name="kode" value="<?= $kodeBaru; ?>" readonly="readonly" required>
	    	     	  	  </label>
	    	     	  </li> 
	    	     	  <li>
	    	     	  	   <label for="nama">
	    	     	  	   Nama
                       <input type="text" id="nama" name="nama" required>
	    	     	  	  </label>
	    	     	  </li> 
	    	     	  <li>
	    	     	  	   <label for="deskripsi">
	    	     	  	   Deskripsi
                       <input type="text" id="deskripsi" name="deskripsi" required>
	    	     	  	  </label>
	    	     	  </li>
	    	     	  <li>
	    	     	  	   <label for="harga">
	    	     	  	   Harga
                       <input type="number" id="harga" name="harga" required>
	    	     	  	  </label>
	    	     	  </li> 
	    	     	   <li>
	    	     	  	   <label for="stock">
	    	     	  	   Stock
                       <input type="number" id="stock" name="stock" required>
	    	     	  	  </label>
	    	     	  </li>
	    	     	  <li>
	    	     	  	   <label for="kategori">
	    	     	  	   Kategori
                       <select name="kategori" id="kategori" required>
                       	   <option selected disabled value>Select Kategori</option>
                       	   <option value="Elektronik">Elektronik</option>
                       	   <option value="Pakaian">Pakaian</option>
                       	   <option value="Makanan">Makanan</option>
                       </select>
	    	     	  	  </label>
	    	     	  </li>
	    	     	  <li>
	    	     	  	   <label for="gambar">
	    	     	  	   Gambar
                       <input type="file" id="gambar" name="gambar" class="upload-gambar">
	    	     	  	  </label>
	    	     	  </li>
	    	     	  <li>
	    	     	  	   <button type="submit" name="submit" class="btn">Insert Data!</button>
	    	     	  </li>
	    	     </ul>
	    </form>
</body>
</html>