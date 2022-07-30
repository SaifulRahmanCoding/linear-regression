<?php
// koneksi database 
require_once('../src/koneksi.php');

//pangil file - file di php excel reader
require_once('../vendor/php-excel-reader/excel_reader2.php');
require_once('../vendor/SpreadsheetReader.php');

$opsi = ($_GET['opsi']) ? $_GET['opsi'] : "";

if ($opsi == "impor") {
	
	$allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

	if(in_array($_FILES["file"]["type"],$allowedFileType)){

        // piindahkan file ke folder uploads pada projek
		$targetPath = '../uploads/'.$_FILES['file']['name'];
		move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);

		$reader = new SpreadsheetReader($targetPath);

		// hitung sheet
		$sheetCount = count($reader->sheets());

		for($i=0;$i<$sheetCount;$i++) {

			$reader->ChangeSheet($i);

			foreach ($reader as $kolom) {
          		//definisikan satu persatu kolom yang akan di impor,
				$suhu = (isset($kolom[0])) ? $kolom[0] : "";

				$cacat = (isset($kolom[1])) ? $kolom[1] : "";

				if (!empty($suhu) || !empty($cacat)) {
					
					$query = "INSERT INTO tb_training(x,y) VALUES('$suhu','$cacat')";
					$result = mysqli_query($db, $query);

					if($result==false) { ?>
						<script type='text/javascript'>
							alert('Gagal Impor Data');
							window.location.href="../index.php";
						</script>
					<?php }else{ ?>
						<script type='text/javascript'>
							alert('Sukses Impor Data');
							window.location.href="../index.php";
						</script> 
						<?php
					}
				}
			}

		}
	}else { ?>
		<script type='text/javascript'>
			alert('Tipe File Salah, Tolong Impor file .xls atau .xlsx');
			window.location.href="../index.php";
		</script>
	<?php }


}elseif($opsi == "delete"){
	$query = "DELETE FROM tb_training";
	$delete = mysqli_query($db,$query);

	$query = "DELETE FROM koefisien_regresi";
	mysqli_query($db,$query);
	
	if($delete==false) { ?>

		<script type='text/javascript'>
			alert('Gagal Hapus Data');
			window.location.href="../index.php";
		</script>

	<?php }else{

		mysqli_query($db,"ALTER TABLE tb_training auto_increment=1"); ?>

		<script type='text/javascript'>
			alert('Sukses Hapus Data');
			window.location.href="../index.php";
		</script> 
		<?php	

	}
}
?>