<!DOCTYPE html>
<html lang="en">

<head>
  <title>Calon Siswa sudah Mendaftar</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="../../js/jquery-latest.js"></script>
  <script type="text/javascript" src="../../js/jquery.tablesorter.min.js"></script>
  <script type="text/javascript" src="../0-chartjs/Chart.js"></script>

</head>

<body>



  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <center><img style="margin-top: 25px;" src="../../images/logo-banten.png" />
      </div>
      <div class="col-md-6">
        <center>
          <h2 style="margin-top:  25px;"><b>SMK Negeri 1 Kragilan</b></h2>
        </center>
        <center>
          <h4><b>Daftar Calon Peserta Didik yang sudah bisa Seleksi Administrasi</b></h4>
        </center>
        <center>
          <h5><b>Tahun Pelajaran 2020/2021</b></h4>
        </center>
        <center>
          <h4><b>Program Studi Otomatisasi Tata Kelola Perkantoran</b></h4>
        </center><br>
        <!-- font ganti jenis -->
      </div>
      <div class="col-md-3">
        <center><img style="margin-bottom:  80px; margin-top:  25px;" class="img-fluid" alt="Bootstrap Image Preview" src="../../images/logo-smkn1.png" />
      </div>
    </div>

    <!-- <div style="position: relative; height:80vh; width:80vw; margin: auto;">
      <canvas id="myChart"></canvas>
    </div> -->

    <!-- <div style="height: 500px !important; margin:auto; ">
        <canvas width="600" height="250" id="myChart"></canvas>
    </div> -->

    <div style="width: 800px;margin: 0px auto;">
	<canvas id="myChart"></canvas>
</div>

    <div class='alert alert-danger' role='alert'>
      <center>Maaf jika nama pendaftar belum muncul tolong di cek kembali 1 sampai 2 hari :)
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Cari Peserta Calon Peserta Didik :</label>
      <div class="col-sm-3">
        <input type='text' class="form-control" id='input' onkeyup='searchTable()'>
      </div>


    </div>

    <table class="table table-bordered table-hover" id="domainsTable">
      <thead>
        <tr>
          <th>
            <center>No
          </th>
          <th>
            <center>Nomor Pendaftaran
          </th>
          <th>
            <center>Seleksi Administrasi
          </th>
          <th>
            <center>NISN Siswa
          </th>
          <th>
            <center>Nama Siswa
          </th>
          <th>
            <center>Asal Sekolah
          </th>
          <!-- Data di buka bos :) -->
          <!-- <th>
            <center>Lolos Seleksi
          </th> -->
        </tr>
      </thead>
      <tbody>
        <?php
      include '../../koneksi.php';
      $halperpage = 500;
      $page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
      $mulai = ($page>1) ? ($page * $halperpage) - $halperpage : 0;
      $result = mysqli_query($koneksi, "SELECT no_p,tgl_pendaftaran,nisn,nama_siswa,kompetensi_keahlian,asal_sekolah,kondisi,id
         FROM f_siswa_otkp");
      $total = mysqli_num_rows($result);
      $pages = ceil($total/$halperpage);

      $data = mysqli_query($koneksi, "SELECT no_p,tgl_pendaftaran,nisn,nama_siswa,kompetensi_keahlian,asal_sekolah,kondisi,id
        from f_siswa_otkp where kompetensi_keahlian in ('Otomatisasi dan Tata kelola Perkantoran') LIMIT $mulai, $halperpage ");
      $no = $mulai+1;


      while ($d = mysqli_fetch_array($data)) {
          ?>

        <tr>
          <td>
            <center><?php echo $no++ ?>
          </td>
          <td>
            <center><?php echo $d['no_p']; ?>
          </td>
          <td>
            <center><?php echo $d['tgl_pendaftaran']; ?>
          </td>
          <td>
            <center><?php echo $d['nisn']; ?>
          </td>
          <td>
            <center><?php echo $d['nama_siswa']; ?>
          </td>
          <td>
            <center><?php echo $d['asal_sekolah']; ?>
          </td>
          <!-- Data di buka bos :) -->
          <!-- <td>
            <center><?php echo $d['kondisi']; ?>
          </td> -->
        </tr>

        <?php
      } ?>
      </tbody>
    </table>
    <div>
      <?php for ($i=1; $i<=$pages ; $i++) {
          ?>
      <a class="btn btn-info btn-md" href="?halaman=<?php echo $i; ?>"><?php echo $i; ?></a>
      <?php
      } // database

  ?>
    </div>
  </div>
  <script>
    $(document).ready(function() {
      $("#domainsTable").tablesorter({
        sortList: [
          [3, 1],
          [2, 0]
        ]
      });
    });

    function searchTable() {
      var input;
      var saring;
      var status;
      var tbody;
      var tr;
      var td;
      var i;
      var j;
      input = document.getElementById("input");
      saring = input.value.toUpperCase();
      tbody = document.getElementsByTagName("tbody")[0];;
      tr = tbody.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td");
        for (j = 0; j < td.length; j++) {
          if (td[j].innerHTML.toUpperCase().indexOf(saring) > -1) {
            status = true;
          }
        }
        if (status) {
          tr[i].style.display = "";
          status = false;
        } else {
          tr[i].style.display = "none";
        }
      }
    }

    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ["Siswa Bisa Seleksi",
        "Siswa Belum Seleksi",
        "Siswa Sudah Seleksi",
        "Data Sudah Diperikasa",
        "Data Belum Diperiksa"],
        datasets: [{
          label: '',
          data: [
          <?php
          //seluruh siswa
          $diagram_semua = mysqli_query($koneksi, "SELECT tgl_pendaftaran FROM f_siswa_otkp ");
          echo mysqli_num_rows($diagram_semua);
          ?>,
          <?php
          //siswa belum seleksi
          $diagram_blm = mysqli_query($koneksi, "SELECT tgl_pendaftaran FROM f_siswa_otkp WHERE tgl_pendaftaran = ''");
          echo mysqli_num_rows($diagram_blm);
          ?>,
          <?php
          //sudah seleksi
          $diagram_semua_cek = mysqli_num_rows($diagram_semua);
          $diagram_blm_cek = mysqli_num_rows($diagram_blm);
          $sudah_seleksi = $diagram_semua_cek - $diagram_blm_cek;
          echo $diagram_semua_cek - $diagram_blm_cek;
          ?>,
          <?php
          //siswa sudah seleksi
          $diagram_periksa = mysqli_query($koneksi, "SELECT tgl_pendaftaran FROM f_siswa_otkp WHERE kondisi = ''");
          echo mysqli_num_rows($diagram_periksa);
          ?>,
          <?php
          $diagram_periksa_cek = mysqli_num_rows($diagram_periksa);
          // $akl_semua_cek = mysqli_num_rows($akl_semua);
          echo $sudah_seleksi - $diagram_periksa_cek;
          ?>
          ],
          backgroundColor: [
          'rgba(0, 101, 153, 1.00)',
          'rgba(125, 106, 172, 1.00)',
          'rgba(133, 198, 202, 1.00)',
          'rgba(255, 127, 66, 1.00)',
          'rgba(248, 161, 28, 1.00)',
          'rgba(73, 179, 165, 1.00)',
          ],
          borderColor: [
            'rgba(0, 101, 153, 1.00)',
            'rgba(125, 106, 172, 1.00)',
            'rgba(133, 198, 202, 1.00)',
            'rgba(255, 127, 66, 1.00)',
            'rgba(248, 161, 28, 1.00)',
            'rgba(73, 179, 165, 1.00)',
          ],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero:true
            }
          }]
        }
      }
    });
  </script>
</body>

</html>
