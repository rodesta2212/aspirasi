<!DOCTYPE html>
<html>

<?php
    include("config.php");
    include_once('includes/user.inc.php');

	session_start();
	if (!isset($_SESSION['id_user'])) echo "<script>location.href='login.php'</script>";
    $config = new Config(); $db = $config->getConnection();

	$User = new User($db);
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
						<h4 class="text-blue h4"><i class="dw dw-user"></i> Mahasiswa</h4>
						<!-- <p class="mb-0">you can find more options <a class="text-primary" href="https://datatables.net/" target="_blank">Click Here</a></p> -->
                    </div>
                    <div style="padding-right:15px;">
                        <!-- <a href="user-create"> -->
                            <!-- <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#createModal">Tambah</button> -->
                        <!-- </a> -->
                    </div>
                    <div class="pb-20">
						<table class="data-table table stripe hover nowrap">
							<thead>
								<tr class="text-center">
									<th>No</th>
									<th>Nama</th>
                                    <th>NIM</th>
									<th>Jurusan</th>
									<th>Email</th>
									<th>Telp</th>
									<th>Jenis Kelamin</th>
								</tr>
							</thead>
							<tbody>
                                <?php $no=1; $Users = $User->readAllMahasiswa(); while ($row = $Users->fetch(PDO::FETCH_ASSOC)) : ?>
								<tr class="text-center">
									<td><?=$no?></td>
									<td><?=$row['nama']?></td>
                                    <td><?=$row['nim']?></td>
									<td><?=$row['jurusan']?></td>
									<td><?=$row['email']?></td>
									<td><?=$row['telp']?></td>
									<td>
										<?php if($row['jenis_kelamin'] == 'laki'): ?>
											Laki - Laki
										<?php else: ?>
											Perempuan
										<?php endif; ?>
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
