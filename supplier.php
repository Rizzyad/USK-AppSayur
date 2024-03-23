<?php 
session_start();

if(!isset($_SESSION["login"])) {
    header("location:login/login.php?pesan=aksesditolak");
}

include "koneksi/koneksi.php";

$sql = "SELECT*FROM supplier ORDER BY id_supplier ASC ";
$query = mysqli_query($koneksi,$sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Supplier</title>
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
                        <a href="barang.php" class="nav-link">Barang</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link active">Supplier</a>
                    </li>
                </ul>
                <a href="login/logout.php" class="btn btn-secondary">Logout</a>
            </div>
        </div>
    </nav>

    <br>

    <div class="container">

        <h1 class="row justify-content-center">DATA SUPPLIER</h1>
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
                        <form action="crud/crud_supplier.php" method="post">
                            <div class="form-group">
                                <label for="nama_supplier">Nama Supplier</label>
                                <input type="text" name="nama_supplier" id="nama_supplier" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" name="alamat" id="alamat" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="no_hp">No Hp</label>
                                <input type="text" name="no_hp" id="no_hp" class="form-control" required>
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
                <th>ID Supplier</th>
                <th>Nama Supplier</th>
                <th>Alamat</th>
                <th>No HP</th>
                <th class="no-print">Aksi</th>
            </tr>
            <?php while($supplier = mysqli_fetch_assoc($query)) : ?>
                <tr>
                    <td><?= $supplier["id_supplier"]; ?></td>
                    <td><?= $supplier["nama_supplier"]; ?></td>
                    <td><?= $supplier["alamat"]; ?></td>
                    <td><?= $supplier["no_hp"]; ?></td>
                    <td class="no-print">
                        <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $supplier["id_supplier"]; ?>">Edit</a> |
                        <a href="crud/crud_supplier.php?id_supplier=<?= $supplier["id_supplier"]; ?>" class="btn btn-danger" onclick="return confirm('Anda Yakin?')">Hapus</a>
                    </td>
                </tr>

                <div class="modal fade" id="modalEdit<?= $supplier["id_supplier"]; ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Form Edit</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <form action="crud/crud_supplier.php" method="post">
                                        <input type="hidden" name="id_supplier" value="<?= $supplier["id_supplier"]; ?>">
                                    <div class="form-group">
                                        <label for="nama_supplier">Nama Supplier</label>
                                        <input type="text" name="nama_supplier" id="nama_supplier" class="form-control" value="<?= $supplier["nama_supplier"]; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <input type="text" name="alamat" id="alamat" class="form-control" value="<?= $supplier["alamat"]; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="no_hp">No Hp</label>
                                        <input type="text" name="no_hp" id="no_hp" class="form-control" value="<?= $supplier["no_hp"]; ?>" required>
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