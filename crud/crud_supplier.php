<?php 
session_start();

if(isset($_SESSION["login"])) {
    header("../login/login.php?pesan=aksesditolak");
}

include "../koneksi/koneksi.php";

if(isset($_POST["tambah"])) {
    $nama_supplier = $_POST["nama_supplier"];
    $alamat = $_POST["alamat"];
    $no_hp = $_POST["no_hp"];

    $sql = "INSERT INTO supplier (nama_supplier, alamat, no_hp) VALUES ('$nama_supplier', '$alamat', '$no_hp') ";
    $query = mysqli_query($koneksi,$sql);

    if($query) {
        header("location:../supplier.php?tambah=berhasil");
    }else{
        header("location:../supplier.php?tambah=gagal");
    }
}

if(isset($_POST["edit"])) {
    $id_supplier = $_POST["id_supplier"];
    $nama_supplier = $_POST["nama_supplier"]; 
    $alamat = $_POST["alamat"]; 
    $no_hp = $_POST["no_hp"];

    $sql = "UPDATE supplier SET nama_supplier = '$nama_supplier', alamat = '$alamat', no_hp = '$no_hp' WHERE id_supplier = '$id_supplier' ";
    $query = mysqli_query($koneksi,$sql);

    if($query) {
        header("location:../supplier.php?edit=berhasil");
    }else{
        header("location:../supplier.php?edit=gagal");
    }
}

if(isset($_GET["id_supplier"])) {
    $id_supplier = $_GET["id_supplier"];

    $sql = "DELETE FROM supplier WHERE id_supplier = '$id_supplier' ";
    $query = mysqli_query($koneksi,$sql);

    if($query) {
        header("location:../supplier.php?hapus=berhasil");
    }else{
        header("location:../supplier.php?hapus=gagal");
    }
}
?>