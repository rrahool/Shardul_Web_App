<?php
require_once "../../../vendor/autoload.php";
$objDel = new\App\WareHouse\VolunteerStore();
$objDel->setdata($_REQUEST);
$objDel->Delete();