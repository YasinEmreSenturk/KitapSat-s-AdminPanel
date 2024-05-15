<?php


$sorgu = "SELECT * FROM anasayfa_ust_basliklar";
$getir = mysqli_query($baglan, $sorgu);
$anasayfaMenu = mysqli_fetch_assoc($getir);


?>

<header class="header">

   <div class="header-1">
      <div class="flex">
         <div class="share">

         </div>
      </div>
   </div>

   <div class="header-2">
      <div class="flex">
      <a href="admin_anasayfa.php" class="logo"><?php echo $anasayfaMenu['bolum_birinci_baslik']; ?><span style="color:black;"><?php echo $anasayfaMenu['bolum_ikinci_baslik']; ?></span></a>

         <nav class="navbar">
               <a href="anasayfa.php"><?php echo $anasayfaMenu['bolum_bir']; ?></a>
               <a href="magaza.php"><?php echo $anasayfaMenu['bolum_iki']; ?></a>
               <a href="iletisim.php"><?php echo $anasayfaMenu['bolum_uc']; ?></a>
               <a href="siparisler.php"><?php echo $anasayfaMenu['bolum_dort']; ?></a>
         </nav>

         <div class="icons">
            <div class="fas fa-bars" id="menu-btn"></div>
            <a href="arama_sayfasi.php" class="fas fa-search"></a>
            <div class="fas fa-user" id="user-btn"></div>
            <?php
               $secili_sepet_numarasi = mysqli_query($baglan, "SELECT * FROM `sepet` WHERE uye_id = '$uye_id'") or die('query failed');
               $sepet_satir_numarasi = mysqli_num_rows($secili_sepet_numarasi); 
            ?>
            <a href="sepet.php"> <i class="fas fa-shopping-cart"></i> <span>(<?php echo $sepet_satir_numarasi; ?>)</span> </a>
         </div>

         <div class="user-box">
            <p><span><?php echo htmlspecialchars($_SESSION['uye_ad']);?> <?php echo htmlspecialchars($_SESSION['uye_soyad']);?></span></p>
            <p>mail : <span><?php echo htmlspecialchars($_SESSION['uye_email']); ?></span></p>
            <a href="cikis_yap.php" class="delete-btn">Çıkış Yap</a>
         </div>
      </div>
   </div>

</header>

<?php
if (isset($message)) {
    foreach ($message as $msg) {
        echo '
        <div class="message">
            <span>' . htmlspecialchars($msg) . '</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
        </div>
        ';
    }
}
?>