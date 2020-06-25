<?php
session_start();
if ($_SESSION['status']!="admin" && $_SESSION['status']!="akl") {
    header("location:index.php?pesan=belum_login");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>PPDB SMKN 1 Kragilan</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../../css/bootstrap.min.css">

  <script src="../../js/bootstrap.min.js"></script>
</head>
<body>


<div class="container">

  <div class="container-fluid">
	<div class="row">
		<div class="col-md-3">
		</div>
		<div class="col-md-6">
      <center><h3>Daftar Ulang Peserta Didik</h3></center>
      <center><h3>SMK Negeri 1 Kragilan</h3></center>
      <center><h3>Kompetensi Keahlian Akuntansi Keuangan Lembaga</h3></center>
		</div>
		<div class="col-md-3">
		</div>
  </div>

  <table class="table table-bordered">
    <?php
      include '../../koneksi.php';
      $nik = isset($_GET['nik']) ? abs((int) $_GET['nik']) : 0;
      $data = mysqli_query($koneksi, "select
      id,
      nisn,
      nama,
      kompetensi_keahlian,
      asal_sekolah,
      npsn_sekolah,
      alamat,
      rt,
      rw,
      kelurahan,
      kecamatan,
      kota,
      no_hp,
      nik,
      swa_photo,
      photo_fakta,
      tgl_daftar_ulang,
      kondisi,
      no_pendaftaran
       from daftar_ulang where nik='$nik'");
      while ($d = mysqli_fetch_array($data)) {
          include('tampil.php'); ?>

    </table><br>
    <?php
      } ?>

      </div>
    </div>
</div>
</div>

  </body>
</html>
