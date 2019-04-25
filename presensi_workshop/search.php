<?php
  require_once("db.config.php");
  $tb = 'tamu_undangan';
  if(isset($_GET['q'])) {
     $json = [];
      if(!empty($_GET['q'])){
        $q = $mysqli->real_escape_string($_GET['q']);
        $str = "SELECT * FROM $tb WHERE nik LIKE '%$q%' OR nama LIKE '$q%'";
        $qry = $mysqli->query($str);
        //var_dump($qry);
        if($qry->num_rows >= 1){
          while ($row = $qry->fetch_assoc()) {
            $json[] = $row;
          }
        }
      }
      echo json_encode($json);
  }

  elseif(isset($_GET['nik'])) {
     $json = [];
      if(!empty($_GET['nik'])){
        $q = $mysqli->real_escape_string($_GET['nik']);
        $str = "SELECT * FROM $tb WHERE nik='$q'";
        $qry = $mysqli->query($str);
        //var_dump($qry);
        if($qry->num_rows >= 1){
          while ($row = $qry->fetch_assoc()) {
            $json[] = $row;
          }
        }
      }
      echo json_encode($json);
  }

  elseif(isset($_POST['do'])) {
     $json = [];
      if(!empty($_POST['do'])){
        $do = $_POST['do'];
        if ($do){
          $str = "SELECT tamu_undangan.nama, log_kehadiran.created_date FROM tamu_undangan INNER JOIN log_kehadiran ON tamu_undangan.nik=log_kehadiran.nik ORDER BY tamu_undangan.nama ASC";
          $qry = $mysqli->query($str);
          //var_dump($qry);
          if($qry->num_rows >= 1){
            while ($row = $qry->fetch_assoc()) {
              $json[] = $row;
            }
          }
        }
      }
      echo json_encode($json);
  }
