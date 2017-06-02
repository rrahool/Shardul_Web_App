<?php
require_once "../../../../vendor/autoload.php";
use App\WareHouse\VolunteerStore;
$objVolunteerStore = new VolunteerStore();
$objVolunteerStore->setdata($_POST);
$objVolunteerStore->store();
?>