<?php
// kalau pakai offline
$db = mysqli_connect("localhost","root","","dm_lr");

// kalau online

// cek koneksi
if (!$db) {
	echo "Gagal menyambungkan ke MySQL:".mysqli_connect_error();
	exit();
}
?>