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

if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $paket_bimbel = $_POST['paket_bimbel'];
    $lokasi_belajar = $_POST['lokasi_belajar'];
    $fasilitas_tambahan = $_POST['fasilitas_tambahan'];
    $pajak = floatval($_POST['pajak']);
    $catatan = $_POST['catatan'];
    $metode_pembayaran = $_POST['metode_pembayaran'];
    $harga_paket = max(0, intval($_POST['harga_paket']));
    $harga_lokasi = max(0, intval($_POST['harga_lokasi']));
    $harga_fasilitas = max(0, intval($_POST['harga_fasilitas']));
    $biaya_layanan = max(0, intval($_POST['biaya_layanan']));

    // Hitung ulang total biaya
    $subtotal = $harga_paket + $harga_lokasi + $harga_fasilitas + $biaya_layanan;

    // Pastikan pajak tidak negatif
    $pajak = max(0, $pajak);
    $nilai_pajak = ($pajak / 100) * $subtotal;
    $total_biaya = $subtotal + $nilai_pajak;

    // Query update data
    $sql = "UPDATE pendaftar SET 
        nama='$nama',
        email='$email',
        paket_bimbel='$paket_bimbel',
        lokasi_belajar='$lokasi_belajar',
        fasilitas_tambahan='$fasilitas_tambahan',
        pajak='$pajak',
        catatan='$catatan',
        metode_pembayaran='$metode_pembayaran',
        harga_paket='$harga_paket',
        harga_lokasi='$harga_lokasi',
        harga_fasilitas='$harga_fasilitas',
        biaya_layanan='$biaya_layanan',
        total_biaya='$total_biaya'
        WHERE id='$id'";

    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location='indexTgs3.php';</script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Data Pendaftar </title>
  <style>
      .text-custom{
        color: #6a0032ff;
      }
    body { font-family: Arial, sans-serif; background:pink !important; text-align: center; }
    form { background: white; padding: 20px; margin: 20px auto; width: 500px; border-radius: 10px; box-shadow: 0 0 10px #aaa; text-align: left; }
    label { display: block; margin-top: 10px; }
    input, select, textarea { width: 100%; padding: 2px; margin-top: 10px; }
    button { margin-top: 15px; padding: 10px 20px; background: #980246ff; color: white; border: none; border-radius: 5px; cursor: pointer; }
    button:hover { background: #6a0032ff; }
    a { text-decoration: none; color: #6a0032ff; }
    a:hover { text-decoration: underline; }
  </style>
</head>
<body>

<h2 class=" text-custom m-0">Edit Data Pendaftar Bimbel</h2>

<form method="post">
  <label>Nama</label>
  <input type="text" name="nama" value="<?= htmlspecialchars($data['nama']); ?>" required>

  <label>Email</label>
  <input type="email" name="email" value="<?= htmlspecialchars($data['email']); ?>" required>

  <label>Paket Bimbel</label>
  <input type="text" name="paket_bimbel" value="<?= htmlspecialchars($data['paket_bimbel']); ?>" required>

  <label>Lokasi Belajar</label>
  <input type="text" name="lokasi_belajar" value="<?= htmlspecialchars($data['lokasi_belajar']); ?>">

  <label>Fasilitas Tambahan</label>
  <input type="text" name="fasilitas_tambahan" value="<?= htmlspecialchars($data['fasilitas_tambahan']); ?>">

  <label>Pajak (%)</label>
  <input type="number" name="pajak" value="<?= htmlspecialchars($data['pajak']); ?>" min="0">

  <label>Catatan</label>
  <textarea name="catatan"><?= htmlspecialchars($data['catatan']); ?></textarea>

  <label>Metode Pembayaran</label>
  <input type="text" name="metode_pembayaran" value="<?= htmlspecialchars($data['metode_pembayaran']); ?>">

  <label>Harga Paket</label>
  <input type="number" name="harga_paket" value="<?= htmlspecialchars($data['harga_paket']); ?>" min="0">

  <label>Harga Lokasi</label>
  <input type="number" name="harga_lokasi" value="<?= htmlspecialchars($data['harga_lokasi']); ?>" min="0">

  <label>Harga Fasilitas</label>
  <input type="number" name="harga_fasilitas" value="<?= htmlspecialchars($data['harga_fasilitas']); ?>" min="0">

  <label>Biaya Layanan</label>
  <input type="number" name="biaya_layanan" value="<?= htmlspecialchars($data['biaya_layanan']); ?>" min="0">

  <button type="submit" name="update">Update</button>
</form>

<a href="indexTgs3.php">← Kembali ke Dashboard</a>

</body>
</html>
