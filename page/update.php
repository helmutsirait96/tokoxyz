<?php 
  session_start();
    	if( !isset($_SESSION['login']) ) {
    		 header("Location: ../index.php");
    		 exit;
    	}	
 // koneksi database 
   require '../function/functions.php';
 // ambil data di URL
  $no = $_GET["no"];  
  // query data barang berdasarkan no 
  $pro = query("SELECT * FROM products WHERE no = $no")[0];



  // enum values 
  $enum = query("SHOW COLUMNS FROM products LIKE 'kategori'")[0];
  // ambil sebagian string di nilai enum
  $enum_values = explode("'", substr($enum["Type"], 5, -1));
  // hapus string kosong pada nilai enum
  $enum_values = array_filter($enum_values, function($value){
          return   $value != '' && $value != ',';
  });

// ambil data yang dipilih 
  $kategori = query("SELECT kategori FROM products WHERE no = $no")[0];
  $selected_value = $kategori["kategori"]; 



  //  cek apakah tombol submit sudah ditekan atau belum  
   if( isset($_POST["submit"]) ) {
        // cek apakah data berhasil diubah atau tidak
   	if( updateData($_POST) > 0 ) {
   		 echo "<script>
                alert('Data berhasil diupdate');
                document.location.href = 'barang.php';

   		    </script>";
   	} else {
   		echo "<script>
                alert('Data gagal diupdate');
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
	<title>Update</title>
	<link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body> 
	    <h1>Update Data Barang</h1>
	    <form action="" method="post" class="update-form" enctype="multipart/form-data">
	    	     <input type="hidden" name="no" value="<?= $pro["no"]; ?>">
	    	     <input type="hidden" name="gambarLama" value="<?= $pro["gambar"]; ?>">
	    	     <ul>
	    	     	  <li>
	    	     	  	   <label for="kode">
	    	     	  	   Kode
                       <input type="text" id="kode" name="kode" value="<?= $pro["kode"]; ?>" readonly>
	    	     	  	  </label>
	    	     	  </li> 
	    	     	  <li>
	    	     	  	   <label for="nama">
	    	     	  	   Nama
                       <input type="text" id="nama" name="nama" value="<?= $pro["nama"]; ?>">
	    	     	  	  </label>
	    	     	  </li> 
	    	     	  <li>
	    	     	  	   <label for="deskripsi">
	    	     	  	   Deskripsi
                       <input type="text" id="deskripsi" name="deskripsi" required value="<?= $pro["deskripsi"]; ?>">
	    	     	  	  </label>
	    	     	  </li>
	    	     	  <li>
	    	     	  	   <label for="harga">
	    	     	  	   Harga
                       <input type="number" id="harga" name="harga" value="<?= $pro["harga"]; ?>">
	    	     	  	  </label>
	    	     	  </li> 
	    	     	   <li>
	    	     	  	   <label for="stock">
	    	     	  	   Stock
                       <input type="number" id="stock" name="stock" value="<?= $pro["stock"]; ?>">
	    	     	  	  </label>
	    	     	  </li>
	    	     	  <li>
	    	     	  	   <label for="kategori">
	    	     	  	   Kategori


                       <select name="kategori" id="kategori">
                       	   <?php foreach ($enum_values as $value) : ?>
                               
                            <?php if ($value == $selected_value) :?>
                               <option value="<?= $value; ?>" selected><?= $value; ?></option>        
                              <?php else: ?>     
                                    <option value="<?= $value; ?>"><?= $value; ?></option>                      
                            <?php endif; ?>

                       	   <?php endforeach; ?> 	
                       </select>
	    	     	  	  </label>
	    	     	  </li>
	    	     	  <li>
	    	     	  	   <label for="gambar">
	    	     	  	   Gambar
	    	     	  	   <img src="../assets/images/<?= $pro["gambar"]; ?>" alt="" style="display: block;" width="40">
                       <input type="file" id="gambar" name="gambar">
	    	     	  	  </label>
	    	     	  </li>
	    	     	  <li>
	    	     	  	   <button type="submit" name="submit" class="btn">Update Data</button>
	    	     	  </li>
	    	     </ul>
	    </form>
</body>
</html>