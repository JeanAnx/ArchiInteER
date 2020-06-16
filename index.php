<?php 

session_start();

if (isset($_SERVER['PATH_INFO'])) {
  // $path = str_replace('/', '\\', $_SERVER['PATH_INFO']);
  $path = $_SERVER['PATH_INFO'];
}

$to_root = '';
  // require 'view/headerView.phtml';

  if (isset($path) && !empty($path)) {
  if ($path != '\\') {
    if(is_file(__DIR__ . '\\' . 'controller'. $path .'Controller.php')) {

      // PROD if ($path != '/') {
      // PROD   if(is_file(__DIR__ . '/' . 'controller'. $path .'Controller.php')) {
      $to_root = ('../');
      require 'view/headerView.phtml';
      require_once 'controller'. $path .'Controller.php';
    } else {
    } 
  }
}
else
{
  require 'model/db.php';
  
  require 'view/headerView.phtml';
  require_once 'controller/homeController.php';
}
require 'view/footerView.phtml';
/*

if (isset($_GET['p']) && !empty($_GET['p']) && is_file('controller/'.$_GET['p'].'Controller.php'))
{
        require_once 'controller/'.$_GET['p'].'Controller.php';
}
else
{
        require_once 'controller/homeController.php';
}
require 'view/footerView.phtml';
*/