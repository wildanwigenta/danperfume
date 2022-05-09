<?php 
    include("connect.php");
    error_reporting(0);
    $kontak = mysqli_query($konek, "SELECT admin_telp, admin_email, admin_address FROM admin WHERE admin_id = 1");
    $a = mysqli_fetch_object($kontak);
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
                <input type="text" name="search" placeholder="cari produk" value="<?php echo $_GET['search'] ?>" autofocus autocomplete="off" >
                <input type="hidden" name="kat" value="<?php echo $_GET['kat'] ?>" >
                <input type="submit" name="cari" value="Search" >
            </form>
        </div>
    </div>

                <!-- product -->
    <div class="section">
        <div class="container">
            <h3>Product</h3>
            <div class="boxpr">
                <?php 
                    if($_GET['search'] != '' || $_GET['kat'] != '') {
                        $where="AND product_name LIKE '%".$_GET['search']."%' AND category_id LIKE '%".$_GET['kat']."%' ";
                    }
                    $produk = mysqli_query($konek, "SELECT * FROM product WHERE product_status = 1 $where ORDER BY product_id DESC");
                    if(mysqli_num_rows($produk) > 0){
                        while($p = mysqli_fetch_array($produk)){
                ?>
                    <a href="detlproduk.php?id=<?php echo $p ['product_id']; ?>">
                        <div class="col-4">
                            <img src="produk/<?php echo $p ['product_image']; ?>">
                            <p class="nama"><?php echo substr($p ['product_name'], 0, 30); ?></p>
                            <a href="beli.php?id=<?php echo $p ['product_id']; ?>" class="btnbuy" >beli</a> 
                            <p class="harga">Rp. <?php echo number_format($p ['product_price']); ?></p>
                        </div>
                    </a>
                <?php 
                    }}
                    else{
                ?>
                        <p>stok habis</p>
                <?php 
                    }               
                ?>
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