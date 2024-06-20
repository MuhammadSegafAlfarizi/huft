<?php 

include('inc/session_start.php');
include('inc/koneksi.php');
include('inc/header_without.php');

if (!isset($_SESSION['id_register'])) {
    echo "<script>alert('Anda harus login terlebih dahulu!'); window.location.href = 'login.php';</script>";
    exit();
}

$id_register = $_SESSION['id_register'];
$sql = "SELECT * FROM register WHERE id_register = '$id_register'";
$result = mysqli_query($db, $sql);

if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    echo "Data pengguna tidak ditemukan.";
    exit();
}

?>

<!-- Begin Page Content -->
<div class="container-fluid">

<h1 class="h3 mb-4 text-gray-800">Data Profile</h1>

<!-- Basic Card Example -->
<div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Data Profil</h6>
                                </div>
                                <div class="card-body">
                                    <form>
                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-2 col-form-label">Nama</label>
                                            <div class="col-sm-10">
                                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?php echo htmlspecialchars($user['name']); ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?php echo htmlspecialchars($user['email']); ?>">
                                            </div>
                                        </div>
                                    </form>
                                    
                                </div>
                            </div>

<div class="container-fluid">

<?php include('inc/footer.php');?>