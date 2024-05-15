<?php

include 'yapilandirma.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:giris_yap.php');
}

if (isset($_GET['duzelt'])) {
   $duzenle_id = $_GET['duzelt'];
   if (isset($_POST['duzelt_uye'])) {
       $duzelt_uye_id = $_POST['duzelt_uye_id'];
       $duzelt_ad = $_POST['duzelt_ad'];
       $duzelt_soyad = $_POST['duzelt_soyad'];
       $duzelt_mail = $_POST['duzelt_mail'];
       $uye_tipi = $_POST['uye_tipi'];

       $duzelt_sorgu = mysqli_query($baglan, "UPDATE `kullanicilar` SET kullanici_ad = '$duzelt_ad', kullanici_soyad = '$duzelt_soyad', kullanici_mail = '$duzelt_mail', kullanici_tipi = '$uye_tipi' WHERE kullanici_id = '$duzelt_uye_id'");

       if ($duzelt_sorgu) {
           header('location:admin_uyeler.php');
       } else {
           echo "Kullanıcı güncellenemedi.";
       }
   }
}

if (isset($_GET['kaldir'])) {
   $kalir_id = $_GET['kaldir'];
   
   $kaldir_sorgu = mysqli_query($baglan, "DELETE FROM `kullanicilar` WHERE kullanici_id = '$kalir_id'");

   if ($kaldir_sorgu) {
       header('location:admin_uyeler.php');
   } else {
       echo "Kullanıcı silinemedi.";
   }
}

if(isset($_POST['uye_ekle'])){

	$kullaniciAdi = mysqli_real_escape_string($baglan, $_POST['kullanici_adi']);
	$kullaniciSoyadi = mysqli_real_escape_string($baglan, $_POST['kullanici_soyadi']);
	$email = mysqli_real_escape_string($baglan, ($_POST['email']));
	$sifre = mysqli_real_escape_string($baglan, $_POST['sifre']);
	$tekrarSifre = mysqli_real_escape_string($baglan, $_POST['tekrar_sifre']);
	$uyeTipi = $_POST['uye_tipi'];

    $secili_uye = mysqli_query($baglan, "SELECT * FROM kullanicilar WHERE (kullanici_mail = '$email')") or die('Email ve şifre aranırken bir sorun yaşandı');

	if(mysqli_num_rows($secili_uye) > 0){
		$message[] = 'Kullanıcı zaten kayıtlı!';
	}
	else{
		if($sifre != $tekrarSifre){
			$message[] = 'Girilen şifreler eşleşmiyor!';
		}
		else{
			mysqli_query($baglan, "INSERT INTO `kullanicilar`(kullanici_ad, kullanici_soyad, kullanici_mail, kullanici_sifre, kullanici_tipi) VALUES('$kullaniciAdi', '$kullaniciSoyadi', '$email', '$sifre', '$uyeTipi')") or die('query failed');
         $message[] = 'Üye başarıyla eklendi!';
		}
	}
}


if (isset($_POST['uye_ara'])) {
   $uye_ad_ara = $_POST['uye_ad_ara'];
   $uye_soyad_ara = $_POST['uye_soyad_ara'];
   $uye_mail_ara = $_POST['uye_mail_ara'];
   $uye_tipi_ara = isset($_POST['uye_tipi_ara']) ? $_POST['uye_tipi_ara'] : '';

   $arama_sorgusu = "SELECT * FROM `kullanicilar` WHERE 1";

   if (!empty($uye_ad_ara)) {
       $arama_sorgusu .= " AND kullanici_ad LIKE '%$uye_ad_ara%'";
   }

   if (!empty($uye_soyad_ara)) {
       $arama_sorgusu .= " AND kullanici_soyad LIKE '%$uye_soyad_ara%'";
   }

   if (!empty($uye_mail_ara)) {
       $arama_sorgusu .= " AND kullanici_mail LIKE '%$uye_mail_ara%'";
   }

   if (!empty($uye_tipi_ara) && $uye_tipi_ara != 'deger') {
       $arama_sorgusu .= " AND kullanici_tipi = '$uye_tipi_ara'";
   }

   $arama_sonucu = mysqli_query($baglan, $arama_sorgusu);

   if (!$arama_sonucu) {
       die("Arama hatası: " . mysqli_error($baglan));
   }
} else {
   $arama_sorgusu = "SELECT * FROM `kullanicilar`";
   $arama_sonucu = mysqli_query($baglan, $arama_sorgusu);

   if (!$arama_sonucu) {
       die("Arama hatası: " . mysqli_error($baglan));
   }
}

?>

<!DOCTYPE html>
<html lang="tr">
<head>
   
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
   <title>Yönetim Paneli: Üyeler</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/admin_style2.css">

   <style>
      .add-and-search-users {
         max-width: 1800;
         margin: 0 auto;
         display: flex;
         flex-direction: column;
         align-items: center;
      }

      .add-and-search-users h1 {
         text-transform: uppercase;
         color: var(--black);
         margin-bottom: 1.5rem;
      }

      .add-and-search-users .form-container {
         display: flex;
      }

      .add-and-search-users .form-container .add-users-form {
         position: relative;
         right: 250px;
      }
      
      .add-and-search-users .form-container .search-users-form {
         position: relative;
         left: 250px;
      }

      .add-and-search-users form {
         background-color: var(--white);
         border-radius: .5rem;
         padding: 2rem;
         text-align: center;
         box-shadow: var(--box-shadow);
         border: var(--border);
         max-width: 32rem;
      }

      .add-and-search-users form h3 {
         font-size: 2.5rem;
         text-transform: uppercase;
         color: var(--black);
         margin-bottom: 1.5rem;
      }

      .add-and-search-users form .box {
         width: 100%;
         background-color: var(--light-bg);
         border-radius: .5rem;
         margin: 1rem 0;
         padding: 1.2rem 1.4rem;
         color: var(--black);
         font-size: 1.8rem;
         border: var(--border);
      }

      .add-and-search-users form a{
         color: chocolate;
         padding: 0.1rem;
         font-size: 1.5rem;
      }

      .search_users_output .box-container{
         display: grid;
         grid-template-columns: repeat(auto-fit, 30rem);
         justify-content: center;
         gap:1.5rem;
         max-width: 1200px;
         margin:0 auto;
         align-items: flex-start;
      }
      
      .search_users_output .box-container .box{
         background-color: var(--white);
         padding:2rem;
         border:var(--border);
         box-shadow: var(--box-shadow);
         border-radius: .5rem;
         text-align: center;
      }
      
      .search_users_output .box-container .box p{
         padding-bottom: 1.5rem;
         font-size: 2rem;
         color:var(--light-color);
      }
      
      .search_users_output .box-container .box p span{
         color:var(--purple);
      }
      
      .search_users_output .box-container .box .delete-btn{
         margin-top: 0;
      }

      .users .box-container{
         display: grid;
         grid-template-columns: repeat(auto-fit, 30rem);
         justify-content: center;
         gap:1.5rem;
         max-width: 1200px;
         margin:0 auto;
         align-items: flex-start;
      }

      .users .box-container .box{
         background-color: var(--white);
         padding:2rem;
         border:var(--border);
         box-shadow: var(--box-shadow);
         border-radius: .5rem;
         text-align: center;
      }

      .users .box-container .box p{
         padding-bottom: 1.5rem;
         font-size: 2rem;
         color:var(--light-color);
      }

      .users .box-container .box p span{
         color:var(--purple);
      }

      .users .box-container .box .delete-btn{
         margin-top: 0;
      }

      .edit-users-form{
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
      
      .edit-users-form form{
         width: 300px;
         padding:2rem;
         text-align: center;
         border-radius: .5rem;
         background-color: var(--white);
      }
      
      .edit-users-form form img{
         height: 25rem;
         margin-bottom: 1rem;
      }
      
      .edit-users-form form .box{
         margin:1rem 0;
         padding:1.2rem 1.4rem;
         border:var(--border);
         border-radius: .5rem;
         background-color: var(--light-bg);
         font-size: 1.8rem;
         color:var(--black);
         width: 100%;
      }
   </style>
</head>
<body>
   
<?php include 'admin_baslik.php'; ?>

<section class="add-and-search-users">
   <div class="form-container">
      <form class='add-users-form' id='add-users-form' action="" method="post" enctype="multipart/form-data">
         <h3>Hesap Ekle</h3>
         <input type="text" name= "kullanici_adi" placeholder="Adınızı giriniz" required class="box" id="name">
         <input type="text" name= "kullanici_soyadi" placeholder="Soyadınızı giriniz" required class="box">
         <input type="email" name= "email" placeholder="Mail adresinizi giriniz" required class="box">
         <input type="text" name = "sifre" placeholder="Şifrenizi giriniz" required class="box">
         <input type="text" name="tekrar_sifre" placeholder="Şifrenizi tekrar giriniz" required class="box">
         <select name="uye_tipi">
            <option value="uye">uye olarak</option>
            <option value="admin">admin olarak</option>
         </select>
         <input type="submit" name="uye_ekle" value="Ekle" class="btn">
      </form>

      <form class='search-users-form' id='search-users-form' action="" method="post" enctype="multipart/form-data">
         <h3>Hesap Ara</h3>
         <input type="text" name="uye_ad_ara" placeholder="Üye adını giriniz" class="box">
         <input type="text" name="uye_soyad_ara" placeholder="Üye soyadını giriniz" class="box">
         <input type="text" name="uye_mail_ara" placeholder="Mail adresini giriniz" class="box">
         <select class="box" name="uye_tipi_ara">
            <option value="deger" selected disabled>Üye tipi seçiniz</option>
            <option value="uye">uye</option>
            <option value="admin">admin</option>         
         </select>
         <input type="submit" value="Ara" name="uye_ara" class="search-btn">
         <a href="admin_uyeler.php">Temizle</a>
      </form>
   <div>
</section>

<section class="edit-users-form">
   <?php
      if (isset($_GET['duzelt'])) {
         $duzenle_id = $_GET['duzelt'];
         $duzelt_sorgu = mysqli_query($baglan, "SELECT * FROM `kullanicilar` WHERE kullanici_id = '$duzenle_id'") or die('query failed');
         if (mysqli_num_rows($duzelt_sorgu) > 0) {
            while ($duzenle_getir = mysqli_fetch_assoc($duzelt_sorgu)) {
   ?>
            <form action="" method="post" enctype="multipart/form-data">
               <input type="hidden" name="duzelt_uye_id" value="<?php echo $duzenle_getir['kullanici_id']; ?>">
               <input type="text" name="duzelt_ad" value="<?php echo $duzenle_getir['kullanici_ad']; ?>"
                  class="box" required placeholder="İsim giriniz">
               <input type="text" name="duzelt_soyad" value="<?php echo $duzenle_getir['kullanici_soyad']; ?>"
                  class="box" required placeholder="Soyad giriniz">
               <input type="email" name="duzelt_mail" value="<?php echo $duzenle_getir['kullanici_mail']; ?>"
                  class="box" required placeholder="Mail giriniz">
                  <select class="box" name="uye_tipi">
                     <option value="uye" <?php echo ($duzenle_getir['kullanici_tipi'] === 'uye') ? 'selected' : ''; ?>>uye</option>
                      <option value="admin" <?php echo ($duzenle_getir['kullanici_tipi'] === 'admin') ? 'selected' : ''; ?>>admin</option>
                  </select>
               <input type="submit" value="Onay" name="duzelt_uye" class="accept-btn">
               <input type="button" value="İptal" id="duzelt_iptal" class="cancel-btn">
            </form>
   <?php
         }
      }
   } else {
      echo '<script>document.querySelector(".edit-users-form").style.display = "none";</script>';
   }
   ?>
</section>

<section class="search_users_output">
   <h1 class="title">Kayıtlı Hesaplar</h1>
   <div class="box-container">
      <?php
      while ($kullanici_getir = mysqli_fetch_assoc($arama_sonucu)) {
      ?>
            <div class="box">
               <p> Id : <span><?php echo $kullanici_getir['kullanici_id']; ?></span> </p>
               <p> Adı : <span><?php echo $kullanici_getir['kullanici_ad']; ?></span> </p>
               <p> Soyadı : <span><?php echo $kullanici_getir['kullanici_soyad']; ?></span> </p>
               <p><span><?php echo $kullanici_getir['kullanici_mail']; ?></span> </p>
               <p> Üye Türü : <span style="color:<?php if ($kullanici_getir['kullanici_tipi'] == 'admin') {
                  echo 'var(--orange)';
                  } ?>"><?php echo $kullanici_getir['kullanici_tipi']; ?></span> </p>
               <a href="admin_uyeler.php?duzelt=<?php echo $kullanici_getir['kullanici_id']; ?>" class="option-btn">Düzelt</a>
               <a href="admin_uyeler.php?kaldir=<?php echo $kullanici_getir['kullanici_id']; ?>" onclick="return confirm('Üye silinsin mi?');" class="delete-btn">Kaldır</a>
            </div>
      <?php
      };
      ?>
   </div>
</section>

<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>

<script>
   document.querySelector('#duzelt_iptal').onclick = () => {
    document.querySelector('.edit-users-form').style.display = 'none';
    window.location.href = 'admin_uyeler.php';
}
</script>