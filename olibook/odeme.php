<?php

include 'yapilandirma.php';

session_start();

setlocale(LC_TIME, 'tr_TR');


$uye_id = $_SESSION['uye_id'];

if(!isset($uye_id)){
   header('location:giris_yap.php');
}

if(isset($_POST['siparis_ver'])){

    $ad = mysqli_real_escape_string($baglan, $_POST['ad']);
    $soyad = mysqli_real_escape_string($baglan, $_POST['soyad']);
    $numara = $_POST['numara'];
    $mail = mysqli_real_escape_string($baglan, $_POST['mail']);
    $odeme_turu = mysqli_real_escape_string($baglan, $_POST['odeme_turu']);
    $adres = mysqli_real_escape_string($baglan, $_POST['adres1'].', '. $_POST['adres2'].', '. $_POST['ilce'].', '. $_POST['il'].' , '. $_POST['ulke'].' - '. $_POST['posta_kodu']);
    $siparis_tarihi = date('d-m-y');
 
    $sepet_toplam = 0;
    $sepet_urunleri[] = '';
 
    $sepet_sorgusu = mysqli_query($baglan, "SELECT * FROM `sepet` WHERE uye_id = '$uye_id'") or die('query failed');
    if(mysqli_num_rows($sepet_sorgusu) > 0){
       while($sepet_urunu = mysqli_fetch_assoc($sepet_sorgusu)){
          $sepet_urunleri[] = $sepet_urunu['urun_ad'].' ('.$sepet_urunu['urun_miktar'].') ';
          $alt_toplam = ($sepet_urunu['urun_ucret'] * $sepet_urunu['urun_miktar']);
          $sepet_toplam += $alt_toplam;
       }
    }
 
    $toplam_urunler = implode(', ',$sepet_urunleri);
 
    $order_query = mysqli_query($baglan, "SELECT * FROM `siparisler` WHERE kullanici_ad = '$ad' AND kullanici_soyad = '$soyad' AND kullanici_numara = '$numara' AND kullanici_mail = '$mail' AND odeme_turu = '$odeme_turu' AND kullanici_adres = '$adres' AND toplam_urunler = '$toplam_urunler' AND toplam_ucret = '$sepet_toplam'") or die('query failed');
 
    if($sepet_toplam == 0){
       $message[] = 'Sepetinizde ürün yok!';
    }else{
       if(mysqli_num_rows($order_query) > 0){
          $message[] = 'Sipariş zaten verilmiş!'; 
       }else{
          mysqli_query($baglan, "INSERT INTO `siparisler`(kullanici_id, kullanici_ad, kullanici_soyad, kullanici_numara, kullanici_mail, odeme_turu, kullanici_adres, toplam_urunler, toplam_ucret, siparis_tarih) VALUES('$uye_id', '$ad', '$soyad', '$numara', '$mail', '$odeme_turu', '$adres', '$toplam_urunler', '$sepet_toplam', '$siparis_tarihi')") or die('query failed');
          $message[] = 'Sipariş başarıyla gönderildi!';
          mysqli_query($baglan, "DELETE FROM `sepet` WHERE uye_id = '$uye_id'") or die('query failed');
       }
    }
    
 }
 
 ?>


<!DOCTYPE html>
<html lang="tr">
<head>
   
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Ödeme</title>

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

        .checkout form{
            max-width: 820px;
            padding:2rem;
            margin:0 auto;
            border:var(--border);
            background-color: var(--light-bg);
            border-radius: .5rem;
        }

        .checkout form h3{
            text-align: center;
            margin-bottom: 2rem;
            color:var(--black);
            text-transform: uppercase;
            font-size: 3rem;
        }

        .checkout form .flex{
            display: flex;
            flex-wrap: wrap;
            gap:1.5rem;
        }

        .checkout form .flex .inputBox{
            flex:1 1 40rem;
        }

        .checkout form .flex span{
            font-size: 2rem;
            color:var(--black);
        }

        .checkout form .flex select,
        .checkout form .flex input{
            border:var(--border);
            width: 100%;
            border-radius: .5rem;
            width: 100%;
            background-color: var(--white);
            padding:1.2rem 1.4rem;
            font-size: 1.8rem;
            margin:1rem 0;
        }
       
        .checkout .siparis-ver-btn{
            text-align: center;
        }
   </style>

</head>

<body>

<?php include 'baslik.php';?>

<div class="heading">
   <h3>Ödeme</h3>
   <p> <a href="anasayfa.php">Anasayfa</a> / Ödeme </p>
</div>

<section class="display-order">

   <?php  
      $buyuk_toplam = 0;
      $secili_sepet = mysqli_query($baglan, "SELECT * FROM `sepet` WHERE uye_id = '$uye_id'") or die('query failed');
      if(mysqli_num_rows($secili_sepet) > 0){
         while($sepet_getir = mysqli_fetch_assoc($secili_sepet)){
            $toplam_fiyat = ($sepet_getir['urun_ucret'] * $sepet_getir['urun_miktar']);
            $buyuk_toplam += $toplam_fiyat;
   ?>
   <p> <?php echo $sepet_getir['urun_ad']; ?> <span>(<?php echo $sepet_getir['urun_ucret'].'₺/-'.' x '. $sepet_getir['urun_miktar']; ?>)</span> </p>
   <?php
      }
   }else{
      echo '<p class="empty">Sepetiniz boş!</p>';
   }
   ?>
   <div class="grand-total"> Toplam : <span><?php echo $buyuk_toplam; ?>₺/-</span> </div>

</section>

<section class="checkout">

    <form action="" method="post">
        <h3>place your order</h3>
        <div class="flex">
            <table>
                <tr>
                    <td>
                        <div class="inputBox">
                            <span>Adınız :</span>
                            <input type="text" name="ad" required placeholder="Adınızı giriniz">      
                        </div>
                    </td>
                    <td>
                        <div class="inputBox">
                            <span>Soyadınız :</span>
                            <input type="text" name="soyad" required placeholder="Adınızı giriniz">      
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="inputBox">
                            <span>Numaranız :</span>
                            <input type="number" name="numara" required placeholder="Numaranızı giriniz">
                        </div>
                    </td>
                    <td>
                        <div class="inputBox">
                            <span>Mailiniz :</span>
                            <input type="email" name="mail" required placeholder="Mailinizi giriniz">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="inputBox">
                            <span>Ödeme Türü :</span>
                            <select name="odeme_turu">
                                <option value="deger" selected disabled>-</option>
                                <option value="Nakit">Kapıda Ödeme (Nakit)</option>
                                <option value="Kredi Kartı">Kredi Kartı</option>
                                <option value="Havale / EFT">Havale / EFT</option>
                                <option value="Hediye Çeki">Hediye Çeki</option>
                            </select>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="inputBox">
                            <span>Adres 1. Satır:</span>
                            <input type="text" name="adres1" required placeholder="Adresinizi yazın">
                        </div>
                    </td>
                    <td>
                        <div class="inputBox">
                            <span>Adres 2. Satır</span>
                            <input type="text" name="adres2" placeholder="Adresinizi yazın. (Opsiyonel)">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="inputBox">
                            <span>İlçe :</span>
                            <input type="text" name="ilce" required placeholder="Örn: Balçova">
                        </div>
                    </td>
                    <td>
                        <div class="inputBox">
                            <span>İl :</span>
                            <input type="text" name="il" required placeholder="Örn: İzmir">
                        </div>
                    </td>
                </tr>  
                <tr> 
                    <td>
                        <div class="inputBox">
                            <span>Ülke :</span>
                            <input type="text" name="ulke" required placeholder="Örn: Türkiye">
                        </div>
                    </td>
                    <td>
                        <div class="inputBox">
                            <span>Posta Kodu :</span>
                            <input type="number" min="0" name="posta_kodu" required placeholder="Örn: 3510">
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="siparis-ver-btn">
            <input type="submit" value="Siparişi Ver" class="btn" name="siparis_ver">
        </div>
    </form>

</section>


<?php include 'altbaslik.php'; ?>


<script src="js/script.js"></script>

</body>
</html>