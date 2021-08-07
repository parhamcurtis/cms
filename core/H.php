<?php 
namespace Core;

class H {

    public static function dnd($data=[], $die = true){
        echo "<pre>";
        var_dump($data);
        echo "</pre>";
        if($die) {
            die;
        }
    }
    
}