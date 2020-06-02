<?php


namespace controller\blogs;


use controller\AbstractController;
use model\entities\Blog;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use util\exceptions\BadRequestException;
use util\exceptions\NotFoundException;

class BlogController extends AbstractController
{

    const STR_BLOG_NOT_FOUND = "str_blog_not_found";

    public static function getAll(Request $request, Response $response, $args){
        $blogs = Blog::all();
        self::writeJsonToResponse($response,$blogs->toArray(),null);
        return $response;
    }

    public static function add(Request $request, Response $response, $args){
        $json = self::readJsonFromRequest($request);
        if(!isset($json['title']) || empty($json['title'])){
            throw new BadRequestException("Title is not set!");
        }
        if(!isset($json['description']) || empty($json['description'])){
            throw new BadRequestException("Description is empty");
        }
        if(!isset($json['image_url']) || empty($json['image_url'])){
            throw new BadRequestException("Image url is not set!");
        };
        $blog = new Blog($json);
        $blog->save();
        self::writeJsonToResponse($response,$blog->toArray(),"Blog successfully created");
        return $response;
    }

    public static function getById(Request $request, Response $response, $args){
        $blog = Blog::findById($args['id']);
        if($blog == null){
            throw new NotFoundException(self::STR_BLOG_NOT_FOUND);
        }
        self::writeJsonToResponse($response,$blog->toArray(),null);
        return $response;
    }



}