<?php 
include 'php/koneksiTgs3.php';


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM pendaftar WHERE id = '$id'";
    $query = mysqli_query($koneksi, $sql);

    if ($query && mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);
    } else {
        echo "<script>alert('Data tidak ditemukan!'); window.location='indexTgs3.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('ID tidak ditemukan!'); window.location='indexTgs3.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Detail Pendaftaran Bimbel</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color:pink !important;
    }
    .result-container {
      max-width: 750px;
      margin: 30px auto; 
      background: #fff; 
      padding: 20px 30px;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1); 
    }
    h2 {
      text-align: center;
      margin-bottom: 20px;
    }
    table {
      width: 100%;
      border-collapse: collapse; 
      margin-bottom: 20px;
    }
    td, th {
      border: 1px solid #6a0d2fff;
      padding: 10px;
    }
    th {
      background:#f9d3ddff;
      text-align: left;
      width: 40%; 
    }
    .total {
      font-weight: bold;
      background: #f7aabfff; 
    }
    .btn-center {
      text-align: center;
    }
    .btn-center a {
      background: #980246ff;
      color: #fff;
      padding: 10px 20px;
      border-radius: 6px;
      text-decoration: none;
    }
    .btn-center a:hover {
      background: #6a0032ff;
    }
  </style>
</head>
<body>

<div class="result-container">
  <h2>Data Pendaftaran Bimbel</h2>
  <table>
    <tr><th>Nama</th><td><?= htmlspecialchars($data['nama']); ?></td></tr>
    <tr><th>Email</th><td><?= htmlspecialchars($data['email']); ?></td></tr>
    <tr><th>Paket Bimbel</th><td><?= htmlspecialchars($data['paket_bimbel']); ?></td></tr>
    <tr><th>Lokasi Belajar</th><td><?= htmlspecialchars($data['lokasi_belajar']); ?></td></tr>
    <tr><th>Fasilitas Tambahan</th><td><?= htmlspecialchars($data['fasilitas_tambahan']); ?></td></tr>
    <tr><th>Pajak</th><td><?= htmlspecialchars($data['pajak']); ?>%</td></tr>
    <tr><th>Catatan</th><td><?= htmlspecialchars($data['catatan']); ?></td></tr>
    <tr><th>Metode Pembayaran</th><td><?= htmlspecialchars($data['metode_pembayaran']); ?></td></tr>
    <tr><th>Tanggal Daftar</th><td><?= htmlspecialchars($data['tanggal_daftar']); ?></td></tr>
  </table>

  <h2>Rincian Biaya</h2>
  <table>
    <tr><th>Harga Paket</th><td>Rp <?= number_format($data['harga_paket'], 0, ',', '.'); ?></td></tr>
    <tr><th>Harga Lokasi</th><td>Rp <?= number_format($data['harga_lokasi'], 0, ',', '.'); ?></td></tr>
    <tr><th>Harga Fasilitas</th><td>Rp <?= number_format($data['harga_fasilitas'], 0, ',', '.'); ?></td></tr>
    <tr><th>Biaya Layanan</th><td>Rp <?= number_format($data['biaya_layanan'], 0, ',', '.'); ?></td></tr>
    <tr><th>Pajak (<?= htmlspecialchars($data['pajak']); ?>%)</th>
        <td>Rp <?= number_format(($data['pajak'] / 100) * ($data['harga_paket'] + $data['harga_lokasi'] + $data['harga_fasilitas'] + $data['biaya_layanan']), 0, ',', '.'); ?></td></tr>
    <tr class="total"><th>Total Akhir</th><td>Rp <?= number_format($data['total_biaya'], 0, ',', '.'); ?></td></tr>
  </table>

  <div class="btn-center">
    <a href="indexTgs3.php">← Kembali ke Dashboard</a>
  </div>
</div>

</body>
</html>
