<?php
  require_once("db.config.php");
  date_default_timezone_set('Asia/Jakarta');
  $tb = 'tamu_undangan';
  if (isset($_GET['nik'])) {
      $json = [];
      if (!empty($_GET['nik'])) {
          $q = $mysqli->real_escape_string($_GET['nik']);
          $str = "SELECT * FROM $tb WHERE nik='$q'";
          $qry = $mysqli->query($str);
          //var_dump($qry);
          if ($qry->num_rows == 1) {
              $row = $qry->fetch_object();
              $nik = $row->nik;
              $name = $row->nama;
              $level = $row->group;

              $str2 = "INSERT INTO peserta_undian (nik, nama) VALUES ('$nik','$name')";
              $qry2 = $mysqli->query($str2);
              // echo "<script>alert($mysqli->affected_rows);</script>";
              if ($mysqli->affected_rows == 1) {
                  $today = date('Y-m-d H:i:s');
                  $str1 = "UPDATE tamu_undangan SET status='1' WHERE nik='$nik'";
                  $qry1 = $mysqli->query($str1);
                  $str3 = "INSERT INTO log_kehadiran (nik,created_date) VALUES ('$nik','$today')";
                  $qry3 = $mysqli->query($str3);
                  echo "<script>alert('Welcome to Workshop Double Jawara Digital Telkomsel Area Jabotabek Jabar 2018');</script>";
              } else {
                  echo "<script>alert('Welcome back, you are already in');</script>";
                  $today = date('Y-m-d H:i:s');
                  $str = "UPDATE peserta_undian SET iswinner='0', winnerdate='$today'";
                  $qry = $mysqli->query($str);
              }
          } else {
              echo "<script>alert('You are not invited');</script>";
          }
      }
      echo '<meta http-equiv="refresh" content="0;url=index.php" />';
  }
