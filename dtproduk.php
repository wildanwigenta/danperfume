<?php 
    session_start();
    include("connect.php");
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
            <h3>Data Produk</h3>
            <div class="box">
                <p><a href="tambahproduk.php"><img src='img/plus.png'></a></p><br>
               <table  border="1" cellspacing ="0" class="table" >
                   <thead>
                       <tr>
                            <th width="60px">No</th>
                            <th>Kategori</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Gambar</th>
                            <th>Status</th>
                            <th colspan="2">Aksi</th>                           
                       </tr>
                   </thead>
                   <tbody>
                        <?php 
                            $i = 1;
                            $produk = mysqli_query($konek, "SELECT * FROM product LEFT JOIN category USING (category_id) ORDER BY product_id DESC");
                            while($row = mysqli_fetch_array($produk)){
                        ?>
                            <tr>
                                <td><?php echo $i++ ?></td>
                                <td><?php echo $row['category_name'] ?></td>
                                <td><?php echo $row['product_name'] ?></td>
                                <td>Rp. <?php echo number_format($row['product_price']) ?></td>
                                <td><a href="produk/<?php echo $row['product_image'] ?>" target="_blank"><img src="produk/<?php echo $row['product_image'] ?>" width="50px"></a></td>
                                <td><?php echo ($row['product_status'] == 0)? 'Tidak Aktif':'Aktif'; ?></td>
                                <td  width="50px">
                                        <a href="editproduk.php?id=<?php echo $row['product_id'] ?>"><img src='img/b_edit.png'></a>
                                </td>
                                <td  width="60px">
                                        <a href="proseshapus.php?idp=<?php echo $row['product_id'] ?>" onclick = "return confirm('yakin ingin hapus ?')"><img src='img/b_drop.png'></a>
                                </td>
                            </tr>
                        <?php 
                            }                        
                        ?>
                   </tbody>
               </table>
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