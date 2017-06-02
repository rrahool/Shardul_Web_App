<?php
require_once ('../../../vendor/autoload.php');
use App\WareHouse;
$objAdminadd = new WareHouse\AdminStore();
$objAdminadd ->setData($_REQUEST);
$objAdminadd->Activateadmin();