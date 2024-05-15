<?php
include 'yapilandirma.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location: giris_yap.php');
}

$message = array();

if (isset($_POST['urun_ekle'])) {
    $urun_adi = mysqli_real_escape_string($baglan, $_POST['urun_isim']);
    $urun_fiyati = $_POST['urun_fiyat'];
    $urun_yazari = mysqli_real_escape_string($baglan, $_POST['urun_yazar']);
    $urun_resimi = $_FILES['urun_resim']['name'];
    $urun_resim_boyutu = $_FILES['urun_resim']['size'];
    $urun_tmp_adi = $_FILES['urun_resim']['tmp_name'];
    $urun_resim_dosyasi = 'uploaded_img/' . $urun_resimi;

    $secili_urun_adi = mysqli_query($baglan, "SELECT urun_ad FROM `urunler` WHERE urun_ad = '$urun_adi'") or die('Sorgu başarısız');

    if (mysqli_num_rows($secili_urun_adi) > 0) {
        $message[] = 'Bu ürün zaten ekli';
    } else {
        $urun_ekleme_sorgusu = mysqli_query($baglan, "INSERT INTO `urunler` (urun_ad, urun_ucret, urun_yazar, urun_resim) VALUES ('$urun_adi', '$urun_fiyati', '$urun_yazari','$urun_resimi')") or die('Hatalı Sorgu');

        if ($urun_ekleme_sorgusu) {
            if ($urun_resim_boyutu > 2000000) {
                $message[] = 'Resim boyutu çok büyük!';
            } else {
                move_uploaded_file($urun_tmp_adi, $urun_resim_dosyasi);
                $message[] = 'Ürün başarıyla eklendi!';
            }
        } else {
            $message[] = 'Ürün eklenemedi!';
        }
    }
}

if (isset($_GET['kaldir'])) {
    $kalir_id = $_GET['kaldir'];
    $resim_kaldirma_sorgusu = mysqli_query($baglan, "SELECT urun_resim FROM `urunler` WHERE urun_id = '$kalir_id'") or die('query failed');
    $kaldirilan_resmi_getir = mysqli_fetch_assoc($resim_kaldirma_sorgusu);
    unlink('uploaded_img/' . $kaldirilan_resmi_getir['urun_resim']);
    mysqli_query($baglan, "DELETE FROM `urunler` WHERE urun_id = '$kalir_id'") or die('query failed');
    header('location: admin_urunler.php');
}

if (isset($_POST['duzelt_urun'])) {
    $duzelt_urun_id = $_POST['duzelt_urun_id'];
    $duzelt_ad = mysqli_real_escape_string($baglan, $_POST['duzelt_ad']);
    $duzelt_fiyat = $_POST['duzelt_fiyat'];
    $duzelt_yazar = mysqli_real_escape_string($baglan, $_POST['duzelt_yazar']);

    mysqli_query($baglan, "UPDATE `urunler` SET urun_ad = '$duzelt_ad', urun_ucret = '$duzelt_fiyat', urun_yazar = '$duzelt_yazar' WHERE urun_id = '$duzelt_urun_id'") or die('query failed');

    $duzelt_resim = $_FILES['duzelt_resim']['name'];
    $duzelt_resim_tmp_ad = $_FILES['duzelt_resim']['tmp_name'];
    $duzelt_resim_boyut = $_FILES['duzelt_resim']['size'];
    $duzelt_dosya = 'uploaded_img/' . $duzelt_resim;
    $duzelt_eski_resim = $_POST['duzelt_eski_resim'];

    if (!empty($duzelt_resim)) {
        if ($duzelt_resim_boyut > 2000000) {
            $message[] = 'Bu resmin boyutu çok büyük';
        } else {
            mysqli_query($baglan, "UPDATE `urunler` SET urun_resim = '$duzelt_resim' WHERE urun_id = '$duzelt_urun_id'") or die('query failed');
            move_uploaded_file($duzelt_resim_tmp_ad, $duzelt_dosya);
            unlink('uploaded_img/' . $duzelt_eski_resim);
        }
    }

    header('location: admin_urunler.php');
}

if (isset($_POST['duzelt_iptal'])) {
    
}
?>

<!DOCTYPE html>
<html lang="tr">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Yönetim Paneli: Ürünler</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/admin_style2.css">

    <style>
        .add-and-search-products {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .add-and-search-products h1 {
            text-transform: uppercase;
            color: var(--black);
            margin-bottom: 1.5rem;
        }

        .add-and-search-products .form-container {
            display: flex;
            gap: 50rem;
        }

        .add-and-search-products form {
            background-color: var(--white);
            border-radius: .5rem;
            padding: 2rem;
            text-align: center;
            box-shadow: var(--box-shadow);
            border: var(--border);
            max-width: 32rem;
        }

        .add-and-search-products form h3 {
            font-size: 2.5rem;
            text-transform: uppercase;
            color: var(--black);
            margin-bottom: 1.5rem;
        }

        .add-and-search-products form .box {
            width: 100%;
            background-color: var(--light-bg);
            border-radius: .5rem;
            margin: 1rem 0;
            padding: 1.2rem 1.4rem;
            color: var(--black);
            font-size: 1.8rem;
            border: var(--border);
        }

        .add-and-search-products form a{
            color: chocolate;
            padding: 0.1rem;
            font-size: 1.5rem;
        }

        .show-products .box-container{
            display: grid;
            grid-template-columns: repeat(auto-fit, 30rem);
            justify-content: center;
            gap:1.5rem;
            max-width: 1800px;
            margin:0 auto;
            align-items: flex-start;
        }

        .show-products{
            padding-top: 0;
        }

        .show-products .box-container .box{
                text-align: center;
                padding:2rem;
                border-radius: .5rem;
                border:var(--border);
                box-shadow: var(--box-shadow);
                background-color: var(--white);
        }

        .show-products .box-container .box img{
            height: 30rem;
        }

        .show-products .box-container .box .name{
            padding:1rem 0;
            font-size: 2rem;
            color:var(--black);
        }

        .show-products .box-container .box .price{
            padding:1rem 0;
            font-size: 2.5rem;
            color:var(--red);
        }

        .edit-product-form{
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

        .edit-product-form form{
            width: 400px;
            padding:2rem;
            text-align: center;
            border-radius: .5rem;
            background-color: var(--white);
        }

        .edit-product-form form img{
            height: 25rem;
            margin-bottom: 1rem;
        }

        .edit-product-form form .box{
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

    <section class="add-and-search-products">
        <div class="form-container">
            <form id="add-products" action="" method="post" enctype="multipart/form-data">
                <h3>Ürün Ekle</h3>
                <input type="text" name="urun_isim" class="box" placeholder="Ürün adı giriniz" required>
                <input type="text" name="urun_yazar" class="box" placeholder="Yazar adı giriniz" required>
                <input type="number" min="0" name="urun_fiyat" class="box" placeholder="Fiyat giriniz" required>
                <input type="file" name="urun_resim" accept="image/jpg, image/jpeg, image/png" class="box" required>
                <input type="submit" value="Ekle" name="urun_ekle" class="btn">
            </form>

            <form class="search-products" action="" method="post" enctype="multipart/form-data">
                <h3>Ürün Ara</h3>
                <input type="text" name="urun_isim_ara" class="box" placeholder="Ürün adı giriniz">
                <input type="text" name="urun_yazar_ara" class="box" placeholder="Yazar adı giriniz">
                <table>
                    <tr>
                        <td><input type="number" min="0" name="urun_min_fiyat" class="box" placeholder="Min. fiyat"></td>
                        <td><input type="number" min="0" name="urun_max_fiyat" class="box" placeholder="Max. fiyat"></td>
                    </tr>
                </table>
                <input type="submit" value="Ara" name="urun_ara" class="search-btn">
                <a href="admin_urunler.php">Temizle</a>
            </form>
        </div>
    </section>


    <section class="show-products">
    <?php
    if (isset($_POST['urun_ara'])) {
        $urun_adi = mysqli_real_escape_string($baglan, $_POST['urun_isim_ara']);
        $yazar_adi = mysqli_real_escape_string($baglan, $_POST['urun_yazar_ara']);
        $min_fiyat = isset($_POST['urun_min_fiyat']) ? (float)$_POST['urun_min_fiyat'] : 0;
        $max_fiyat = isset($_POST['urun_max_fiyat']) ? (float)$_POST['urun_max_fiyat'] : PHP_FLOAT_MAX;

        $arama_sorgusu = "SELECT * FROM `urunler` WHERE 1";

        if (!empty($urun_adi)) {
            $arama_sorgusu .= " AND urun_ad LIKE '%$urun_adi%'";
        }

        if (!empty($yazar_adi)) {
            $arama_sorgusu .= " AND urun_yazar LIKE '%$yazar_adi%'";
        }

        if (!empty($min_fiyat)) {
            if (!empty($max_fiyat)) {
                $arama_sorgusu .= " AND urun_ucret BETWEEN $min_fiyat AND $max_fiyat";
            } else {
                $arama_sorgusu .= " AND urun_ucret >= $min_fiyat";
            }
        } else {
            if (!empty($max_fiyat)) {
                $arama_sorgusu .= " AND urun_ucret <= $max_fiyat";
            }
        }

        $arama_sonucu = mysqli_query($baglan, $arama_sorgusu);

        if (!$arama_sonucu) {
            die("Arama hatası: " . mysqli_error($baglan));
        }

        echo '<h1 class="title">Mağaza Ürünleri</h1>
        <div class="box-container">';
        while ($urunu_getir = mysqli_fetch_assoc($arama_sonucu)) {
            ?>
            <div class="box">
                <img src="uploaded_img/<?php echo $urunu_getir['urun_resim']; ?>" alt="">
                <div class="name"><?php echo $urunu_getir['urun_ad']; ?></div>
                <div class="name"><?php echo "Yazar: " . $urunu_getir['urun_yazar']; ?></div>
                <div class="price">Fiyat: <?php echo $urunu_getir['urun_ucret']; ?>₺/-</div>
                <a href="admin_urunler.php?duzelt=<?php echo $urunu_getir['urun_id']; ?>" class="option-btn">Düzelt</a>
                <a href="admin_urunler.php?kaldir=<?php echo $urunu_getir['urun_id']; ?>" class="delete-btn" onclick="return confirm('Ürünü silmek istediğinizden emin misiniz?');">Kaldır</a>
            </div>
        <?php
        }
        echo '</div>';
    } else {
        $secili_urun = mysqli_query($baglan, "SELECT * FROM `urunler`") or die('query failed');

        echo '<h1 class="title">Mağaza Ürünleri</h1>
        <div class="box-container">';
        while ($urunu_getir = mysqli_fetch_assoc($secili_urun)) {
            ?>
            <div class="box">
                <img src="uploaded_img/<?php echo $urunu_getir['urun_resim']; ?>" alt="">
                <div class="name"><?php echo $urunu_getir['urun_ad']; ?></div>
                <div class="name">Yazar: <?php echo $urunu_getir['urun_yazar']; ?></div>
                <div class="price">Fiyat: <?php echo $urunu_getir['urun_ucret']; ?>₺/-</div>
                <a href="admin_urunler.php?duzelt=<?php echo $urunu_getir['urun_id']; ?>" class="option-btn">Düzelt</a>
                <a href="admin_urunler.php?kaldir=<?php echo $urunu_getir['urun_id']; ?>" class="delete-btn" onclick="return confirm('Ürünü silmek istediğinizden emin misiniz?');">Kaldır</a>
            </div>
        <?php
        }
        echo '</div>';
    }
    ?>
    </section>

    <section class="edit-product-form">
        <?php
        if (isset($_GET['duzelt'])) {
            $duzenle_id = $_GET['duzelt'];
            $duzelt_sorgu = mysqli_query($baglan, "SELECT * FROM `urunler` WHERE urun_id = '$duzenle_id'") or die('query failed');
            if (mysqli_num_rows($duzelt_sorgu) > 0) {
                while ($duzenle_getir = mysqli_fetch_assoc($duzelt_sorgu)) {
                    ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="duzelt_urun_id" value="<?php echo $duzenle_getir['urun_id']; ?>">
                        <input type="hidden" name="duzelt_eski_resim" value="<?php echo $duzenle_getir['urun_resim']; ?>">
                        <img src="uploaded_img/<?php echo $duzenle_getir['urun_resim']; ?>" alt="">
                        <input type="text" name="duzelt_ad" value="<?php echo $duzenle_getir['urun_ad']; ?>" class="box" required placeholder="Yeni ürün ismi giriniz">
                        <input type="text" name="duzelt_yazar" value="<?php echo $duzenle_getir['urun_yazar']; ?>" class="box" required placeholder="Yeni yazar adı giriniz">
                        <input type="number" name="duzelt_fiyat" value="<?php echo $duzenle_getir['urun_ucret']; ?>" min="0" class="box" required placeholder="Yeni ürün fiyatı giriniz">
                        <input type="file" class="box" name="duzelt_resim" accept="image/jpg, image/jpeg, image/png">
                        <input type="submit" value="Onay" name="duzelt_urun" class="accept-btn">
                        <input type="button" value="İptal" id="duzelt_iptal" class="cancel-btn">
                    </form>
        <?php
                }
            }
        } else {
            echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
        }
        ?>
    </section>

    <script src="js/admin_script.js"></script>
</body>

</html>

<script>
    document.querySelector('#duzelt_iptal').onclick = () => {
        document.querySelector('.edit-product-form').style.display = 'none';
        window.location.href = 'admin_urunler.php';
    }
</script>