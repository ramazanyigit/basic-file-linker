<?php 
	if(!isset($_GET["File"]) || @$_GET["File"] == "" ) header("Location:http://www.cseklenti.com/");
	require_once('system_source/system_config.php');
	$file_query = mysqli_query($cse_connection,"SELECT FilePath FROM cse_dosyalar WHERE FileName='".addslashes($_GET["File"])."' LIMIT 0,1") or die(0);
	if(mysqli_num_rows($file_query) <= 0) {
		header("Location:http://www.cseklenti.com/");
	} else {
		mysqli_query($cse_connection,"UPDATE cse_dosyalar SET DownloadStat=DownloadStat+1 WHERE FileName='".addslashes($_GET["File"])."'");
		$file_query = mysqli_fetch_array($file_query);
		if(file_exists($file_query["FilePath"])) {
			header("Content-Type: application/octet-stream");
			header("Content-Transfer-Encoding: Binary");
			header('Content-disposition: attachment; filename="'.basename($file_query["FilePath"]).'"'); 
			readfile($file_query["FilePath"]);
		} else {
			echo "Dosya bulunamadý!";
		}
	}
	
?>