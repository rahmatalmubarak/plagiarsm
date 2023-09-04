<?php
include('class.pdf2text.php');
include('copyscape_premium_api.php');
include('koneksi.php');
session_start();
$a = new PDF2Text();

$nama = $_SESSION['Username'];
$sql = "SELECT * FROM Tugasakhir WHERE username = '$nama'";
$result = mysqli_query($koneksi, $sql);
$row = mysqli_fetch_assoc($result);
$y = $row['username'];
$NIM = $row['nim'];

$newFilename = $y . "-" . $NIM . ".pdf";

$a->setFilename("./upload/".$newFilename);
$a->decodePDF();
$pdf_to_text_value = $a->output();
echo json_encode(copyscape_api_text_search_internet($pdf_to_text_value, 'ISO-8859-1', 2));
?>