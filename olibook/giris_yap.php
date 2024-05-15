<?php

include 'yapilandirma.php';
session_start();

if (isset($_POST['submit'])) {
    
    $email = mysqli_real_escape_string($baglan, $_POST['email']);
    $sifre = mysqli_real_escape_string($baglan, $_POST['sifre']);

    $secili_uye = mysqli_query($baglan, "SELECT * FROM kullanicilar WHERE kullanici_mail = '$email' AND kullanici_sifre = '$sifre'") or die('Email ve şifre aranırken bir sorun yaşandı');

    if (mysqli_num_rows($secili_uye) > 0) {

        $satir = mysqli_fetch_assoc($secili_uye);

        if ($satir['kullanici_tipi'] == 'admin') {

            $_SESSION['admin_ad'] = $satir['kullanici_ad'];
            $_SESSION['admin_soyad'] = $satir['kullanici_soyad'];
            $_SESSION['admin_mail'] = $satir['kullanici_mail'];
            $_SESSION['admin_id'] = $satir['kullanici_id'];
			echo "<script>alert('Giriş Başarılı!'); 
			alert('Yönetim Paneline Yönlendiriliyorsunuz.');
			window.location.href='admin_anasayfa.php';
			</script";

        } elseif ($satir['kullanici_tipi'] == 'uye') {

            $_SESSION['uye_ad'] = $satir['kullanici_ad'];
            $_SESSION['uye_soyad'] = $satir['kullanici_soyad'];
            $_SESSION['uye_email'] = $satir['kullanici_mail'];
            $_SESSION['uye_id'] = $satir['kullanici_id'];
			echo "<script>alert('Giriş Başarılı!'); 
			alert('Anasayfaya Yönlendiriliyorsunuz.');
			window.location.href='anasayfa.php';
			</script";

        }

    } else {

        $message[] = 'Hatalı mail veya şifre!';

    }

}

?>

<!DOCTYPE html>
<html lang="tr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Giris</title>

	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="css/main2.css">
</head>
<body>

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

<div class="form-container">

	<form action="" method="post">
		<h3>GIRIS YAP</h3>
		<input type="email" name= "email" placeholder="Mail adresinizi giriniz" required class="box">
        <input type="password" name = "sifre" placeholder="Şifrenizi giriniz" required class="box">
        <input type="submit" name="submit" value="giris yap" class="btn">
        <p>Kayıtlı bir hesabınız yok mu? <a href="kayit_ol.php"><b>Kayıt Ol</b></p>
	</form>

</div>
</body>
</html>