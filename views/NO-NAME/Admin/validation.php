<?php
require_once ('../../../vendor/autoload.php');

use App\User\User;
use App\User\Auth;
use App\Message\Message;
use App\Utility\Utility;
use App\WareHouse\Authentication;

$auth= new Authentication();
$auth->setData($_POST);



$status2=$auth->is_AdminEmailavailble();
$status3 = $auth->is_AdminName_available();


if($status2){
    echo "available";
}
else{

    echo "not available";

}