<?php
include('inc/session_start.php');
include('inc/koneksi.php');
include('inc/header.php');

// Ambil query pencarian
$query = isset($_GET['q']) ? $_GET['q'] : '';

?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Hasil Pencarian untuk "<?php echo htmlspecialchars($query); ?>"</h1>

    <!-- Hasil Pencarian -->
    <div class="row">
        <?php
        if ($query) {
            // Buat query pencarian menggunakan prepared statements untuk keamanan
            $stmt = $db->prepare("SELECT * FROM beranda WHERE judul LIKE ?");
            $search = "%" . $query . "%";
            $stmt->bind_param("s", $search);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
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
            } else {
                echo '<p>Tidak ada hasil ditemukan.</p>';
            }

            $stmt->close();
        }
        ?>
    </div>
</div>

<?php include('inc/footer.php'); ?>
