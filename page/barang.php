<?php 
    session_start();
    	if( !isset($_SESSION['login'])) {
    		 header("Location: ../index.php");
    		 exit;
    	}	

 // koneksi database 
      require '../function/functions.php';
 // pagination
    // $products = query("SELECT * FROM products LIMIT $awalData, $jumlahDataPerhalaman"); 
  
  // Tombol cari Ditekan
     // if( isset($_POST["find"]) ) {
     // 	  // mendapatkan apapun yang di ketik kan oleh user
     //       $products = cariBarang($_POST["keyword"]);	
     //       // jika data kosong 
     // 	     $jumlahData = count($products);
     // 	     if($jumlahData == 0) {
     //              $dataKosong = true;
     //      }  
     // }  
     
// 1. KONFIGURASI PAGINATION
// $jumlahDataPerhalaman = 2;

// 2. CEK APAKAH USER SEDANG MENCARI SESUATU
// Gunakan $_GET atau $_REQUEST agar keyword tetap tersimpan saat pindah halaman
// $keyword = "";
// if (isset($_POST["find"])) {
//     $keyword = $_POST["keyword"];
// } elseif (isset($_GET["keyword"])) {
//     $keyword = $_GET["keyword"];
// }

// // 3. HITUNG TOTAL DATA (Berdasarkan Keyword jika ada)
// if ($keyword != "") {
//     $queryHitung = "SELECT * FROM products WHERE 
//                     nama LIKE '%$keyword%' OR 
//                     kode LIKE '%$keyword%' OR 
//                     harga LIKE '%$keyword%' OR
//                     stock LIKE '%$keyword%' OR
//                     kategori LIKE '%$keyword%'";
// } else {
//     $queryHitung = "SELECT * FROM products";
// }

// $hasilHitung = query($queryHitung);
// $jumlahData = count($hasilHitung);
// $jumlahHalaman = ceil($jumlahData / $jumlahDataPerhalaman);

// // 4. TENTUKAN HALAMAN AKTIF
// $halamanAktif = (isset($_GET["page"])) ? (int)$_GET["page"] : 1;
// $awalData = ($jumlahDataPerhalaman * $halamanAktif) - $jumlahDataPerhalaman;

// // 5. AMBIL DATA DENGAN LIMIT (Sesuai Keyword + Pagination)
// if ($keyword != "") {
//     $queryData = "SELECT * FROM products WHERE 
//                   nama LIKE '%$keyword%' OR 
//                   kode LIKE '%$keyword%' OR 
//                   harga LIKE '%$keyword%' OR
//                   stock LIKE '%$keyword%' OR
//                   kategori LIKE '%$keyword%' 
//                   LIMIT $awalData, $jumlahDataPerhalaman";
// } else {
//     $queryData = "SELECT * FROM products LIMIT $awalData, $jumlahDataPerhalaman";
// }

// $products = query($queryData);

// // 6. CEK JIKA DATA KOSONG
// if ($jumlahData == 0) {
//     $dataKosong = true;
// }


// KONFIGURASI PAGINATION
$jumlahDataPerhalaman = 2;

// CEK APAKAH USER SEDANG MENCARI SESUATU
// Ambil keyword dari URL (pakai method GET agar pagination sinkron)
$keyword = (isset($_GET["keyword"])) ? $_GET["keyword"] : "";
$displayKeyword = "";
if (isset($_POST["find"])) {
    $keyword = $_POST["keyword"];
    $displayKeyword = ""; // Ini yang membuat input jadi kosong lagi

} elseif (isset($_GET["keyword"])) {
    $keyword = $_GET["keyword"];
    $displayKeyword = $keyword;
} else {
	  $keyword = "";
}

// 3. HITUNG TOTAL DATA (Berdasarkan Keyword jika ada)
if ($keyword != "") {
    $queryHitung = "SELECT * FROM products WHERE 
                    nama LIKE '%$keyword%' OR 
                    kode LIKE '%$keyword%' OR 
                    harga LIKE '%$keyword%' OR
                    stock LIKE '%$keyword%' OR
                    kategori LIKE '%$keyword%'";
} else {
    $queryHitung = "SELECT * FROM products";
}

$hasilHitung = query($queryHitung);
$jumlahData = count($hasilHitung);
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerhalaman);

// 4. TENTUKAN HALAMAN AKTIF
$halamanAktif = (isset($_GET["page"])) ? (int)$_GET["page"] : 1;
$awalData = ($jumlahDataPerhalaman * $halamanAktif) - $jumlahDataPerhalaman;

//  ambil data dengan LIMIT (Sesuai Keyword + Pagination)
if ($keyword != "") {
    $queryData = "SELECT * FROM products WHERE 
                  nama LIKE '%$keyword%' OR 
                  kode LIKE '%$keyword%' OR 
                  harga LIKE '%$keyword%' OR
                  stock LIKE '%$keyword%' OR
                  kategori LIKE '%$keyword%' 
                  LIMIT $awalData, $jumlahDataPerhalaman";
} else {
    $queryData = "SELECT * FROM products LIMIT $awalData, $jumlahDataPerhalaman";
}

$products = query($queryData);

 // cek jika data kosong
if ($jumlahData == 0) {
    $dataKosong = true;
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
	     	      <input type="text" name="keyword" autofocus placeholder="keyword Pencarian" autocomplete="off" value="<?= $displayKeyword; ?>">
	     	   </div>
	     	      <button type="submit" name="find" class="btn fill barang">Find Data</button>
	     </form>
	     <!-- navigasi -->
	     <div class="nav-pagination">
         <?php if( $halamanAktif > 1 ) : ?>
	         	<a href="?page=<?= $halamanAktif - 1; ?>&keyword=<?= $keyword; ?>" class="prev">Previous</a>
          <?php endif; ?> 	

	     	   <?php for($i = 1; $i <= $jumlahHalaman; $i++) : ?>
	     	   	<?php if( $i == $halamanAktif ) : ?>
                 <a href="?page=<?= $i; ?>&keyword=<?= $keyword; ?>" style="font-weight: bold; color: greenyellow; background-color: black;"><?= $i; ?></a>
              <?php else : ?>
                 <a href="?page=<?= $i; ?>&keyword=<?= $keyword; ?>"><?= $i; ?></a>  
              <?php endif; ?> 
	        <?php endfor; ?> 
	               <?php if( $halamanAktif < $jumlahHalaman ) : ?>
	         	<a href="?page=<?= $halamanAktif + 1; ?>&keyword=<?= $keyword; ?>" class="next">Next</a>
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