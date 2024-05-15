<?php

include 'yapilandirma.php';

session_start();

$uye_id = $_SESSION['uye_id'];

if(!isset($uye_id)){
   header('location:giris_yap.php');
}

if(isset($_POST['sepete_ekle'])){

   $urun_adi = $_POST['urun_ad'];
   $urun_yazari = $_POST['urun_yazar'];
   $urun_fiyati = $_POST['urun_ucret'];
   $urun_resmi = $_POST['urun_resim'];
   $urun_miktari = $_POST['urun_miktar'];

   $sepet_numara_kontrol = mysqli_query($baglan, "SELECT * FROM `sepet` WHERE urun_ad = '$urun_adi' AND uye_id = '$uye_id'") or die('query failed');

   if(mysqli_num_rows($sepet_numara_kontrol) > 0){
      $message[] = 'Zaten sepete eklendi!';
   } else {
      // Validate numeric values before inserting into the database
      if (is_numeric($urun_fiyati) && is_numeric($urun_miktari)) {
         mysqli_query($baglan, "INSERT INTO `sepet` (uye_id, urun_ad, urun_yazar, urun_ucret, urun_miktar, urun_resim) VALUES ('$uye_id','$urun_adi', '$urun_yazari', '$urun_fiyati', '$urun_miktari', '$urun_resmi')") or die('query failed');
         $message[] = 'Ürün sepete eklendi!';
      } else {
         $message[] = 'Geçersiz fiyat veya miktar!';
      }
   }

}

$anasayfa_Icerik1_Sorgu = "SELECT * FROM anasayfa_icerikler WHERE icerik_id = 1";
$anasayfa_Icerik1_getir = mysqli_query($baglan, $anasayfa_Icerik1_Sorgu);
$anasayfaIcerik1 = mysqli_fetch_assoc($anasayfa_Icerik1_getir);

$anasayfa_Urun_Tanitim_Sorgu = "SELECT * FROM anasayfa_urun_tanitim Where urun_tanitim_id = 1";
$anasayfa_Urun_Tanitim_getir = mysqli_query($baglan, $anasayfa_Urun_Tanitim_Sorgu);
$UrunTanitim = mysqli_fetch_assoc($anasayfa_Urun_Tanitim_getir);

$anasayfa_Icerik2_Sorgu = "SELECT * FROM anasayfa_icerikler WHERE icerik_id = 2";
$anasayfa_Icerik2_getir = mysqli_query($baglan, $anasayfa_Icerik2_Sorgu);
$anasayfaIcerik2 = mysqli_fetch_assoc($anasayfa_Icerik2_getir);

?>

<!DOCTYPE html>
<html lang="tr">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Anasayfa</title>


   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/main2.css">

   <style>
      .home{
         min-height: 70vh;
         background:linear-gradient(rgba(0,0,0,.7), rgba(0,0,0,.7)), url('img/content1-bg.jpg') no-repeat;
         background-size: cover;
         background-position: center;
         display: flex;
         align-items: center;
         justify-content: center;
      }

      .home .content{
         text-align: center;
         width: 60rem;
      }

      .home .content h3{
         font-size: 5rem;
         color:var(--white);
         text-transform: uppercase;
      }

      .home .content p{
         font-size:1.8rem;
         color:var(--light-white);
         padding:1rem 0;
         line-height: 1.5;
      }

      .products-introduction .box-container{
         max-width: 1800px;
         margin:0 auto;
         display: grid;
         grid-template-columns: repeat(auto-fit, 30rem);
         align-items: flex-start;
         gap:1.5rem;
         justify-content: center;
      }

      .products-introduction .box-container .box{
         border-radius: .5rem;
         background-color: var(--white);
         box-shadow: var(--box-shadow);
         padding:2rem;
         text-align: center;
         border:var(--border);
         position: relative;
      }

      .products-introduction .box-container .box .image{
         height: 30rem;
      }

      .products-introduction .box-container .box .name{
         padding:1rem 0;
         font-size: 2rem;
         color:var(--black);
      }

      .products-introduction .box-container .box .qty{
         width: 100%;
         padding:1.2rem 1.4rem;
         border-radius: .5rem;
         border:var(--border);
         margin:1rem 0;
         font-size: 2rem;
      }

      .products-introduction .box-container .box .price{
         position: absolute;
         top:1rem; left:1rem;
         border-radius: .5rem;
         padding:1rem;
         font-size: 2.5rem;
         color:var(--white);
         background-color: var(--red);
      }
   </style>
</head>
<body>
   
<?php include 'baslik.php'; ?>

<section style="margin-top:150px;" class="home">

   <div class="content">
      <h3><?php echo $anasayfaIcerik1['icerik_baslik'];?></h3>
      <p><?php echo $anasayfaIcerik1['icerik_yazi']; ?></p>
      <a href="<?php echo $anasayfaIcerik1['icerik_buton_adres']; ?>" class="white-btn"><?php echo $anasayfaIcerik1['icerik_buton']; ?></a>
   </div>

</section>

<section class="products-introduction">

   <h1 class="title"><?php echo $UrunTanitim['urun_tanitim_baslik']; ?></h1>

   <div class="box-container">

      <?php
         $urun_miktar = $UrunTanitim['urun_tanitim_miktar'];
         $secili_urun = mysqli_query($baglan, "SELECT * FROM `urunler` LIMIT $urun_miktar") or die('query failed');
         if(mysqli_num_rows($secili_urun) > 0){
            while($urunu_getir = mysqli_fetch_assoc($secili_urun)){
      ?>
     <form action="" method="post" class="box">
         <img class="image" src="uploaded_img/<?php echo $urunu_getir['urun_resim']; ?>" alt="">
         <div class="name"><?php echo $urunu_getir['urun_ad']; ?></div>
         <div class="name"><?php echo "Yazar: " . $urunu_getir['urun_yazar']; ?></div>
         <div class="price"><?php echo $urunu_getir['urun_ucret']; ?>₺/-</div>
         <input type="number" min="1" name="urun_miktar" value="1" class="qty">
         <input type="hidden" name="urun_ad" value="<?php echo $urunu_getir['urun_ad']; ?>">
         <input type="hidden" name="urun_ucret" value="<?php echo $urunu_getir['urun_ucret']; ?>">
         <input type="hidden" name="urun_yazar" value="<?php echo $urunu_getir['urun_yazar']; ?>">
         <input type="hidden" name="urun_resim" value="<?php echo $urunu_getir['urun_resim']; ?>">
         <input type="submit" value="Sepete Ekle" name="sepete_ekle" class="btn">
      </form>
      <?php
         }
      }else{
         echo '<p class="empty">Henüz ürün eklenmedi!</p>';
      }
      ?>
   </div>

   <div class="load-more" style="margin-top: 2rem; text-align:center">
      <a href="magaza.php" class="option-btn">Daha Fazla</a>
   </div>

</section>

<section class="home-contact">

   <div class="content">
      <h3><?php echo $anasayfaIcerik2['icerik_baslik'];?></h3>
      <p><?php echo $anasayfaIcerik2['icerik_yazi']; ?></p>
      <a href="<?php echo $anasayfaIcerik2['icerik_buton_adres']; ?>" class="white-btn"><?php echo $anasayfaIcerik2['icerik_buton']; ?></a>
   </div>

</section>

<?php include 'altbaslik.php'; ?>

<script src="js/script.js"></script>

</body>
</html>