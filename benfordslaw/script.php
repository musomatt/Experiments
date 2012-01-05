<?php

$fhandle = fopen('data.txt', 'r');
$fhandle2 = fopen('data2.txt', 'w');

while($row = fgets($fhandle)){
	
	$space = strpos($row, "\t");
	$new_row = substr($row, 0, $space) . "\n";
	
	fwrite($fhandle2, $new_row); 
	
}

fclose($fhandle);
fclose($fhandle2);

?>
