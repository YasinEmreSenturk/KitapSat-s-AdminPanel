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

include 'yapilandirma.php';

$sorgu = "SELECT * FROM anasayfa_ust_menuler";
$getir = mysqli_query($baglan, $sorgu);

$anasayfaMenu = mysqli_fetch_assoc($getir);

?>

<header class="header">

    <div class="header-1">
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
    </div>
    <div class="header-2">
        <div class="flex">
            <a href="admin_anasayfa.php" class="logo">Oli<span style="color:black;">book</span></a>

            <nav class="navbar">
                <a href="admin_anasayfa.php"><?php echo $anasayfaMenu['birinci_bolum']; ?></a>
                <a href="magaza.php"><?php echo $anasayfaMenu['ikinci_bolum']; ?></a>
                <a href="iletisim.php"><?php echo $anasayfaMenu['ucuncu_bolum']; ?></a>
                <a href="siparisler.php"><?php echo $anasayfaMenu['dorduncu_bolum']; ?></a>
            </nav>

            <p href="admin_anasayfa_php" class="option-btn">Düzelt</p>
        </div>
    </div>
</header>

<!-- Düzenleme Formu -->
<div class="edit-menu-form" style="display: none;">
    <form action="" method="post">
        <label for="birinci_bolum">Anasayfa:</label>
        <input type="text" name="birinci_bolum" value="<?php echo $anasayfaMenu['birinci_bolum']; ?>">

        <label for="ikinci_bolum">Mağaza:</label>
        <input type="text" name="ikinci_bolum" value="<?php echo $anasayfaMenu['ikinci_bolum']; ?>">

        <label for="ucuncu_bolum">İletişim:</label>
        <input type="text" name="ucuncu_bolum" value="<?php echo $anasayfaMenu['ucuncu_bolum']; ?>">

        <label for="dorduncu_bolum">Siparişler:</label>
        <input type="text" name="dorduncu_bolum" value="<?php echo $anasayfaMenu['dorduncu_bolum']; ?>">

        <input type="submit" value="Kaydet">
        <button type="button">İptal</button>
    </form>
</div>