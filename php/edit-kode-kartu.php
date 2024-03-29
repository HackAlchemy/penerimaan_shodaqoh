<?php
include "../db_conn.php";

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form inputs from the request body
    $kodetrx = $_POST['kodetrx'];
    $operator = $_POST['operator'];
    $tanggal = $_POST['tanggal'];
    $gelar1 = $_POST['gelar1'];
    $nama = $_POST['nama'];
    $gelar2 = $_POST['gelar2'];
    $alamat = $_POST['lengkap'];
    $telepon = $_POST['telepon'];
    $total_sumbangan = $_POST['sumbangan_barang'];
    $total_sumbangan_rp = $_POST['sumbangan_uang'];
    $kode_kartu = $_POST['kode_kartu'];
    $ambil_kartu = $_POST['ambil_kartu'] ?? null;

    // Update ke database
    $update_main = "UPDATE input SET 
    operator = ?, 
    tanggal = ?, 
    gelar1 = ?, 
    nama = ?, 
    gelar2 = ?, 
    alamat = ?, 
    telepon = ?, 
    total_sumbangan_rp = ?, 
    total_sumbangan = ?,
    kode_kartu = ?,
    ambil_kartu = ?
    WHERE kodetrx = ?";
    $stmt = mysqli_prepare($conn, $update_main);
    mysqli_stmt_bind_param($stmt, "ssssssssssss", $operator, $tanggal, $gelar1, $nama, $gelar2, $alamat, $telepon, $total_sumbangan_rp, $total_sumbangan, $kode_kartu, $ambil_kartu, $kodetrx);

    // Eksekusi query
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo "<script>
        alert('Data berhasil disimpan');
        window.location.href = '../form.php';
        </script>";
        exit();
    } else {
        echo "<script>
        alert('Kode Kartu gagal disimpan');
        window.location.href = '../form.php';
        </script>";
    }
} else {
    // Display error message if the request is not a POST request
    echo "Invalid request.";
}
