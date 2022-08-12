<?php 
	if(isset($_POST["id"])) {
		$id = intval($_POST["id"]);
		echo "ID: $id<br />";
		echo "MD5: ".md5("csefile_".$id);
	}
?>

<form method="POST" action="cse_downloadmd5.php">
	<input type="text" name="id" />
	<input type="submit" value="Create!" />
</form>