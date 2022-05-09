<?php 
    include("connect.php");
    error_reporting(0);
    $kontak = mysqli_query($konek, "SELECT admin_telp, admin_email, admin_address FROM admin WHERE admin_id = 1");
    $a = mysqli_fetch_object($kontak);

    $produk = mysqli_query($konek, "SELECT * FROM product WHERE product_id = '".$_GET['id']."' ");
    $p = mysqli_fetch_object($produk);
    
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
            <h1><a href="index.php"><img src="img/lg.png" width="35px"> Danperfume</a></h1>
            <ul>
                <li><a href="index.php">Beranda</a></li>
                <li><a href="produk.php">Produk</a></li>
                <li><a href="keranjang.php">Cart</a></li>
                <li><a href="login.php">Admin Seller</a></li>
            </ul>
        </div>
    </header>

                <!-- search -->
    <div class="search">
        <div class="container">
            <form action="produk.php">
                <input type="text" name="search" placeholder="cari produk" value="<?php echo $_GET['search'] ?>" >
                <input type="hidden" name="kat" value="<?php echo $_GET['kat'] ?>" >
                <input type="submit" name="cari" value="Search" >
            </form>
        </div>
    </div>

                <!-- product detail -->
    <div class="section">
        <div class="container">
            <h3>Detail Produk</h3>
            <div class="box">
                <div class="col-2">
                    <img src="produk/<?php echo $p->product_image ?>" width="100%">
                </div>
                <div class="col-2">
                    <h3><?php echo $p->product_name ?></h3>
                    <h4>Rp. <?php echo number_format($p->product_price) ?></h4>
                    <p>deskripsi: <br>
                        <?php echo $p->product_description ?>
                    </p>
                        <a href="https://api.whatsapp.com/send?phone=<?php echo $a->admin_telp ?>&text = Hai, apakah produk ini masih tersedia? " target="_blank"><img src="img/wa.png" width="40px"> Hubungi Via Whatsapp</a>
                    <p>
                        
                    </p>
                </div>
            </div>
        </div>
    </div>
               
                <!-- footer -->
    <div class="footer">
        <div class="container">
            <h5>Alamat</h5>
            <p><?php echo $a->admin_address; ?></p>

            <h5>Email</h5>
            <p><?php echo $a->admin_email; ?></p>

            <h5>No. Hp </h5>
            <p><?php echo $a->admin_telp; ?></p>
            <small>Copyright &copy; 2022 - Danperfume.</small>
        </div>
    </div>
</body>
</html>