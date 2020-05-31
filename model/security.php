<?php 

function clean($string) {

  $string = htmlspecialchars($string);
  $string = strip_tags($string);
  $trash = [
    '<a',
    '<script',
    '#file_links['
  ];
  str_replace($trash,"*", $string);

  return $string;
}
