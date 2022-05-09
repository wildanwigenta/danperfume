<?php 
    include("connect.php");
    error_reporting(0);  
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

                <!-- purchase -->
    <div class="section">
        <div class="container">
            <h3>Keranjang Pembelian</h3>
            <div class="box">
                <div class="col-2">
                    <p>test</p>
                </div>
                <div class="col-2">
                    <?php 
                            session_start();
                            $product_id = $_GET['id'];

                            if(isset($_SESSION['keranjang'][$product_id])){
                                $_SESSION['keranjang'][$product_id] += 1;
                            }
                            else{
                                $_SESSION['keranjang'][$product_id] = 1;
                            }
      
                                    //menuju ke halaman keranjang
                            echo'<script>alert("produk dimasukan ke keranjang belanja")</script>';
                            echo'<script>window.location="keranjang.php"</script>';
                    ?>
                </div>
            </div>
        </div>
    </div>
               