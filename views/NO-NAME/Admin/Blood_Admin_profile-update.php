<?php
require_once "../../../vendor/autoload.php";
use App\WareHouse\AdminStore;
$objUserStore =new AdminStore();
$objUserStore->setdata($_POST);
$objUserStore->UpdateAdmin();
?>