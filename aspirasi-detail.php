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
	$Aspirasi->readOneDetail();

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
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<!-- Simple Datatable start -->
				<div class="card-box mb-30">
					<div class="pd-20">
						<h4 class="text-blue h4"><i class="dw dw-edit-file"></i> 
							Lihat Hasil
						</h4>
						<!-- <p class="mb-0">you can find more options <a class="text-primary" href="https://datatables.net/" target="_blank">Click Here</a></p> -->
                    </div>
					<!-- horizontal Basic Forms Start -->
					<div class="pd-20 mb-30 row">
						<div class="form-group col-6">
							<label>Nama Mahasiswa</label>
							<input type="text" class="form-control" name="nama_mahasiswa" value="<?php echo $Aspirasi->nama_mahasiswa; ?>" readonly>
						</div>
						<div class="form-group col-6">
							<label>NIM</label>
							<input type="text" class="form-control" name="nim" value="<?php echo $Aspirasi->nim; ?>" readonly>
						</div>
						<div class="form-group col-6">
							<label>Jurusan</label>
							<input type="text" class="form-control" name="jurusan" value="<?php echo $Aspirasi->jurusan; ?>" readonly>
						</div>
						<div class="form-group col-6">
							<label>Jenis Kelamin</label>
							<?php if($Aspirasi->jenis_kelamin == 'laki'): ?>
								<input type="text" class="form-control" name="jk" value="Laki - Laki" readonly>
							<?php else: ?>
								<input type="text" class="form-control" name="jk" value="Perempuan" readonly>
							<?php endif; ?>
						</div>
						<div class="form-group col-6">
							<label>Kategori</label>
							<input type="text" class="form-control" name="nama_kategori" value="<?php echo $Aspirasi->nama_kategori; ?>" readonly>
						</div>
						<div class="form-group col-6">
							<label>Bidang</label>
							<input type="text" class="form-control" name="bidang" value="<?php echo $Aspirasi->bidang; ?>" readonly>
						</div>
						<div class="form-group col-12">
							<label>Aspirasi</label>
							<textarea class="form-control" name="aspirasi" style="height:100px;" readonly><?php echo $Aspirasi->aspirasi; ?></textarea>
						</div>
						<div class="form-group col-12">
							<label>Hasil Advokasi</label>
							<textarea class="form-control" style="height:100px;" readonly><?php echo $Aspirasi->advokasi; ?></textarea>
						</div>
						<div class="form-group col-12">
							<label>File Upload : </label>
							<a href="upload/<?php echo $Aspirasi->file; ?>" target="_blank" style="color:red;">Lihat File Terupload</a>
						</div>
					</div>
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
