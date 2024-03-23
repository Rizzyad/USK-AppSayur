<?php 
session_start();

if(!isset($_SESSION["login"])) {
    header("location:login/login.php?pesan=aksesditolak");
}

include "koneksi/koneksi.php";

$sql = "SELECT*FROM transaksi t
        INNER JOIN pembeli p ON t.id_pembeli = p.id_pembeli
        INNER JOIN barang b ON t.id_barang = b.id_barang ORDER BY t.id_transaksi ASC ";
$query = mysqli_query($koneksi,$sql);

$sql_pembeli = "SELECT*FROM pembeli";
$query_pembeli = mysqli_query($koneksi,$sql_pembeli);

$sql_barang = "SELECT*FROM barang";
$query_barang = mysqli_query($koneksi,$sql_barang);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Transaksi</title>
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
                        <a href="#" class="nav-link active">Transaksi</a>
                    </li>
                    <li class="nav-item">
                        <a href="pembeli.php" class="nav-link">Pembeli</a>
                    </li>
                    <li class="nav-item">
                        <a href="barang.php" class="nav-link">Barang</a>
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

        <h1 class="row justify-content-center">DATA TRANSAKSI</h1>
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
                        <form action="crud/crud_transaksi.php" method="post">
                            <div class="form-group">
                                <label for="id_pembeli">Pembeli</label>
                                <select name="id_pembeli" id="id_pembeli" class="form-control" required>
                                    <option value="" disabled selected>-- Pilihan Pembeli --</option>
                                    <?php while($pembeli = mysqli_fetch_assoc($query_pembeli)) : ?>
                                        <option value="<?= $pembeli["id_pembeli"]; ?>"><?= $pembeli["nama_pembeli"]; ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="id_barang">Barang</label>
                                <select name="id_barang" id="id_barang" class="form-control" required>
                                    <option value="" disabled selected>-- Pilihan Barang --</option>
                                    <?php while($barang = mysqli_fetch_assoc($query_barang)) : ?>
                                        <option value="<?= $barang["id_barang"]; ?>"><?= $barang["nama_barang"]; ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="jumlah">Jumlah</label>
                                <input type="number" name="jumlah" id="jumlah" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="tgl_transaksi">Tanggal Transaksi</label>
                                <input type="date" name="tgl_transaksi" id="tgl_transaksi" class="form-control" readonly required>
                            </div>
                    </div>
                    <div class="modal-footer">                            
                            <button type="submit" class="btn btn-primary" name="tambah" onclick="return confirm('Anda Yakin ingin tambah data?')">Tambah</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <table class="table">
            <tr class="table-dark">
                <th>ID Transaksi</th>
                <th>Pembeli</th>
                <th>Barang</th>
                <th>Jumlah</th>
                <th>Tanggal Transaksi</th>
                <th class="no-print">Aksi</th>
            </tr>
            <?php while($transaksi = mysqli_fetch_assoc($query)) : ?>
                <tr>
                    <td><?= $transaksi["id_transaksi"]; ?></td>
                    <td><?= $transaksi["nama_pembeli"]; ?></td>
                    <td><?= $transaksi["nama_barang"]; ?></td>
                    <td><?= $transaksi["jumlah"]; ?></td>
                    <td><?= $transaksi["tgl_transaksi"]; ?></td>
                    <td class="no-print">
                        <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $transaksi["id_transaksi"]; ?>">Edit</a> |
                        <a href="crud/crud_transaksi.php?id_transaksi=<?= $transaksi["id_transaksi"]; ?>" class="btn btn-danger" onclick="return confirm('Anda Yakin?')">Hapus</a>
                    </td>
                </tr>

                <div class="modal fade" id="modalEdit<?= $transaksi["id_transaksi"]; ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Form Edit</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <form action="crud/crud_transaksi.php" method="post">
                                        <input type="hidden" name="id_transaksi" value="<?= $transaksi["id_transaksi"]; ?>">
                                    <div class="form-group">
                                        <label for="id_pembeli">Pembeli</label>
                                        <select name="id_pembeli" id="id_pembeli" class="form-control" required>
                                            <option value="" disabled>-- Pilihan Pembeli --</option>
                                            <?php mysqli_data_seek($query_pembeli, 0);
                                             while($pembeli = mysqli_fetch_assoc($query_pembeli)) : ?>
                                                <option value="<?= $pembeli["id_pembeli"]; ?>" <?= ($pembeli["id_pembeli"] == $transaksi["id_pembeli"]) ? "selected" : ""; ?>><?= $pembeli["nama_pembeli"]; ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="id_barang">Barang</label>
                                        <select name="id_barang" id="id_barang" class="form-control" required>
                                            <option value="" disabled>-- Pilihan Barang --</option>
                                            <?php mysqli_data_seek($query_barang, 0);
                                             while($barang = mysqli_fetch_assoc($query_barang)) : ?>
                                                <option value="<?= $barang["id_barang"]; ?>" <?= ($barang["id_barang"] == $transaksi["id_barang"]) ? "selected" : ""; ?>><?= $barang["nama_barang"]; ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="jumlah">Jumlah</label>
                                        <input type="number" name="jumlah" id="jumlah" class="form-control" value="<?= $transaksi["jumlah"]; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="tgl_transaksi">Tanggal Transaksi</label>
                                        <input type="date" name="tgl_transaksi" id="tgl_transaksi" class="form-control" value="<?= $transaksi["tgl_transaksi"]; ?>" required>
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

    <script>
        document.getElementById("tgl_transaksi").valueAsDate = new Date();
    </script>

</body>
</html>