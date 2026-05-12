<?php
include "db.php";

$id = $_GET['id'];

$sql = "DELETE FROM toplantilar WHERE id=$id";
$baglanti->query($sql);

header("Location: index.php");
?>