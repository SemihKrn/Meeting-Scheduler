<?php

include "db.php";

$toplantilar = [];

// şimdilik tüm kullanıcılar (sonra user_id filtre ekleyeceğiz)
$sql = "SELECT * FROM toplantilar";

$sonuc = $baglanti->query($sql);

while($row = $sonuc->fetch_assoc()){

    // RENK SİSTEMİ
    $color = "#0d6efd"; // default mavi

    if(isset($row['onem'])){

        if($row['onem'] == "high"){
            $color = "#dc3545"; // kırmızı (acil)
        }
        else if($row['onem'] == "normal"){
            $color = "#ffc107"; // sarı
        }
        else if($row['onem'] == "low"){
            $color = "#198754"; // yeşil
        }
    }

    $toplantilar[] = [

        'title' => $row['baslik'],

        'start' => $row['tarih'],

        'color' => $color,

        // modal için ekstra bilgiler
        'extendedProps' => [

            'aciklama' => $row['aciklama'] ?? '',
            'saat' => $row['saat'] ?? ''
        ]

    ];
}

header('Content-Type: application/json');

echo json_encode($toplantilar);