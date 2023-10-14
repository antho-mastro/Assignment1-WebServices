<?php

namespace Vanier\Api\Controllers;

use Fig\Http\Message\StatusCodeInterface as HttpCodes;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;
use Vanier\Api\Exceptions\HttpInvalidInputsException;
use Vanier\Api\Helpers\Input;
use Vanier\Api\Models\BaseModel;

class FilmsController extends BaseController
{
    
    private $films_model = null;
    public function __construct(){
        $this->films_model = new FilmsModel();
    }
    
    public function handleCreateFilms(Request $request, Response $response)
    {
    
        
            //echo 'hello from films callback!';exit;
            //Pull the list of films from the DB 
        $films_data = $request->getParsedBody();
        if (!isset($films_data)){
                throw new HttpBadRequestException($request, "Couldnt create films");
        }
        //TODO: VALIDATE request payload
        //!NOTE TEST
//?TEST
        //TODO: check if the film contains valid values
        //call a validation function that accepts
        //1)the array containing data
        //2)


        foreach($films_data as $key => $film){
            
            $this->films_model->createFilm($film);
        }
        //prepare a response
        
        $response_data = array(
            "code" => HttpCodes::STATUS_CREATED,
            "message" => "Created list of films succesfully",

        );
       // return $this->prepareOkResponse(

        //);
        
        
        $filters = $request->getQueryParams();
        $films = $this->films_model->getAll($filters);
      
      //  var_dump($films);exit;
            //
            //prepare hhttp request
        $json_data = json_encode($films);
        //write the data to the body of the response
        $response->getBody()->write($json_data);

            //send the response
        return $response;
    }

public function handleGetFilms(Request $request, Response $response, array $uri_args){

    $filters = $request->getQueryParams();

    $validation_response = $this->isValidPagingParams($filters);
    if($validation_response === true){

        $this->films_model->setPaginationOptions(
            $filters['page'],
            $filters['page_size']
        );
    
    }else{
        //httpbadrequestexception
    }

    $films = $this->films_model->getAll($filters);

    return $this->prepareOkResponse($response, (array)$films);
}
   
}
