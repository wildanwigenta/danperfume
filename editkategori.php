<?php 
    session_start();
    include("connect.php");
    if($_SESSION['status_login'] != true){
        echo '<script>window.location="login.php"</script>';
    }
    $kategori = mysqli_query($konek, "SELECT * FROM category WHERE category_id = '".$_GET['id']."' ");
    if(mysqli_num_rows($kategori) == 0){
        echo '<script>window.location="dtkategori.php"</script>';
    }
    $k = mysqli_fetch_object($kategori);
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
                <li><a href="dtkategori.php">Data Kategori</a></li><?php  ?>
                <li><a href="dtproduk.php">Data Produk</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </header>
                <!-- content -->
    <div class="section">
        <div class="container">
            <h3>Edit Data Kategori</h3>
            <div class="box">
                <form action="" method="POST">
                    <input type="text" name="nama" placeholder="Nama Kategori" class="inputcontrol" value="<?php echo $k->category_name ?>" required>
                    <input type="submit" name="submit" value="Submit" class="btn" >
                </form>
                <?php 
                    if(isset($_POST['submit'])){

                            $nama = $_POST['nama'];
                            $update = mysqli_query($konek, "UPDATE category SET
                                                category_name = '".$nama."'
                                                WHERE category_id = '".$k->category_id."'
                                    ");
                        
                        if($update){
                            echo '<script>alert("Edit Data Kategori Berhasil")</script>';
                            echo '<script>window.location="dtkategori.php"</script>';
                        }
                        else{
                            echo 'gagal' .mysqli_error($konek);
                        }
                    }

                ?><script></script>
            </div>
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