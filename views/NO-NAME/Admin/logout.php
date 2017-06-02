<?php
require_once ('../../../vendor/autoload.php');
use App\WareHouse\Authentication;
use App\Utility\Utility;
$objAdminLogout = new Authentication();
$objAdminLogout->Admin_log_out();