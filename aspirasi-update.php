<!DOCTYPE html>
<html>

<?php
    include("config.php");
	include_once('includes/aspirasi.inc.php');

	session_start();
	if (!isset($_SESSION['id_user'])) echo "<script>location.href='login.php'</script>";
    $config = new Config(); $db = $config->getConnection();

	$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

	$Aspirasi = new Aspirasi($db);
	$Aspirasi->id_aspirasi = $id;
	$Aspirasi->readOne();
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

    <?php
		if($_POST){
			// post aspirasi
			$Aspirasi->id_aspirasi = $_POST["id_aspirasi"];
            $Aspirasi->aspirasi = $_POST["aspirasi"];
            $Aspirasi->id_kategori = $_POST["id_kategori"];
            $Aspirasi->id_mahasiswa = $_POST["id_mahasiswa"];
			$Aspirasi->status = $_POST["status"];

			if ($Aspirasi->update()) {
				echo '<script language="javascript">';
                echo 'alert("Data Berhasil Terkirim")';
				echo '</script>';
				echo "<script>location.href='aspirasi.php'</script>";
			} else {
				echo '<script language="javascript">';
                echo 'alert("Data Gagal Terkirim")';
                echo '</script>';
			}
		}
	?>

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<!-- Simple Datatable start -->
				<div class="card-box mb-30">
					<div class="pd-20">
						<h4 class="text-blue h4"><i class="dw dw-edit-file"></i> 
							<?php if($_SESSION['role'] == 'bem'): ?>
								Verifikasi Aspirasi
							<?php elseif($_SESSION['role'] == 'dpm'): ?>
								Konfirmasi Aspirasi
							<?php endif; ?>
						
						</h4>
						<!-- <p class="mb-0">you can find more options <a class="text-primary" href="https://datatables.net/" target="_blank">Click Here</a></p> -->
                    </div>
					<form method="POST" enctype="multipart/form-data">
					<!-- hidden -->
					<input type="hidden" name="id_aspirasi" value="<?php echo $Aspirasi->id_aspirasi; ?>">
					<input type="hidden" name="id_mahasiswa" value="<?php echo $Aspirasi->id_mahasiswa; ?>">
					<input type="hidden" name="id_kategori" value="<?php echo $Aspirasi->id_kategori; ?>">
					<?php if($_SESSION['role'] == 'bem'): ?>
						<input type="hidden" name="status" value="Terverifikasi">
					<?php elseif($_SESSION['role'] == 'dpm'): ?>
						<input type="hidden" name="status" value="Terkonfirmasi">
					<?php endif; ?>
					<div style="padding-right:15px;">
                        <!-- <a href="ujian-create"> -->
							<?php if($_SESSION['role'] == 'bem'): ?>
								<a href="aspirasi-penolakan.php?id=<?php echo $Aspirasi->id_aspirasi; ?>" class="btn btn-danger float-right">Penolakan</a>
								<button type="submit" class="btn btn-success float-right" style="margin-right:10px;">Verifikasi</button>
							<?php elseif($_SESSION['role'] == 'dpm'): ?>
								<button type="submit" class="btn btn-success float-right">Konfirmasi</button>
							<?php endif; ?>
                        <!-- </a> -->
                    </div>
					<!-- horizontal Basic Forms Start -->
					<div class="pd-20 mb-30">
						<div class="form-group">
							<label>Nama Mahasiswa</label>
							<input type="text" class="form-control" name="nama_mahasiswa" value="<?php echo $Aspirasi->nama_mahasiswa; ?>" readonly>
						</div>
						<div class="form-group">
							<label>NIM</label>
							<input type="text" class="form-control" name="nim" value="<?php echo $Aspirasi->nim; ?>" readonly>
						</div>
						<div class="form-group">
							<label>Kategori</label>
							<input type="text" class="form-control" name="nama_kategori" value="<?php echo $Aspirasi->nama_kategori; ?> (<?php echo $Aspirasi->bidang; ?>)" readonly>
						</div>
						<div class="form-group">
							<label>Aspirasi</label>
							<textarea class="form-control" name="aspirasi" style="height:100px;" readonly><?php echo $Aspirasi->aspirasi; ?></textarea>
						</div>
					</div>
					</form>
				</div>
				<!-- Simple Datatable End -->
			</div>
            <!-- footer -->
            <?php include("footer.php"); ?>
		</div>
	</div>
	<!-- js -->
    <?php include("script.php"); ?>
</body>
</html>
