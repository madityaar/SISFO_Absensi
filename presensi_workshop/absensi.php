<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gift_quantity";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}

$nik=$_POST["nik_1"];


$sql_find = "SELECT * FROM absen WHERE NIK='".$nik."' AND tanggal=CURDATE()";
if ($conn->query($sql_find)->num_rows > 0 ) {
   //update jam keluar
   $result=mysqli_query($conn,$sql_find);
   $row=mysqli_fetch_array($result,MYSQLI_NUM);

   if($conn->query($sql_find)->num_rows > 0){
     $timestamp = date("H:i:s");
     $sql_update = "UPDATE jam SET jamKeluar=CURTIME() WHERE idjam=".$row[2];
     $conn->query($sql_update);
   }


} else {
  //insert table jam jam masuk & insert table absen
   $sql_insert = "INSERT INTO jam (jamMasuk) VALUES (CURTIME())";
   if ($conn->query($sql_insert) === TRUE){
      $last_id= mysqli_insert_id($conn);
      $sql_insert = "INSERT INTO absen (NIK, idJam, tanggal) VALUES ('".$nik."', ".$last_id. ", CURDATE())";
      $conn->query($sql_insert);
   }
}

$conn->close();

header("Location: index.php");
die();
?>
