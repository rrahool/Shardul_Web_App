<?php
require_once "../../../vendor/autoload.php";
$objDel = new\App\WareHouse\BloodDonorStore();
$objDel->setdata($_REQUEST);
$objDel->bloodMultipleTrash($_POST['mark']);