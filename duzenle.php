<?php
include "db.php";

// ID al
$id = $_GET['id'];

// veriyi çek
$sonuc = $baglanti->query("SELECT * FROM toplantilar WHERE id=$id");
$row = $sonuc->fetch_assoc();

// form gönderildiyse güncelle
if($_POST){
    $baslik = $_POST['baslik'];
    $aciklama = $_POST['aciklama'];
    $tarih = $_POST['tarih'];
    $saat = $_POST['saat'];

    $baglanti->query("
        UPDATE toplantilar 
        SET baslik='$baslik', aciklama='$aciklama', tarih='$tarih', saat='$saat'
        WHERE id=$id
    ");

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Toplantı Düzenle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.3/dist/lux/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h2>✏️ Toplantı Düzenle</h2>

    <form method="POST">

        <input class="form-control mb-2" type="text" name="baslik" 
               value="<?php echo $row['baslik']; ?>">

        <textarea class="form-control mb-2" name="aciklama"><?php echo $row['aciklama']; ?></textarea>

        <input class="form-control mb-2" type="date" name="tarih" 
               value="<?php echo $row['tarih']; ?>">

        <input class="form-control mb-2" type="time" name="saat" 
               value="<?php echo $row['saat']; ?>">

        <button class="btn btn-success w-100">Güncelle</button>

    </form>

</div>

</body>
</html>