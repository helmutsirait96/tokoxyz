<?php 
 // database
 $db = mysqli_connect("localhost", "root", "", "toko");
  function query($query) {
  	    global $db;
       $result = mysqli_query($db, $query);
       $rows = [];
       while( $row = mysqli_fetch_assoc($result) ) {
       	  $rows[] = $row; 
       }
       return $rows;
 }

// Upload Gambar
 function uploadGambar() {
      $nama_file = $_FILES["gambar"]["name"]; // nama file
      $ukuran_gambar = $_FILES["gambar"]["size"]; // ukuran gambar
      $error = $_FILES["gambar"]["error"]; // error pada gambar
      $tmp_image = $_FILES["gambar"]["tmp_name"]; // tempat peyimpanan sementara

      // cek apakah tidak ada gambar yang diupload 
      if( $error === 4 ) {
          echo "<script>
                 alert('Pilih gambar terlebih dahulu!');
               </script>";
          return false;     
      }  

      // cek apakah yang diupload gambar 
      $ekstensiGambarValid = ["jpg", "jpeg", "png"];
      $ektensiGambar = explode('.', $nama_file);
      $ektensiGambar = strtolower(end($ektensiGambar));
      if( !in_array($ektensiGambar, $ekstensiGambarValid) ) {
           echo "<script>
                 alert('yang ada upload bukan gambar!');
               </script>";
          return false;     
      }

      // cek jika ukuran terlalu besar
      if( $ukuran_gambar > 1000000 ) {
             echo "<script>
                 alert('Ukuran gambar terlalu besar!');
               </script>";
          return false;     
      }

      // lolos pengecekan gambar siap di upload 
      // generate nama baru pada gambar 
      $nama_file_baru = uniqid();
      $nama_file_baru .= '.';
      $nama_file_baru .= $ektensiGambar;
      // var_dump($nama_file_baru);die;
      move_uploaded_file($tmp_image, '../assets/images/' . $nama_file_baru);
      return $nama_file_baru; 



 }

 // Tambah Data Barang 
 function tambahDataBarang($barang) {
        // ambil data dari tiap elemen dalam form
         global $db;
         $kode = htmlspecialchars($barang["kode"]);
         $nama = htmlspecialchars($barang["nama"]);
         $deskripsi = htmlspecialchars($barang["deskripsi"]);
         $harga = htmlspecialchars($barang["harga"]);
         $stock = htmlspecialchars($barang["stock"]);
         $kategori = htmlspecialchars($barang["kategori"]);

   // upload gambar 
    $gambar = uploadGambar();
    if( !$gambar ) {
        return $gambar;
    } 

   // query insert data
          $query = "INSERT INTO products
                    VALUES
                    ('', '$kode', '$nama', '$deskripsi', '$harga', '$stock', '$gambar', '$kategori')
                  ";
           mysqli_query($db, $query);

           return mysqli_affected_rows($db);
 } 




// Kode Otomatis 
 function kodeOtomatis() {
       global $db;
       $query = "SELECT max(kode) as maxKode FROM products";
       $result = mysqli_query($db, $query);
       $data = mysqli_fetch_assoc($result);
       
       $kodeBarang = $data["maxKode"]; 
       return $kodeBarang;  
 }

 // Hapus Data
 function hapusData($no) {
         global $db;
         mysqli_query($db, "DELETE FROM products WHERE no = $no");
         return mysqli_affected_rows($db);
 }

// Update Data 
 function updateData($update) {
           // ambil data dari tiap elemen dalam form
         global $db;
         $no = $update["no"];
         $kode = htmlspecialchars($update["kode"]);
         $nama = htmlspecialchars($update["nama"]);
         $deskripsi = htmlspecialchars($update["deskripsi"]);
         $harga = htmlspecialchars($update["harga"]);
         $stock = htmlspecialchars($update["stock"]);
         $kategori = htmlspecialchars($update["kategori"]);
        // Gambar lama 
         $gambarLama = htmlspecialchars($update["gambarLama"]);

         // cek user pilih gambar baru atau tidak 
         if( $_FILES["gambar"]["error"] === 4 ) {
              $gambar = $gambarLama;
         } else {
              // gambar Baru
              $gambar = uploadGambar();
         }
         
      // query update data
          $query = "UPDATE products SET
                    kode = '$kode', 
                    nama = '$nama',
                    deskripsi = '$deskripsi',
                     harga = '$harga',
                     stock = '$stock',
                     gambar = '$gambar',
                     kategori = '$kategori' 
                     WHERE no = $no
                  ";
           mysqli_query($db, $query);
         // return angka ketika data ada yang diupdate
           return mysqli_affected_rows($db);
 }

//  Cari Barang & pagination
 // Konfigurasi pagination
     // jumlah data perhalaman 
    $jumlahDataPerhalaman = 2;
    // jumlah halaman = total data / data perhalaman
    // Jumlah data yang ada di dalam database
    $jumlahData = count(query("SELECT * FROM products"));
    // jumlah halaman yang mau di tampilkan
    $jumlahHalaman = ceil($jumlahData / $jumlahDataPerhalaman);
    // mengambil halaman aktif
    $halamanAktif = ( isset($_GET["page"]) ) ? $_GET["page"] : 1;
    // awal data perhalaman
    $awalData = ($jumlahDataPerhalaman * $halamanAktif) - $jumlahDataPerhalaman;
    // halaman = 2, awal data = 3 

function cariBarang($keyword) {
     $query = "SELECT * FROM products
               WHERE 
               nama LIKE '%$keyword%' OR
               kode LIKE '%$keyword%' OR
               harga LIKE '%$keyword%' OR
               stock LIKE '%$keyword%' OR
               kategori LIKE '%$keyword%'
              ";
      return query($query);        
}

// Function Register User
   function registerUser($register) {
         global $db;

         $username =  strtolower(stripcslashes($register["username"]));
         $password = mysqli_real_escape_string($db, $register["password"]);
         $confirmpassword = mysqli_real_escape_string($db, $register["confirm"]);
         $email = strtolower(stripcslashes($register["email"]));
        
         // cek username sudah ada atau belum 
         $result = mysqli_query($db, "SELECT username FROM users WHERE username = '$username'");
          if( mysqli_fetch_assoc($result) ) {
               echo "
                  <script>
                    alert('username sudah terdaftar');
                  </script>
               ";
               return false;
          } 


        // Cek Konfirmasi password
         if( $password !== $confirmpassword ) {
              echo "<script>
                  alert('Konfimasi password tidak sesuai');
                </script>";
              return false;   
         }

         // Engkripsi password 
         $password = password_hash($password, PASSWORD_DEFAULT);
         // add user ke dalam database 
         mysqli_query($db, "INSERT INTO users VALUES('', '$username', '$password', '$email')");

         return mysqli_affected_rows($db);
   }



  ?>