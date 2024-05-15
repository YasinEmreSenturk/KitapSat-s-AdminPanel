<?php

include 'yapilandirma.php';

$anasayfa_AltBasliklar_Sorgu = "SELECT * FROM anasayfa_alt_basliklar";
$anasayfa_AltBasliklar_getir = mysqli_query($baglan, $anasayfa_AltBasliklar_Sorgu);
$anasayfaAltBasliklar = mysqli_fetch_assoc($anasayfa_AltBasliklar_getir);

?>



<section class="footer">

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

</section>