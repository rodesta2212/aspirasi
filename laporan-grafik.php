<!DOCTYPE html>
<html>

<?php
	include("config.php");
	include_once('includes/aspirasi.inc.php');

	session_start();
	if (!isset($_SESSION['id_user'])) echo "<script>location.href='login.php'</script>";
	$config = new Config(); $db = $config->getConnection();

	$Aspirasi = new Aspirasi($db);
?>

<!-- header -->
<?php include("header.php"); ?>

<body>
	<!-- head navbar -->
	<?php include("head-navbar.php"); ?>

	<!-- right sidebar -->
	<?php include("right-sidebar.php"); ?>

	<!-- left sidebar -->
	<?php include("left-sidebar.php"); ?>

	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20">
			<div class="card-box pd-20 height-100-p mb-30">
				<div class="row align-items-center">
					<div class="col-md-6">
						<div class="h5 mb-0">Laporan Perkategori</div>
						<div id="bar-kategori"></div>
					</div>
					<div class="col-md-6">
						<div class="h5 mb-0">Laporan Berdasarkan Angkatan</div>
						<div id="bar-angkatan"></div>
					</div>
				</div>
			</div>

			<!-- footer -->
            <?php include("footer.php"); ?>
		</div>
	</div>
	<!-- js -->
	<script src="vendors/scripts/core.js"></script>
	<script src="vendors/scripts/script.min.js"></script>
	<script src="vendors/scripts/process.js"></script>
	<script src="vendors/scripts/layout-settings.js"></script>
	<script src="src/plugins/apexcharts/apexcharts.min.js"></script>
	<script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script>
	<script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
	<script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script>
	<script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
	<script src="vendors/scripts/dashboard.js"></script>

	
	<script>
		Morris.Bar({
			element: 'bar-kategori',
			data: [
				<?php $Aspirasis = $Aspirasi->LaporanPerkategori(); while ($row = $Aspirasis->fetch(PDO::FETCH_ASSOC)) : ?>
					{ x: '<?=$row['nama_kategori']?>', data1: <?=$row['jml_aspirasi']?> },
				<?php endwhile; ?>
			],
			xkey: 'x',
			ykeys: ['data1'],
			labels: ['Aspirasi'],
			// barColors: ["#0000FF"]
		});

		Morris.Bar({
			element: 'bar-angkatan',
			data: [
				<?php $Aspirasis = $Aspirasi->LaporanPerangkatan(); while ($row = $Aspirasis->fetch(PDO::FETCH_ASSOC)) : ?>
					{ x: '20<?=$row['angkatan']?>', data2: <?=$row['jml_aspirasi']?> },
				<?php endwhile; ?>
			],
			xkey: 'x',
			ykeys: ['data2'],
			labels: ['Aspirasi'],
			barColors: ["#088F8F"]
		});
	</script>

</body>
</html>