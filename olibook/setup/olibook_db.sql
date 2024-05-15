-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 13 Kas 2023, 13:11:21
-- Sunucu sürümü: 8.0.31
-- PHP Sürümü: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `olibook_db`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `anasayfa_alt_basliklar`
--

DROP TABLE IF EXISTS `anasayfa_alt_basliklar`;
CREATE TABLE IF NOT EXISTS `anasayfa_alt_basliklar` (
  `altbolum_id` int NOT NULL AUTO_INCREMENT,
  `altbolum1_baslik` varchar(20) COLLATE utf8mb3_turkish_ci NOT NULL,
  `altbolum1_1` varchar(20) COLLATE utf8mb3_turkish_ci NOT NULL,
  `altbolum1_1hash` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci NOT NULL,
  `altbolum1_2` varchar(20) COLLATE utf8mb3_turkish_ci NOT NULL,
  `altbolum1_2hash` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci NOT NULL,
  `altbolum1_3` varchar(20) COLLATE utf8mb3_turkish_ci NOT NULL,
  `altbolum1_3hash` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci NOT NULL,
  `altbolum1_4` varchar(20) COLLATE utf8mb3_turkish_ci NOT NULL,
  `altbolum1_4hash` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci NOT NULL,
  `altbolum2_baslik` varchar(20) COLLATE utf8mb3_turkish_ci NOT NULL,
  `altbolum2_1` varchar(20) COLLATE utf8mb3_turkish_ci NOT NULL,
  `altbolum2_1hash` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci NOT NULL,
  `altbolum2_2` varchar(20) COLLATE utf8mb3_turkish_ci NOT NULL,
  `altbolum2_2hash` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci NOT NULL,
  `altbolum2_3` varchar(20) COLLATE utf8mb3_turkish_ci NOT NULL,
  `altbolum2_3hash` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci NOT NULL,
  `altbolum2_4` varchar(20) COLLATE utf8mb3_turkish_ci NOT NULL,
  `altbolum2_4hash` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci NOT NULL,
  `altbolum3_baslik` varchar(20) COLLATE utf8mb3_turkish_ci NOT NULL,
  `altbolum3_1` varchar(20) COLLATE utf8mb3_turkish_ci NOT NULL,
  `altbolum3_2` varchar(20) COLLATE utf8mb3_turkish_ci NOT NULL,
  `altbolum3_3` varchar(20) COLLATE utf8mb3_turkish_ci NOT NULL,
  `altbolum3_4` varchar(20) COLLATE utf8mb3_turkish_ci NOT NULL,
  `altbolum4_baslik` varchar(20) COLLATE utf8mb3_turkish_ci NOT NULL,
  `altbolum4_1` varchar(20) COLLATE utf8mb3_turkish_ci NOT NULL,
  `altbolum4_1hash` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci NOT NULL,
  `altbolum4_2` varchar(20) COLLATE utf8mb3_turkish_ci NOT NULL,
  `altbolum4_2hash` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci NOT NULL,
  PRIMARY KEY (`altbolum_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

--
-- Tablo döküm verisi `anasayfa_alt_basliklar`
--

INSERT INTO `anasayfa_alt_basliklar` (`altbolum_id`, `altbolum1_baslik`, `altbolum1_1`, `altbolum1_1hash`, `altbolum1_2`, `altbolum1_2hash`, `altbolum1_3`, `altbolum1_3hash`, `altbolum1_4`, `altbolum1_4hash`, `altbolum2_baslik`, `altbolum2_1`, `altbolum2_1hash`, `altbolum2_2`, `altbolum2_2hash`, `altbolum2_3`, `altbolum2_3hash`, `altbolum2_4`, `altbolum2_4hash`, `altbolum3_baslik`, `altbolum3_1`, `altbolum3_2`, `altbolum3_3`, `altbolum3_4`, `altbolum4_baslik`, `altbolum4_1`, `altbolum4_1hash`, `altbolum4_2`, `altbolum4_2hash`) VALUES
(1, 'HIZLI LİNKLER', 'Anasayfa', 'anasayfa.php', 'Mağaza', 'magaza.php', 'İletişim', 'iletisim.php', 'Siparişler', 'siparisler.php', 'BİZİ TAKİP ET', 'Facebook', '#', 'Twitter', '#', 'İnstagram', '#', 'Linkedin', '#', 'İLETİŞİM İNFO', '0550-000-0000', '0550-000-0000', 'olibook@gmail.com', ' İzmir, Türkiye', 'EXTRA LİNKLER', 'Giriş Yap', 'giris_yap.php', 'Kayıt Ol', 'kayit_ol.php');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `anasayfa_icerikler`
--

DROP TABLE IF EXISTS `anasayfa_icerikler`;
CREATE TABLE IF NOT EXISTS `anasayfa_icerikler` (
  `icerik_id` int NOT NULL AUTO_INCREMENT,
  `icerik_baslik` varchar(150) COLLATE utf8mb3_turkish_ci NOT NULL DEFAULT 'Lorem ipsum dolor sit amet, consectetur adipisicing elit',
  `icerik_yazi` varchar(256) COLLATE utf8mb3_turkish_ci NOT NULL DEFAULT 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
  `icerik_buton_adres` varchar(100) COLLATE utf8mb3_turkish_ci NOT NULL,
  `icerik_buton` varchar(20) COLLATE utf8mb3_turkish_ci NOT NULL,
  PRIMARY KEY (`icerik_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

--
-- Tablo döküm verisi `anasayfa_icerikler`
--

INSERT INTO `anasayfa_icerikler` (`icerik_id`, `icerik_baslik`, `icerik_yazi`, `icerik_buton_adres`, `icerik_buton`) VALUES
(1, 'İstediğiniz kitap kapınıza kadar geliyor', 'Aradığınız tüm kitaplar bırada...', 'magaza.php', 'Daha Fazlası'),
(2, 'Bizimle iletişime mi geçmek istiyorsun?', 'Bizimle iletişime geçmek mi istiyorsunuz? O halde öyleyse iletişim kısmından bize ulaşabilirsiniz.', 'iletisim.php', 'İletişime Geç');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `anasayfa_urun_tanitim`
--

DROP TABLE IF EXISTS `anasayfa_urun_tanitim`;
CREATE TABLE IF NOT EXISTS `anasayfa_urun_tanitim` (
  `urun_tanitim_id` int NOT NULL AUTO_INCREMENT,
  `urun_tanitim_baslik` varchar(100) COLLATE utf8mb3_turkish_ci NOT NULL DEFAULT 'SON ÜRÜNLER',
  `urun_tanitim_miktar` tinyint NOT NULL DEFAULT '6',
  PRIMARY KEY (`urun_tanitim_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

--
-- Tablo döküm verisi `anasayfa_urun_tanitim`
--

INSERT INTO `anasayfa_urun_tanitim` (`urun_tanitim_id`, `urun_tanitim_baslik`, `urun_tanitim_miktar`) VALUES
(1, 'En Çok Satan ÜRÜNLER', 5);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `anasayfa_ust_basliklar`
--

DROP TABLE IF EXISTS `anasayfa_ust_basliklar`;
CREATE TABLE IF NOT EXISTS `anasayfa_ust_basliklar` (
  `bolum_id` int NOT NULL AUTO_INCREMENT,
  `bolum_birinci_baslik` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci NOT NULL,
  `bolum_ikinci_baslik` varchar(20) COLLATE utf8mb3_turkish_ci NOT NULL,
  `bolum_bir` varchar(20) COLLATE utf8mb3_turkish_ci NOT NULL DEFAULT 'Anasayfa',
  `bolum_iki` varchar(20) COLLATE utf8mb3_turkish_ci NOT NULL DEFAULT 'Mağaza',
  `bolum_uc` varchar(20) COLLATE utf8mb3_turkish_ci NOT NULL DEFAULT 'İletişim',
  `bolum_dort` varchar(20) COLLATE utf8mb3_turkish_ci NOT NULL DEFAULT 'Siparişler',
  PRIMARY KEY (`bolum_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

--
-- Tablo döküm verisi `anasayfa_ust_basliklar`
--

INSERT INTO `anasayfa_ust_basliklar` (`bolum_id`, `bolum_birinci_baslik`, `bolum_ikinci_baslik`, `bolum_bir`, `bolum_iki`, `bolum_uc`, `bolum_dort`) VALUES
(1, 'Oli', 'Book', 'Anasayfa', 'Mağaza', 'İletişim', 'Siparişler');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanicilar`
--

DROP TABLE IF EXISTS `kullanicilar`;
CREATE TABLE IF NOT EXISTS `kullanicilar` (
  `kullanici_id` int NOT NULL AUTO_INCREMENT,
  `kullanici_ad` varchar(100) COLLATE utf8mb3_turkish_ci NOT NULL,
  `kullanici_soyad` varchar(100) COLLATE utf8mb3_turkish_ci NOT NULL,
  `kullanici_mail` varchar(100) COLLATE utf8mb3_turkish_ci NOT NULL,
  `kullanici_sifre` varchar(100) COLLATE utf8mb3_turkish_ci NOT NULL,
  `kullanici_tipi` varchar(20) COLLATE utf8mb3_turkish_ci NOT NULL DEFAULT 'uye',
  PRIMARY KEY (`kullanici_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

--
-- Tablo döküm verisi `kullanicilar`
--

INSERT INTO `kullanicilar` (`kullanici_id`, `kullanici_ad`, `kullanici_soyad`, `kullanici_mail`, `kullanici_sifre`, `kullanici_tipi`) VALUES
(2, 'Admin', 'Username', 'admin@gmail.com', '123', 'admin'),
(3, 'User', 'Username', 'user@gmail.com', '123', 'uye'),
(4, 'Enes', 'Tekbaş', 'enestekbas@gmail.com', '123', 'uye'),
(6, 'Sadık', 'Serines', 'sadikserines@gmail.com', '123', 'uye'),
(7, 'Yasin Emre', 'Şentürk', 'yasinemre@gmail.com', '123', 'admin'),
(8, 'yasin', 'senturk', 'yasinsen@gmail.com', '123', 'uye');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `mesajlar`
--

DROP TABLE IF EXISTS `mesajlar`;
CREATE TABLE IF NOT EXISTS `mesajlar` (
  `mesaj_id` int NOT NULL AUTO_INCREMENT,
  `kullanici_id` int NOT NULL,
  `kullanici_ad` varchar(100) COLLATE utf8mb3_turkish_ci NOT NULL,
  `kullanici_soyad` varchar(100) COLLATE utf8mb3_turkish_ci NOT NULL,
  `kullanici_no` varchar(12) COLLATE utf8mb3_turkish_ci NOT NULL,
  `kullanici_mail` varchar(100) COLLATE utf8mb3_turkish_ci NOT NULL,
  `mesaj` varchar(500) COLLATE utf8mb3_turkish_ci NOT NULL,
  PRIMARY KEY (`mesaj_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

--
-- Tablo döküm verisi `mesajlar`
--

INSERT INTO `mesajlar` (`mesaj_id`, `kullanici_id`, `kullanici_ad`, `kullanici_soyad`, `kullanici_no`, `kullanici_mail`, `mesaj`) VALUES
(2, 1, 'Sadik', 'Serines', '5050266505', 'sadikserines05@gmail.com', 'Bu bir deneme mesajıdır. Sitenizde \'Deneme\' isminde bir kitap mevcut olmadığını görüyorum. Eklemenizi istiyorum.');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sepet`
--

DROP TABLE IF EXISTS `sepet`;
CREATE TABLE IF NOT EXISTS `sepet` (
  `sepet_id` int NOT NULL AUTO_INCREMENT,
  `uye_id` int NOT NULL,
  `urun_ad` varchar(100) COLLATE utf8mb3_turkish_ci NOT NULL,
  `urun_yazar` varchar(100) COLLATE utf8mb3_turkish_ci NOT NULL,
  `urun_ucret` int NOT NULL,
  `urun_miktar` int NOT NULL,
  `urun_resim` varchar(100) COLLATE utf8mb3_turkish_ci NOT NULL,
  PRIMARY KEY (`sepet_id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

--
-- Tablo döküm verisi `sepet`
--

INSERT INTO `sepet` (`sepet_id`, `uye_id`, `urun_ad`, `urun_yazar`, `urun_ucret`, `urun_miktar`, `urun_resim`) VALUES
(7, 10, 'Bash and L', 'Asss', 8, 5, 'bash_and_lucy-2.jpg'),
(8, 4, 'Bash and L', 'Asss', 8, 3, 'bash_and_lucy-2.jpg'),
(31, 7, 'Sinekli Bakkal', 'Halide Edip Adıvar', 100, 1, 'sinekli-bakkal.jpg'),
(32, 7, 'Nutuk', 'Atatürk', 150, 2, 'nutuk.jpg'),
(33, 7, 'Türkün Ateşle İmtihanı', 'Halide Edip Adıvar', 100, 1, 'türkün-ateşle-imtihanı.jpg'),
(36, 0, 'Sinekli Bakkal', 'Halide Edip Adıvar', 100, 1, 'sinekli-bakkal.jpg'),
(42, 3, 'Nutuk', 'Atatürk', 150, 1, 'nutuk.jpg'),
(45, 3, 'Mor Salkımlı Ev', 'Halide Edip Adıvar', 100, 1, 'mor-sakımlı-ev.jpg');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `siparisler`
--

DROP TABLE IF EXISTS `siparisler`;
CREATE TABLE IF NOT EXISTS `siparisler` (
  `siparis_id` int NOT NULL AUTO_INCREMENT,
  `kullanici_id` int NOT NULL,
  `kullanici_ad` varchar(100) COLLATE utf8mb3_turkish_ci NOT NULL,
  `kullanici_soyad` varchar(100) COLLATE utf8mb3_turkish_ci NOT NULL,
  `kullanici_numara` varchar(11) COLLATE utf8mb3_turkish_ci NOT NULL,
  `kullanici_mail` varchar(100) COLLATE utf8mb3_turkish_ci NOT NULL,
  `odeme_turu` varchar(50) COLLATE utf8mb3_turkish_ci NOT NULL,
  `kullanici_adres` varchar(500) COLLATE utf8mb3_turkish_ci NOT NULL,
  `toplam_urunler` varchar(1000) COLLATE utf8mb3_turkish_ci NOT NULL,
  `toplam_ucret` int NOT NULL,
  `siparis_tarih` varchar(50) COLLATE utf8mb3_turkish_ci NOT NULL,
  `odeme_durumu` varchar(20) COLLATE utf8mb3_turkish_ci NOT NULL DEFAULT 'askıda',
  PRIMARY KEY (`siparis_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urunler`
--

DROP TABLE IF EXISTS `urunler`;
CREATE TABLE IF NOT EXISTS `urunler` (
  `urun_id` int NOT NULL AUTO_INCREMENT,
  `urun_ad` varchar(100) COLLATE utf8mb3_turkish_ci NOT NULL,
  `urun_ucret` int NOT NULL,
  `urun_yazar` varchar(100) COLLATE utf8mb3_turkish_ci NOT NULL,
  `urun_resim` varchar(100) COLLATE utf8mb3_turkish_ci NOT NULL,
  PRIMARY KEY (`urun_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

--
-- Tablo döküm verisi `urunler`
--

INSERT INTO `urunler` (`urun_id`, `urun_ad`, `urun_ucret`, `urun_yazar`, `urun_resim`) VALUES
(11, 'Nutuk', 150, 'Atatürk', 'nutuk.jpg'),
(12, 'Türkün Ateşle İmtihanı', 100, 'Halide Edip Adıvar', 'türkün-ateşle-imtihanı.jpg'),
(13, 'Sinekli Bakkal', 100, 'Halide Edip Adıvar', 'sinekli-bakkal.jpg'),
(14, 'Mor Salkımlı Ev', 100, 'Halide Edip Adıvar', 'mor-sakımlı-ev.jpg'),
(15, 'Ateşten Gömlek', 100, 'Halide Edip Adıvar', 'ateşten-gömlek.jpg'),
(16, 'Don Kişot', 70, 'Miguel De Cervantes', 'don-kişot.jpg'),
(17, 'Harry Potter 1', 60, 'J. K. Rowling', 'harry-potter-1-felsefe-taşı.jpg'),
(18, 'Harry Potter 2', 65, 'J. K. Rowling', 'harry-potter-2-sırlar-odası.jpg'),
(19, 'Harry Potter 3', 70, 'J. K. Rowling', 'harry-potter-3-azkaban-tutsağı.jpg'),
(20, 'Harry Potter 4', 75, 'J. K. Rowling', 'harry-potter-4-ateş-kadehi.jpg'),
(21, 'Harry Potter 5', 65, 'J. K. Rowling', 'harry-potter-5-zümrüdüanka-yoldaşları.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
