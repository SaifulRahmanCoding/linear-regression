<?php
session_start();
// koneksi database 
require_once('../src/koneksi.php');

$opsi = ($_GET['opsi']) ? $_GET['opsi'] : "";

if ($opsi == "input") {
	
	$nilai_test = (isset($_POST['nilai_test'])) ? $_POST['nilai_test'] : "";
	$parameter = (isset($_POST['parameter'])) ? $_POST['parameter'] : "";

	if ($nilai_test < 0 && $parameter == "unit") {
		$nilai_test = 0;
	}
	// definsikan variabel dari session a dan b
	$a = round($_SESSION['a'],2);
	$b = round($_SESSION['b'],2);

	// model persamaan regresi linear adalah Y = a + (b*X) dan untuk X = (Y - a) / b
	if ($parameter == "suhu") {
		$X = $nilai_test;
		$Y = $a + ($b * $X);

		// kondisi jika Y < 0
		$Y = ($Y < 0) ? 0 : $Y;

	}elseif($parameter == "unit"){
		$Y = $nilai_test;
		$X = ($Y - $a) / $b;
	}

	// insert ke database
	$insert = mysqli_query($db,"INSERT INTO tb_testing (x_test,y_test) VALUES('$X','$Y')");

	if($insert==false) { ?>
		<script type='text/javascript'>
			alert('Gagal Menambahkan Data');
			window.location.href="../index.php";
		</script>
	<?php }else{ ?>
		<script type='text/javascript'>
			window.location.href="../index.php";
		</script> 
	<? }
}

elseif($opsi == "delete-all"){

	$query = "DELETE FROM tb_testing";
	$delete_all = mysqli_query($db,$query);

	if($delete_all==false) { ?>

		<script type='text/javascript'>
			alert('Gagal Hapus Data');
			window.location.href="../index.php";
		</script>

	<?php }else{

		mysqli_query($db,"ALTER TABLE tb_testing auto_increment=1"); ?>

		<script type='text/javascript'>
			alert('Sukses Hapus Data');
			window.location.href="../index.php";
		</script> 
		<?php	

	}
}

elseif($opsi == "delete"){
	$id = (isset($_GET['id'])) ? $_GET['id'] : "";

	$query = "DELETE FROM tb_testing WHERE id_test = '$id'";
	$delete = mysqli_query($db,$query);

	if($delete==false) { ?>

		<script type='text/javascript'>
			alert('Gagal Hapus Data');
			window.location.href="../index.php";
		</script>

	<?php }else{

		$desc_ai = mysqli_fetch_assoc(mysqli_query($db,"SELECT max(id_test) as id_max FROM tb_testing"));
		$ai = $desc_ai['id_max']+1;

		mysqli_query($db,"ALTER TABLE tb_testing auto_increment=$ai"); ?>

		<script type='text/javascript'>
			alert('Sukses Hapus Data');
			window.location.href="../index.php";
		</script> 
		<?php	

	}
}
?>