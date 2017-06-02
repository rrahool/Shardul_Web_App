<?php
require_once "../../../vendor/autoload.php";
$objTrash = new\App\WareHouse\BloodDonorStore();
$objTrash->setdata($_REQUEST);
$objTrash->recover();