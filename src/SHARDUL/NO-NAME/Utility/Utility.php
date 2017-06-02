<?php
namespace App\Utility;

class Utility{

    public static function redirect($data){
        header('Location:'.$data);
    }

    public function dd($data){
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        die;
    }

}