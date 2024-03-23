<?php 
session_start();

if(isset($_SESSION["login"])) {
    header("../login/login.php?pesan=aksesditolak");
}

include "../koneksi/koneksi.php";

if(isset($_POST["tambah"])) {
    $id_supplier = $_POST["id_supplier"];
    $nama_barang = $_POST["nama_barang"];
    $stok = $_POST["stok"];
    $harga_perkilo = $_POST["harga_perkilo"];

    $sql = "INSERT INTO barang (id_supplier, nama_barang, stok, harga_perkilo) VALUES ('$id_supplier', '$nama_barang','$stok','$harga_perkilo') ";
    $query = mysqli_query($koneksi,$sql);

    if($query) {
        header("location:../barang.php?tambah=berhasil");
    }else{
        header("location:../barang.php?tambah=gagal");
    }
}

if(isset($_POST["edit"])) {
    $id_barang = $_POST["id_barang"];
    $id_supplier = $_POST["id_supplier"];
    $nama_barang = $_POST["nama_barang"];
    $stok = $_POST["stok"];
    $harga_perkilo = $_POST["harga_perkilo"];

    $sql = "UPDATE barang SET id_supplier = '$id_supplier', nama_barang = '$nama_barang', stok = '$stok', harga_perkilo = '$harga_perkilo' WHERE id_barang = '$id_barang' ";
    $query = mysqli_query($koneksi,$sql);

    if($query) {
        header("location:../barang.php?edit=berhasil");
    }else{
        header("location:../barang.php?edit=gagal");
    }
}

if(isset($_GET["id_barang"])) {
    $id_barang = $_GET["id_barang"];

    $sql = "DELETE FROM barang WHERE id_barang = '$id_barang' ";
    $query = mysqli_query($koneksi,$sql);

    if($query) {
        header("location:../barang.php?hapus=berhasil");
    }else{
        header("location:../barang.php?hapus=gagal");
    }
}
?>