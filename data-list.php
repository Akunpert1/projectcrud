<?php

include_once 'config/class-roti.php';
$roti = new roti();
// Menampilkan alert berdasarkan status yang diterima melalui parameter GET
if(isset($_GET['status'])){
	// Mengecek nilai parameter GET 'status' dan menampilkan alert yang sesuai menggunakan JavaScript
	if($_GET['status'] == 'inputsuccess'){
		echo "<script>alert('Data roti berhasil ditambahkan.');</script>";
	} else if($_GET['status'] == 'editsuccess'){
		echo "<script>alert('Data roti berhasil diubah.');</script>";
	} else if($_GET['status'] == 'deletesuccess'){
		echo "<script>alert('Data roti berhasil dihapus.');</script>";
	} else if($_GET['status'] == 'deletefailed'){
		echo "<script>alert('Gagal menghapus data roti. Silakan coba lagi.');</script>";
	}
}
$dataroti = $roti->getAllroti();

?>
<!doctype html>
<html lang="en">
	<head>
		<?php include 'template/header.php'; ?>
	</head>

	<body class="layout-fixed fixed-header fixed-footer sidebar-expand-lg sidebar-open bg-body-tertiary">

		<div class="app-wrapper">

			<?php include 'template/navbar.php'; ?>

			<?php include 'template/sidebar.php'; ?>

			<main class="app-main">

				<div class="app-content-header">
					<div class="container-fluid">
						<div class="row">
							<div class="col-sm-6">
								<h3 class="mb-0">Daftar roti</h3>
							</div>
							<div class="col-sm-6">
								<ol class="breadcrumb float-sm-end">
									<li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
									<li class="breadcrumb-item active" aria-current="page">Beranda</li>
								</ol>
							</div>
						</div>
					</div>
				</div>

				<div class="app-content">
					<div class="container-fluid">
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header">
										<h3 class="card-title">Tabel roti</h3>
										<div class="card-tools">
											<button type="button" class="btn btn-tool" data-lte-toggle="card-collapse" title="Collapse">
												<i data-lte-icon="expand" class="bi bi-plus-lg"></i>
												<i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
											</button>
											<button type="button" class="btn btn-tool" data-lte-toggle="card-remove" title="Remove">
												<i class="bi bi-x-lg"></i>
											</button>
										</div>
									</div>
									<div class="card-body p-0 table-responsive">
										<table class="table table-striped" role="table">
											<thead>
												<tr>
													<th>No</th>
													<th>NIM</th>
													<th>Nama</th>
													<th>toping</th>
												    <th>jumlah</th>
													<th>Provinsi</th>
													<th>Alamat</th>
													<th>Telp</th>
													<th>Email</th>
													<th class="text-center">Status</th>
													<th class="text-center">Aksi</th>
												</tr>
											</thead>
											<tbody>
												<?php
													if(count($dataroti) == 0){
													    echo '<tr class="align-middle">
															<td colspan="10" class="text-center">Tidak ada data mahasiswa.</td>
														</tr>';
													} else {
														foreach ($dataroti as $index => $roti){
															if($roti['status'] == 1){
															    $roti['status'] = '<span class="badge bg-success">PROSES</span>';
															} elseif($roti['status'] == 2){
															    $mahasiswa['status'] = '<span class="badge bg-danger">DIKIRIM</span>';
															} elseif($mahasiswa['status'] == 3){
															    $mahasiswa['status'] = '<span class="badge bg-warning text-dark">DIANTAR</span>';
															} elseif($mahasiswa['status'] == 4){
															    $mahasiswa['status'] = '<span class="badge bg-primary">TELAH DITERIMA</span>';
															} 
															echo '<tr class="align-middle">
																<td>'.($index + 1).'</td>
																<td>'.$roti['kode'].'</td>
																<td>'.$roti['nama'].'</td>
																<td>'.$roti['toping'].'</td>
																<td>'.$roti['jumlah'].'</td>
																<td>'.$roti['provinsi'].'</td>
																<td>'.$roti['alamat'].'</td>
																<td>'.$roti['telp'].'</td>
																<td>'.$roti['email'].'</td>
																<td class="text-center">'.$roti['status'].'</td>
																<td class="text-center">
																	<button type="button" class="btn btn-sm btn-warning me-1" onclick="window.location.href=\'data-edit.php?id='.$roti['id'].'\'"><i class="bi bi-pencil-fill"></i> Edit</button>
																	<button type="button" class="btn btn-sm btn-danger" onclick="if(confirm(\'Yakin ingin menghapus data mahasiswa ini?\')){window.location.href=\'proses/proses-delete.php?id='.$roti['id'].'\'}"><i class="bi bi-trash-fill"></i> Hapus</button>
																</td>
															</tr>';
														}
													}
												?>
											</tbody>
										</table>
									</div>
									<div class="card-footer">
										<button type="button" class="btn btn-primary" onclick="window.location.href='data-input.php'"><i class="bi bi-plus-lg"></i> Tambah roti</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</main>

			<?php include 'template/footer.php'; ?>

		</div>
		
		<?php include 'template/script.php'; ?>

	</body>
</html>