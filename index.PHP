<?php
include('inc/session_start.php');
include('inc/koneksi.php');
include('inc/header.php');

// Mengambil ID user dari sesi
$id_register = $_SESSION['id_register']; // Pastikan Anda sudah mengatur sesi dan login user

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['pin'])) {
    $id_beranda = $_POST['id_beranda'];

    // Membuat prepared statement untuk menambahkan pin
    $stmt = $db->prepare("INSERT INTO pin (id_register, id_beranda) VALUES (?, ?)");

    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($db->error));
    }

    $stmt->bind_param("ii", $id_register, $id_beranda);

    if ($stmt->execute()) {
        echo "<script>alert('Berhasil menambahkan ke pin!'); window.location.href = 'index.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan ke pin!'); window.location.href = 'index.php';</script>";
    }

    $stmt->close();
}

?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Beranda</h1>

    <!-- Contoh Postingan -->
    <div class="row">
        <?php
        $result = $db->query("SELECT * FROM beranda");
        while ($row = $result->fetch_assoc()) {
            $link = $row['link'];
            // Tambahkan http:// jika tidak ada protokol pada link
            if (strpos($link, 'http://') !== 0 && strpos($link, 'https://') !== 0) {
                $link = 'http://' . $link;
            }

            echo '
            <div class="col-lg-6 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">' . htmlspecialchars($row['judul']) . '</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                <!-- Tambahkan form untuk menambahkan pin -->
                                <form method="POST" action="">
                                    <input type="hidden" name="id_beranda" value="' . $row['id_beranda'] . '">
                                    <button type="submit" name="pin" class="dropdown-item">Tambahkan ke Pin</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4 rounded" style="width: 20rem;" src="data:image/jpeg;base64,' . base64_encode($row['gambar']) . '" alt="...">
                        </div>
                        <p>' . htmlspecialchars($row['deskripsi']) . '</p>
                        <a target="_blank" rel="nofollow" href="' . htmlspecialchars($link) . '">Link ecommerce</a>
                    </div>
                </div>
            </div>';
        }
        $result->free();
        ?>
    </div>
</div>

<?php include('inc/footer.php'); ?>
