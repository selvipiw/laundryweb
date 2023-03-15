<?php 
require 'koneksi.php';
function ambilsatubaris($conn, $query) {
    $db = mysqli_query($conn, $query);
    return mysqli_fetch_assoc($db);
}
if (isset($_GET['id'])) {
    $id_transaksi = $_GET['id'];
}
$query = "SELECT transaksi.*, pelanggan.nama_pelanggan, detail_transaksi.total_harga, detail_transaksi.total_bayar FROM transaksi INNER JOIN pelanggan ON pelanggan.id_pelanggan = transaksi.id_pelanggan INNER JOIN detail_transaksi ON detail_transaksi.id_transaksi = transaksi.id_transaksi WHERE transaksi.id_transaksi = " . $_GET['id'];
$data = ambilsatubaris($conn, $query);

setlocale(LC_ALL, 'id_id');
setlocale(LC_TIME, 'id_ID.utf8');
?>
<!DOCTYPE html>
<html>

<head>
    <title>Cetak Laporan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
    
<center>

    <h2>DATA LAPORAN TRANSAKSI LAUNDRY</h2>
    <h6><?= strftime('%A %d %B %Y') ?></h6>
    <h6 class="mr-auto">Oleh : <?= $_SESSION['username']; ?></h6>
    <br>
</center>
<table class="table table-bordered" style="width: 100%;">
<thead>
    <tr>
        <th>Kode Invoice</th>
        <th>nama pelanggan</th>
        <th>status</th>
        <th>pembayaran</th>
        <th>tanggal pembayaran</th>
        <th>total bayar</th>
    </tr>
</thead>
<tbody>
    <tr>
                        <td><?= $data['kode_invoice']; ?></td>
                        <td><?= $data['nama_pelanggan']; ?></td>
                        <td><?= $data['status']; ?></td>
                        <td><?= $data['status_bayar']; ?></td>
                        <td><?= $data['tgl_pembayaran']; ?></td>
                        <td><?= 'Rp ' . number_format($data['total_harga']); ?></td>
    </tr>
</tbody>
</table>
</body>

<script>window.print()</script>