<?php

include 'yapilandirma.php';

if(isset($_POST['submit'])){

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
			echo "<script>alert('Kayıt Başarılı!'); 
			alert('Giriş Sayfasına Yönlendiriliyorsunuz...');
			window.location.href='giris_yap.php';
			</script";
		}
	}
}

?>

<!DOCTYPE html>
<html lang="tr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Kayıt</title>

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
		<h3>KAYIT OL</h3>
		<input type="text" name= "kullanici_adi" placeholder="Adınızı giriniz" required class="box" id="name">
		<input type="text" name= "kullanici_soyadi" placeholder="Soyadınızı giriniz" required class="box">
		<input type="email" name= "email" placeholder="Mail adresinizi giriniz" required class="box">
		<input type="password" name = "sifre" placeholder="Şifrenizi giriniz" required class="box">
		<input type="password" name="tekrar_sifre" placeholder="Şifrenizi tekrar giriniz" required class="box">
		<select name="uye_tipi">
			<option value="uye">uye olarak</option>
		</select>
		<input type="submit" name="submit" value="kayıt ol" class="btn">
		<p>Zaten kayıtlı bir hesabın var mı? <a href="giris_yap.php"><b>Giriş Yap</b></p>
	</form>

</div>
</body>
</html>