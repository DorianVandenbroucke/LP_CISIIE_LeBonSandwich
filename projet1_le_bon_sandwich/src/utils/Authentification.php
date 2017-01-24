<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use src\models\Commande;
use \Illuminate\Database\Eloquent\ModelNotFoundException as NotFound;


function response_JSON(Request $req, Response $resp, callable $next){
    $resp = $resp->withHeader("Content-type", "application/json, charset=utf-8");
    return $next($req, $resp);
}

function checkTOKEN(Request $req, Response $resp, callable $next){
        
        $id = $req->getAttribute('route')->getArgument('id');
        $Authorization = $req->getHeader('Authorization');

        if(empty($Authorization)){
            $resp = $resp->withStatus(403);
            $resp->getBody()->write(json_encode(['error'=>'no token']));
            $resp = $resp->withHeader("Content-type", "application/json, charset=utf-8");
            return $resp;
        }

        $token = substr($Authorization[0],6);

        try
        {
            Commande::where('id','=',$id)->where('token','=',$token)->firstOrfail()->toJson();
        }
        catch(NotFound $e)
        {
            $resp = $resp->withStatus(403);
            $resp->getBody()->write(json_encode(['error'=>'invalid token']));
            $resp = $resp->withHeader("Content-type", "application/json, charset=utf-8");
            return $resp;
        }

        $resp = $next($req, $resp);
        return $resp;
}


function checkACCESS(Request $req, Response $resp, callable $next){
    
    $Authorization = $req->getHeader('Authorization');

    if(empty($Authorization)){
        $resp = $resp->withStatus(403);
        $resp->getBody()->write(json_encode(['error'=>'no username or password']));
        $resp = $resp->withHeader("Content-type", "application/json, charset=utf-8");
        return $resp;
    }

    $usernamePassword = base64_decode(substr($Authorization[0],6));
    $username = substr($usernamePassword ,0,strpos($usernamePassword, ':'));   
    $password = substr($usernamePassword ,strpos($usernamePassword, ':')+1);

    if($username === "admin" && $password === "pass")
        return $next($req, $resp); 

    $resp = $resp->withStatus(403);
    $resp->getBody()->write(json_encode(['error'=>'access dined']));
    $resp = $resp->withHeader("Content-type", "application/json, charset=utf-8");
    return $resp;
}   
