<?php

session_start();

if(!isset($_SESSION['kullanici'])){
    header("Location: login.php");
    exit;
}

include "db.php";

?>

<!DOCTYPE html>
<html>
<head>
    <title>Toplantı Zamanlayıcı</title>

    <link href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.3/dist/lux/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">

    <!-- FullCalendar -->
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css' rel='stylesheet'>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>

</head>

<body>

<div class="container mt-5" style="max-width: 1000px;">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h5>
            Hoşgeldin,
            <?php echo htmlspecialchars($_SESSION['kullanici']); ?>
        </h5>

        <a href="logout.php" class="btn btn-dark">
            Çıkış Yap
        </a>

    </div>

    <h1 class="text-center mb-4">📅 Toplantı Zamanlayıcı</h1>

    <!-- TOPLANTI EKLE -->
    <div class="card p-4 mb-4">

        <form action="ekle.php" method="POST">

            <input class="form-control mb-2" type="text" name="baslik" placeholder="Başlık" required>

            <textarea class="form-control mb-2" name="aciklama" placeholder="Açıklama"></textarea>

            <input class="form-control mb-2" type="date" name="tarih" required>

            <input class="form-control mb-2" type="time" name="saat" required>

            <!-- ÖNEM SEVİYESİ (RENK İÇİN) -->
            <select class="form-control mb-2" name="onem" required>
                <option value="low">Düşük</option>
                <option value="normal">Normal</option>
                <option value="high">Acil</option>
            </select>

            <button class="btn btn-primary w-100">Toplantı Ekle</button>

        </form>

    </div>

    <!-- TAKVİM -->
    <div class="card p-4 mb-4">

        <h4 class="mb-4">📆 Takvim</h4>

        <div id="calendar"></div>

    </div>

</div>

<!-- MODAL -->
<div class="modal fade" id="eventModal" tabindex="-1">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="modalTitle"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <p id="modalAciklama"></p>

        <p><b>Tarih:</b> <span id="modalTarih"></span></p>

        <p><b>Saat:</b> <span id="modalSaat"></span></p>

      </div>

    </div>

  </div>

</div>

<!-- BOOTSTRAP -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- TAKVİM -->
<script>

document.addEventListener('DOMContentLoaded', function() {

    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {

        initialView: 'dayGridMonth',
        locale: 'tr',

        events: 'takvim_veri.php',

        eventClick: function(info) {

            document.getElementById("modalTitle").innerText = info.event.title;
            document.getElementById("modalAciklama").innerText = info.event.extendedProps.aciklama;
            document.getElementById("modalSaat").innerText = info.event.extendedProps.saat;

            // daha doğru tarih formatı
            document.getElementById("modalTarih").innerText = info.event.start.toLocaleDateString();

            var myModal = new bootstrap.Modal(document.getElementById('eventModal'));
            myModal.show();
        }

    });

    calendar.render();

});

</script>

</body>
</html>