<?php
	if(!isset($_SESSION)) session_start();
	
	$cse_database['hostname'] = 'localhost';
	$cse_database['username'] = 'root';
	$cse_database['password'] = '';
	$cse_database['database'] = 'cse_download';
	
	$cse_admin['username'] = 'cse_admin';
	$cse_admin['password'] = 'cse';
	
	$cse_filehash = 'csefile_';
	
	$cse_connection = mysqli_connect($cse_database['hostname'],$cse_database['username'],$cse_database['password']) or die(0);
	mysqli_select_db($cse_connection,$cse_database['database']) or die(0);
?>