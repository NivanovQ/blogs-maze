<?php
/**
 * Created by PhpStorm.
 * User: Krasi_PC
 * Date: 17.7.2017 г.
 * Time: 7:54
 */

namespace controller;


use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


abstract class AbstractController {


    protected static function writeJsonToResponse(Response $response, $json, $msg = null, $language_id = null ){
        $obj = new \stdClass();
        $obj->message = $msg;
        $obj->data = $json;
        $obj->has_error = false;
        $response->getBody()->write(json_encode($obj, JSON_UNESCAPED_SLASHES));
    }

    protected static function readJsonFromRequest(Request $request){
        if($request->isGet()){
            throw new \Exception("Json cannot be read from GET request");
        }
        $json = json_decode($request->getBody(), true);
        if(json_last_error() !== JSON_ERROR_NONE){
            $cause = "Json syntax error";
            switch (json_last_error()){
                case JSON_ERROR_STATE_MISMATCH : $cause = "Invalid or malformed JSON"; break;
                case JSON_ERROR_SYNTAX : $cause = "Syntax error"; break;
                case JSON_ERROR_UTF8 : $cause = "Malformed UTF-8 characters, possibly incorrectly encoded"; break;
            }
            throw new \Exception($cause);
        }
        return $json;
    }
}
