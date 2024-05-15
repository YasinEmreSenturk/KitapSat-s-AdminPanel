<?php

include 'yapilandirma.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:giris_yap.php');
};

if(isset($_GET['kaldir'])){
   $kaldir_id = $_GET['kaldir'];
   mysqli_query($baglan, "DELETE FROM `mesajlar` WHERE mesaj_id = '$kaldir_id'") or die('query failed');
   header('location:admin_mesajlar.php');
}

?>

<!DOCTYPE html>
<html lang="tr">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Yönetim Paneli: Mesajlar</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/admin_style2.css">
   <style>
      .messages .box-container {
         display: grid;
         grid-template-columns: repeat(auto-fit, 35rem);
         justify-content: center;
         gap: 1.5rem;
         max-width: 1200px;
         margin: 0 auto;
         align-items: flex-start;
      }

      .messages .box-container .box {
         background-color: var(--white);
         padding: 2rem;
         border: var(--border);
         box-shadow: var(--box-shadow);
         border-radius: 0.5rem;
      }

      .messages .box-container .box p {
         padding-bottom: 0.5rem;
         font-size: 2rem;
         color: var(--light-color);
         line-height: 1.5;
      }

      .messages .box-container .box p span {
         color: var(--purple);
      }

      .messages .box-container .box .delete-btn {
         position: relative;
         left: 100px;
         margin-top: 10px;
      }
   </style>
</head>
<body>
   
<?php include 'admin_baslik.php'; ?>

<section class="messages">

   <h1 class="title">Mesajlar</h1>

   <div class="box-container">
   <?php
      $secili_mesaj = mysqli_query($baglan, "SELECT * FROM `mesajlar`") or die('query failed');
      if(mysqli_num_rows($secili_mesaj) > 0){
         while($mesaj_getir = mysqli_fetch_assoc($secili_mesaj)){
      
   ?>
   <div class="box">
      <p> Kullanıcı Id : <span><?php echo $mesaj_getir['kullanici_id']; ?></span> </p>
      <p> Adı Soyadı: <span><?php echo $mesaj_getir['kullanici_ad']; ?></span> <span><?php echo $mesaj_getir['kullanici_soyad']; ?></span></p>
      <p> Tel No : <span><?php echo $mesaj_getir['kullanici_no']; ?></span> </p>
      <p> Mail : <span><?php echo $mesaj_getir['kullanici_mail']; ?></span> </p>
      <p> Mesaj :<br><span><?php echo $mesaj_getir['mesaj']; ?></span> </p>
      <a href="admin_mesajlar.php?kaldir=<?php echo $mesaj_getir['mesaj_id']; ?>" onclick="return confirm('Mesaj silinsin mi?');" class="delete-btn">Kaldır</a>
   </div>
   <?php
      };
   }else{
      echo '<p class="empty">Mesajınız yok!</p>';
   }
   ?>
   </div>

</section>









<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>