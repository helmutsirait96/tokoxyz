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
         $gambar = htmlspecialchars($barang["gambar"]);

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
         $gambar = htmlspecialchars($update["gambar"]);

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



  ?>