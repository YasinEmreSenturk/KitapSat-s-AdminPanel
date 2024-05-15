<?php

include 'yapilandirma.php';

session_start();

$uye_id = $_SESSION['uye_id'];

if(!isset($uye_id)){
   header('location:giris_yap.php');
}

if(isset($_POST['gonder'])){

   $name = mysqli_real_escape_string($baglan, $_POST['name']);
   $surname = mysqli_real_escape_string($baglan, $_POST['surname']);
   $email = mysqli_real_escape_string($baglan, $_POST['email']);
   $number = $_POST['number'];
   $msg = mysqli_real_escape_string($baglan, $_POST['message']);

   $select_message = mysqli_query($baglan, "SELECT * FROM `mesajlar` WHERE kullanici_ad = '$name' AND kullanici_soyad = '$surname' AND kullanici_mail = '$email' AND kullanici_no = '$number' AND mesaj = '$msg'") or die('query failed');

   if(mysqli_num_rows($select_message) > 0){
      $message[] = 'Mesaj çoktan gönderildi!';
   }else{
      mysqli_query($baglan, "INSERT INTO `mesajlar`(kullanici_id, kullanici_ad, kullanici_soyad, kullanici_mail, kullanici_no, mesaj) VALUES('$uye_id', '$name', '$surname', '$email', '$number', '$msg')") or die('query failed');
      $message[] = 'Mesaj başarıyla gönderildi!';
   }

}

?>

<!DOCTYPE html>
<html lang="tr">
<head>
   
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>İletişim</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/main2.css">
   <style>
      
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

<?php include 'baslik.php';?>


<div class="heading">
   <h3>İletişime Geç</h3>
   <p> <a href="anasayfa.php">Anasayfa</a> / İletisim </p>
</div>

<section class="contact">

   <form action="" method="post">
      <h3>Bize Ulaşın!</h3>
      <input type="text" name="name" required placeholder="Adınızı giriniz" class="box">
      <input type="text" name="surname" required placeholder="Soyadınızı giriniz" class="box">
      <input type="email" name="email" required placeholder="Mailinizi giriniz" class="box">
      <input type="number" name="number" required placeholder="Numaranızı giriniz" class="box">
      <textarea name="message" class="box" placeholder="Mesajınızı giriniz" id="" cols="30" rows="10"></textarea>
      <input type="submit" value="Gönder" name="gonder" class="btn">
   </form>

</section>























<?php include 'altbaslik.php'; ?>


<script src="js/script.js"></script>

</body>
</html>