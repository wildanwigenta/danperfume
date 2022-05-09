<?php 
include("connect.php");
    session_start();
    if($_SESSION['status_loginc'] != true){
        echo '<script>alert("Silahkan login terlebih dahulu")</script>';
        echo '<script>window.location="loginc.php"</script>';
    }
    $query = mysqli_query($konek, "SELECT * FROM customer WHERE customer_id = '".$_SESSION['id']."'");
    $d = mysqli_fetch_object($query);
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
                <!-- content -->
    <div class="section">
        <div class="container">
            <h3>Checkout</h3>
            <div class="box">
                <table  border="1" cellspacing ="0" class="table" >
                    <thead>
                        <tr>
                            <th width="60px">No</th>
                            <th>Produk</th> 
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subharga</th>                          
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1;?>
                        <?php $totalbelanja=0; ?>
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
                                <?php $totalbelanja+=$subharga ?>
                                <?php $i++?>
                            </tr>               
                        <?php endforeach ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4">Total Belanja</th>
                            <th>Rp. <?php echo number_format($totalbelanja); ?></th>
                        </tr>
                    </tfoot>
                </table><br>

                <center>                                      
                    <div class="pur">
                        <p>Nama     : <?php echo $d->customer_name ?></p>   
                        <p>No telp  : <?php echo $d->customer_telp ?></p>
                        <p>Email    : <?php echo $d->customer_email ?></p><br>
                        <p>Alamat    : <?php echo $d->customer_address ?></p>
                    </div>                    
                </center><br>
                
                <center>
                    <div class="purc">
                        <h5>Silahkan Melakukan Pembayaran Rp. <?php echo number_format($totalbelanja); ?> ke</h5>
                        <h4>--  BANK BRI 137-003650-3496 'Wildan Wigenta'  --</h4>
                    </div>          
                </center>

            </div>
                <center>   barang segera dikirim ke alamat    </center>
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