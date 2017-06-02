<?php
namespace App\BloodDonor;
use App\Model\Database as DB;

class Blood_Donor extends DB
{

    public $id;
    public $userID;
    public $userName;
    public $bloodGroup;
    public $phone;
    public $lastDonateDate;
    public $prefarebleTime;
    public $zone;
    public $gender;
    public $BlooduserID;
    public $bloodDonorpp;
    public $UpdatedLastDonateDate;

    public function setdata($data = array())
    {
        if (array_key_exists('id',$data)){
            $this->id = $data['id'];
        }
        if (array_key_exists('BlooduserID',$data)){
            $this->BlooduserID = $data['BlooduserID'];
        }
        if (array_key_exists('userID',$data)){
            $this->userID = $data['userID'];
        }
        if (array_key_exists('Bloodgroup',$data)){
            $this->bloodGroup = $data['Bloodgroup'];
        }
        if (array_key_exists('Zone',$data)){
            $this->zone = $data['Zone'];
        }

        if (array_key_exists('userName',$data)){
            $this->userName = $data['userName'];
        }

        if (array_key_exists('PreferableTime',$data)){
            $this->prefarebleTime = $data['PreferableTime'];
        }

        if (array_key_exists('LastDonateDate',$data)){
            $this->lastDonateDate = $data['LastDonateDate'];
        }
        if (array_key_exists('gender',$data)){
            $this->gender = $data['gender'];
        }

        if (array_key_exists('phone',$data)){
            $this->phone = $data['phone'];
        }
        if (array_key_exists('blood_donor_pp',$data)){
            $this->bloodDonorpp = $data['blood_donor_pp'];
        }
        if (array_key_exists('update-donate-date',$data)){
            $this->UpdatedLastDonateDate = $data['update-donate-date'];
        }
    }

    public function setUserId($data){
        $this->BlooduserID = $data;
    }

}