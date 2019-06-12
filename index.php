<?php 

session_start();

require 'view/headerView.phtml';

if (isset($_GET['p']) && !empty($_GET['p']) && is_file('controller/'.$_GET['p'].'Controller.php'))
{
        require_once 'controller/'.$_GET['p'].'Controller.php';
}
else
{
        require_once 'controller/homeController.php';
}
require 'view/footerView.phtml';
