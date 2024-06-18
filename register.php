<?php 
include('inc/login_header.php');
include('inc/koneksi.php');

if(isset($_POST['submit'])){
    mysqli_query($db, "insert into register set
    name = '$_POST[name]',
    email = '$_POST[email]',
    password = '$_POST[password]'
    ");

    echo "<script>alert('Data berhasil disimpan!'); window.location.href = 'login.php';</script>";

}

?>

                            <form class="user" method="POST">
                                <div class="form-group">
                                    <input name="name" type="text" class="form-control form-control-user" id="exampleFirstName"
                                        placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <input name="email" type="email" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Email Address">
                                </div>
                                <div class="form-group">
                                    <input name="password" type="password" class="form-control form-control-user" id="exampleInputPassword" 
                                        placeholder="Password">
                                </div>
                                <button name="submit" type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.php">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="login.php">Already have an account? Login!</a>
                            </div>

<?php include('inc/login_footer.php');