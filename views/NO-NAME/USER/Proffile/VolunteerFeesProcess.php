<?php
require_once ('../../../../vendor/autoload.php');
use App\Utility\Utility;
use App\WareHouse\VolunteerFeesStore;

$objVolunteerFees = new VolunteerFeesStore();
$objVolunteerFees->setData($_POST);
$objVolunteerFees->VolunteerFeesStore();