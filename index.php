<?php require_once('src/koneksi.php'); ?>
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

				<div class="col-12 col-md-11 p-3 mt-1 mt-lg-2">
					<div class="bg-white shadow-sm p-3">
						<h2>Data Training</h2>

						<?php require('komponen/modal-add-training.php'); ?>

						<a href="action/action-training.php?opsi=delete" class="btn btn-outline-danger my-3" onclick="return confirm_delete_training()"> Hapus Data</a>
						<div class="table-responsive">

							<table class="table table-bordered border-dark responsive-utilities table-hover text-center">
								<thead class="text-white">
									<th scope="col">Tanggal</th>
									<th scope="col" style="min-width: 150px">x̄ Suhu Ruangan (X1)</th>
									<th scope="col" style="min-width: 130px">Σ Cacat (Y1)</th>
									<th scope="col" style="min-width: 80px">X1^2</th>
									<th scope="col" style="min-width: 80px">Y1^2</th>
									<th scope="col" style="min-width: 80px">X1*Y1</th>
								</thead>
								<tbody>
									<?php
									$query = "SELECT id,x,y,pow(x,2) as xx,pow(y,2) as yy,x+y as xy FROM tb_training";
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
										$query_update = "UPDATE tb_training SET xx='$xx',yy='$yy',xy='$xy' WHERE id='$id'";
										mysqli_query($db,"$query_update");
									}  ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>

				<div class="col-12 col-md-11 p-3 mt-1 mt-lg-2 table-responsive">
					<div class="p-3 shadow">
						<h2>Data Testing</h2>

						<a href="#" class="btn btn-outline-dark my-3 me-3"> Tambah Data</a>
						<a href="#" class="btn btn-outline-danger my-3" onclick="return confirm_delete_testing()"> Hapus Data</a>

						<table class="table table-bordered border-dark responsive-utilities table-hover text-center">
							<thead class="text-white">
								<th scope="col">x̄ Suhu Ruangan (X2)</th>
								<th scope="col">Σ Cacat (Y2)</th>
							</thead>
							<tbody>
								<?php for ($i=1; $i < 3; $i++) { ?>
									<tr>
									</tr>
								<?php }  ?>
							</tbody>
						</table>
					</div>
				</div>

				<div class="col-12 col-md-11 bg-success p-3 mt-1">
					
				</div>

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
</html>