<?php
/**
 * Created by PhpStorm.
 * User: SFT
 * Date: 10-Mar-17
 * Time: 9:50 PM
 */

namespace App\WareHouse;
use App\Model\Database as dbh;
use PDO;
class counter extends dbh
{
    public function userCount(){
        $query = "SELECT * FROM user WHERE softDelete ='No'";
        $STH=$this->dbh->query($query);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        $count = $STH->rowCount();
        return $count;
    }

    public function NewuserCount(){
        $query = "SELECT * FROM user WHERE softDelete ='Yes'";
        $STH=$this->dbh->query($query);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        $count = $STH->rowCount();
        return $count;
    }

    public function donorCount(){
        $query = "SELECT * FROM user WHERE role ='BloodDonor'";
        $STH=$this->dbh->query($query);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        $count = $STH->rowCount();
        return $count;
    }

    public function volunteerCount(){
        $query = "SELECT * FROM user WHERE role ='Volunteer'";
        $STH=$this->dbh->query($query);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        $count = $STH->rowCount();
        return $count;
    }
}