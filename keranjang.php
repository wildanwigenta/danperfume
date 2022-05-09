<?php 
    include("connect.php");
    error_reporting(0);

    $produk = mysqli_query($konek, "SELECT * FROM product WHERE product_id = '".$_GET['id']."' ");
    $p = mysqli_fetch_object($produk);

    session_start();

    if(empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"])){
        echo '<script>alert("Silahkan belanja terlebih dahulu")</script>';
        echo '<script>window.location="index.php"</script>';
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
            <h1><a href="index.php"><img src="img/lg.png" width="35px"> Danperfume</a></h1>
            <ul>
                <li><a href="index.php">Beranda</a></li>
                <li><a href="keranjang.php">Cart</a></li>
                <!-- jika sudah login -->
                <?php if(isset($_SESSION['c_global'])): ?>
                    <li><a href="logoutc.php">Logout</a></li>

                <!-- jika belum login -->
                <?php else: ?>
                    <li><a href="loginc.php">Login</a></li>
                <?php endif ?>
                

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

                <!-- cart -->
    <div class="section">
        <div class="container">
            <h3>keranjang</h3>
            <div class="box">
                <table  border="1" cellspacing ="0" class="table" >
                   <thead>
                       <tr>
                            <th width="60px">No</th>
                            <th>Produk</th> 
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subharga</th>
                            <th>Del</th>                           
                       </tr>
                   </thead>
                   <tbody>
                       <?php $i=1;?>
                        <?php foreach($_SESSION['keranjang'] as $product_id => $jumlah): ?> 

                                <!-- menampilkan produk yang sedang diperulangkan berdasarkan product_id -->
                                <?php
                                      
                                    $ambil = mysqli_query($konek, "SELECT * FROM product WHERE product_id='$product_id' ");
                                    $pecah = mysqli_fetch_assoc($ambil);
                                    $subharga = $pecah["product_price"] * $jumlah;
                                        // echo"<pre>";
                                        //     print_r($pecah);
                                        // echo"</pre>";
                                ?>
                                <tr>
                                    <td><?php echo $i ?></td>
                                    <td><?php echo $pecah["product_name"]; ?></td>
                                    <td>Rp. <?php echo number_format($pecah["product_price"]); ?></td>
                                    <td><?php echo $jumlah; ?></td>
                                    <td>Rp. <?php echo number_format($subharga); ?></td>
                                    <td><a href="hapuskeranjang.php?id=<?php echo $product_id ?>" onclick = "return confirm('yakin ingin hapus ?')"><img src='img/b_drop.png'></a></td>
                                    <?php $i++?>
                                </tr>                            
                        <?php endforeach ?>
                   </tbody>
               </table>                
            </div>
                <a href="index.php" class="btn-secondary">Lanjut Belanja</a> <a href="checkout.php" class="btn-primary">checkout</a>
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