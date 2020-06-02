<?php


namespace controller\labyrinth;


use controller\AbstractController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use util\exceptions\BadRequestException;

class LabyrinthController extends AbstractController
{

    public static function generete(Request $request, Response $response, $args){
        $json = self::readJsonFromRequest($request);
        if(!isset($json['x']) || empty($json['x'])){
            throw new BadRequestException("X is not set");
        }
        if(!isset($json['y']) || empty($json['y'])){
            throw new BadRequestException("Y is not set!");
        }
        $x = $json['x'];
        $y = $json['y'];

        if($x <= 0 || $y <= 0){
            throw new BadRequestException("Labyrinth squares should be positive numbers!");
        }

        $labyrinth = [];

        self::getlabyrinth($x,$y,$labyrinth);
        self::putExit($x,$y,$labyrinth);

        self::getPossibleExits($labyrinth);


    }

    private static function getPossibleExits(&$labyrinth)
    {

        if($labyrinth[1][1] === 2){
            var_dump("Exit is at the begging");
            var_dump($labyrinth);
            return;
        }

        $labyrinth[1][1] = "R"; //the entrance to my labyrinth is always the first square

        foreach ($labyrinth as &$y){
            foreach ($y as &$x){
                if($x == 1){
                    $x = "G";
                }
            }
        }

        var_dump($labyrinth);

        $isPossibleFirstStepToRight = true;
        for ($i=1;$i<=count($labyrinth);$i++){
            $subRoad = $labyrinth[$i];
            if($i == 1){
                $b = 2; // at first row next first step is second square
            }else{
                $b = 1; // at second row and each next the first step is first square
            }
            for($c=$b;$c<=count($subRoad);$c++){
                if($c == 2){
                    if($subRoad[$c] === 0){
                        $isPossibleFirstStepToRight = false;
                        break; //means we dont have road to right
                    }
                }elseif($c ==1 && !$isPossibleFirstStepToRight && $subRoad[$c] === 0){
                    var_dump("There are no more possible steps to exit!");
                    return;
                }
            }
        }
    }

    private static function getLabyrinth($coordinateX,$coordinateY,&$labyrinth){
        for ($i = 1; $i <= $coordinateY; $i++){
            $offset = self::genereteRoad($coordinateX);
            $labyrinth[$i] = $offset;
        }
    }

    private static function genereteRoad($possible_squares){
        $result = [];
        for ($i=1; $i<=$possible_squares;$i++){
            $rnd = rand(0,1);
            $result[$i] = $rnd;
        }
        return $result;
    }

    private static function putExit($coordinateX,$coordinateY, &$arr_labyrinth){
        $rndY = rand(1,$coordinateY);
        $rndX = rand(1,$coordinateX);
        $arr_labyrinth[$rndY][$rndX] = 2;
    }

}