<?php 
require_once('src/koneksi.php'); 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>DM Linear Regression</title>
	<?php require('config/style.php'); ?>
</head>
<body class="bg-light">
	<!-- Header -->
	<div id="header" class="wrapper shadow-sm sticky-top bg-white">
		<div class="container">
			<div class="row">
				<div class="col-8 col-sm-6 logo d-flex justify-content-start align-items-center py-2">
					<img src="src/img/logo.png" alt="">
					<span class="fs-3 ms-2">Linear Regression</span>
				</div>
				<div class="col-4 col-sm-6 d-flex justify-content-end align-items-center fw-bolder">
					<span id="jam" class="mx-1"></span>:
					<span id="menit" class="mx-1"></span>:
					<span id="detik" class="mx-1"></span>
					<span class="mx-1">WIB</span>
				</div>
			</div>
		</div>
	</div>
	<!-- End Header -->

	<!-- Content -->
	<div id="content" class="wrapper mb-5">
		<div class="container">
			<div class="row justify-content-center">

				<!-- TRAINING -->
				<div class="col-12 col-md-8 p-3 mt-1 mt-lg-2">
					<div class="bg-white shadow-sm p-3">
						<h2>Data Training</h2>

						<?php require('komponen/modal-add-training.php'); ?>

						<a href="action/action-training.php?opsi=delete" class="btn btn-outline-danger my-3" onclick="return confirm_delete_training()"> Hapus Data</a>
						<!-- tabel 1 -->
						<div class="table-responsive">

							<table class="table table-bordered border-dark responsive-utilities table-hover text-center">
								<thead class="text-white">
									<th scope="col" style="width: 60px !important;">Tanggal</th>
									<th scope="col" style="min-width: 150px">Rata-Rata Suhu Ruangan (X)</th>
									<th scope="col" style="min-width: 130px">Jumlah Cacat (Y)</th>
									<th scope="col" style="min-width: 80px">X^2</th>
									<th scope="col" style="min-width: 80px">Y^2</th>
									<th scope="col" style="min-width: 80px">X*Y</th>
								</thead>

								<tbody>
									<?php
// ================================ TAHAP 1, hitung hasil x^2,y^2, dan x+y
									$query = "SELECT id,x,y,pow(x,2) as xx,pow(y,2) as yy,x*y as xy FROM tb_training";
									$select = mysqli_query($db,$query);
									foreach ($select as $training) { 
										$id=$training['id'];
										$x=$training['x'];
										$y=$training['y'];
										$xx=$training['xx'];
										$yy=$training['yy'];
										$xy=$training['xy'];
										?>
										<tr>
											<td><?php echo $id ?></td>
											<td><?php echo $x ?></td>
											<td><?php echo $y ?></td>
											<td><?php echo $xx ?></td>
											<td><?php echo $yy ?></td>
											<td><?php echo $xy ?></td>
										</tr>
										<?php
										// isi data yang sebelumnya kosong
										$query_update = "UPDATE tb_training SET xx='$xx',yy='$yy',xy='$xy' WHERE id='$id'";
										mysqli_query($db,"$query_update");
									}

// ================================ TAHAP 2, panggil data SUM
									$select_sum = mysqli_fetch_assoc(mysqli_query($db,"SELECT count(id) as n, sum(x) as jml_x, sum(y) as jml_y, sum(xx) as jml_xx, sum(yy) as jml_yy, sum(xy) as jml_xy FROM tb_training"));

									// atasi error bila variabel jumlah belum ada
									$n = (!empty($select_sum['n'])) ? $select_sum['n'] : "";
									$jml_x = (!empty($select_sum['jml_x'])) ? $select_sum['jml_x'] : "";
									$jml_y = (!empty($select_sum['jml_y'])) ? $select_sum['jml_y'] : "";
									$jml_xx = (!empty($select_sum['jml_xx'])) ? $select_sum['jml_xx'] : "";
									$jml_yy = (!empty($select_sum['jml_yy'])) ? $select_sum['jml_yy'] : "";
									$jml_xy = (!empty($select_sum['jml_xy'])) ? $select_sum['jml_xy'] : "";
									?>

									<tr> <td colspan="6" class="bg-white"></td> </tr>
									<tr class="text-white">
										<th>n</th>
										<th>Σ X</th>
										<th>Σ Y</th>
										<th>Σ X^2</th>
										<th>Σ Y^2</th>
										<th>Σ X*Y</th>
									</tr>
									<tr>
										<td><?php echo $n ?></td>
										<td><?php echo $jml_x ?></td>
										<td><?php echo $jml_y ?></td>
										<td><?php echo $jml_xx ?></td>
										<td><?php echo $jml_yy ?></td>
										<td><?php echo $jml_xy ?></td>
									</tr>
								</tbody>
							</table>
						</div>

						<!-- tabel 2 -->
						<div class="table-responsive">
							<table class="table table-bordered border-dark responsive-utilities table-hover text-center">
								<thead class="text-white">
									<th scope="col">a</th>
									<th scope="col">b</th>
								</thead>
								<tbody>
									<?php
// ================================ TAHAP 3, menghitung a dan b
									if (!empty($n)){
										// hitung koefisien
										// jika jumlah data n hanya satu atau data yang dihitung bernilai 0 pada bagian pembagi, maka set nilai a dan b jadikan 0.
										$deteksi_zero = ($n*$jml_xx) - pow($jml_x,2);

										$a = ($deteksi_zero == 0) ? 0 : round((($jml_y*$jml_xx) - ($jml_x*$jml_xy)) / (($n*$jml_xx) - pow($jml_x,2)),2);
										$b = ($deteksi_zero == 0) ? 0 : round((($n*$jml_xy) - ($jml_x*$jml_y)) / (($n*$jml_xx) - pow($jml_x,2)),2);

										// isi nilai a dan b sebagai session untuk digunakan nantinya pada action testing 
										$_SESSION['a'] = $a;
										$_SESSION['b'] = $b;
										?>
										<!-- tampilkan Nilai -->
										<tr>
											<td><?php echo $a ?></td>
											<td><?php echo $b ?></td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<!-- END TRAINING -->

				<!-- TESTING -->
				<div class="col-12 col-md-4 p-3 mt-1 mt-lg-2">
					<div class="p-3 shadow">

						<h2>Data Testing</h2>
						<?php
						if(isset($a) && isset($b)) : ?>
							<!-- Rumus untuk menentukan nilai X dan Y dari koefisien regresi a dan b -->
							<span class="d-block"> <b>X =</b> (Y - <?php echo ($a < 0) ? '('.$a.')' : $a ?>) / <?php echo $b ?> </span>
							<span class="d-block"> <b>Y =</b> <?php echo $a ?> + (<?php echo $b ?>*X) </span>
						<?php endif;

						$deteksi_zero = (!empty($n)) ? ($n*$jml_xx) - pow($jml_x,2) : 0;
						if($n>1 && $deteksi_zero!=0) :
							require('komponen/modal-add-testing.php'); ?>
						<?php endif; ?>

						<a href="action/action-testing.php?opsi=delete-all" class="btn btn-outline-danger my-3" onclick="return confirm_delete_testing()"> Hapus Data</a>

						<div class="table-responsive">

							<table class="table table-bordered border-dark responsive-utilities table-hover text-center">
								<thead class="text-white">
									<th scope="col" style="min-width: 130px;">Rata-Rata Suhu Ruangan (X)</th>
									<th scope="col">Jumlah Cacat (Y)</th>
									<th scope="col">Aksi</th>
								</thead>

								<tbody>
									<?php
									$query = "SELECT * FROM tb_testing";
									$select = mysqli_query($db,$query);
									foreach ($select as $training) { 
										$id_test=$training['id_test'];
										$x_test= round($training['x_test'],2);
										$y_test= round($training['y_test'],2);
										?>
										<tr>
											<td><?php echo $x_test ?></td>
											<td><?php echo $y_test ?></td>
											<td>
												<a href="action/action-testing.php?id=<?php echo $id_test ?>&opsi=delete" class="hapus-testing text-decoration-none text-danger" onclick="return confirm_delete()">Hapus</a>
											</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>

					</div>
				</div>
				<!-- END TESTING -->

			</div>
		</div>
	</div>
	<!-- End Content -->

	<!-- Footer -->
	<div id="footer" class="wrapper mt-3 py-2 fixed-bottom">
		<div class="container">
			<div class="copyright d-flex justify-content-start">
				<span class="text-white">© Saiful Rahman 2022 &nbsp|&nbsp Tugas Mata Kuliah Data Mining</span>
			</div>
		</div>

	</div>
	<!-- End Footer -->
</body>
<?php require('config/script.php'); ?>
