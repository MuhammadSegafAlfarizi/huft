<?php
include('inc/session_start.php');
include('inc/koneksi.php');
include('inc/header.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $link = $_POST['link'];
    $image = $_FILES['image']['tmp_name'];

    if ($image) {
        // Mengambil konten file gambar
        $imgContent = file_get_contents($image);

        // Membuat prepared statement
        $stmt = $db->prepare("INSERT INTO beranda (judul, deskripsi, link, gambar) VALUES (?, ?, ?, ?)");

        // Memeriksa apakah prepare berhasil
        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($db->error));
        }

        // Mengikat parameter ke placeholder
        $stmt->bind_param("ssss", $judul, $deskripsi, $link, $imgContent);

        // Menjalankan pernyataan
        if ($stmt->execute()) {
            echo "<script>alert('Data berhasil disimpan!'); window.location.href = 'index.php';</script>";
        } else {
            echo "<script>alert('Data gagal disimpan!'); window.location.href = 'post.php';</script>";
            exit();
        }

        // Menutup statement
        $stmt->close();
    } else {
        echo "<script>alert('Gambar tidak valid!'); window.location.href = 'post.php';</script>";
    }
}

$db->close();
?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Upload</h1>
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group row">
            <label for="inputHeader3" class="col-sm-2 col-form-label">Judul</label>
            <div class="col-sm-10">
                <input name="judul" type="text" class="form-control" id="inputHeader3" placeholder="Judul">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputDescription3" class="col-sm-2 col-form-label">Deskripsi</label>
            <div class="col-sm-10">
                <input name="deskripsi" type="text" class="form-control" id="inputDescription3" placeholder="Deskripsi">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Link pembelian</label>
            <div class="col-sm-10">
                <input name="link" type="text" class="form-control" id="inputEmail3" placeholder="Link pembelian">
            </div>
        </div>
        <div class="form-group row">
            <label for="exampleFormControlFile1" class="col-sm-2 col-form-label">Gambar</label>
            <div class="col-sm-10">
                <input name="image" type="file" class="form-control-file" id="exampleFormControlFile1">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10">
                <button type="submit" name="submit" class="btn btn-primary">Upload</button>
            </div>
        </div>
    </form>
</div>

<?php include('inc/footer.php'); ?>
