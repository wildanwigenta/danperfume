<?php 
    include("connect.php");
    if(isset($_GET['idk'])){
        $delete = mysqli_query($konek, "DELETE FROM category WHERE category_id = '".$_GET['idk']."' ");
        echo '<script>window.location="dtkategori.php"</script>';
    }

    if(isset($_GET['idp'])){
        $produk = mysqli_query($konek, "SELECT product_image FROM product WHERE product_id = '".$_GET['idp']."' ");
        $p = mysqli_fetch_object($produk);
        unlink('./produk/'.$p->product_image);

        $delete = mysqli_query($konek, "DELETE FROM product WHERE product_id = '".$_GET['idp']."' ");
        echo '<script>window.location="dtproduk.php"</script>';
    }

?>