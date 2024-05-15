<?php

session_start();

include 'yapilandirma.php';

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:giris_yap.php');
}

if (isset($_POST['siparis_duzelt'])) {
    $siparis_guncel_id = mysqli_real_escape_string($baglan, $_POST['siparis_id']);
    $guncel_odeme = mysqli_real_escape_string($baglan, $_POST['guncel_odeme']);
    $query = "UPDATE `siparisler` SET odeme_durumu = '$guncel_odeme' WHERE siparis_id = '$siparis_guncel_id'";
    mysqli_query($baglan, $query) or die('Query failed');
    $message[] = 'Ödeme durumu güncellendi!';
}

if (isset($_GET['kaldir'])) {
    $kaldir_id = mysqli_real_escape_string($baglan, $_GET['kaldir']);
    mysqli_query($baglan, "DELETE FROM `siparisler` WHERE siparis_id = '$kaldir_id'") or die('Query failed');
    header('location:admin_siparisler.php');
}

?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yönetim Paneli: Siparişler</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/admin_style2.css">

    <style>
        .orders .box-container{
            display: grid;
            grid-template-columns: repeat(auto-fit, 30rem);
            justify-content: center;
            gap:1.5rem;
            max-width: 1200px;
            margin:0 auto;
            align-items: flex-start;
        }

        .orders .box-container .box{
            background-color: var(--white);
            padding:2rem;
            border:var(--border);
            box-shadow: var(--box-shadow);
            border-radius: .5rem;
        }

        .orders .box-container .box p{
            padding-bottom: 1rem;
            font-size: 2rem;
            color:var(--light-color);
        }

        .orders .box-container .box p span{
            color:var(--purple);
        }

        .orders .box-container .box form{
            text-align: center;
        }

        .orders .box-container .box form select{
            border-radius: .5rem;
            margin:.5rem 0;
            width: 100%;
            background-color: var(--light-bg);
            border:var(--border);
            padding:1.2rem 1.4rem;
            font-size: 1.8rem;
            color:var(--black);
        }
    </style>
</head>

<body>
    <?php include 'admin_baslik.php'; ?>

    <section class="orders">
        <h1 class="title">Verilen Siparişler</h1>
        <div class="box-container">
            <?php
            $secili_siparis = mysqli_query($baglan, "SELECT * FROM `siparisler`") or die('Query failed');
            if (mysqli_num_rows($secili_siparis) > 0) {
                while ($siparis_getir = mysqli_fetch_assoc($secili_siparis)) {
            ?>
                    <div class="box">
                        <p> Kullanıcı Id : <span><?php echo $siparis_getir['kullanici_id']; ?></span> </p>
                        <p> Sipariş Tarihi : <span><?php echo $siparis_getir['siparis_tarih']; ?></span> </p>
                        <p> Adı : <span><?php echo $siparis_getir['kullanici_ad']; ?></span> </p>
                        <p> Soyadı : <span><?php echo $siparis_getir['kullanici_soyad']; ?></span> </p>
                        <p> Tel No: <span><?php echo $siparis_getir['kullanici_numara']; ?></span> </p>
                        <p> Mail : <span><?php echo $siparis_getir['kullanici_mail']; ?></span> </p>
                        <p> Adres : <span><?php echo $siparis_getir['kullanici_adres']; ?></span> </p>
                        <p> Toplam Ürünler : <span><?php echo $siparis_getir['toplam_urunler']; ?></span> </p>
                        <p> Toplam Fiyat : <span><?php echo $siparis_getir['toplam_ucret']; ?>₺/-</span> </p>
                        <p> Ödeme Türü : <span><?php echo $siparis_getir['odeme_turu']; ?></span> </p>

                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <input type="hidden" name="siparis_id" value="<?php echo $siparis_getir['siparis_id']; ?>">
                            <select name="guncel_odeme">
                                <?php
                                $secili_askida = ($siparis_getir['odeme_durumu'] == 'askida') ? 'selected' : '';
                                $secili_tamamlanan = ($siparis_getir['odeme_durumu'] == 'tamamlandı') ? 'selected' : '';
                                ?>
                                <option value="askida" <?php echo $secili_askida; ?>>askıda</option>
                                <option value="tamamlandı" <?php echo $secili_tamamlanan; ?>>tamamlanan</option>
                            </select>
                            <input type="submit" value="Düzelt" name="siparis_duzelt" class="option-btn">
                            <a href="admin_siparisler.php?kaldir=<?php echo $siparis_getir['siparis_id']; ?>" onclick="return confirm('Sipariş silinsin mi?');" class="delete-btn">Kaldır</a>
                        </form>
                    </div>
            <?php
                }
            } else {
                echo '<p class="empty">Henüz sipariş verilmedi!</p>';
            }
            ?>
        </div>
    </section>

    <script src="js/admin_script.js"></script>

</body>

</html>