<?php 

session_start();

require_once 'view/headerView.phtml';

if (!empty($_GET['p']) && is_file('controller/'.$_GET['p'].'Controller.php'))
{
        include 'controller/'.$_GET['p'].'Controller.php';
}
else
{
        include 'controller/homeController.php';
}
require_once 'view/footerView.phtml';

/*
if ($_SERVER['QUERY_STRING'] != '' && is_file('controller/'.$_SERVER['QUERY_STRING'].'Controller.php'))
{
        include 'controller/'.$_SERVER['QUERY_STRING'].'Controller.php';

        } else {
                include 'controller/homeController.php';
        }
require_once 'view/footerView.phtml';
*/