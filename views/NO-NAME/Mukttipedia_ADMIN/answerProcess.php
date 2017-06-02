<?php
require_once("../../../vendor/autoload.php");
use App\WareHouse\MuktipideaStore;

$objMuktipideaQuestion = new MuktipideaStore();
$objMuktipideaQuestion->setdata($_POST);
$objMuktipideaQuestion->set_answer();