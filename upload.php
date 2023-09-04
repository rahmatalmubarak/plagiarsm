<?php
/*echo "<pre>";
print_r($_FILES);
echo "</pre>";*/

?>

<?php

include "koneksi.php";

session_start();
// if (empty($_SESSION['Username'])) {
//     echo "<script>alert('Maaf, untuk mengakses halaman ini, anda harus login terlebih dahulu, terima kasih');document.location='index.php'</script>";
// }
// $userUpload = $_POST["Username"];
$nama = $_SESSION['Username'];
$sql = "SELECT * FROM Tugasakhir WHERE username = '$nama'";
$result = mysqli_query($koneksi, $sql);
$row = mysqli_fetch_assoc($result);
$y = $row['username'];
$NIM = $row['nim'];


// $Username = "adsadsa";
// $NIM = "yyyyyyyyyy";

//extension List
$extensionList = array("pdf","doc","docx");
//ambil data file
$namaFile = $_FILES['berkas']['name'];
$namaSementara = $_FILES['berkas']['tmp_name'];

$pecah = explode(".", $namaFile);
$ekstensi = $pecah[1];

//Buat nama file baru
$newFilename = $y . "-" . $NIM . ".pdf";

//tentukan lokasi file  akan dipindahkan
$dirUpload = "upload/";

//pindahkan file
if (in_array($ekstensi, $extensionList)) {
	$upload = move_uploaded_file($namaSementara, $dirUpload.$newFilename);
}
?>