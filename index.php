<?php 
    include("connect.php");
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
                <input type="text" name="search" placeholder="cari produk" autofocus autocomplete="off">
                <input type="submit" name="cari" value="Search" > 
            </form>
        </div>
    </div>

                <!-- category -->
    <div class="section">
        <div class="container">
            <h3>kategori</h3>
            <div class="box">
            <?php 
                $kategori = mysqli_query($konek, "SELECT * FROM category ORDER BY category_id DESC");
                if(mysqli_num_rows($kategori) > 0){
                    while($k = mysqli_fetch_array($kategori)){
            ?>
                <a href="produk.php?kat=<?php echo $k ['category_id']; ?>">
                    <div class="col-5">
                        <img src="img/iconkategori.png" width="50px" style="margin-bottom:5px;">
                            <p><?php echo $k ['category_name']; ?></p>
                    </div>
                </a>

            <?php 
                }}
                else{
            ?>
                    <p>data kategori tidak ada</p>
            <?php 
                }
            ?>
                </div>
            </div>
        </div>
    </div>

                <!-- new product -->
    <div class="section">
        <div class="container">
            <h3><img src='img/new.gif' class="ngif"></h3>
            <div class="boxpr">
                <?php
                    $produk = mysqli_query($konek, "SELECT * FROM product WHERE product_status = 1 ORDER BY product_id DESC LIMIT 12");
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
                        <p>data produk tidak ada</p>
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