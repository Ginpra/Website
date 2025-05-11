<?php
$hostname = "localhost";//hostname
$user = "root"; //username untuk login ke mysql
$pass = ""; //password untuk login ke mysql
$db = "luxtech"; //nama database

$conn = mysqli_connect($hostname, $user, $pass, $db); //membuat koneksi ke server mysql (dbnya di server mysql)

if ($conn->connect_error) {
    die("maaf koneksi gagal: " . $conn->connect_error);
}
?>