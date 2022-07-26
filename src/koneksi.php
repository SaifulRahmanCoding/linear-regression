<?php
// kalau pakai offline
// $db = mysqli_connect("localhost","root","","dm_lr");

// kalau online
$db = mysqli_connect("sql202.ezyro.com","ezyro_32252488","jveis0ls","ezyro_32252488_dm_lr");

// cek koneksi
if (!$db) {
	echo "Gagal menyambungkan ke MySQL:".mysqli_connect_error();
	exit();
}
?>