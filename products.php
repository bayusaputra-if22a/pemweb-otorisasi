<?php 
session_start();
if ($_SESSION['role'] != 'user') {
    header("location:admin.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./plugin/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Products</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Bayu Web</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="profile.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">History</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="#">Products</a>
              </li>
            </ul>
              <a href="backend/logout.php" class="btn btn-danger">Logout</a>
          </div>
        </div>
</nav>
    <h1>Data produk</h1>
    <div style="border: none !important" class="card m-1">
      <div class="card-body">
    <table class="table">
        <thead class="table-primary">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama produk</th>
                <th scope="col">Harga</th>
                <th scope="col">Gambar Produk</th>
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
                    <td>Rp <?= number_format($row['price'], 0, ',', '.'); ?></td>
                    <!-- <td><img src="<?=$row['image'];?>" width="100"></td> -->
                    <td><a class="btn btn-info" href="<?php echo $base_url ?><?=$row['image'];?>" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i> Lihat</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
      </div>
    </div>
    <script src="../plugin/js/bootstrap.min.js"></script>
    <script>
    function hapus(id_user){
        var konfirmasi = confirm("Anda yakin ingin menghapus data ini?");
        if(konfirmasi == true){
            window.location.href = "backend/delete.php?id=" + id_user;
        }
        else {
            return false;
        }
    }
</script>
</body>
</html>
