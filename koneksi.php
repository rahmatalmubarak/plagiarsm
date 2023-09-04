<?php



$koneksi = mysqli_connect('localhost', 'root', '', 'TA');

 if(!$koneksi){

 echo "Koneksi Gagal";


 }





 ?>

<?php

/*$hostname = 'localhost';
$user = 'root';
$password = 'qwertyuiop';
$database = 'TA';

$mysqli = mysqli_init();
$mysqliConnected = $mysqli->real_connect($hostname, $user, $password, $database);
if (!$mysqliConnected) {
  die("Connect Error: " . $mysqli->connect_error());
}

echo 'Success... ' . $mysqli->host_info . "\n";

$mysqli->close();

if(!$mysqliConnected){

  echo "Koneksi Gagal";

}

?>*/
