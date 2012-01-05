<?php

/**
 * This script is intended to be run on the command line and 
 * simply takes a list of numbers (in this case data.txt - country
 * populations) and finds out the first-digit distribution.
 * 
 * It then compares it to Benford's law and outputs on the 
 * command line. Benford's law would be easier to see if it's plotted 
 * as a graph but for the moment, it's plotted as a chart on the CLI.
 * 
 * A set of numbers is said to satisfy Benford's law if the leading 
 * digit (d) occurs with a similar probability to log10(1+1/d).
 * 
 * Used for things like fraud detection :)
 * 
 */

// Benford's Law (http://en.wikipedia.org/wiki/Benford's_law)
function benford($num){
	 return log10(1+1/$num);
}

$dist = Array();
$dist_total = 0;
$fhandle = fopen('data.txt', 'r');

while($row = fgets($fhandle)){
	
	$first_digit = (string) substr($row, 0, 1);
	
	if (array_key_exists($first_digit, $dist)){
		$dist[$first_digit]++;
	} else {
		$dist[$first_digit] = 1;
	}
	
	$dist_total++;
	
}

ksort($dist);

print "# | Dist  | Benford" . PHP_EOL;

foreach($dist as $digit => $count){
	print "$digit | " . number_format(($count / $dist_total), 3) . " | " . number_format(benford($digit), 3) . PHP_EOL;
}

print "\n\nFor more information: http://en.wikipedia.org/wiki/Benford's_law or www.benfords-law.com\n\n";

?>
