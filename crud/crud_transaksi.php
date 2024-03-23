<?php 
session_start();

if(isset($_SESSION["login"])) {
    header("../login/login.php?pesan=aksesditolak");
}

include "../koneksi/koneksi.php";

if(isset($_POST["tambah"])) {
    $id_pembeli = $_POST["id_pembeli"];
    $id_barang = $_POST["id_barang"];
    $jumlah = $_POST["jumlah"];

    $query_barang = mysqli_query($koneksi,"SELECT*FROM barang WHERE id_barang = '$id_barang' "); 
    while($barang = mysqli_fetch_assoc($query_barang)) {
        $stok = $barang["stok"];
    }

    if($jumlah > $stok) {
        echo "<script>
            alert('Jumlah melebihi stok barang');
            window.location.href='../index.php';
            </script>";
        exit();
    }

    $tgl_transaksi = $_POST["tgl_transaksi"];

    $sql = "INSERT INTO transaksi (id_pembeli, id_barang, jumlah, tgl_transaksi) VALUES ('$id_pembeli', '$id_barang','$jumlah','$tgl_transaksi') ";
    $query = mysqli_query($koneksi,$sql);

    if($query) {
        header("location:../index.php?tambah=berhasil");
    }else{
        header("location:../index.php?tambah=gagal");
    }
}

if(isset($_POST["edit"])) {
    $id_transaksi = $_POST["id_transaksi"];
    $id_pembeli = $_POST["id_pembeli"];
    $id_barang = $_POST["id_barang"];
    $jumlah = $_POST["jumlah"];
    $tgl_transaksi = $_POST["tgl_transaksi"];

    $sql = "UPDATE transaksi SET id_pembeli = '$id_pembeli', id_barang = '$id_barang', jumlah = '$jumlah', tgl_transaksi = '$tgl_transaksi' WHERE id_transaksi = '$id_transaksi' ";
    $query = mysqli_query($koneksi,$sql);

    if($query) {
        header("location:../index.php?edit=berhasil");
    }else{
        header("location:../index.php?edit=gagal");
    }
}

if(isset($_GET["id_transaksi"])) {
    $id_transaksi = $_GET["id_transaksi"];

    $sql = "DELETE FROM transaksi WHERE id_transaksi = '$id_transaksi' ";
    $query = mysqli_query($koneksi,$sql);

    if($query) {
        header("location:../index.php?hapus=berhasil");
    }else{
        header("location:../index.php?hapus=gagal");
    }
}
?>