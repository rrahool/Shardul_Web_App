<?php
require_once "../../../../vendor/autoload.php";
use App\WareHouse\UserStore;
$objUserStore =new UserStore();
$objUserStore->setdata($_POST);
$objUserStore->update();
?>