<!DOCTYPE html>
<html>

<?php
    include("config.php");
	include_once('includes/aspirasi.inc.php');
	include_once('includes/advokasi.inc.php');

	session_start();
	if (!isset($_SESSION['id_user'])) echo "<script>location.href='login.php'</script>";
    $config = new Config(); $db = $config->getConnection();

	$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

	$Aspirasi = new Aspirasi($db);
	$Aspirasi->id_aspirasi = $id;
	$Aspirasi->readOne();

	$Advokasi = new Advokasi($db);
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
		// upload file
		if(isset($_FILES['file'])){
			$errors= array();
			$file_name = str_replace(" ", "-", $_FILES['file']['name']);
			$file_size =$_FILES['file']['size'];
			$file_tmp =$_FILES['file']['tmp_name'];
			$file_type=$_FILES['file']['type'];
			$tmp = explode('.', $file_name);
			$file_extension = end($tmp);
			$extensions= array("jpeg","jpg","png","pdf");
			
			if(in_array($file_extension,$extensions)=== false){
				// $errors[]="extension not allowed, please choose a JPEG or PNG file.";
			}
			
			if($file_size > 20097152){
				$errors[]='File size must be excately 20 MB';
			}
			
			if(empty($errors)==true){
				move_uploaded_file($file_tmp,"upload/".$file_name);
				// echo "Success";
				
			}else{
				print_r($errors);
			}
		}

		if($_POST){
			// post aspirasi
			$Aspirasi->id_aspirasi = $_POST["id_aspirasi"];
            $Aspirasi->aspirasi = $_POST["aspirasi"];
            $Aspirasi->id_kategori = $_POST["id_kategori"];
            $Aspirasi->id_mahasiswa = $_POST["id_mahasiswa"];
			$Aspirasi->status = $_POST["status"];

			// post advokasi
			$Advokasi->id_advokasi = $_POST["id_advokasi"];
            $Advokasi->advokasi = $_POST["advokasi"];
            $Advokasi->id_aspirasi = $_POST["id_aspirasi"];
            if (!empty($_FILES['file']['name'])){
				$Advokasi->file = $_FILES['file']['name'];
			}

			if ($Aspirasi->update() && $Advokasi->insert()) {
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
							Upload Hasil
						</h4>
						<!-- <p class="mb-0">you can find more options <a class="text-primary" href="https://datatables.net/" target="_blank">Click Here</a></p> -->
                    </div>
					<form method="POST" enctype="multipart/form-data">
					<!-- hidden -->
					<input type="hidden" name="id_aspirasi" value="<?php echo $Aspirasi->id_aspirasi; ?>">
					<input type="hidden" name="id_advokasi" value="<?php echo $Advokasi->getNewId(); ?>">
					<input type="hidden" name="id_mahasiswa" value="<?php echo $Aspirasi->id_mahasiswa; ?>">
					<input type="hidden" name="id_kategori" value="<?php echo $Aspirasi->id_kategori; ?>">
					<input type="hidden" name="status" value="Selesai">
					<div style="padding-right:15px;">
                        <!-- <a href="ujian-create"> -->
                            <button type="submit" class="btn btn-success float-right">Simpan</button>
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
						<div class="form-group">
							<label>Hasil Advokasi</label>
							<textarea class="form-control" name="advokasi" placeholder="Masukkan Hasil Advokasi" style="height:100px;" required></textarea>
						</div>
						<div class="form-group">
							<label>Upload Hasil</label>
							<input type="file" class="form-control" name="file" required>
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
