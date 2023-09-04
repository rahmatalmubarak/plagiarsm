<?php
 //error_reporting(1);
?>
<?php

//panggil koneksi database
include "koneksi.php";

$password = md5($_POST['Password']);
$username = $_POST['Username'];
// $password = mysqli_escape_string($koneksi, $pass);

//cek username, terdaftar atau tidak
$sql = "SELECT * FROM Tugasakhir WHERE username='$username' AND password='$password'";
$result = mysqli_query($koneksi, $sql);

//uji jika username terdaftar
if ($result) {
    $row = mysqli_fetch_assoc($result);
    //jika username terdaftar
    //cek password sesuai atau tidak
    if ($password = $row['password']) {
    session_start();
    $_SESSION['Username'] = $row['username'];
    header('Location: txt.php');
    }else{
    echo"<script>alert('Maaf, Login Gagal');document.location='index.php'</script>";
    }
}
else {
        echo "<script>alert('Maaf, Login Gagal, Password anda tidak sesuai!');document.location='index.php'</script>";
}
?>

