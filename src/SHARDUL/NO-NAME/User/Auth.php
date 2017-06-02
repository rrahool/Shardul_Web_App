<?php

namespace App\User;
use App\Model\Database as DB;
use App\Message\Message;
use App\Utility\Utility;
use PDOException;
use PDO;

class  Auth extends DB
{
    public $email = "";
    public $password = "";
    public $userName="";
    public $nid="";

    public function setData($data = Array()){

        if (array_key_exists('Email', $data)) {
            $this->email = $data['Email'];
        }
        if (array_key_exists('userName', $data)) {
            $this->userName = $data['userName'];
        }
        if (array_key_exists('Password', $data)) {
            $this->password = $data['Password'];
        }
        if (array_key_exists('UserName',$data)) {
            $this->userName = $data['UserName'];
        }
        if (array_key_exists('nid',$data)) {
            $this->nid = $data['nid'];
        }

        return $this;
    }
}