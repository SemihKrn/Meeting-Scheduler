<?php
session_start();

include "db.php";

$hata = "";

if($_POST){

    $kullanici_adi = $_POST['kullanici_adi'];
    $sifre = $_POST['sifre'];

    $stmt = $baglanti->prepare("
    SELECT * FROM users
    WHERE kullanici_adi=?
    ");

    $stmt->bind_param("s", $kullanici_adi);

    $stmt->execute();

    $sonuc = $stmt->get_result();

    if($sonuc->num_rows > 0){

        $user = $sonuc->fetch_assoc();

        if(password_verify($sifre, $user['sifre'])){

            $_SESSION['kullanici'] = $user['kullanici_adi'];

            header("Location: index.php");

        }else{
            $hata = "Şifre yanlış!";
        }

    }else{
        $hata = "Kullanıcı bulunamadı!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Giriş Yap</title>

    <link href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.3/dist/lux/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5" style="max-width:500px;">

    <div class="card p-4">

        <h2 class="text-center mb-4">Giriş Yap</h2>

        <?php
        if($hata){
            echo "<div class='alert alert-danger'>$hata</div>";
        }
        ?>

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

            <button class="btn btn-success w-100">
                Giriş Yap
            </button>

        </form>

        <a href="register.php" class="mt-3 text-center">
            Hesap Oluştur
        </a>

    </div>

</div>

</body>
</html>