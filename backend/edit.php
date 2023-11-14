<?php 
session_start();
if ($_SESSION['role'] != 'admin') {
    echo "
    <script>
    alert('Halaman ini hanya bisa di akses oleh admin');
    window.location = '../profile.php';
    </script>
    ";
}
require_once("../config/db.php");
$id = $_GET['id'];
$data = mysqli_query($db_connect, "SELECT * FROM products WHERE id = $id");
$row = mysqli_fetch_assoc($data);

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    $tempImage = $_FILES['image']['tmp_name'];
    $imageInfo = getimagesize($tempImage);
    if ($imageInfo === false) {
        echo "
        <script>
        alert('File yang diunggah bukan file gambar');
        window.location = '../show.php';
        </script>
        ";
        exit;
    }
    $randomFilename = time() . '-' . md5(rand()) . '-' . $image;
    $uploadPath = $_SERVER['DOCUMENT_ROOT'] . '/pemweb-otorisasi-main/upload/' . $randomFilename;
    $upload = move_uploaded_file($tempImage, $uploadPath);
    if ($upload) {
        $updateQuery = "UPDATE products SET 
        name = '$name', 
        price = '$price', 
        image = '/upload/$randomFilename'
        WHERE id = $id";

        if (mysqli_query($db_connect, $updateQuery)) {
            echo "
            <script>
            alert('Data berhasil diubah');
            window.location = '../show.php';
            </script>
            ";
        } else {
            echo "
            <script>
            alert('Data gagal diubah. Error: " . mysqli_error($db_connect) . "');
            window.location = '../show.php';
            </script>
            ";
        }
    } else {
        echo "
        <script>
        alert('Gagal mengunggah file');
        window.location = '../show.php';
        </script>
        ";
    }
}
?>
