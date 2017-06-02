<?php
require_once "../../../vendor/autoload.php";
$objDel = new\App\WareHouse\BloodStore();
$objDel->setdata($_REQUEST);
$objDel->Delete();