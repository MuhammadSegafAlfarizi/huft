<?php 

include('inc/header.php');

include ("inc/koneksi.php");

if(isset($_POST['submit'])){

    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $link = $_POST['link'];
    $gambar = $_POST['gambar'];
    
    //Perintah Query untuk proses insert ke database
    
    $sql_profil = "INSERT INTO beranda (judul, deskripsi, link, gambar)
                VALUES ('$judul','$deskripsi','$link','$gambar')";
    
    $query = mysqli_query($db, $sql_profil);
    
    if($query){
        echo "Berhasil Simpan!
            <meta http-equiv='refresh' content='3;url=index.php'>";
    } else {
        echo "Gagal simpan!
            <meta http-equiv='refresh' content='3;url=post.php'>";

    }

}


?>

<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Upload</h1>

    <form method="POST" >
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
            <label for="inputPassword3" class="col-sm-2 col-form-label">Gambar</label>
            <div class="col-sm-10">
                <input name="gambar" type="file" class="form-control-file" id="exampleFormControlFile1"> 
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

<?php include('inc/footer.php');?>