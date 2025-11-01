<?php 
include 'php/koneksiTgs3.php';
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Data Pendaftaran Bimbel</title>
  <!-- Bootstrap 5 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      background-color:pink !important;
    }
    .card {
      border-radius: 15px;
    }
    .table th {
      background-color: #df1f73ff !important;
      color: white;
    }
    .btn-tambah{
      background-color: #980246ff;
      color: white;
      border: none;
      transition: 0.3s;
    }
    .btn-tambah:hover {
      background-color: #6a0032ff; 
      color: #fff;
  }
    .text-custom{
        color: #6a0032ff;
      }
  </style>
</head>

<body>
  <div class="container mt-5">
    <div class="card shadow-sm border-0">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h3 class="fw-bold text-custom m-0">Data Pendaftaran Bimbel</h3>
          <a href="tambahDataTgs3.php" class="btn btn-tambah">
            <i class="bi bi-plus-circle"></i> Tambah Data
          </a>
        </div>

        <table class="table table-bordered align-middle text-center">
          <thead>
            <tr>
              <th style="width: 60px;">ID</th>
              <th>Nama</th>
              <th>Paket</th>
              <th>Total Biaya</th>
              <th style="width: 150px;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = "SELECT * FROM pendaftar";
            $query = mysqli_query($koneksi, $sql);
            $jumlahData = mysqli_num_rows($query);

            if ($jumlahData == 0) {
              echo "<tr><td colspan='5' class='text-muted'>Tidak ada data</td></tr>";
            } else {
              while ($data = mysqli_fetch_assoc($query)) {
                echo "<tr>";
                echo "<td>{$data['id']}</td>";
                echo "<td>{$data['nama']}</td>";

                $paket = $data['paket_bimbel'] ?: 'Undefined';
                echo "<td>{$paket}</td>";

                $total = number_format($data['total_biaya'], 0, ',', '.');
                echo "<td>Rp {$total}</td>";

                echo "<td>
                        <a href='detailTgs3.php?id={$data['id']}' class='btn btn-sm btn-info text-white me-1'>
                          <i class='bi bi-eye'></i>
                        </a>
                        <a href='editTgs3.php?id={$data['id']}' class='btn btn-sm btn-warning text-white me-1'>
                          <i class='bi bi-pencil'></i>
                        </a>
                        <a href='php/hapusTgs3.php?id={$data['id']}'
                           onclick=\"return confirm('Yakin ingin menghapus data ini?')\"
                           class='btn btn-sm btn-danger'>
                          <i class='bi bi-trash'></i>
                        </a>
                      </td>";
                echo "</tr>";
              }
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
