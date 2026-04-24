<?php 
    session_start();
    	if( !isset($_SESSION['login'])) {
    		 header("Location: ../index.php");
    		 exit;
    	}	

 // koneksi database 
      require '../function/functions.php';
 // pagination
    $products = query("SELECT * FROM products LIMIT $awalData, $jumlahDataPerhalaman"); 
  



  // Tombol cari Ditekan
     if( isset($_POST["find"]) ) {
     	  // mendapatkan apapun yang di ketik kan oleh user
          //  $products = cariBarang($_GET["keyword"]);	
     	    //  $jumlahData = count($products);
     	    //  if($jumlahData == 0) {
          //         $dataKosong = true;
          // }
           $_SESSION["keyword"] = $_POST["keyword"];
           $halamanAktif = 1; // Reset ke halaman 1 setiap kali cari baru
           // Ambil keyword dari session jika ada, jika tidak kosongkan
           $keyword = (isset($_SESSION["keyword"])) ? $_SESSION["keyword"] : "";
           // 2. Konfigurasi Pagination
           $jumlahDataPerhalaman = 2;
         // Hitung jumlah data berdasarkan keyword di session
         $queryHitung = "SELECT * FROM products WHERE 
                nama LIKE '%$keyword%' OR 
                kode LIKE '%$keyword%' OR 
                harga LIKE '%$keyword%' OR
                stock LIKE '%$keyword%' OR
               kategori LIKE '%$keyword%'";
          $jumlahData = count(query($queryHitung));
         $jumlahHalaman = ceil($jumlahData / $jumlahDataPerhalaman);
         $halamanAktif = (isset($_GET["page"])) ? $_GET["page"] : 1;
        $awalData = ($jumlahDataPerhalaman * $halamanAktif) - $jumlahDataPerhalaman;
      // 3. Ambil data dengan LIMIT
       $products = query("$queryHitung LIMIT $awalData, $jumlahDataPerhalaman"); 

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
<body style="display: flex; flex-direction: column; "> 
	<main class="main-data-barang">
	<div class="insert">
        <div class="menu-barang">
		   <a href="main-page.php">Home</a>
	 	   <a href="admin.php">Admin Dashboard</a>
         <a href="insert.php" class="btn" target="_blank">Insert Data</a> 
        </div>
	     <form action="" method="post" class="form-cari">
               <div class="input-group search-box">
	     	      <input type="text" name="keyword" autofocus placeholder="keyword Pencarian" autocomplete="off">
	     	   </div>
	     	      <button type="submit" name="find" class="btn fill barang">Find Data</button>
	     </form>
	     <!-- navigasi -->
	     <div class="nav-pagination">
         <?php if( $halamanAktif > 1 ) : ?>
	         	<a href="?page=<?= $halamanAktif - 1; ?>">&laquo;</a>
          <?php endif; ?> 	

	     	   <?php for($i = 1; $i <= $jumlahHalaman; $i++) : ?>
	     	   	<?php if( $i == $halamanAktif ) : ?>
                 <a href="?page=<?= $i; ?>" style="font-weight: bold; color:red;"><?= $i; ?></a>
              <?php else : ?>
                 <a href="?page=<?= $i; ?>"><?= $i; ?></a>  
              <?php endif; ?> 
	        <?php endfor; ?> 
	               <?php if( $halamanAktif < $jumlahHalaman ) : ?>
	         	<a href="?page=<?= $halamanAktif + 1; ?>">&raquo;</a>
          <?php endif; ?> 	
	     </div>
	     	<!-- end navigation -->
	</div>
	 <table>
	 	 
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
            <p style="collor: red; font-size: 1.5em;">Data Tidak Ditemukan!</p>
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
	 	  	  	   	 <a href="update.php?no=<?= $row["no"]; ?>" class="btn fill aksi" target="_blank">update</a>
	 	  	  	   	 <a href="delete.php?no=<?= $row["no"] ?>" class="btn fill aksi" onclick="return confirm('yakin dihapus?')">delete</a>
	 	  	  	   </td>
	 	  	  </tr>
	 	  	  <?php $urutan++; ?>
	 	   <?php endforeach; ?>	  
	 	  </tbody>
	 </table>
	</main> 
</body>
</html>