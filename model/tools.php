<?php 

function dump($variable) {
	return '<pre>' . var_dump($variable) . '</pre>';
}

function cleanArray($array) {
	$i = 0;
	foreach ($array as $row) {

		if ($row == " " || $row == "") {
			unset($array[$i]);
		}
		$i++;
	}

	$string = implode(',' , $array);
	$string = ltrim($string , ",");
	$cleanArray = explode(',' , $string);

	return $cleanArray ;
}


