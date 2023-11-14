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
$base_url = "http://localhost/pemweb-otorisasi-main/upload";
if (isset($_POST['submit'])) {
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
        $updateQuery = "INSERT INTO products (name,price,image)
        VALUES ('$name','$price','/upload/$randomFilename')";

        if (mysqli_query($db_connect, $updateQuery)) {
            echo "
            <script>
            alert('Data berhasil ditambahkan');
            window.location = '../show.php';
            </script>
            ";
        } else {
            echo "
            <script>
            alert('Data gagal ditambahkan. Error: " . mysqli_error($db_connect) . "');
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

