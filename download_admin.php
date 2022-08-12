<?php
	require_once 'system_source/system_config.php';
	if( isset($_POST["username"],$_POST["password"]) ) {
		if($_POST["username"] == $cse_admin["username"] && $_POST["password"] == $cse_admin["password"]) $_SESSION["cse_logined"] = 1;
	}
	if(@$_SESSION["cse_logined"] == 1) { 
		if(@$_GET["Delete"] == 1 && isset($_GET["File"]) && @$_GET["File"] != "") {
			mysqli_query($cse_connection,"DELETE FROM cse_dosyalar WHERE FileName='".addslashes($_GET["File"])."'") or die(mysqli_error($cse_connection));
		} else if(@$_POST["file_path"] != "" && isset($_POST["file_path"])) {
			if(file_exists(@$_POST["file_path"])) {
				$result = mysqli_query($cse_connection,"SHOW TABLE STATUS LIKE 'table_name'");
				$row = mysqli_fetch_array($result); $file_hash = md5($cse_filehash.$row["Auto_increment"]);
				mysqli_query($cse_connection,"INSERT INTO cse_dosyalar (FileName,FilePath) VALUES ('".$file_hash."','".addslashes($_POST["file_path"])."');") or die(mysqli_error($cse_connection)); 
				echo "<center>Dosya baþarýyla eklendi!<br />Link: <a href='http://dosyalar.cseklenti.com/Indir/".$file_hash."/'>http://dosyalar.cseklenti.com/Indir/".$file_hash."/</a></center>";
			} else { echo "Eklenecek Dosya bulunamadý!"; }
		}
		
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-9">
	<title>Admin - dosyalar.cseklenti.com</title>
</head>
<body style='margin-top:60px;'><center>
<?php 
	if(@$_SESSION["cse_logined"] != 1) {
		echo '<form method="POST" action="download_admin.php"><table border="0"><tr><td>Kullanýcý Adý:</td><td><input type="text" name="username" /></td></tr>
			  <tr><td>Þifre:</td><td><input type="password" name="password" /></td></tr><td colspan="2"><input type="submit" value="Giriþ Yap" style="width:100%;"/></td></tr> </form>';
	} else {
		// Add File
		echo '<table border="1" cellspacing="0" style="min-width:900px;">
		<tr style="text-align:center;"><td colspan=2 style="background:silver;">Dosya Ekle</td></tr>
		<form method="POST" action="download_admin.php">
		<tr><td>Dosya Yolu:</td><td><input type="text" name="file_path" style="width:98%;" /></td></tr>
		<tr><td colspan=2><input type="submit" value="Ekle!" style="width:100%; border:1px solid #000; background-color:lightgreen;"/></td></tr>
		</form>
		</table>';
		
		echo '<br/><br/><br/>';
		
		// File List
		echo '<table border="1" cellspacing="0" style="min-width:900px;">
		<tr style="text-align:center;"><td colspan=5 style="background:silver;">Sunucudaki Dosyalar</td></tr>
		<tr><td>#</td><td>Dosya Yolu</td><td>Dosya URL</td><td>Ýndirme</td><td>Ýþlemler</td></tr>';
		$query = mysqli_query($cse_connection,"SELECT * FROM cse_dosyalar WHERE 1");
		while($query2 = mysqli_fetch_array($query)) {
			echo '<tr><td>'.$query2["FileID"].'</td><td>'.$query2["FilePath"].'</td><td><a href="http://dosyalar.cseklenti.com/Indir/'.$query2['FileName'].'/">http://dosyalar.cseklenti.com/Indir/'.$query2['FileName'].'/</a></td><td>'.$query2["DownloadStat"].'</td><td><a href="http://dosyalar.cseklenti.com/download_admin.php?Delete=1&File='.$query2["FileName"].'">Sil</a></td></tr>';
		}
		
		echo'<tr><td colspan=5 style="text-align:center;background:silver;"> dosyalar.cseklenti.com -- Author: RamazanYigit. </td></tr></table>';
	}
?>
</center></body>
</html>
<?php mysqli_close($cse_connection); ?>
