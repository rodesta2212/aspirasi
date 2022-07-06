<!DOCTYPE html>
<html>

<?php
    include("config.php");
    include_once('includes/guru.inc.php');

	session_start();
	if (!isset($_SESSION['id_user'])) echo "<script>location.href='login.php'</script>";
    $config = new Config(); $db = $config->getConnection();

    $Guru = new Guru($db);
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
						<h4 class="text-blue h4"><i class="dw dw-mortarboard"></i> Data Guru</h4>
						<!-- <p class="mb-0">you can find more options <a class="text-primary" href="https://datatables.net/" target="_blank">Click Here</a></p> -->
					</div>
					<div class="pb-20">
						<table class="data-table table stripe hover nowrap">
							<thead>
								<tr class="text-center">
									<th>ID Guru</th>
									<th>Nama</th>
                                    <th>Asal Sekolah</th>
                                    <th>No Telp</th>
                                    <th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
                                <?php $no=1; $gurus = $Guru->readAll(); while ($row = $gurus->fetch(PDO::FETCH_ASSOC)) : ?>
								<tr class="text-center">
									<td><?=$row['id_guru']?></td>
									<td><?=$row['nama']?></td>
                                    <td><?=$row['nama_lembaga']?></td>
                                    <td><?=$row['telp']?></td>
                                    <td><?=$row['status']?></td>
									<td>
                                        <a class="dropdown-item link-action" href="guru-verifikasi.php?id=<?php echo $row['id_guru']; ?>&&id_user=<?php echo $row['id_user']; ?>"><i class="dw dw-eye"></i> Detail</a> | 
										<!-- <a class="dropdown-item link-action" href="guru-update.php?id=<?php echo $row['id_guru']; ?>&&id_user=<?php echo $row['id_user']; ?>"><i class="dw dw-edit-1"></i> Edit</a> |  -->
										<a class="dropdown-item link-action" href="guru-delete.php?id=<?php echo $row['id_guru']; ?>&&id_user=<?php echo $row['id_user']; ?>"><i class="dw dw-delete-3"></i> Delete</a>
									</td>
								</tr>
                                <?php endwhile; ?>
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
