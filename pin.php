<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

include('inc/koneksi.php');
include('inc/header_without.php');

// Mengambil informasi user dari session
$id_register = $_SESSION['id_register'];
$name = $_SESSION['name'];
$email = $_SESSION['email'];
$password = $_SESSION['password'];

// Aktifkan pelaporan kesalahan
error_reporting(E_ALL);
ini_set('display_errors', 1);

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">OOTD yang tersimpan</h1>

    <!-- Content Row -->
    <div class="row">

        <?php
        // Mengambil data pin dari database berdasarkan id_register
        $sql = "SELECT beranda.id_beranda, beranda.judul, beranda.deskripsi, beranda.link, beranda.gambar 
                FROM pin 
                INNER JOIN beranda ON pin.id_beranda = beranda.id_beranda 
                WHERE pin.id_register = ?";
        $stmt = $db->prepare($sql);
        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($db->error));
        }
        $stmt->bind_param("i", $id_register);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            echo '<div class="col-lg-6 mb-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">' . htmlspecialchars($row['judul']) . '</h6>
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                    aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="hapus_pin.php?id_beranda=' . $row['id_beranda'] . '">Hapus dari Pin</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="text-center">
                                <img class="img-fluid px-3 px-sm-4 mt-3 mb-4 rounded" style="width: 20rem;"
                                    src="data:image/jpeg;base64,' . base64_encode($row['gambar']) . '" alt="...">
                            </div>
                            <p>' . htmlspecialchars($row['deskripsi']) . '</p>
                            <a target="_blank" rel="nofollow" href="' . htmlspecialchars($row['link']) . '">Link ecommerce</a>
                        </div>
                    </div>
                </div>';
        }

        $stmt->close();
        $db->close();
        ?>

    </div>

</div>
<!-- /.container-fluid -->

<?php include('inc/footer.php'); ?>
