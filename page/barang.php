<?php 
 // session
    session_start();
    	if( !isset($_SESSION['login'])) {
    		 header("Location: ../index.php");
    		 exit;
    	}	
 // koneksi database 
      require '../function/functions.php';
// Logika penentuan keyword
$keyword = "";
$displayKeyword = ""; // Variabel untuk isi kotak input
if (isset($_POST["find"])) {
    $keyword = htmlspecialchars($_POST["keyword"]);
    // Redirect ke halaman yang sama dengan parameter GET yang bersih
    $displayKeyword = "";
    header("Location: barang.php?keyword=" . urlencode($keyword));
    exit;
} elseif (isset($_GET["keyword"])) {
    $keyword = $_GET["keyword"];
    $displayKeyword = $keyword; // Tetap tampilkan jika melalui URL/Pagination
}

// Tentukan limit per halaman
$jumlahDataPerhalaman = 2; 
// Panggil fungsi
$hasilCari = cariBarang($keyword, $jumlahDataPerhalaman);
// akses data:
$products = $hasilCari['products'];
$jumlahHalaman = $hasilCari['jumlahHalaman'];
$halamanAktif = $hasilCari['halamanAktif'];
$dataKosong = $hasilCari['dataKosong'];






// // 1. Konfigurasi Pagination
// $jumlahDataPerhalaman = 2;
// // 2. Cek apakah user sedang melakukan pencarian dengan keyword tertentu
// // Gunakan $_GET atau $_REQUEST agar keyword tetap tersimpan saat pindah halaman

// $keyword = (isset($_GET["keyword"])) ? $_GET["keyword"] : "";
// $displayKeyword = "";
//  if (isset($_POST["find"])) {
//     $keyword = htmlspecialchars($_POST["keyword"]);
//     $displayKeyword = ""; // Ini yang membuat input jadi kosong lagi

// } elseif (isset($_GET["keyword"])) {
//     $keyword = $_GET["keyword"];
//     $displayKeyword = $keyword;
// } else {
// 	  $keyword = "";
// }

// // 3. Hitung Total Data (Berdasarkan Keyword jika ada)
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

// // 4. Tentukan halaman Aktif
// $halamanAktif = (isset($_GET["page"])) ? (int)$_GET["page"] : 1;
// $awalData = ($jumlahDataPerhalaman * $halamanAktif) - $jumlahDataPerhalaman;

// // 5. Ambil Data Dengan Limit (Sesuai Keyword + Pagination)
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
// // 6. Cek jika data kosong 
//      $jumlahData = count($products);
//      	  if($jumlahData == 0) {
//            $dataKosong = true;
//   }  


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
	     	
               	<input type="text" name="keyword" autofocus placeholder="keyword Pencarian" autocomplete="off" >
	     	   </div>
	     	      <button type="submit" name="find" class="btn fill barang" onclick="setTimeout(() => { document.getElementsByName('keyword')[0].value = ''; }, 5)">Find Data</button>
                   
  <?php if (isset($_GET["keyword"]) && $_GET["keyword"] !== "") : ?>
    <a href="barang.php">
        <button type="button" class="btn fill">Refresh halaman</button>
    </a>
<?php endif; ?>



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
	 	  	 <?php if ($dataKosong) :?>
            <p style="text-align: center; color: red; font-style: italic;">Data tidak ditemukan untuk kata kunci "<strong><?= $keyword; ?></strong>"</p>
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