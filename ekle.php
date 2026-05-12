<?php
session_start();
include "db.php";

// login kontrol (güvenlik)
if(!isset($_SESSION['kullanici'])){
    header("Location: login.php");
    exit;
}

$baslik = $_POST['baslik'];
$aciklama = $_POST['aciklama'];
$tarih = $_POST['tarih'];
$saat = $_POST['saat'];
$onem = $_POST['onem'];

// (ileride kullanıcıya özel yapmak için hazır)
$user_id = 1; // şimdilik sabit, sonra session ile bağlayacağız

$stmt = $baglanti->prepare("
INSERT INTO toplantilar (baslik, aciklama, tarih, saat, onem, user_id)
VALUES (?, ?, ?, ?, ?, ?)
");

$stmt->bind_param("sssssi", $baslik, $aciklama, $tarih, $saat, $onem, $user_id);

$stmt->execute();

header("Location: index.php");
exit;
?>