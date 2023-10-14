<?php

namespace Vanier\Api\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Vanier\Api\Helpers\Validator;


class BaseController 
{
    protected function prepareOkResponse(Response $response, array $data, int $status_code = 200)
    {
        // var_dump($data);
        $json_data = json_encode($data);
        //-- Write JSON data into the response's body.        
        $response->getBody()->write($json_data);
        return $response->withStatus($status_code)->withAddedHeader(HEADERS_CONTENT_TYPE, APP_MEDIA_TYPE_JSON);
    }
    
    protected function isValidPagingParams(array $paging_params): mixed
    {
        $rules = array(
            'page' => [
                'required',
                'numeric',
                ['min', 1]
            ],
            'page_size' => [
                'required',
                'integer',
                ['min', 5],
                ['max', 100]
            ]
        );
        return $this->isValidData($paging_params, $rules);
    }
    
    
    protected function isValidData(array $data, array $rules) : mixed
    {
        // Create a validator and override the default language used in expressing the error messages.
    $validator = new Validator($data, [], 'en');
    // Important: map the validation rules before calling validate()
    $validator->mapFieldsRules($rules);
    if ($validator->validate()) {
        //echo "<br> Valid data!";
        return true;
    } 
    return $validator->errorsToJson();
}


//return $validator->errors();
//return $validator->errorsToJson();

}
