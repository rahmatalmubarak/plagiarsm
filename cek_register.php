<?php
// error_reporting(0);
?>
<?php

//panggil koneksi database
include "koneksi.php";

$username = $_POST['username'];
$nim = $_POST['nim'];
$password = md5($_POST['password']);
$cpassword = md5($_POST['cpassword']);

$sql = "SELECT * FROM Tugasakhir WHERE username='$username'";
$result = mysqli_query($koneksi, $sql);
	if ($result){
	    $inputsql = "INSERT INTO Tugasakhir (username, nim, password) VALUES ('$username', '$nim', '$password')";
	    $masukan = mysqli_query($koneksi, $inputsql);
		if ($masukan){
		    echo "<script>alert('User Berhasil Didaftarkan')</script>";
			header("Location:index.php");
		}else{
		    echo "'Woops, Username Sudah Ada.';document.location='register.php'";
		}
	}else{
	    echo "Password tidak cocok.";
	}

?>
