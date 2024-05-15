<?php

include 'yapilandirma.php';

session_start();
session_unset();
session_destroy();

header('location:giris_yap.php');

?>