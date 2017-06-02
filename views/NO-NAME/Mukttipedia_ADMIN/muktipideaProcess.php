<?php
require_once("../../../vendor/autoload.php");

use App\WareHouse\MuktipideaStore;
$objMuktipideaStore = new MuktipideaStore();
$objMuktipideaStore->setdata($_POST);
$objMuktipideaStore->store();
?>