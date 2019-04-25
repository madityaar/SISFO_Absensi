<?php
debug_backtrace() || die ("Direct access not permitted");

	$config_sql['host']="localhost";
	$config_sql['user']="root";
	$config_sql['pass']="";
	//
	// $config_sql['db']="presensi_halalbihalal";

	// $config_sql['host']="103.43.45.174";
	// $config_sql['user']="imamhak";
	// $config_sql['pass']="Januari2018!!";

	$config_sql['db']="gift_quantity";

	$mysqli = new mysqli($config_sql['host'],$config_sql['user'],$config_sql['pass'],$config_sql['db']);
	if(mysqli_connect_errno())
	{
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
?>
