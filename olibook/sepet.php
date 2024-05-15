<?php

include 'yapilandirma.php';

session_start();

$uye_id = $_SESSION['uye_id'];

if (!isset($uye_id)) {
   header('location:giris_yap.php');
}

if (isset($_POST['guncelle_sepet'])) {
   $sepet_id = $_POST['sepet_id'];
   $sepet_miktar = $_POST['sepet_miktar'];
   mysqli_query($baglan, "UPDATE `sepet` SET urun_miktar = '$sepet_miktar' WHERE sepet_id = '$sepet_id'") or die('query failed');
   $message[] = 'Sepet miktarı güncellendi.';
}

if (isset($_GET['kaldir'])) {
   $kaldir_id = $_GET['kaldir'];
   mysqli_query($baglan, "DELETE FROM `sepet` WHERE sepet_id = '$kaldir_id'") or die('query failed');
   header('location:sepet.php');
}

if (isset($_GET['hepsini_sil'])) {
   mysqli_query($baglan, "DELETE FROM `sepet` WHERE uye_id = '$uye_id'") or die('query failed');
   header('location:sepet.php');
}

?>

<!DOCTYPE html>
<html lang="tr">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Sipariş</title>


   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/main2.css">
   <style>
      
      .shopping-cart{
         margin-top: 25px;
      }

      .shopping-cart .box-container{
         margin-top: 50px;
      }

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
   
<?php include 'baslik.php'; ?>

<div class="heading">
   <h3>Sepet</h3>
   <p> <a href="anasayfa.php">Anasayfa</a> / Sepet </p>
</div>

<section class="shopping-cart">

   <h1 class="title">Eklenen Ürünler</h1>

   <div class="box-container">
      <?php
         $genel_toplam = 0;
         $secili_sepet = mysqli_query($baglan, "SELECT * FROM `sepet` WHERE uye_id = '$uye_id'") or die('query failed');
         if(mysqli_num_rows($secili_sepet) > 0){
            while($sepet_getir = mysqli_fetch_assoc($secili_sepet)){   
               $alt_toplam = $sepet_getir['urun_miktar'] * $sepet_getir['urun_ucret'];
               $genel_toplam += $alt_toplam;
      ?>
      <div class="box">
         <a href="sepet.php?kaldir=<?php echo $sepet_getir['sepet_id']; ?>" class="fas fa-times" onclick="return confirm('Sepetten silinsin mi?');"></a>
         <img src="uploaded_img/<?php echo $sepet_getir['urun_resim']; ?>" alt="">
         <div class="name"><?php echo $sepet_getir['urun_ad']; ?></div>
         <div class="name"><?php echo "Yazar: " . $sepet_getir['urun_yazar']; ?></div>
         <div class="price"><?php echo $sepet_getir['urun_ucret']; ?>₺/-</div>
         <form action="" method="post">
            <input type="hidden" name="sepet_id" value="<?php echo $sepet_getir['sepet_id']; ?>">
            <input type="number" min="1" name="sepet_miktar" value="<?php echo $sepet_getir['urun_miktar']; ?>">
            <input type="submit" name="guncelle_sepet" value="Güncelle" class="option-btn">
         </form>
         <div class="sub-total"> Alt Toplam : <span><?php echo $alt_toplam; ?>₺/-</span> </div>
      </div>
      <?php
            }
         } else {
            echo '<p class="empty">Sepetiniz boş!</p>';
         }
      ?>
   </div>

   <div style="margin-top: 2rem; text-align:center;">
      <a href="sepet.php?hepsini_sil" class="delete-btn <?php echo ($genel_toplam > 1)?'':'disabled'; ?>" onclick="return confirm('Sepet tamamen silinsin mi?');">Hepsini sil</a>
   </div>

   <div class="cart-total">
      <p>Genel Toplam : <span><?php echo $genel_toplam; ?>₺/-</span></p>
      <div class="flex">
         <a href="magaza.php" class="option-btn">Alışverişe devam et</a>
         <a href="odeme.php" class="btn <?php echo ($genel_toplam > 1)?'':'disabled'; ?>">Ödeme işlemine geçin</a>
      </div>
   </div>

</section>








<?php include 'altbaslik.php'; ?>


<script src="js/script.js"></script>

</body>
</html>