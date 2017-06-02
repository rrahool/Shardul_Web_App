<?php
namespace App\Volunteer;

use \App\Model\Database as DB;

class Volunteer extends DB
{
 public $id;
 public $userID;
 public $highestEducation;
 public $passingYear;
 public $roll;
 public $phone;
 public $userName;
 public $email;
 public $password;
 public $volunteer_pp;
 public $Volunteer_ID;

     public function setdata($allpostdata = null){


         if (array_key_exists('id',$allpostdata)){
             $this->id = $allpostdata['id'];
         }
         if (array_key_exists('userName',$allpostdata)){
             $this->userName = $allpostdata['userName'];
         }
         if (array_key_exists('userID',$allpostdata)){
             $this->userID = $allpostdata['userID'];
         }
         if (array_key_exists('highestEducation',$allpostdata)){
             $this->highestEducation = $allpostdata['highestEducation'];
         }
         if (array_key_exists('passingYear',$allpostdata)){
             $this->passingYear = $allpostdata['passingYear'];
         }
		 if (array_key_exists('roll',$allpostdata)){
             $this->roll = $allpostdata['roll'];
         }
         if (array_key_exists('phone',$allpostdata)){
             $this->phone = $allpostdata['phone'];
         }
         if (array_key_exists('Password',$allpostdata)){
             $this->password = $allpostdata['Password'];
         }
         if (array_key_exists('Email',$allpostdata)){
             $this->email = $allpostdata['Email'];
         }
         if (array_key_exists('volunteer_pp',$allpostdata)){
             $this->volunteer_pp = $allpostdata['volunteer_pp'];
         }
         if (array_key_exists('Volunteer_ID',$allpostdata)){
             $this->Volunteer_ID = $allpostdata['Volunteer_ID'];
         }
     }

    public function setUserId($data){
        $this->userID = $data;
    }
}