<?php
require_once "../../../vendor/autoload.php";
$objUpdate = new App\WareHouse\BloodStore();
$objUpdate->setdata($_REQUEST);
$objUpdate->update();