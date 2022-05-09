<?php 
    session_start();
    if($_SESSION['status_login'] != true){
        echo '<script>window.location="login.php"</script>';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>danperfume</title>
    <link rel="stylesheet" href="css/style.css">
    <style>@import url('https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@300&display=swap');</style>    
</head>
<body>
                <!-- header -->
    <header>
        <div class="container">
            <h1><a href="dashboard.php"><img src="img/lg.png" width="35px"> Danperfume</a></h1>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="profil.php">Profil</a></li>
                <li><a href="dtkategori.php">Data Kategori</a></li>
                <li><a href="dtproduk.php">Data Produk</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </header>
                <!-- content -->
    <div class="section">
        <div class="container">
            <h3>Dashboard</h3>
            <div class="box">
                <h4>Welcome.. <?php echo $_SESSION['a_global']->admin_name ?> !</h4>
            </div>
                    <center><img src='img/spray-perfume.gif' class="gif"></center>
        </div>      
    </div>
    
                <!-- footer -->
    <footer>
        <div class="container">      
            <small>Copyright &copy; 2022 - Danperfume.</small>
        </div>
    </footer>
</body>
</html>