<?php 
session_start();

if(!isset($_SESSION["login"])) {
    header("location:login/login.php?pesan=aksesditolak");
}

include "koneksi/koneksi.php";

$sql = "SELECT*FROM barang b
        INNER JOIN supplier p ON b.id_supplier = p.id_supplier ORDER BY b.id_barang ASC ";
$query = mysqli_query($koneksi,$sql);

$sql_supplier = "SELECT*FROM supplier";
$query_supplier = mysqli_query($koneksi,$sql_supplier);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pembeli</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
        <div class="container-fluid">
            <div class="collapse navbar-collapse">
                <div class="navbar-brand">TOKO SAYUR</div>
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link">Transaksi</a>
                    </li>
                    <li class="nav-item">
                        <a href="pembeli.php" class="nav-link">Pembeli</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link active">Barang</a>
                    </li>
                    <li class="nav-item">
                        <a href="supplier.php" class="nav-link">Supplier</a>
                    </li>
                </ul>
                <a href="login/logout.php" class="btn btn-secondary">Logout</a>
            </div>
        </div>
    </nav>

    <br>

    <div class="container">

        <h1 class="row justify-content-center">DATA BARANG</h1>
        <a href="#" class="btn btn-primary no-print" data-bs-toggle="modal" data-bs-target="#modalTambah">Tambah</a>
        <a href="#" class="btn btn-info no-print" onclick="window.print()">Cetak</a>

        <br><br>

        <?php 
            
            if(isset($_GET["tambah"])) {
                if($_GET["tambah"] == "berhasil") {
                    echo '<div class="alert alert-dismissible alert-success no-print">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            <strong>Berhasil!</strong> Tambah data berhasil!
                        </div>';
                }else if($_GET["tambah"] == "gagal") {
                    echo '<div class="alert alert-dismissible alert-danger no-print">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            <strong>Gagal!</strong> Tambah data gagal!
                        </div>';
                }
            }

            if(isset($_GET["edit"])) {
                if($_GET["edit"] == "berhasil") {
                    echo '<div class="alert alert-dismissible alert-success no-print">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            <strong>Berhasil!</strong> Edit data berhasil!
                        </div>';
                }else if($_GET["edit"] == "gagal") {
                    echo '<div class="alert alert-dismissible alert-danger no-print">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            <strong>Gagal!</strong> Edit data gagal!
                        </div>';
                }
            }

            if(isset($_GET["hapus"])) {
                if($_GET["hapus"] == "berhasil") {
                    echo '<div class="alert alert-dismissible alert-success no-print">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            <strong>Berhasil!</strong> Hapus data berhasil!
                        </div>';
                }else if($_GET["hapus"] == "gagal") {
                    echo '<div class="alert alert-dismissible alert-danger no-print">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            <strong>Gagal!</strong> Hapus data gagal!
                        </div>';
                }
            }

        ?>

        <div class="modal fade" id="modalTambah">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Form Tambah</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form action="crud/crud_barang.php" method="post">
                            <div class="form-group">
                                <label for="id_supplier">Supplier</label>
                                <select name="id_supplier" id="id_supplier" class="form-control" required>
                                    <option value="" disabled selected>-- Pilihan Supplier --</option>
                                    <?php while($supplier = mysqli_fetch_assoc($query_supplier)) : ?>
                                        <option value="<?= $supplier["id_supplier"]; ?>"><?= $supplier["nama_supplier"]; ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nama_barang">Nama Barang</label>
                                <input type="text" name="nama_barang" id="nama_barang" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="stok">Stok</label>
                                <input type="number" name="stok" id="stok" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="harga_perkilo">Harga Perkilo</label>
                                <input type="number" name="harga_perkilo" id="harga_perkilo" class="form-control" required>
                            </div>
                    </div>
                    <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="tambah">Tambah</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <table class="table">
            <tr class="table-dark">
                <th>ID Barang</th>
                <th>Supplier</th>
                <th>Nama Barang</th>
                <th>Stok</th>
                <th>Harga Perkilo</th>
                <th class="no-print">Aksi</th>
            </tr>
            <?php while($barang = mysqli_fetch_assoc($query)) : ?>
                <tr>
                    <td><?= $barang["id_barang"]; ?></td>
                    <td><?= $barang["nama_supplier"]; ?></td>
                    <td><?= $barang["nama_barang"]; ?></td>
                    <td><?= $barang["stok"]; ?></td>
                    <td><?= $barang["harga_perkilo"]; ?></td>
                    <td class="no-print">
                        <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $barang["id_barang"]; ?>">Edit</a> |
                        <a href="crud/crud_barang.php?id_barang=<?= $barang["id_barang"]; ?>" class="btn btn-danger" onclick="return confirm('Anda Yakin?')">Hapus</a>
                    </td>
                </tr>

                <div class="modal fade" id="modalEdit<?= $barang["id_barang"]; ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Form Edit</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <form action="crud/crud_barang.php" method="post"> 
                                        <input type="hidden" name="id_barang" value="<?= $barang["id_barang"]; ?>">
                                    <div class="form-group">
                                        <label for="id_supplier">Supplier</label>
                                        <select name="id_supplier" id="id_supplier" class="form-control" required>
                                            <option value="" disabled>-- Pilihan Supplier --</option>
                                            <?php mysqli_data_seek($query_supplier, 0);
                                            while($supplier = mysqli_fetch_assoc($query_supplier)) : ?>
                                                <option value="<?= $supplier["id_supplier"]; ?>" <?= ($supplier["id_supplier"] == $barang["id_supplier"]) ? "selected" : ""; ?>><?= $supplier["nama_supplier"]; ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_barang">Nama Barang</label>
                                        <input type="text" name="nama_barang" id="nama_barang" class="form-control" value="<?= $barang["nama_barang"]; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="stok">Stok</label>
                                        <input type="number" name="stok" id="stok" class="form-control" value="<?= $barang["stok"]; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="harga_perkilo">Harga Perkilo</label>
                                        <input type="number" name="harga_perkilo" id="harga_perkilo" class="form-control" value="<?= $barang["harga_perkilo"]; ?>" required>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" name="edit">Edit</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endwhile; ?>
        </table>

    </div>

</body>
</html>