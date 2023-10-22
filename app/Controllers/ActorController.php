<?php
use Vanier\Api\Controllers\BaseController;
use Fig\Http\Message\StatusCodeInterface as HttpCodes;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;
use Vanier\Api\Exceptions\HttpInvalidInputsException;
use Vanier\Api\Models\BaseModel;
use Vanier\Api\Models\ActorsModel;


class CustomerController extends BaseController{
//?Why is this not defined
    private $actor_model = null;
    public function __construct(){
        $this->actor_model = new ActorsModel();
    }
    /**
     * handleCreateActors
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return void
     */
    public function handleCreateActor(Request $request, Response $response)
    {
    
        $actor_data = $request->getParsedBody();
        if (!isset($actor_data)){
                throw new HttpBadRequestException($request, "Couldnt create actors");
        }

        foreach($actor_data as $key => $actor){
            
            $this->actor_model->createActor($actor);
        }
        //prepare a response
        
        $response_data = array(
            "code" => HttpCodes::STATUS_CREATED,
            "message" => "Created list of actors succesfully",

        );
        
            //prepare hhttp request
        $json_data = json_encode($actor);
        //write the data to the body of the response
        $response->getBody()->write($json_data);

            //send the response
        return $response;
    }
    public function handleGetActors(Request $request, Response $response, array $uriargs){

    $filters = $request->getQueryParams();

     $actor = $this->actor_model->getAll($filters);

    return $this->prepareOkResponse($response, (array)$actor);
    }
}

?>