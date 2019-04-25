<?php

  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "gift_quantity";

  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
  }


  $karyawan_masuk = "SELECT * FROM absen WHERE tanggal=CURDATE()";
  $total_karyawan = "SELECT * FROM datapegawai";
  $last_absen = "SELECT * FROM absen WHERE tanggal=CURDATE() ORDER BY idAbsen DESC LIMIT 1";
  $result1=mysqli_query($conn, $karyawan_masuk);
  $result2=mysqli_query($conn, $total_karyawan);
  $result3=mysqli_query($conn, $last_absen);
  $row = mysqli_fetch_array($result3,MYSQLI_NUM);
  $karyawan_terakhir = "SELECT * FROM datapegawai WHERE NIK='".$row[1]."'";
  $result4 = mysqli_query($conn, $karyawan_terakhir);
  if($result4->num_rows > 0){
    $row_karyawan  = mysqli_fetch_array($result4,MYSQLI_NUM);
  }else{
    $row_karyawan[0]='Belum ada';
    $row_karyawan[1]='absen';
  }
  $count_masuk = $result1->num_rows;
  $count_total = $result2->num_rows;



?>
