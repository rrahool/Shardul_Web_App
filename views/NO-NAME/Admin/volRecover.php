<?php
require_once "../../../vendor/autoload.php";
$objTrash = new\App\WareHouse\VolunteerStore();
$objTrash->setdata($_REQUEST);
$objTrash->recover();