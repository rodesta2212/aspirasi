<!DOCTYPE html>
<html>

<?php
    include("config.php");
    include_once('includes/aspirasi.inc.php');
	include_once('includes/kategori.inc.php');

	session_start();
	if (!isset($_SESSION['id_user'])) echo "<script>location.href='login.php'</script>";
    $config = new Config(); $db = $config->getConnection();

	$Aspirasi = new Aspirasi($db);
	$Kategori = new Kategori($db);
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

			if($Aspirasi->insert()){
				echo '<script language="javascript">';
                echo 'alert("Data Berhasil Terkirim")';
                echo '</script>';
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
						<h4 class="text-blue h4"><i class="dw dw-pencil"></i> Data Aspirasi</h4>
						<!-- <p class="mb-0">you can find more options <a class="text-primary" href="https://datatables.net/" target="_blank">Click Here</a></p> -->
                    </div>
                    <div style="padding-right:15px;">
                        <!-- <a href="aspirasi-create"> -->
                            <!-- <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#createModal">Tambah</button> -->
                        <!-- </a> -->
                    </div>
                    <div class="pb-20">
						<table class="data-table table stripe hover nowrap">
							<thead>
								<tr class="text-center">
									<th>No</th>
									<th>aspirasi</th>
                                    <th>Kategori</th>
                                    <th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
                                <?php $no=1; $Aspirasis = $Aspirasi->readAll(); while ($row = $Aspirasis->fetch(PDO::FETCH_ASSOC)) : ?>
								<tr class="text-center">
									<td><?=$no?></td>
									<td><?=$row['aspirasi']?></td>
                                    <td><?=$row['nama_kategori']?> (<?=$row['bidang']?>)</td>
                                    <td>
										<?php if($_SESSION['role'] == 'bem'): ?>
											<?php if($row['status'] == 'Terverifikasi'): ?>
												Terverifikasi (Menunggu Tanggapan DPM)
											<?php elseif($row['status'] == 'Menunggu Verifikasi'): ?>
												Menunggu Verifikasi
											<?php elseif($row['status'] == 'Terkonfirmasi'): ?>
												Terkonfirmasi (Menunggu Tanggapan Advokasi)
											<?php elseif($row['status'] == 'Selesai'): ?>
												Selesai
											<?php endif; ?>
										<?php elseif($_SESSION['role'] == 'dpm'): ?>
											<?php if($row['status'] == 'Terverifikasi'): ?>
												Terverifikasi
											<?php elseif($row['status'] == 'Menunggu Verifikasi'): ?>
												Menunggu Tanggapan BEM
											<?php elseif($row['status'] == 'Terkonfirmasi'): ?>
												Terkonfirmasi (Menunggu Tanggapan Advokasi)
											<?php elseif($row['status'] == 'Selesai'): ?>
												Selesai
											<?php endif; ?>
										<?php endif; ?>
									</td>
									<td>
										<?php if($_SESSION['role'] == 'bem'): ?>
											<?php if($row['status'] == 'Selesai'): ?>
												<a class="dropdown-item link-action" href="aspirasi-detail.php?id=<?php echo $row['id_aspirasi']; ?>"><i class="dw dw-eye"></i> Cek Hasil</a>
											<?php elseif($row['status'] == 'Menunggu Verifikasi'): ?>
												<a class="dropdown-item link-action" href="aspirasi-update.php?id=<?php echo $row['id_aspirasi']; ?>"><i class="dw dw-edit-1"></i> Verifikasi</a>
											<?php else: ?>
												<i class="dropdown-item link-action dw dw-counterclockwise"></i>
											<?php endif; ?>
										<?php elseif($_SESSION['role'] == 'dpm'): ?>
											<?php if($row['status'] == 'Selesai'): ?>
												<a class="dropdown-item link-action" href="aspirasi-detail.php?id=<?php echo $row['id_aspirasi']; ?>"><i class="dw dw-eye"></i> Cek Hasil</a>
											<?php elseif($row['status'] == 'Terverifikasi'): ?>
												<a class="dropdown-item link-action" href="aspirasi-update.php?id=<?php echo $row['id_aspirasi']; ?>"><i class="dw dw-edit-1"></i> Konfirmasi</a>
											<?php elseif($row['status'] == 'Terkonfirmasi'): ?>
												<a class="dropdown-item link-action" href="aspirasi-cetak.php?id=<?php echo $row['id_aspirasi']; ?>"><i class="dw dw-print"></i> Print |</a>
												<a class="dropdown-item link-action" href="aspirasi-upload.php?id=<?php echo $row['id_aspirasi']; ?>"><i class="dw dw-upload2"></i> Upload</a>
											<?php else: ?>
												<i class="dropdown-item link-action dw dw-counterclockwise"></i>
											<?php endif; ?>
										<?php endif; ?>
									</td>
								</tr>
                                <?php $no++; endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
				<!-- Simple Datatable End -->

                <!-- Modal Create-->
                <div class="modal fade" id="createModal" role="dialog">
                    <div class="modal-dialog">
                        <form method="POST">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah Aspirasi</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <!-- hidden form -->
									<input type="hidden" name="status" value="Menunggu Verifikasi">
									<input type="hidden" name="id_aspirasi" value="<?php echo $Aspirasi->getNewId(); ?>">
									<input type="hidden" name="id_mahasiswa" value="<?php echo $_SESSION['id_mahasiswa']; ?>">
									<!-- hidden form -->
									<div class="form-group row">
										<label class="col-sm-4 col-form-label">Kategori<span style="color:red;">*</span></label>
										<div class="col-sm-8">
											<select class="custom-select col-12" name="id_kategori">
												<option selected disabled>Pilih Salah Satu...</option>
												<?php $kategoris = $Kategori->readAll(); while ($row = $kategoris->fetch(PDO::FETCH_ASSOC)) : ?>
													<option value="<?=$row['id_kategori']?>"><?=$row['nama']?> (<?=$row['bidang']?>)</option>
												<?php endwhile; ?>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-12 col-form-label">Aspirasi<span style="color:red;">*</span></label>
										<div class="col-sm-12">
											<textarea class="form-control" name="aspirasi" placeholder="Masukkan Aspirasi Mahasiswa" required style="height:100px;"></textarea>
										</div>
									</div>
                                </div>
                                <div class="modal-footer">
                                    <!-- <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> -->
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

			</div>
            <!-- footer -->
            <?php include("footer.php"); ?>
		</div>
	</div>
	<!-- js -->
    <?php include("script.php"); ?>
</body>
</html>
