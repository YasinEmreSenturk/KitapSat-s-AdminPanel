<?php

include 'yapilandirma.php';

session_start();

$uye_id = $_SESSION['uye_id'];

if(!isset($uye_id)){
   header('location:giris_yap.php');
}

?>


<!DOCTYPE html>
<html lang="tr">
<head>
   
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Siparişler</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/main2.css">
   
   <style>
      
        .heading{
            margin-top: 150px;
            min-height: 400px;
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),url('img/heading-bg2.jpg') no-repeat;
            background-size: cover;
            background-position: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .heading h3{
            font-size: 5rem;
            color:var(--white);
            text-transform: uppercase;
        }

        .heading p{
            font-size: 2.5rem;
            color:var(--white);
        }

        .heading p a{
            color:var(--white);
        }

        .heading p a:hover{
            text-decoration: underline;
        }

   </style>

</head>

<body>

<?php include 'baslik.php';?>

<div class="heading">
   <h3>Siparişler</h3>
   <p> <a href="anasayfa.php">Anasayfa</a> / Siparişler </p>
</div>

<section class="placed-orders">

   <h1 class="title">Verilen Siparisler</h1>

    <div class="box-container">

        <?php
            $siparis_sorgusu = mysqli_query($baglan, "SELECT * FROM `siparisler` WHERE kullanici_id = '$uye_id'") or die('query failed');
            if(mysqli_num_rows($siparis_sorgusu) > 0){
                while($siparis_getir = mysqli_fetch_assoc($siparis_sorgusu)){
        ?>
        <div class="box">
            <p> Verilen Tarih : <span><?php echo $siparis_getir['siparis_tarih']; ?></span> </p>
            <p> Adı Soyadı : <span><?php echo $siparis_getir['kullanici_ad']; ?> 
                        <span><?php echo $siparis_getir['kullanici_soyad']; ?></span> </p>
            <p> Tel No : <span><?php echo $siparis_getir['kullanici_numara']; ?></span> </p>
            <p> Mail : <span><?php echo $siparis_getir['kullanici_mail']; ?></span> </p>
            <p> Adres : <span><?php echo $siparis_getir['kullanici_adres']; ?></span> </p>
            <p> Ödeme Türü : <span><?php echo $siparis_getir['odeme_turu']; ?></span> </p>
            <p> Siparişlerin : <span><?php echo $siparis_getir['toplam_urunler']; ?></span> </p>
            <p> Toplam Fiyat: <span>$<?php echo $siparis_getir['toplam_ucret']; ?>/-</span> </p>
            <p> Ödeme Durumu : <span style="color:<?php if($siparis_getir['odeme_durumu'] == 'askıda'){ echo 'red'; }else{ echo 'green'; } ?>;"><?php echo $siparis_getir['odeme_durumu']; ?></span> </p>
            </div>
        <?php
        }
        }else{
            echo '<p class="empty">Henüz bir sipariş verilmemiş!</p>';
        }
        ?>
    </div>

</section>


<?php include 'altbaslik.php'; ?>

<script src="js/script.js"></script>

</body>
</html>