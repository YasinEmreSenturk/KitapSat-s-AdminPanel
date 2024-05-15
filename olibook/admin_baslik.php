<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">

    <div class="flex">

        <a href="admin_anasayfa.php" class="logo">Yönetim<span>Paneli</span></a>

        <nav class="navbar">
            <a href="admin_anasayfa.php">Anasayfa</a>
            <a href="admin_gostergeler.php">Göstergeler</a>
            <a href="admin_urunler.php">Ürünler</a>
            <a href="admin_siparisler.php">Siparişler</a>
            <a href="admin_uyeler.php">Üyeler</a>
            <a href="admin_mesajlar.php">Mesajlar</a>
        </nav>

        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <div id="user-btn" class="fas fa-user"></div>
        </div>

        <div class="account-box">
            <p><span><?php echo $_SESSION['admin_ad']; ?></span> <span><?php echo $_SESSION['admin_soyad']; ?></span></p>
            <p>mail : <span><?php echo $_SESSION['admin_mail']; ?></span></p>
            <a href="cikis_yap.php" class="delete-btn">Çıkış Yap</a>
        </div>

    </div>
</header>