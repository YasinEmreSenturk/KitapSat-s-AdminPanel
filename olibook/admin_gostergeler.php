<?php

include 'yapilandirma.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:giris_yap.php');
}

?>

<!DOCTYPE html>
<html lang="tr">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
   <title>Yönetim Paneli: Göstergeler</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/admin_style2.css">

   <style>
      .dashboard .box-container{
         display: grid;
         grid-template-columns: repeat(auto-fit, minmax(25rem, 1fr));
         gap:1.5rem;
         max-width: 1200px;
         margin:0 auto;
         align-items: flex-start;
      }

      .dashboard .box-container .box{
         border-radius: .5rem;
         padding:2rem;
         background-color: var(--white);
         box-shadow: var(--box-shadow);
         border:var(--border);
         text-align: center;
      }

      .dashboard .box-container .box h3{
         font-size: 5rem;
         color:var(--black); 
      }

      .dashboard .box-container .box p{
         margin-top: 1.5rem;
         padding:1.5rem;
         background-color: var(--light-bg);
         color:var(--purple);
         font-size: 2rem;
         border-radius: .5rem;
         border:var(--border);
      }
   </style>
</head>
<body>
   
<?php 

include 'admin_baslik.php';
?>

<section class="dashboard">

   <h1 class="title">Göstergeler</h1>

   <div class="box-container">

      <div class="box">
         <?php
            $toplam_aski = 0;
            $secili_aski = mysqli_query($baglan, "SELECT toplam_ucret FROM `siparisler` WHERE odeme_durumu = 'askıda'") or die('sss');
            if(mysqli_num_rows($secili_aski) > 0){
               while($askilari_getir = mysqli_fetch_assoc($secili_aski)){
                  $toplam_ucret = $askilari_getir['toplam_ucret'];
                  $toplam_aski += $toplam_ucret;
               };
            };
         ?>
         <h3><?php echo $toplam_aski; ?>₺/-</h3>
         <p>Askıdaki Ödeme</p>
      </div>

      <div class="box">
         <?php
            $toplam_tamamlanan = 0;
            $secili_tamamlanan = mysqli_query($baglan, "SELECT toplam_ucret FROM `siparisler` WHERE odeme_durumu = 'tamamlandı'") or die('query failed');
            if(mysqli_num_rows($secili_tamamlanan) > 0){
               while($tamamlanan_getir = mysqli_fetch_assoc($secili_tamamlanan)){
                  $toplam_ucret = $tamamlanan_getir['toplam_ucret'];
                  $toplam_tamamlanan += $toplam_ucret;
               };
            };
         ?>
         <h3><?php echo $toplam_tamamlanan; ?>₺/-</h3>
         <p>Tamamlanan Ödeme</p>
      </div>

      <div class="box">
         <?php 
            $secili_siparisler = mysqli_query($baglan, "SELECT * FROM `siparisler`") or die('query failed');
            $siparis_sayisi = mysqli_num_rows($secili_siparisler);
         ?>
         <h3><?php echo $siparis_sayisi; ?></h3>
         <p>Alınan Sipariş</p>
      </div>

      <div class="box">
         <?php 
            $secili_urunler = mysqli_query($baglan, "SELECT * FROM `urunler`") or die('query failed');
            $urun_sayisi = mysqli_num_rows($secili_urunler);
         ?>
         <h3><?php echo $urun_sayisi; ?></h3>
         <p>Ürün Eklendi</p>
      </div>

      <div class="box">
         <?php 
            $secili_kullanicilar = mysqli_query($baglan, "SELECT * FROM `kullanicilar` WHERE kullanici_tipi = 'uye'") or die('query failed');
            $kullanci_sayisi = mysqli_num_rows($secili_kullanicilar);
         ?>
         <h3><?php echo $kullanci_sayisi; ?></h3>
         <p>Normal Üye</p>
      </div>

      <div class="box">
         <?php 
            $secili_adminler = mysqli_query($baglan, "SELECT * FROM `kullanicilar` WHERE kullanici_tipi = 'admin'") or die('query failed');
            $admin_sayisi = mysqli_num_rows($secili_adminler);
         ?>
         <h3><?php echo $admin_sayisi; ?></h3>
         <p>Admin Üye</p>
      </div>

      <div class="box">
         <?php 
            $secili_hesap = mysqli_query($baglan, "SELECT * FROM `kullanicilar`") or die('query failed');
            $hesap_sayisi = mysqli_num_rows($secili_hesap);
         ?>
         <h3><?php echo $hesap_sayisi; ?></h3>
         <p>Toplam Üye</p>
      </div>

      <div class="box">
         <?php 
            $secili_mesajlar = mysqli_query($baglan, "SELECT * FROM `mesajlar`") or die('query failed');
            $mesaj_sayisi = mysqli_num_rows($secili_mesajlar);
         ?>
         <h3><?php echo $mesaj_sayisi; ?></h3>
         <p>Yeni Mesaj</p>
      </div>

   </div>

</section>

<script src="js/admin_script.js"></script>

</body>
</html>