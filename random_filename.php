<?php 
$prefix = "cse_";
$filename_length=9;

$digits = array(
"a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","y","z","w","x","0","1","2","3","4","5","6","7","8","9","0"
);
$filename = null;
for($i=0; $i < $filename_length; $i++) {
	$filename .= $digits[rand(0,count($digits) - 1)]; 
}

echo "Random Filename: ".$prefix.$filename;
?>