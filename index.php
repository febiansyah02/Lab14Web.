<?php
include 'koneksi.php';

// jumlah data per halaman
$per_page = 5;

// halaman saat ini
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// hitung offset
$offset = ($page - 1) * $per_page;

// ambil data sesuai halaman
$sql = "SELECT * FROM table_barang LIMIT $offset, $per_page";
$query = mysqli_query($koneksi, $sql);

// hitung total data
$total_data = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM table_barang"));

// hitung total halaman
$total_page = ceil($total_data / $per_page);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Praktikum Pagination</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Data Barang</h2>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>No</th>
        <th>Nama Barang</th>
        <th>Harga</th>
    </tr>

    <?php
    $no = $offset + 1;
    while ($row = mysqli_fetch_assoc($query)) {
    ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= $row['nama_barang'] ?></td>
        <td><?= number_format($row['harga']) ?></td>
    </tr>
    <?php } ?>
</table>

<!-- PAGINATION -->
<div class="pagination">

    <!-- Previous -->
    <?php if ($page > 1) { ?>
        <a href="?page=<?= $page - 1 ?>">Previous</a>
    <?php } ?>

    <!-- Nomor Halaman -->
    <?php for ($i = 1; $i <= $total_page; $i++) { ?>
        <a href="?page=<?= $i ?>" 
           class="<?= ($page == $i) ? 'active' : '' ?>">
           <?= $i ?>
        </a>
    <?php } ?>

    <!-- Next -->
    <?php if ($page < $total_page) { ?>
        <a href="?page=<?= $page + 1 ?>">Next</a>
    <?php } ?>

</div>

</body>
</html>
