<?php 
session_start();
if ($_SESSION['role'] != 'admin') {
    // session_destroy();
    echo "
    <script>
    alert('Halaman ini hanya bisa di akses oleh admin');
    window.location = 'profile.php';
    </script>
    ";
    // header("location:profile.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./plugin/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
    <h1>Data produk</h1>
    <div style="border: none !important" class="card m-1">
      <div class="card-body">
        <div class="card-title d-flex justify-content-between">
        <a class="btn btn-primary mb-2" href="backend/create.php">Tambah Data</a>
        </div>
    <table class="table">
        <thead class="table-primary">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama produk</th>
                <th scope="col">harga</th>
                <th scope="col">gambar produk</th>
                <th scope="col">Opsi</th>
            </tr>
        </thead>
        <tbody>
            <?php
                require './config/db.php';
                $base_url = "http://localhost/pemweb-otorisasi-main/";

                $products = mysqli_query($db_connect,"SELECT * FROM products");
                $no = 1;

                while($row = mysqli_fetch_assoc($products)) {
            ?>
                <tr>
                    <td><?=$no++;?></td>
                    <td><?=$row['name'];?></td>
                    <td><?=$row['price'];?></td>
                    <!-- <td><img src="<?=$row['image'];?>" width="100"></td> -->
                    <td><a href="<?php echo $base_url ?><?=$row['image'];?>" target="_blank">Lihat</a></td>
                    <td>
                        <a href="backend/edit.php?id=<?=$row['id'];?>">Edit</a>
                        <a href="backend/delete.php?id=<?=$row['id'];?>">Hapus</a>

                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
      </div>
    </div>
</body>
</html>
