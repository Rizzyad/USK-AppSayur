<?php 
session_start();

if(isset($_SESSION["login"])) {
    header("../login/login.php?pesan=aksesditolak");
}

include "../koneksi/koneksi.php";

if(isset($_POST["tambah"])) {
    $nama_pembeli = $_POST["nama_pembeli"];
    $no_hp = $_POST["no_hp"];

    $sql = "INSERT INTO pembeli (nama_pembeli, no_hp) VALUES ('$nama_pembeli', '$no_hp') ";
    $query = mysqli_query($koneksi,$sql);

    if($query) {
        header("location:../pembeli.php?tambah=berhasil");
    }else{
        header("location:../pembeli.php?tambah=gagal");
    }
}

if(isset($_POST["edit"])) {
    $id_pembeli = $_POST["id_pembeli"];
    $nama_pembeli = $_POST["nama_pembeli"];
    $no_hp = $_POST["no_hp"];

    $sql = "UPDATE pembeli SET nama_pembeli = '$nama_pembeli', no_hp = '$no_hp' WHERE id_pembeli = '$id_pembeli' ";
    $query = mysqli_query($koneksi,$sql);

    if($query) {
        header("location:../pembeli.php?edit=berhasil");
    }else{
        header("location:../pembeli.php?edit=gagal");
    }
}

if(isset($_GET["id_pembeli"])) {
    $id_pembeli = $_GET["id_pembeli"];

    $sql = "DELETE FROM pembeli WHERE id_pembeli = '$id_pembeli' ";
    $query = mysqli_query($koneksi,$sql);

    if($query) {
        header("location:../pembeli.php?hapus=berhasil");
    }else{
        header("location:../pembeli.php?hapus=gagal");
    }
}
?>