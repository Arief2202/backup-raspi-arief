<!DOCTYPE html>
<html>
<head>
	<title>CRUD Petani Kode</title>
	<link rel="icon" href="http://www.petanikode.com/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="http://192.168.100.200/arief/UTSPemWeb/css/style.css">
</head>
<body>

<?php

// --- koneksi ke database
// $koneksi = mysqli_connect("localhost","root","","pertanian") or die(mysqli_error());

// --- Fngsi tambah data (Create)
function tambah($koneksi){
	
	if (isset($_POST['btn_simpan'])){
		$id = time();
		$nm_tanaman = $_POST['nm_tanaman'];
		$hasil = $_POST['hasil'];
		$lama = $_POST['lama'];
		$tgl_panen = $_POST['tgl_panen'];
		
		if(!empty($nm_tanaman) && !empty($hasil) && !empty($lama) && !empty($tgl_panen)){
			$sql = "INSERT INTO tabel_panen (id,nama_tanaman, hasil_panen, lama_tanam, tanggal_panen) VALUES(".$id.",'".$nm_tanaman."','".$hasil."','".$lama."','".$tgl_panen."')";
			$simpan = mysqli_query($koneksi, $sql);
			if($simpan && isset($_GET['aksi'])){
				if($_GET['aksi'] == 'create'){
					header('location: index.php');
				}
			}
			$id = "";
			$nm_tanaman="";
			$hasil="";
			$lama="";
			$tgl_panen="";
		} else {
			$pesan = "Tidak dapat menyimpan, data belum lengkap!";
		}
	}
	
	?> 
		<form action="" method="POST">
			<div id="myModal" class="modal hidden">
				<div class="modal-content">
						<span class="close">&times;</span>
						<h2>Add Data</h2>
						<div class="inputBox">
							<input type="text" name="nm_tanaman" required="">
							<label>Nama tanaman</label>
						</div>
						<div class="inputBox">
							<input type="number" name="hasil" required="">
							<label>Hasil panen (Kg)</label>
						</div>
						<div class="inputBox">
							<input type="number" name="lama" required="">
							<label>Lama tanam (Bulan)</label>
						</div>
						<div class="inputBox">
							<input type="date" class="tgl" name="tgl_panen" required="">
							<label style="top: -20px;">Tanggal panen</label>
						</div>
						<input type="submit" name="btn_simpan" value="Simpan">
						<input type="reset" name="reset" value="Besihkan">
				</div>

			</div>
		</form>
	<?php
}

// --- Tutup Fngsi tambah data


// --- Fungsi Baca Data (Read)
function tampil_data($koneksi){
	$sql = "SELECT * FROM tabel_panen";
	$query = mysqli_query($koneksi, $sql);
	?>
	<div class="container">

	<button id="myBtn" class="transparent-button">
	<img style="width:30px;"src="img/add.png">
	</button>
	
	<div class="text-center"><b>DATA PANEN</b></div>	

	<table class="styled-table">
		<thead>
			<tr>
				<th>ID</th>
				<th>Nama Tanaman</th>
				<th>Hasil Panen</th>
				<th>Lama Tanam</th>
				<th>Tanggal Panen</th>
				<th>Edit</th>
			</tr>
		</thead>
		<tbody>
	<?php
	while($data = mysqli_fetch_array($query)){
		?>
			<tr>
				<td><?php echo $data['id']; ?></td>
				<td><?php echo $data['nama_tanaman']; ?></td>
				<td><?php echo $data['hasil_panen']; ?> Kg</td>
				<td><?php echo $data['lama_tanam']; ?> bulan</td>
				<td><?php echo $data['tanggal_panen']; ?></td>
				<td>
						<a href="index.php?aksi=update&id=<?php echo $data['id']; ?>&nama=<?php echo $data['nama_tanaman']; ?>&hasil=<?php echo $data['hasil_panen']; ?>&lama=<?php echo $data['lama_tanam']; ?>&tanggal=<?php echo $data['tanggal_panen']; ?>">
						<img style="width:30px;"src="img/edit.png"></a>
				</td>
			</tr>
		<?php
	}
	echo "</tbody>";
	echo "</table>";
	echo "</div>";
}
// --- Tutup Fungsi Baca Data (Read)


// --- Fungsi Ubah Data (Update)
function ubah($koneksi){

	// ubah data
	if(isset($_POST['btn_ubah'])){
		$id = $_POST['id'];
		$nm_tanaman = $_POST['nm_tanaman'];
		$hasil = $_POST['hasil'];
		$lama = $_POST['lama'];
		$tgl_panen = $_POST['tgl_panen'];
		
		if(!empty($nm_tanaman) && !empty($hasil) && !empty($lama) && !empty($tgl_panen)){
			$perubahan = "nama_tanaman='".$nm_tanaman."',hasil_panen=".$hasil.",lama_tanam=".$lama.",tanggal_panen='".$tgl_panen."'";
			$sql_update = "UPDATE tabel_panen SET ".$perubahan." WHERE id=$id";
			$update = mysqli_query($koneksi, $sql_update);
			if($update && isset($_GET['aksi'])){
				if($_GET['aksi'] == 'update'){
					header('location: index.php');
				}
			}
		} else {
			$pesan = "Data tidak lengkap!";
		}
	}
	
	// tampilkan form ubah
	if(isset($_GET['id'])){
		?>
			<form action="" method="POST">
				<div id="myModal" class="modal">
					<div class="modal-content">
							<span class="close">&times;</span>
							<h2>Edit Data</h2>
							<input type="hidden" name="id" value="<?php echo $_GET['id'] ?>"/>
							<div class="inputBox">
								<input type="text" name="nm_tanaman" required="" value="<?php echo $_GET['nama'] ?>">
								<label>Nama tanaman</label>
							</div>
							<div class="inputBox">
								<input type="number" name="hasil" required="" value="<?php echo $_GET['hasil'] ?>">
								<label>Hasil panen (Kg)</label>
							</div>
							<div class="inputBox">
								<input type="number" name="lama" required="" value="<?php echo $_GET['lama'] ?>">
								<label>Lama tanam (Bulan)</label>
							</div>
							<div class="inputBox">
								<input type="date" class="tgl" name="tgl_panen" required="" value="<?php echo $_GET['tanggal'] ?>">
								<label style="top: -20px;">Tanggal panen</label>
							</div>
							<input type="submit" name="btn_ubah" value="Save"/>
							
							<a href="index.php?aksi=delete&id=<?php echo $_GET['id'] ?>">
							<img style="float: right; width:30px;"src="img/remove.png"></a>
					</div>
				</div>
			</form>
		<?php
	}
	
}
// --- Tutup Fungsi Update


// --- Fungsi Delete
function hapus($koneksi){

	if(isset($_GET['id']) && isset($_GET['aksi'])){
		$id = $_GET['id'];
		$sql_hapus = "DELETE FROM tabel_panen WHERE id=" . $id;
		$hapus = mysqli_query($koneksi, $sql_hapus);
		
		if($hapus){
			if($_GET['aksi'] == 'delete'){
				header('location: index.php');
			}
		}
	}
	
}
// --- Tutup Fungsi Hapus


// ===================================================================

// --- Program Utama
if (isset($_GET['aksi'])){
	switch($_GET['aksi']){
		case "create":
			echo '<a href="index.php"> &laquo; Home</a>';
			tambah($koneksi);
			break;
		case "read":
			tampil_data($koneksi);
			break;
		case "update":
			ubah($koneksi);
			tampil_data($koneksi);
			break;
		case "delete":
			hapus($koneksi);
			break;
		default:
			echo "<h3>Aksi <i>".$_GET['aksi']."</i> tidaka ada!</h3>";
			tambah($koneksi);
			tampil_data($koneksi);
	}
} else {
	tambah($koneksi);
	tampil_data($koneksi);
}

?>


<script>
var modal = document.getElementById("myModal");
var btn = document.getElementById("myBtn");
var span = document.getElementsByClassName("close")[0];

if (window.history.replaceState) {
	window.history.replaceState( null, null, window.location.href );
}

btn.onclick = function() {
  modal.style.display = "block";
}

span.onclick = function() {
  modal.style.display = "none";
  window.location.href="index.php";
}

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  window.location.href="index.php";
  }
}
</script>
</body>
</html>
