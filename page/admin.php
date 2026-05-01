<?php 
      require '../function/functions.php';
       session_start();
    	if( !isset($_SESSION['login'])) {
    		 header("Location: ../index.php");
    		 exit;
    	}	
        // $_SESSION['admin'] = true;	
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="../assets/css/styles.css">
	<title>Admin Dashboard</title>
</head>
<body>
    <div class="main-dashboard-container">
           <aside class="sidebar">
            <div class="sidebar-header">
               <h1>Admin Panel</h1>
           </div>
        <nav class="nav-menu">
            <a href="#" class="nav-item">Dashboard</a>
            <div class="dropdown">
                <button class="dropdown-btn" onclick="toggleDropdown()">
                    Management 
                    <span class="arrow">▶</span>
                </button>
                <div class="dropdown-container" id="managementDropdown">
                    <a href="#">Users List</a>
                    <a href="#">Roles & Permissions</a>
                    <a href="#">Audit Logs</a>
                </div>
            </div>

            <a href="#" class="nav-item">Products</a>
            <a href="#" class="nav-item">Orders</a>
            <a href="#" class="nav-item">Settings</a>
             <a href="./barang.php" class="nav-item">Data Barang</a>
            <a href="./logout.php" class="nav-item">Logout!</a>   
        </nav>
           </aside>

       <main class="main-content">
         <header class="top-bar">
               <div class="input-group search-box">
                     <input type="text" placeholder="Search data.....">
               </div>
                <div class="user-profile">
                  <span>Welcome, <strong><?= salam(waktu(), "Admin"); ?></strong></span>
                 <img src="" alt="Avatar">
            </div>
         </header>
         <section class="content-body">
               <h2>Dashboard Overview</h2>
         </section>
    </main>
    </div>
    

    <script src="../assets/js/script.js"></script>
</body>
</html>