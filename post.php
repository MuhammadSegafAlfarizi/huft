<?php 

include('inc/header.php');
include('inc/koneksi.php');
  
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = isset($_POST['judul']) ? $_POST['judul'] : '';
    $deskripsi = isset($_POST['deskripsi']) ? $_POST['deskripsi'] : '';
    $link = isset($_POST['link']) ? $_POST['link'] : '';
    $gambar = isset($_FILES['gambar']) ? $_FILES['gambar'] : '';

    if ($judul && $deskripsi && $link && $gambar && $gambar['error'] === UPLOAD_ERR_OK) {
        // Contoh penyimpanan data ke database
        $conn = new mysqli("localhost", "username", "password", "database");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("INSERT INTO tb_images (judul, deskripsi, link, dataimage) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $judul, $deskripsi, $link, file_get_contents($gambar['tmp_name']));

        if ($stmt->execute()) {
            echo "Data berhasil disimpan.";
            echo "<meta http-equiv='refresh' content='0; url=index.php'>";
        } else {
            echo "Terjadi kesalahan: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "Harap isi semua bidang dan pastikan tidak ada error dalam file upload.";
    }
}    
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
                <input name="link" type="url" class="form-control" id="inputEmail3" placeholder="Link pembelian">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Gambar</label>
            <div class="col-sm-10">
                <input name="gambar" type="file" class="form-control-file" id="exampleFormControlFile1"> 
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Upload</button>
            </div>
        </div>
    </form>
</div>

<?php include('inc/footer.php'); ?>
