<?php

namespace App\Admin;



use App\Message\Message;
use App\Utility\Utility;
use PDO;
use PDOException;
use App\Model\Database as DB;

class Admin extends DB
{
    public $id ="";
    public $fullname = "";
    public $nid = "";
    public $email = "";
    public $username = "";
    public $password = "";
    public $birthdate = "";
    public $phone = "";
    public $address = "";
    public $catagory = "";


    public function setData($data = array())
    {
        if (array_key_exists('id', $data)) {
            $this->id = $data['id'];
        }
        if (array_key_exists('Fullname', $data)) {
            $this->fullname = $data['Fullname'];
        }

        if (array_key_exists('nid', $data)) {
            $this->nid = $data['nid'];
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
            if($this->birthdate==""){
                $this->birthdate ="";
            }else{
                $this->birthdate = date('Y-m-d',strtotime($this->birthdate));
            }
        }

        if (array_key_exists('PhoneNumber', $data)) {
            $this->phone = $data['PhoneNumber'];
        }

        if (array_key_exists('address', $data)) {
            $this->address = $data['address'];
        }

        if (array_key_exists('catagory', $data)) {
            $this->catagory = $data['catagory'];
        }

    }
    public function setEmail($email){
        $this->email = $email;
    }


}


