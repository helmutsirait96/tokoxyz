<?php 
    session_start();
    	if( !isset($_SESSION['login'])) {
    		 header("Location: ../index.php");
    		 exit;
    	}	


    	
 // koneksi database 
      require '../function/functions.php';
 // Tampilkan seluruh data barang
      $products = query("Select * FROM products"); 
  // Tombol cari Ditekan
     if( isset($_POST["find"]) ) {
     	  // mendapatkan apapun yang di ketik kan oleh user
           $products = cariBarang($_POST["keyword"]);	 
     	     $jumlahData = count($products);
     	     if($jumlahData == 0) {
                  $dataKosong = true;
          }

       }
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Barang</title>
	<link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body> 
	<div class="insert">
	     <a href="insert.php" class="btn" target="_blank">Insert Data</a> 
	     <form action="" method="post" class="form-cari">
	     	      <input type="text" name="keyword" autofocus placeholder="keyword Pencarian" autocomplete="off">
	     	      <button type="submit" name="find" class="btn">Find Data</button>
	     </form>
	</div>
	 <table>
	 	  <a href="main-page.php">Home</a>
	 	  <a href="admin.php">Admin Dashboard</a>
	 	  <caption class="title">
	 	     <strong>Barang</strong>
	 	</caption>
	 	  <thead>
	 	  	    <tr>
	 	  	    	  <th>No</th>
	 	  	    	  <th>Gambar</th>
	 	  	    	  <th>Kode</th>
	 	  	    	  <th>Nama</th>
	 	  	    	  <th>Deskripsi</th>
	 	  	    	  <th>Harga</th>
	 	  	    	  <th>Stock</th>
	 	  	    	  <th>Kategori</th>
	 	  	    	  <th>Aksi</th>
	 	  	    </tr>
	 	  </thead>
	 	  <tbody>
	 	  	 <?php if (isset($dataKosong)) :?>
            <p style="collor: red; font-size: 1.5em;">Data Tidak Ditemukkan!</p>
	 	  	<?php endif; ?>
	 	  	<?php $urutan = 1; ?>
	 	  	<?php  foreach( $products as $row ) : ?>	
	 	  		 <?php if($urutan % 2 == 0): ?>
	 	  	  <tr class="baris">
	 	  	       <?php else: ?>
	 	  	  <tr>
	 	  	  <?php endif; ?>	
	 	  	  	   <td><?= $urutan; ?></td>
	 	  	  	   <td>
	 	  	  	   	  <img src="../assets/images/<?= $row["gambar"]; ?>" alt="" width="50">
	 	  	  	   </td>
	 	  	  	   <td><?= $row["kode"]; ?></td>
	 	  	  	   <td><?= $row["nama"]; ?></td>
	 	  	  	   <td><?= $row["deskripsi"]; ?></td>
	 	  	  	   <td><?= $row["harga"]; ?></td>
	 	  	  	   <td><?= $row["stock"]; ?></td>
	 	  	  	   <td><?= $row["kategori"]; ?></td>
	 	  	  	    <td>
	 	  	  	   	 <a href="update.php?no=<?= $row["no"]; ?>" class="btn" target="_blank">update</a>
	 	  	  	   	 <a href="delete.php?no=<?= $row["no"] ?>" class="btn" onclick="return confirm('yakin dihapus?')">delete</a>
	 	  	  	   </td>
	 	  	  </tr>
	 	  	  <?php $urutan++; ?>
	 	   <?php endforeach; ?>	  
	 	  </tbody>
	 </table>
</body>
</html>