<?php
include "db.php";

if($_POST){

    $kullanici_adi = $_POST['kullanici_adi'];

    // şifreyi şifrele
    $sifre = password_hash($_POST['sifre'], PASSWORD_DEFAULT);

    $stmt = $baglanti->prepare("
    INSERT INTO users(kullanici_adi, sifre)
    VALUES (?, ?)
    ");

    $stmt->bind_param("ss", $kullanici_adi, $sifre);

    $stmt->execute();

    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kayıt Ol</title>

    <link href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.3/dist/lux/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5" style="max-width:500px;">

    <div class="card p-4">

        <h2 class="text-center mb-4">Kayıt Ol</h2>

        <form method="POST">

            <input class="form-control mb-3"
                   type="text"
                   name="kullanici_adi"
                   placeholder="Kullanıcı Adı"
                   required>

            <input class="form-control mb-3"
                   type="password"
                   name="sifre"
                   placeholder="Şifre"
                   required>

            <button class="btn btn-primary w-100">
                Kayıt Ol
            </button>

        </form>

        <a href="login.php" class="mt-3 text-center">
            Giriş Yap
        </a>

    </div>

</div>

</body>
</html>