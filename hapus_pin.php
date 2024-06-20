<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

include('inc/koneksi.php');

// Mengambil informasi user dari session
$id_register = $_SESSION['id_register'];

// Aktifkan pelaporan kesalahan
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Menghapus pin jika diminta
if (isset($_GET['id_beranda'])) {
    $id_beranda = $_GET['id_beranda'];

    // Tambahkan debugging untuk memastikan nilai yang diterima
    echo "<pre>";
    echo "Debugging Info:\n";
    echo "id_register: " . htmlspecialchars($id_register) . "\n";
    echo "id_beranda: " . htmlspecialchars($id_beranda) . "\n";
    echo "</pre>";

    $stmt = $db->prepare("DELETE FROM pin WHERE id_beranda = ? AND id_register = ?");
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($db->error));
    }
    $stmt->bind_param("ii", $id_beranda, $id_register);

    if ($stmt->execute()) {
        echo "<script>alert('Pin berhasil dihapus!'); window.location.href = 'index.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus pin: " . htmlspecialchars($stmt->error) . "'); window.location.href = 'index.php';</script>";
    }

    $stmt->close();
} else {
    echo "<script>alert('ID beranda tidak ditemukan!'); window.location.href = 'index.php';</script>";
}

$db->close();
?>