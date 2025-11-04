<?php

include_once '../config/class-roti.php';
$roti = new roti();

// Mengambil data dari POST dengan default jika tidak ada
$dataroti = [
    'id' => $_POST['id'] ?? 0,
    'kode' => $_POST['kode'] ?? '',
    'nama' => $_POST['nama'] ?? '',
    'toping' => $_POST['toping'] ?? '',
    'jumlah' => $_POST['jumlah'] ?? '',
    'alamat' => $_POST['alamat'] ?? '',
    'provinsi' => $_POST['provinsi'] ?? '',
    'email' => $_POST['email'] ?? '',
    'telp' => $_POST['telp'] ?? '',
    'status' => $_POST['status'] ?? ''
];

$edit = $roti->editroti($dataroti);

if($edit){
    header("Location: ../data-list.php?status=editsuccess");
} else {
    header("Location: ../data-edit.php?id=".$dataroti['id']."&status=failed");
}

?>
