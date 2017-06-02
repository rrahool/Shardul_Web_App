<?php
/**
 * Created by PhpStorm.
 * User: Run Forrest Run
 * Date: 3/14/2017
 * Time: 2:46 AM
 */

namespace App\Volunteer;
use App\Model\Database as DB;

class VolunteerFees extends DB
{
    public $VolunteerID;
    public $Amount;
    public $paymentdate;

    public function setdata($allpostdata = null){

        if (array_key_exists('VolunteerID',$allpostdata)){
            $this->VolunteerID = $allpostdata['VolunteerID'];
        }
        if (array_key_exists('amount',$allpostdata)){
            $this->Amount = $allpostdata['amount'];
        }
        if (array_key_exists('paymentdate', $allpostdata)) {
            $this->paymentdate = $allpostdata['paymentdate'];
        }
    }
    public function setVolunteerId($data){
        $this->VolunteerID= $data;
    }
}
