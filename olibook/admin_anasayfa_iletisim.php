<?php

include 'yapilandirma.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:giris_yap.php');
}

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

if (isset($_GET['duzeltmenu'])) {
    $duzenle_id = $_GET['duzeltmenu'];
    if (isset($_POST['duzelt_menu'])) {
       $duzeltMenuId = $_POST['duzelt_menu_id'];
       $duzeltMenuBaslikKisimBir = $_POST['duzelt_menu_baslik_bir'];
       $duzeltMenuBaslikKisimİki = $_POST['duzelt_menu_baslik_iki'];
       $duzeltMenuBir = $_POST['duzelt_menu_bir'];
       $duzeltMenuIki = $_POST['duzelt_menu_iki'];
       $duzeltMenuUc = $_POST['duzelt_menu_uc'];
       $duzeltMenuDort = $_POST['duzelt_menu_dort'];
 
       $anasayfa_UstBaslik_Duzeltme_Sorgusu = mysqli_query($baglan, "UPDATE `anasayfa_ust_basliklar` SET bolum_birinci_baslik = '$duzeltMenuBaslikKisimBir', bolum_ikinci_baslik = '$duzeltMenuBaslikKisimİki' , bolum_bir = '$duzeltMenuBir', bolum_iki = '$duzeltMenuIki', bolum_uc = '$duzeltMenuUc', bolum_dort = '$duzeltMenuDort' WHERE bolum_id = '$duzeltMenuId'");
 
       if ($anasayfa_UstBaslik_Duzeltme_Sorgusu) {
          header('location:admin_anasayfa_magaza.php');
       } else {
          echo "Kullanıcı güncellenemedi.";
       }
    }
 }

 if (isset($_GET['duzeltaltbolum'])) {
    $duzenle_id = $_GET['duzeltaltbolum'];
    if (isset($_POST['duzelt_altbolum'])) {
       $duzeltAltBolumId = $_POST['duzelt_altmenu_id'];
       $duzeltAltBaslik1 = $_POST['duzelt_altbaslik1'];
       $duzeltAltBaslik2 = $_POST['duzelt_altbaslik2'];
       $duzeltAltBaslik3 = $_POST['duzelt_altbaslik3'];
       $duzeltAltBaslik4 = $_POST['duzelt_altbaslik4'];
       $duzeltAltBolum1_1 = $_POST['duzelt_altbolum1_1'];
       $duzeltAltBolum1_2 = $_POST['duzelt_altbolum1_2'];
       $duzeltAltBolum1_3 = $_POST['duzelt_altbolum1_3'];
       $duzeltAltBolum1_4 = $_POST['duzelt_altbolum1_4'];
       $duzeltAltBolum2_1 = $_POST['duzelt_altbolum2_1'];
       $duzeltAltBolum2_2 = $_POST['duzelt_altbolum2_2'];
       $duzeltAltBolum2_3 = $_POST['duzelt_altbolum2_3'];
       $duzeltAltBolum2_4 = $_POST['duzelt_altbolum2_4'];
       $duzeltAltBolum3_1 = $_POST['duzelt_altbolum3_1'];
       $duzeltAltBolum3_2 = $_POST['duzelt_altbolum3_2'];
       $duzeltAltBolum3_3 = $_POST['duzelt_altbolum3_3'];
       $duzeltAltBolum3_4 = $_POST['duzelt_altbolum3_4'];
       $duzeltAltBolum4_1 = $_POST['duzelt_altbolum4_1'];
       $duzeltAltBolum4_2 = $_POST['duzelt_altbolum4_2'];
       $duzeltAltBolum1_1hash = $_POST['duzelt_altbolum1_1hash'];
       $duzeltAltBolum1_2hash = $_POST['duzelt_altbolum1_2hash'];
       $duzeltAltBolum1_4hash = $_POST['duzelt_altbolum1_4hash'];
       $duzeltAltBolum2_1hash = $_POST['duzelt_altbolum2_1hash'];
       $duzeltAltBolum2_2hash = $_POST['duzelt_altbolum2_2hash'];
       $duzeltAltBolum2_4hash = $_POST['duzelt_altbolum2_4hash'];
       $duzeltAltBolum4_1hash = $_POST['duzelt_altbolum4_1hash'];
       $duzeltAltBolum4_2hash = $_POST['duzelt_altbolum4_2hash'];
 
       $anasayfa_AltBolum_Duzeltme_Sorgusu = mysqli_query($baglan, "UPDATE `anasayfa_alt_basliklar` SET altbolum1_baslik = '$duzeltAltBaslik1',
       altbolum2_baslik = '$duzeltAltBaslik2', altbolum3_baslik = '$duzeltAltBaslik3', altbolum4_baslik = '$duzeltAltBaslik4',
       altbolum1_1 = '$duzeltAltBolum1_1', altbolum1_2 = '$duzeltAltBolum1_2', altbolum1_3 = '$duzeltAltBolum1_3', altbolum1_4 = '$duzeltAltBolum1_4', 
       altbolum2_1 = '$duzeltAltBolum2_1', altbolum2_2 = '$duzeltAltBolum2_2', altbolum2_3 = '$duzeltAltBolum2_3', altbolum2_4 = '$duzeltAltBolum2_4', 
       altbolum3_1 = '$duzeltAltBolum3_1', altbolum3_2 = '$duzeltAltBolum3_2', altbolum3_3 = '$duzeltAltBolum3_3', altbolum3_4 = '$duzeltAltBolum3_4',
       altbolum4_1 = '$duzeltAltBolum4_1', altbolum4_2 = '$duzeltAltBolum4_2',
       altbolum1_1hash = '$duzeltAltBolum1_1hash', altbolum1_2hash = '$duzeltAltBolum1_2hash', altbolum1_4hash = '$duzeltAltBolum1_4hash', 
       altbolum2_1hash = '$duzeltAltBolum2_1hash', altbolum2_2hash = '$duzeltAltBolum2_2hash', altbolum2_4hash = '$duzeltAltBolum2_4hash',
       altbolum4_1hash = '$duzeltAltBolum4_1hash', altbolum4_2hash = '$duzeltAltBolum4_2hash' WHERE altbolum_id = '$duzeltAltBolumId'");
 
       if ($anasayfa_AltBolum_Duzeltme_Sorgusu) {
          header('location:admin_anasayfa.php');
       } else {
          echo "Kullanıcı güncellenemedi.";
       }
    }
 }

?>

<!DOCTYPE html>
<html lang="tr">
<head>

   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
   <title>Yönetim Paneli: Anasayfa/İletişim</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/admin_style2.css">

    <style>

        .heading{
            margin-top: 40px;
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

        .heading p a:hover{
            text-decoration: underline;
        }

        .homepage-header{
            background-color: var(--white);
        }

        .homepage-header .homepage-menu{
            background-color: var(--white);
        }

        .homepage-header .homepage-menu{
            padding:2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            max-width: 1200px;
            margin:0 auto;
        }

        .homepage-header .homepage-menu{
            background-color: var(--white);
        }

        .homepage-header .homepage-menu.active{
            position: fixed;
            top:0; left:0; right:0;
            z-index: 1000;
        }

        .homepage-header .homepage-menu{
            padding:2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            max-width: 1200px;
            margin:0 auto;
            position: relative;
        }

        .homepage-header .homepage-menu p{
            font-size: 2rem;
            color:var(--light-color);
        }

        .homepage-header .homepage-menu p a{
            color:var(--purple);
        }

        .homepage-header .homepage-menu p a:hover{
            text-decoration: underline;
        }

        .homepage-header .homepage-menu .logo{
            font-size: 2.5rem;
            color:var(--purple);
        }

        .homepage-header .homepage-menu .navbar a{
            margin:0 1rem;
            font-size: 2rem;
            color:var(--light-color);
        }

        .homepage-header .homepage-menu .navbar a:hover{
            color:var(--purple);
            text-decoration: underline;
        }

        .edit-menu-form{
            min-height: 100vh;
            background-color: rgba(0,0,0,.7);
            display: flex;
            align-items: center;
            justify-content: center;
            padding:2rem;
            overflow-y: scroll;
            position: fixed;
            top:0; left:0; 
            z-index: 1200;
            width: 100%;
        }

        .edit-menu-form form{
            width: 800px;
            padding:2rem;
            text-align: center;
            border-radius: .5rem;
            background-color: var(--white);
        }

        .edit-menu-form form .box{
            margin:1rem 0;
            padding:1.2rem 1.4rem;
            border:var(--border);
            border-radius: .5rem;
            background-color: var(--light-bg);
            font-size: 1.8rem;
            color:var(--black);
            width: 100%;
        }

        .homepage-footer{
            text-align: center;
            background-color: var(--light-bg);
        }

        .homepage-footer .box-container{
            max-width: 1200px;
            margin:0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(25rem, 1fr));
            gap:3rem;
        }

        .homepage-footer .box-container .box h3{
            text-transform: uppercase;
            color:var(--black);
            font-size: 2rem;
            padding-bottom: 2rem;
        }

        .homepage-footer .box-container .box p,
        .homepage-footer .box-container .box a{
            display: block;
            font-size: 1.7rem;
            color:var(--light-color);
            padding:1rem 0;
        }

        .homepage-footer .box-container .box p i,
        .homepage-footer .box-container .box a i{
            color:var(--purple);
            padding-right: .5rem;
        }

        .homepage-footer .box-container .box a:hover{
            color:var(--purple);
            text-decoration: underline;
        }

        .homepage-footer .credit{
            text-align: center;
            font-size: 2rem;
            color:var(--light-color);
            border-top: var(--border);
            margin-top: 2.5rem;
            padding-top: 2.5rem;
        }

        .homepage-footer .credit span{
            color:var(--purple);
        }

        .edit-homepage-footer-form{
            min-height: 100vh;
            background-color: rgba(0,0,0,.7);
            display: flex;
            align-items: center;
            justify-content: center;
            padding:2rem;
            overflow-y: scroll;
            position: fixed;
            top:0; left:0; 
            z-index: 1200;
            width: 100%;
        }
        
        .edit-homepage-footer-form form{
            width: 1600px;
            padding:2rem;
            text-align: center;
            border-radius: .5rem;
            background-color: var(--white);
        }

        .edit-homepage-footer-form form table{
            width: 100%;
        }

        .edit-homepage-footer-form form td{
            width: 200px;
        }
        
        .edit-homepage-footer-form form .box{
            margin:1rem 0;
            padding:1.2rem 1.4rem;
            border:var(--border);
            border-radius: .5rem;
            background-color: var(--light-bg);
            font-size: 1.8rem;
            color:var(--black);
            width: 100%;
        }


        .contact form{
        margin:0 auto;
        background-color: var(--light-bg);
        border-radius: .5rem;
        border:var(--border);
        padding:2rem;
        max-width: 50rem;
        margin:0 auto;
        text-align: center;
        }

        .contact form h3{
        font-size: 2.5rem;
        text-transform: uppercase;
        margin-bottom: 1rem;
        color:var(--black);
        }

        .contact form .box{
        margin:1rem 0;
        width: 100%;
        border:var(--border);
        background-color: var(--white);
        padding:1.2rem 1.4rem;
        font-size: 1.8rem;
        color:var(--black);
        border-radius: .5rem;
        }

        .contact form textarea{
        height: 20rem;
        resize: none;
        }
    </style>
</head>

<body>
<?php

include 'admin_baslik.php';

$anasayfa_UstBasliklar_Sorgu = "SELECT * FROM anasayfa_ust_basliklar";
$anasayfa_UstBasliklar_getir = mysqli_query($baglan, $anasayfa_UstBasliklar_Sorgu);
$anasayfaMenu = mysqli_fetch_assoc($anasayfa_UstBasliklar_getir);

$anasayfa_AltBasliklar_Sorgu = "SELECT * FROM anasayfa_alt_basliklar";
$anasayfa_AltBasliklar_getir = mysqli_query($baglan, $anasayfa_AltBasliklar_Sorgu);
$anasayfaAltBasliklar = mysqli_fetch_assoc($anasayfa_AltBasliklar_getir);
?>

<header class="homepage-header">
   <div class="homepage-flex">
      <div class="homepage-menu">
         <a href="admin_anasayfa.php" class="logo"><?php echo $anasayfaMenu['bolum_birinci_baslik']; ?><span style="color:black;"><?php echo $anasayfaMenu['bolum_ikinci_baslik']; ?></span></a>

         <nav class="navbar">
               <a href="admin_anasayfa.php"><?php echo $anasayfaMenu['bolum_bir']; ?></a>
               <a href="admin_anasayfa_magaza.php"><?php echo $anasayfaMenu['bolum_iki']; ?></a>
               <a href="admin_anasayfa_iletisim.php"><?php echo $anasayfaMenu['bolum_uc']; ?></a>
               <a href="admin_anasayfa_siparisler.php"><?php echo $anasayfaMenu['bolum_dort']; ?></a>
         </nav>

         <a href="admin_anasayfa_iletisim.php?duzeltmenu=<?php echo $anasayfaMenu['bolum_id']; ?>" name="menu_duzelt" class="option-btn">Düzenle</a>
      </div>
   </div>
</header>

<section class="edit-menu-form">
    <?php
        if (isset($_GET['duzeltmenu'])) {
            $duzenle_id = mysqli_real_escape_string($baglan, $_GET['duzeltmenu']);
            $anasayfa_UstBaslik_Duzeltme_Sorgusu = mysqli_query($baglan, "SELECT * FROM `anasayfa_ust_basliklar` WHERE bolum_id = '$duzenle_id'") or die('query failed');
            if (mysqli_num_rows($anasayfa_UstBaslik_Duzeltme_Sorgusu) > 0) {
                while ($duzenle_menu_getir = mysqli_fetch_assoc($anasayfa_UstBaslik_Duzeltme_Sorgusu)) {
    ?>
                <form action="" method="post" enctype="multipart/form-data">
                <h1 style="text-align:center;padding-bottom:5px;">Menü - Düzenleme Formu</h1>
                    <table>
                        <tr>
                            <input type="hidden" name="duzelt_menu_id" value="<?php echo $duzenle_menu_getir['bolum_id']; ?>">
                            
                            <td><h1 style="text-align:left;">Başlık 1. Kısım:</h1><input type="text" name="duzelt_menu_baslik_bir" value="<?php echo $duzenle_menu_getir['bolum_birinci_baslik']; ?>"
                            class="box" required placeholder="Oli"></td>
                            <td><h1 style="text-align:left;">Başlık 2. Kısım:</h1><input type="text" name="duzelt_menu_baslik_iki" value="<?php echo $duzenle_menu_getir['bolum_ikinci_baslik']; ?>"
                            class="box" required placeholder="book"></td>
                            <td>  </td><td>  </td><td>  </td><td>  </td><td>  </td><td>  </td><td>  </td><td>  </td><td>  </td>
                            <td>  </td><td>  </td><td>  </td><td>  </td><td>  </td><td>  </td><td>  </td><td>  </td><td>  </td>
                            <td><h1 style="text-align:left;">Menu 1.Başlık:</h1><input type="text" name="duzelt_menu_bir" value="<?php echo $duzenle_menu_getir['bolum_bir']; ?>"
                            class="box" required placeholder="Anasayfa"></td>
                            <td><h1 style="text-align:left;">Menu 2.Başlık:</h1><input type="text" name="duzelt_menu_iki" value="<?php echo $duzenle_menu_getir['bolum_iki']; ?>"
                            class="box" required placeholder="Mağaza"></td>
                            <td><h1 style="text-align:left;">Menu 3.Başlık:</h1><input type="text" name="duzelt_menu_uc" value="<?php echo $duzenle_menu_getir['bolum_uc']; ?>"
                            class="box" required placeholder="İletişim"></td>
                            <td><h1 style="text-align:left;">Menu 4.Başlık:</h1><input type="text" name="duzelt_menu_dort" value="<?php echo $duzenle_menu_getir['bolum_dort']; ?>"
                            class="box" required placeholder="Siparişler"></td>
                        </tr>
                    </table>
                        <input type="submit" value="Onay" name="duzelt_menu" class="accept-btn">
                        <a href="admin_anasayfa_iletisim.php"><input type="button" value="İptal" class="cancel-btn"></a>
                </form>
    <?php
            }
        }
    } else {
        echo '<script>document.querySelector(".edit-menu-form").style.display = "none";</script>';
    }
    ?>
</section>

<div class="heading">
   <h3>İletişim</h3>
   <p><a href="admin_anasayfa.php">Anasayfa</a> / İletişim</p>
</div>

<section class="contact">

   <form action="" method="post">
      <h3>Bize Ulaşın!</h3>
      <input type="text" name="name" required placeholder="Adınızı giriniz" class="box">
      <input type="text" name="surname" required placeholder="Soyadınızı giriniz" class="box">
      <input type="email" name="email" required placeholder="Mailinizi giriniz" class="box">
      <input type="number" name="number" required placeholder="Numaranızı giriniz" class="box">
      <textarea name="message" class="box" placeholder="Mesajınızı giriniz" id="" cols="30" rows="10"></textarea>
      <input type="submit" value="Gönder" name="" class="btn">
   </form>

</section>

<section class="homepage-footer">

   <div class="box-container">

      <div class="box">
         <h3><?php echo $anasayfaAltBasliklar['altbolum1_baslik']; ?></h3>
         <a href="<?php echo $anasayfaAltBasliklar['altbolum1_1hash']; ?>"><?php echo $anasayfaAltBasliklar['altbolum1_1']; ?></a>
         <a href="<?php echo $anasayfaAltBasliklar['altbolum1_2hash']; ?>"><?php echo $anasayfaAltBasliklar['altbolum1_2']; ?></a>
         <a href="<?php echo $anasayfaAltBasliklar['altbolum1_3hash']; ?>"><?php echo $anasayfaAltBasliklar['altbolum1_3']; ?></a>
         <a href="<?php echo $anasayfaAltBasliklar['altbolum1_4hash']; ?>"><?php echo $anasayfaAltBasliklar['altbolum1_4']; ?></a>
      </div>

      <div class="box">
         <h3><?php echo $anasayfaAltBasliklar['altbolum2_baslik']; ?></h3>
         <a href="<?php echo $anasayfaAltBasliklar['altbolum2_1hash']; ?>"> <i class="fab fa-facebook-f"></i> <?php echo $anasayfaAltBasliklar['altbolum2_1']; ?> </a>
         <a href="<?php echo $anasayfaAltBasliklar['altbolum2_2hash']; ?>"> <i class="fab fa-twitter"></i> <?php echo $anasayfaAltBasliklar['altbolum2_2']; ?> </a>
         <a href="<?php echo $anasayfaAltBasliklar['altbolum2_3hash']; ?>"> <i class="fab fa-instagram"></i> <?php echo $anasayfaAltBasliklar['altbolum2_3']; ?> </a>
         <a href="<?php echo $anasayfaAltBasliklar['altbolum2_4hash']; ?>"> <i class="fab fa-linkedin"></i> <?php echo $anasayfaAltBasliklar['altbolum2_4']; ?> </a>
      </div>

      <div class="box">
         <h3><?php echo $anasayfaAltBasliklar['altbolum3_baslik']; ?></h3>
         <p> <i class="fas fa-phone"></i> <?php echo $anasayfaAltBasliklar['altbolum3_1']; ?> </p>
         <p> <i class="fas fa-phone"></i> <?php echo $anasayfaAltBasliklar['altbolum3_2']; ?> </p>
         <p> <i class="fas fa-envelope"></i> <?php echo $anasayfaAltBasliklar['altbolum3_3']; ?> </p>
         <p> <i class="fas fa-map-marker-alt"></i> <?php echo $anasayfaAltBasliklar['altbolum3_4']; ?> </p>
      </div>

      <div class="box">
         <h3><?php echo $anasayfaAltBasliklar['altbolum4_baslik']; ?></h3>
         <a href="<?php echo $anasayfaAltBasliklar['altbolum4_1hash']; ?>"><?php echo $anasayfaAltBasliklar['altbolum4_1']; ?></a>
         <a href="<?php echo $anasayfaAltBasliklar['altbolum4_2hash']; ?>"><?php echo $anasayfaAltBasliklar['altbolum4_2']; ?></a>
      </div>
   </div>
   <a href="admin_anasayfa_iletisim.php?duzeltaltbolum=<?php echo $anasayfaAltBasliklar['altbolum_id']; ?>" name="altbolum_duzelt" class="option-btn">Düzenle</a>
</section>

<section class="edit-homepage-footer-form">
   <?php
      if (isset($_GET['duzeltaltbolum'])) {
         $duzenleAltBolum_id = mysqli_real_escape_string($baglan, $_GET['duzeltaltbolum']);
         $anasayfa_AltBolum_Duzeltme_Sorgusu = mysqli_query($baglan, "SELECT * FROM `anasayfa_alt_basliklar` WHERE altbolum_id = '$duzenleAltBolum_id'") or die('query failed');
         if (mysqli_num_rows($anasayfa_AltBolum_Duzeltme_Sorgusu) > 0) {
            while ($duzenle_altbolum_getir = mysqli_fetch_assoc($anasayfa_AltBolum_Duzeltme_Sorgusu)) {
   ?>
            <form action="" method="post" enctype="multipart/form-data">
               <h1 style="text-align:center;padding-bottom:5px;">Alt Menü - Düzenleme Formu</h1>
                     <input type="hidden" name="duzelt_altmenu_id" value="<?php echo $duzenle_altbolum_getir['altbolum_id']; ?>">
                     <table>
                        <tr>
                           <td colspan="2"><h1 style="text-align:left;">Alt Başlık 1:</h1><input type="text" name="duzelt_altbaslik1" value="<?php echo $duzenle_altbolum_getir['altbolum1_baslik']; ?>"
                           class="box" required placeholder="Hızlı Linkler"></td>
                           <td colspan="2"><h1 style="text-align:left;">Alt Başlık 2:</h1><input type="text" name="duzelt_altbaslik2" value="<?php echo $duzenle_altbolum_getir['altbolum2_baslik']; ?>"
                           class="box" required placeholder="Bizi Takip Et"></td>
                           <td colspan="2"><h1 style="text-align:left;">Alt Başlık 3:</h1><input type="text" name="duzelt_altbaslik3" value="<?php echo $duzenle_altbolum_getir['altbolum3_baslik']; ?>"
                           class="box" required placeholder="İletişim İnfo"></td>
                           <td colspan="2"><h1 style="text-align:left;">Alt Başlık 4:</h1><input type="text" name="duzelt_altbaslik4" value="<?php echo $duzenle_altbolum_getir['altbolum4_baslik']; ?>"
                           class="box" required placeholder="Extra Linkler"></td>
                        </tr>
                        <tr>
                           <td colspan="2"><h1 style="text-align:center;">Alt Menü 1:</h1></td>
                           <td colspan="2"><h1 style="text-align:center;">Alt Menü 2:</h1></td>
                           <td colspan="2"><h1 style="text-align:center;">Alt Menü 3:</h1></td>
                           <td colspan="2"><h1 style="text-align:center;">Alt Menü 4:</h1></td> 
                        </tr>
                        <tr>
                           <td><input type="text" name="duzelt_altbolum1_1hash" value="<?php echo $duzenle_altbolum_getir['altbolum1_1hash']; ?>"
                           class="box" required placeholder="anasayfa.php"></td>
                           <td><input type="text" name="duzelt_altbolum1_1" value="<?php echo $duzenle_altbolum_getir['altbolum1_1']; ?>"
                           class="box" required placeholder="Anasayfa"></td>
                           <td><input type="text" name="duzelt_altbolum2_1hash" value="<?php echo $duzenle_altbolum_getir['altbolum2_1hash']; ?>"
                           class="box" required placeholder="#"></td>
                           <td><input type="text" name="duzelt_altbolum2_1" value="<?php echo $duzenle_altbolum_getir['altbolum2_1']; ?>"
                           class="box" required placeholder="Facebook"></td>
                           <td colspan="2"><input type="text" name="duzelt_altbolum3_1" value="<?php echo $duzenle_altbolum_getir['altbolum3_1']; ?>"
                           class="box" required placeholder="Örn: 0550-000-0000"></td>
                           <td><input type="text" name="duzelt_altbolum4_1hash" value="<?php echo $duzenle_altbolum_getir['altbolum4_1hash']; ?>"
                           class="box" required placeholder="giris_yap.php"></td>
                           <td><input type="text" name="duzelt_altbolum4_1" value="<?php echo $duzenle_altbolum_getir['altbolum4_1']; ?>"
                           class="box" required placeholder="Giriş Yap"></td>
                        </tr>
                        <tr>
                        <td><input type="text" name="duzelt_altbolum1_2hash" value="<?php echo $duzenle_altbolum_getir['altbolum1_2hash']; ?>"
                           class="box" required placeholder="magaza.php"></td>
                           <td><input type="text" name="duzelt_altbolum1_2" value="<?php echo $duzenle_altbolum_getir['altbolum1_2']; ?>"
                           class="box" required placeholder="Mağaza"></td>
                           <td><input type="text" name="duzelt_altbolum2_2hash" value="<?php echo $duzenle_altbolum_getir['altbolum2_2hash']; ?>"
                           class="box" required placeholder="#"></td>
                           <td><input type="text" name="duzelt_altbolum2_2" value="<?php echo $duzenle_altbolum_getir['altbolum2_2']; ?>"
                           class="box" required placeholder="Twitter"></td>
                           <td colspan="2"><input type="text" name="duzelt_altbolum3_2" value="<?php echo $duzenle_altbolum_getir['altbolum3_2']; ?>"
                           class="box" required placeholder="Örn: 0550-000-0000"></td>
                           <td><input type="text" name="duzelt_altbolum4_2hash" value="<?php echo $duzenle_altbolum_getir['altbolum4_2hash']; ?>"
                           class="box" required placeholder="kayit_ol.php"></td>
                           <td><input type="text" name="duzelt_altbolum4_2" value="<?php echo $duzenle_altbolum_getir['altbolum4_2']; ?>"
                           class="box" required placeholder="Kayıt Ol"></td>
                        </tr>
                        <tr>
                           <td><input type="text" name="duzelt_altbolum1_3hash" value="<?php echo $duzenle_altbolum_getir['altbolum1_3hash']; ?>"
                           class="box" required placeholder="iletisim.php"></td>
                           <td><input type="text" name="duzelt_altbolum1_3" value="<?php echo $duzenle_altbolum_getir['altbolum1_3']; ?>"
                           class="box" required placeholder="İletişim"></td>
                           <td><input type="text" name="duzelt_altbolum2_3hash" value="<?php echo $duzenle_altbolum_getir['altbolum2_3hash']; ?>"
                           class="box" required placeholder="#"></td>
                           <td><input type="text" name="duzelt_altbolum2_3" value="<?php echo $duzenle_altbolum_getir['altbolum2_3']; ?>"
                           class="box" required placeholder="İnstagram"></td>
                           <td colspan="2"><input type="text" name="duzelt_altbolum3_3" value="<?php echo $duzenle_altbolum_getir['altbolum3_3']; ?>"
                           class="box" required placeholder="Örn: olibook@gmail.com"></td>
                           <td></td>
                           <td></td>
                        </tr>
                        <tr>
                        <td><input type="text" name="duzelt_altbolum1_4hash" value="<?php echo $duzenle_altbolum_getir['altbolum1_4hash']; ?>"
                           class="box" required placeholder="siparisler.php"></td>
                           <td><input type="text" name="duzelt_altbolum1_4" value="<?php echo $duzenle_altbolum_getir['altbolum1_4']; ?>"
                           class="box" required placeholder="Siparişler"></td>
                           <td><input type="text" name="duzelt_altbolum2_4hash" value="<?php echo $duzenle_altbolum_getir['altbolum2_4hash']; ?>"
                           class="box" required placeholder="#"></td>
                           <td><input type="text" name="duzelt_altbolum2_4" value="<?php echo $duzenle_altbolum_getir['altbolum2_4']; ?>"
                           class="box" required placeholder="Linkedin"></td>
                           <td colspan="2"><input type="text" name="duzelt_altbolum3_4" value="<?php echo $duzenle_altbolum_getir['altbolum3_4']; ?>"
                           class="box" required placeholder="Örn: İzmir, Türkiye"></td>
                           <td></td>
                           <td></td>
                        </tr>
                     </table>
                     <input type="submit" value="Onay" name="duzelt_altbolum" class="accept-btn">
                     <a href="admin_anasayfa_iletisim.php"><input type="button" value="İptal" class="cancel-btn"></a>
            </form>
   <?php
         }
      }
   } else {
      echo '<script>document.querySelector(".edit-homepage-footer-form").style.display = "none";</script>';
   }
   ?>
</section>