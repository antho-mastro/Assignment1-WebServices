<?php

namespace Vanier\Api\Controllers;

use Fig\Http\Message\StatusCodeInterface as HttpCodes;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;
use Vanier\Api\Exceptions\HttpInvalidInputsException;
use Vanier\Api\Models\FilmsModel;

class FilmsController extends BaseController
{
    
    private $films_model = null;
    public function __construct(){
        $this->films_model = new FilmsModel();
    }
        
    /**
     * handleCreateFilms
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return void
     */
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

/**
 * handleGetFilms
 *
 * @param  mixed $request
 * @param  mixed $response
 * @param  mixed $uri_args
 * @return void
 */
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

    //$shows = $this->getTVMazeShows();

    
    

    return $this->prepareOkResponse($response, (array)$films);
}

    public function DeleteFilm(Request $request, Response $response){


        $films_id = $request->getParsedBody();


        foreach($films_id as $key => $id){

        }
            if($this->isValidData($id, $this->rules)){
                $this->films_model->deleteFilm($id);
            }else{
                //TODO: add $validation_response to the list of errors.
            }
      
        $response_data = array(
            "code" => HttpCodes::STATUS_CREATED,
            "message" => "The list of film has been deleted"
        );

        return $this->prepareOkResponse($response,$response_data, HttpCodes::STATUS_CREATED);
    }

/*

//! HttpClient Lab 
private function getTVMazeShows(): mixed{
    $ws_invoker = new WebServiceInvoker([]);
    $uri = "https://api.tvmaze.com/shows";
    $shows = $ws_invoker->invokeUri($uri);
    $processed_shows = array();
//Can var dump it
//--Process the list 
foreach ($shows as $key => $show){
$processed_shows [$show->id]["name"] = $show->name;
$processed_shows [$show->id]["language"] = $show->language;
$processed_shows [$show->id]["genres"] = implode(",", $show->genres);
$processed_shows [$show->id]["premiered"] = $show->premiered;
$processed_shows [$show->id]["rating"] = $show->rating->average;
$processed_shows [$show->id]["summary"] = $show->summary;
$processed_shows [$show->id]["type"] = $show->type;
}    

return $processed_shows;
}
*/
   
}
