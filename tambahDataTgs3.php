<?php  
include 'php/koneksiTgs3.php'; 

if (isset($_POST['simpan'])) {
  $nama = $_POST['nama'];
  $email = $_POST['email'];
  $paket_bimbel = $_POST['paket_bimbel'] ?? '';
  $lokasi_belajar = $_POST['lokasi_belajar'];
  $fasilitas_tambahan = isset($_POST['fasilitas_tambahan']) ? $_POST['fasilitas_tambahan'] : [];
  $pajak = floatval($_POST['pajak']);
  if ($pajak < 0) {
    echo "<script>alert('Pajak tidak boleh negatif!'); history.back();</script>";
    exit;
  }
  $catatan = $_POST['catatan'];
  $metode_pembayaran = $_POST['metode_pembayaran'];

  // harga paket
  switch ($paket_bimbel) {
    case "Paket Reguler": $harga_paket = 750000; break;
    case "Paket Intensif SBMPTN": $harga_paket = 500000; break;
    case "Paket Supercamp SBMPTN": $harga_paket = 1000000; break;
    default: $harga_paket = 0;
  }

  // lokasi belajar
  switch ($lokasi_belajar) {
    case "Jakarta Pusat": $harga_lokasi = 100000; break;
    case "Yogyakarta": $harga_lokasi = 80000; break;
    case "Aceh": $harga_lokasi = 120000; break;
    case "Surabaya": $harga_lokasi = 150000; break;
    case "Makassar": $harga_lokasi = 115000; break;
    default: $harga_lokasi = 0;
  }

  // fasilitas tambahan
  $harga_fasilitas = 0;
  foreach ($fasilitas_tambahan as $fasilitas) {
    switch ($fasilitas) {
      case "Modul Cetak Lengkap": $harga_fasilitas += 50000; break;
      case "Modul PDF": $harga_fasilitas += 25000; break;
      case "Video Rekaman Kelas": $harga_fasilitas += 75000; break;
      case "Grup Diskusi Telegram": $harga_fasilitas += 40000; break;
    }
  }

  // biaya layanan
  if ($metode_pembayaran == "Transfer Bank") $biaya_layanan = 3000;
  elseif ($metode_pembayaran == "E-Wallet") $biaya_layanan = 2000;
  else $biaya_layanan = 0;

  // hitung total
  $subtotal = $harga_paket + $harga_lokasi + $harga_fasilitas + $biaya_layanan;
  $nilai_pajak = ($pajak / 100) * $subtotal;
  $total_biaya = $subtotal + $nilai_pajak;
  $tanggal_daftar = date('Y-m-d H:i:s');

  $fasilitas_str = implode(", ", $fasilitas_tambahan);

  $sql = "INSERT INTO pendaftar 
          (nama, email, paket_bimbel, lokasi_belajar, fasilitas_tambahan, pajak, catatan, metode_pembayaran,
           harga_paket, harga_lokasi, harga_fasilitas, biaya_layanan, total_biaya, tanggal_daftar)
          VALUES 
          ('$nama', '$email', '$paket_bimbel', '$lokasi_belajar', '$fasilitas_str', '$pajak',
           '$catatan', '$metode_pembayaran', '$harga_paket', '$harga_lokasi', '$harga_fasilitas',
           '$biaya_layanan', '$total_biaya', '$tanggal_daftar')";

  if (mysqli_query($koneksi, $sql)) {
    echo "<script>alert('Data berhasil disimpan!'); window.location='indexTgs3.php';</script>";
  } else {
    echo "Error: " . mysqli_error($koneksi);
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Bimbel Babarsari - Tambah Data</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
  background-color: pink !important;
}

  .bg-primary {
  background-color: #6a0032ff!important ;
  color: white;
}

    .btn-primary {
      background-color: pink;
      border-color: pink !important ;
      color: #ffffffff ;
    }

    .btn-primary:hover {
      background-color: #d63062ff ; 

    }

  
  </style>
</head>

<div class="container mt-5">
  <div class="card shadow-lg mx-auto" style="max-width: 700px;">
    <div class="card-header text-center bg-primary text-white">
      <h3 class="mb-0">Bimbel Babarsari</h3>
    </div>
    <div class="card-body">
      <form method="post">
        <div class="mb-3">
          <label class="form-label">Nama</label>
          <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Paket Bimbingan</label>
          <div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="paket_bimbel" value="Paket Reguler" required>
              <label class="form-check-label">Paket Reguler - Rp 750.000</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="paket_bimbel" value="Paket Intensif SBMPTN">
              <label class="form-check-label">Paket Intensif SBMPTN - Rp 500.000</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="paket_bimbel" value="Paket Supercamp SBMPTN">
              <label class="form-check-label">Paket Supercamp SBMPTN - Rp 1.000.000</label>
            </div>
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">Lokasi Belajar</label>
          <select name="lokasi_belajar" class="form-select" required>
            <option value="Jakarta Pusat">Jakarta Pusat - Rp 100.000</option>
            <option value="Yogyakarta">Yogyakarta - Rp 80.000</option>
            <option value="Aceh">Aceh - Rp 120.000</option>
            <option value="Surabaya">Surabaya - Rp 150.000</option>
            <option value="Makassar">Makassar - Rp 115.000</option>
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label">Fasilitas Tambahan</label>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="fasilitas_tambahan[]" value="Modul Cetak Lengkap">
            <label class="form-check-label">Modul Cetak Lengkap - Rp 50.000</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="fasilitas_tambahan[]" value="Modul PDF">
            <label class="form-check-label">Modul PDF - Rp 25.000</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="fasilitas_tambahan[]" value="Video Rekaman Kelas">
            <label class="form-check-label">Video Rekaman Kelas - Rp 75.000</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="fasilitas_tambahan[]" value="Grup Diskusi Telegram">
            <label class="form-check-label">Grup Diskusi Telegram - Rp 40.000</label>
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">Pajak (%)</label>
          <input type="number" name="pajak" class="form-control" value="10" min="0" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Catatan</label>
          <textarea name="catatan" class="form-control" rows="3"></textarea>
        </div>

        <div class="mb-3">
          <label class="form-label">Metode Pembayaran</label>
          <select name="metode_pembayaran" class="form-select" required>
            <option value="Transfer Bank">Transfer Bank - Rp 3.000</option>
            <option value="E-Wallet">E-Wallet - Rp 2.000</option>
            <option value="Tunai">Tunai</option>
          </select>
        </div>

        <div class="text-center mt-4">
          <button type="reset" class="btn btn-secondary">Reset</button>
          <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
          <a href="indexTgs3.php" class="btn btn-danger">Kembali ke Dashboard</a>
        </div>
      </form>
    </div>
  </div>
</div>

</body>
</html>
