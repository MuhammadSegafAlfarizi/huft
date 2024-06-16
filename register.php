<?php 
include('inc/login_header.php');
include('inc/koneksi.php');

function isEmailAvailable($db, $email){
    $sql = "SELECT email FROM register WHERE email='$email'";
    return ($db->query($sql)->fetchAll() == null);
}

$errors = []; // varioabel yang akan digunakan untuk menampung pesan error validasi

// script kode ini hanya akan dieksekusi jika kita melakukan submit form
if (!empty($_POST)) {

    // ambil data yang dikirimkan melalui form dan simpan ke dalam variabel
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // lakukan validasi untuk tiap inputan, jika inputan kosong maka tambahkan pesan error kedalam variabel $errors
    if ($name == "") {
        $errors['name'] = "Nama tidak boleh kosong";
    }
    if ($email == "") {
        $errors['email'] = "Email tidak boleh kosong";
    }
    if ($password == "") {
        $errors['password'] = "Password tidak boleh kosong";
    }

    if (!$errors) {
        // cek duplikasi data
        if (isEmailAvailable($db, $email)) {
            // hash password untuk keamanan
            $password = password_hash($password, PASSWORD_DEFAULT);
            // buat sql
            $sql = "INSERT INTO register (name, email, password) VALUES ('$name', '$email', '$password')";
            // simpan data
            if ($db->exec($sql)) {
                // berhasil
                echo "<script>alert('Data berhasil disimpan');</script>";
                echo "<meta http-equiv='refresh' content='0; url=index.php'>";
            } else {
                // gagal
                echo "<script>alert('Gagal menyimpan data');</script>";
                echo "<meta http-equiv='refresh' content='0; url=index.php'>";
            }
        } else {
            $errors['email'] = "Email " . $email . " sudah digunakan";
        }
    }
}
?>

                            <?php foreach ($errors as $error) : ?>
                                <div class="alert bg-danger" role="alert">
                                <?= $error ?>
                                </div>
                                <?php endforeach; ?>

                            <form class="user" method="POST">
                                <div class="form-group">
                                    <input name="name" type="text" class="form-control form-control-user" id="exampleFirstName"
                                        placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <input name="email" type="email" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Email Address">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input name="password" type="password" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Password">
                                    </div>
                                    <div class="col-sm-6">
                                        <input name="repeat_password"type="password" class="form-control form-control-user"
                                            id="exampleRepeatPassword" placeholder="Repeat Password">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.php">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="login.php">Already have an account? Login!</a>
                            </div>

<?php include('inc/login_footer.php');