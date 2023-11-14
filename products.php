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
    <style>
.modal-content {  
  -webkit-animation-name: zoom;
  -webkit-animation-duration: 0.6s;
  animation-name: zoom;
  animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
  from {-webkit-transform:scale(0)} 
  to {-webkit-transform:scale(1)}
}

@keyframes zoom {
  from {transform:scale(0)} 
  to {transform:scale(1)}
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content {
    width: 100%;
  }
}
</style>
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
                <a class="nav-link" aria-current="page" href="./index.php">Home</a>
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
    <div style="border: none !important" class="card m-1">
      <div class="card-body">
        <div class="card-title d-flex justify-content-between">
        </div>
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
                    <td>
                    <button id="myImg" class="btn btn-info" data-image-url="<?php echo $base_url . $row['image']; ?>" data-bs-toggle="modal" data-bs-target="#imageModal">
                        <i class="fa fa-eye" aria-hidden="true"></i> Lihat
                    </button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div style=" max-width: 80% !important;" class="modal-dialog">
      <div class="modal-body">
      <button type="button" style="float: right !important; background-color:aliceblue !important;" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <img class="modal-content" id="img01">
      </div>
    </div>
</div>
      </div>
    </div>
    <script>
    var buttons = document.getElementsByClassName("btn-info");
    var modal = document.getElementById("imageModal");
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");
    for (var i = 0; i < buttons.length; i++) {
        buttons[i].addEventListener("click", function () {
            modal.style.display = "block";
            modalImg.src = this.getAttribute("data-image-url");
            captionText.innerHTML = this.innerText;
        });
    }
    var closeModalButton = document.getElementById("closeModalButton");
    closeModalButton.onclick = function () {
        modal.style.display = "none";
    }
</script>
<script src="plugin/js/bootstrap.min.js"></script>
</body>
</html>
