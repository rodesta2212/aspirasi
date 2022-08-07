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
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<!-- Simple Datatable start -->
				<div class="card-box mb-30">
					<div class="pd-20">
						<h4 class="text-blue h4"><i class="dw dw-file-135"></i> Laporan Hasil Advokasi</h4>
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
									<th>Aspirasi</th>
                                    <th>Advokasi</th>
									<th>Kategori</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
                                <?php $no=1; $Aspirasis = $Aspirasi->readAllSelesai(); while ($row = $Aspirasis->fetch(PDO::FETCH_ASSOC)) : ?>
								<tr class="text-center">
									<td><?=$no?></td>
									<td><?=$row['aspirasi']?></td>
                                    <td><?=$row['advokasi']?></td>
									<td><?=$row['nama_kategori']?> (<?=$row['bidang']?>)</td>
									<td>
										<a class="dropdown-item link-action" href="aspirasi-detail.php?id=<?php echo $row['id_aspirasi']; ?>"><i class="dw dw-eye"></i> Cek Hasil</a>
									</td>
								</tr>
                                <?php $no++; endwhile; ?>
							</tbody>
						</table>
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
