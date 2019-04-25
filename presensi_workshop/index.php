<?php
session_start();
require_once("db.config.php");
include("initialize.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>

	<title>Absensi</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="autocomplete/jquery-autocomplete.css">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
	<style>
		body{
			/* background-image:url('https://ideasphere.com/wp-content/uploads/2016/08/Savin-NY-Website-Background-Web-1-1024x576.jpg'); */
			background-image:url('images/bg.jpg');
			background-color:#f1f1f1;
			background-repeat:no-repeat;
			background-size:cover;
			background-position: center center;
		}
		.container-login100{
			background:none;
		}
	</style>
</head>
<body onload="startTime()">

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100" id="custom-search-input">
				<form class="login100-form validate-form p-l-55 p-r-55 p-t-178" action="absensi.php" method="post">
					<span class="login100-form-title">
						ABSENSI
					</span>

					<div class="wrap-input100 validate-input m-b-16" data-validate="Please enter NIK or Fullname" id="removeData">

							<input class="input100" type="text" placeholder="NIK ..." id="search" name="nik_1">
							<input type="hidden" id="nik" name="nik" />
							<input type="submit" class="btn btn-default" value="Submit" style="margin:10px 80%">

						<!-- <span class="focus-input100"></span> -->
					</div>

					<!-- <div class="wrap-input100 validate-input" data-validate = "Please enter password">
						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100"></span>
					</div> -->

					<!-- <div class="text-right p-t-13 p-b-23">
						<span class="txt1">
							Forgot
						</span>

						<a href="#" class="txt2">
							Username / Password?
						</a>
					</div> -->

					<!-- <div class="container-login100-form-btn">
						<button class="login100-form-btn">
							JOIN !
						</button>
					</div> -->

					<!-- <div class="flex-col-c p-t-170 p-b-40">
						<div class="col-md-6 col-md-offset-3" id="result"></div>
					</div> -->

					<div class="container-login100-form-btn">
						<div id="result"></div>
					</div>



					<!-- <div class="flex-col-c p-t-170 p-b-40"> -->
					<div class="flex-col-c p-t-0 p-b-40">
						<span class="txt1 p-b-9">
							<div id="txt"></div>
						</span>

						<a data-toggle="modal" data-target="#myModal" class="txt3" onclick="getAllPeserta();">
							PT. Sudatama
						</a>
					</div>

					<div id="myModal" class="modal fade" role="dialog">
						<div class="modal-dialog">
							<!-- konten modal-->
							<div class="modal-content">
								<!-- heading modal -->
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Log Attendance</h4>
								</div>
								<!-- body modal -->
								<div class="modal-body" style="
                          overflow-y: scroll;
                          display: block;
                          clear: both;
                          width: 100%;
                          max-height:580px;">
									<div style="overflow: hidden;
														  overflow-x: auto;
															display: block;
														  clear: both;
														  width: 100%;">
										<table id="logTable" style="table-layout: fixed; width: 100%;">
											<tr>
												<th style="font-size:1em; width: 10%;">No</th>
												<th style="font-size:1em; width: 50%;">Name</th>
												<th style="font-size:1em; width: 50%;">Attendance Time</th>
											</tr>
										</table>
									</div>
								</div>
								<!-- footer modal -->
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>

				</form>
			</div>
			<div class="lastabsen">
				<span style="font-size:20px;COLOR:White;background-color: #E53935;padding:0px 20px" > ABSEN TERAKHIR PEGAWAI </span>
				<span style="font-size:20px;COLOR:BLACK;background-color: WHITE;font-family:Ubuntu-Bold;"><?php echo $row_karyawan[0]."  ".$row_karyawan[1] ?></span>
			</div>
			<div class="attendant">
				<div class="susunanbox">
					<span class="teksdiatasbox">KARYAWAN MASUK</span>
					<div class="box_masuk boxsama"><?php echo $count_masuk; ?></div>

				</div>
				<span style="font-size:25px;COLOR:BLACK;background-color: WHITE; padding:5px;border-radius: 5px;">DARI</span>
				<div class="susunanbox">
					<span class="teksdiatasbox">TOTAL KARYAWAN</span>
					<div class="box_keluar boxsama"><?php echo $count_total; ?></div>
				</div>
			</div>
		</div>
	</div>


<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->

	<script src="js/main.js"></script>
	<script src="autocomplete/jquery-autocomplete.js"></script>
	<script type="text/javascript">
	function startTime() {
		var today = new Date();
		var h = today.getHours();
		var m = today.getMinutes();
		var s = today.getSeconds();
		var date_t = today.getDate()+'-'+(today.getMonth()+1)+'-'+ today.getFullYear();
		m = checkTime(m);
		s = checkTime(s);
		document.getElementById('txt').innerHTML =
		h + ":" + m + ":" + s + " | " + date_t;
		var t = setTimeout(startTime, 500);
	}
	function checkTime(i) {
		if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
	return i;
}
	</script>
</body>
</html>
