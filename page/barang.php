<?php 
    // koneksi database 
      require '../function/functions.php';
      // query data dari database toko 
      $products = query("Select * FROM products"); 
      // $result = mysqli_query($db, "SELECT * FROM products"); 
      // ambil data dari object result (fetch)
      // mysqli_fetch_row()  -> array numerik
      // mysqli_fetch_assoc() -> mengembalikan array associative
      // mysqli_fetch_array() -> Mengembalikan keduanya 
      // mysqli_fetch_object() -> Megembalikan object 




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
	</div>
	 <table>
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