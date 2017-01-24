<?php

namespace src\utils;

use \Psr\Http\Message\ServerRequestInterface as Request;

class Authentification 
{
    public static function checkTOKEN(Request $req){
        $Authorization = $req->getHeader('Authorization');
        if(empty($Authorization))
            return false;   
        return substr($Authorization[0],6);
    }
    public static function checkACCESS(Request $req){
        $Authorization = $req->getHeader('Authorization');
        if(empty($Authorization))
            return false;
        $usernamePassword = base64_decode(substr($Authorization[0],6));
        $username = substr($usernamePassword ,0,strpos($usernamePassword, ':'));   
        $password = substr($usernamePassword ,strpos($usernamePassword, ':')+1);
        if($username === "admin" && $password==="pass")
            return true; 
        return false;
    }   
}