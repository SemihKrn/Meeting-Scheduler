<?php
$baglanti = new mysqli("localhost", "root", "", "toplanti_db");

if ($baglanti->connect_error) {
    die("Bağlantı hatası: " . $baglanti->connect_error);
}
?>