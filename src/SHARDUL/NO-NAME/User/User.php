<?php

namespace App\User;



use App\Message\Message;
use App\Utility\Utility;
use PDO;
use PDOException;
use App\Model\Database as DB;

class User extends DB
{
    public $firstName = "";
    public $lastName = "";
    public $email = "";
    public $username = "";
    public $password = "";
    public $birthdate = "";
    public $phone = "";
    public $address = "";
    public $role = "";
    public $id ="";


    public function setData($data = array())
    {
        if (array_key_exists('userID', $data)) {
            $this->id = $data['userID'];
        }
        if (array_key_exists('FirstName', $data)) {
            $this->firstName = $data['FirstName'];
        }

        if (array_key_exists('FirstName', $data)) {
            $this->firstName = $data['FirstName'];
        }

        if (array_key_exists('LastName', $data)) {
            $this->lastName = $data['LastName'];
        }

        if (array_key_exists('Email', $data)) {
            $this->email = $data['Email'];
        }

        if (array_key_exists('UserName', $data)) {
            $this->username = $data['UserName'];
        }

        if (array_key_exists('Password', $data)) {
            $this->password = $data['Password'];
        }

        if (array_key_exists('BirthDate', $data)) {
            $this->birthdate = $data['BirthDate'];
        }

        if (array_key_exists('PhoneNumber', $data)) {
            $this->phone = $data['PhoneNumber'];
        }

        if (array_key_exists('Volunteer', $data)) {
            $this->Role = $data['Volunteer'];
        }

        if (array_key_exists('BloodDonor', $data)) {
            $this->Role = $data['BloodDonor'];
        }

        if (array_key_exists('ADDRSS', $data)) {
            $this->address = $data['ADDRSS'];
        }
        if (array_key_exists('role', $data)) {
            $this->role = $data['role'];
        }

    }
    public function setEmail($email){
        $this->email = $email;
    }


}


