<?php 
session_start();

include "../koneksi/koneksi.php";

if(isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = md5($_POST["password"]);

    $sql = "SELECT*FROM user WHERE username = '$username' AND password = '$password' ";
    $query = mysqli_query($koneksi,$sql);

    if(mysqli_num_rows($query) > 0) {
        $_SESSION["login"] = $username;
        header("location:../index.php?login=berhasil");
    }else {
        header("location:login.php?login=gagal");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="row justify-content-center">Login</h1>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <br>
                    <input type="submit" value="Login" name="login" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</body>
</html>