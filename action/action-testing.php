<?php
// koneksi database 
require_once('../src/koneksi.php');

$opsi = ($_GET['opsi']) ? $_GET['opsi'] : "";

if ($opsi == "input") {
	
	$nilai_test = (isset($_POST['nilai_test'])) ? $_POST['nilai_test'] : "";
	$parameter = (isset($_POST['parameter'])) ? $_POST['parameter'] : "";

	$koefisien_regresi = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM koefisien_regresi"));
	$a = round($koefisien_regresi['a'],2);
	$b = round($koefisien_regresi['b'],2);

	// model persamaan regresi linear adalah Y = a + (b*X)
	if ($parameter == "suhu") {
		$X = $nilai_test;
		$Y = $a + ($b * $X);

	}elseif($parameter == "unit"){
		$Y = $nilai_test;
		$X = ($Y - ($a)) / $b;
	}
	// insert ke database
	$insert = mysqli_query($db,"INSERT INTO tb_testing (x_test,y_test) VALUES('$X','$Y')");

	if($insert==false) { ?>
		<script type='text/javascript'>
			alert('Gagal Menambahkan Data');
			window.location.href="../index.php?";
		</script>
	<?php }else{ ?>
		<script type='text/javascript'>
			window.location.href="../index.php?";
		</script> 
	<? }
}

elseif($opsi == "delete"){
	// $id = (isset($_GET['id'])) ? $_GET['id'] : "";

	$query = "DELETE FROM tb_testing";
	$delete = mysqli_query($db,$query);

	if($delete==false) { ?>

		<script type='text/javascript'>
			alert('Gagal Hapus Data');
			window.location.href="../index.php?";
		</script>

	<?php }else{

		mysqli_query($db,"ALTER TABLE tb_testing auto_increment=1"); ?>

		<script type='text/javascript'>
			alert('Sukses Hapus Data');
			window.location.href="../index.php?";
		</script> 
		<?php	

	}
}
?>