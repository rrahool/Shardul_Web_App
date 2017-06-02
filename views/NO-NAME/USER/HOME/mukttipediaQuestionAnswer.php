<?php
require_once("../../../../vendor/autoload.php");
use App\Utility\Utility;
use App\WareHouse\MuktipideaStore;
use App\Message\Message;
use App\WareHouse\Authentication;
$objUserAuth = new Authentication();
$objUserAuth->setData($_REQUEST);
$status = $objUserAuth->is_userName_exist();

if($status){
    $objMuktipideaQuestion = new MuktipideaStore();
    $objMuktipideaQuestion->setdata($_POST);
    $objMuktipideaQuestion->questionAnswer();

}
else{
    if(!isset($_SESSION))session_start();
    Message::setMessage("User Not exits");
    Utility::redirect('MukttiPediaOld.php');
}

/*


*/
?>