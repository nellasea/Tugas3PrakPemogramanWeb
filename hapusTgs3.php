<?php

include 'koneksiTgs3.php';

// Pastikan ada parameter ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $sql = "DELETE FROM pendaftar WHERE id = '$id'";
    $query = mysqli_query($koneksi, $sql);

    if ($query) {
    echo "
    <script>
        alert('Data berhasil dihapus!');
        window.location = '../indexTgs3.php';
    </script>";
} else {
    echo "
    <script>
        alert('Gagal menghapus data: " . mysqli_error($koneksi) . "');
        window.location = '../indexTgs3.php';
    </script>";
}
} else {
    echo "<script>alert('ID tidak ditemukan!'); window.location='../indexTgs3.php';</script>";
}
?>
