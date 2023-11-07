<?php

namespace Vanier\Api\Middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;



class ContentNegotiationMiddleware implements MiddlewareInterface
{
   
    public function process(Request $request, RequestHandler $handler): ResponseInterface
    {
        //echo "Hello! From test middleware!";exit;
        // DO NOT remove the following statements.
   
/*
$headers = $request->getHeaders();
foreach ($headers as $name => $values) {
    echo $name . ": " . implode(", ", $values);
}
*/
// Get request headers as associative array
$headerValue = $request->getHeaderLine('Accept');

// Define the list of accepted content types
$acceptedContentTypes = ['text/html', 'application/json', 'application/xml'];

// Check if the requested content type is acceptable
if (!$this->isContentTypeAcceptable($headerValue, $acceptedContentTypes)) {
    throw new HttpNotAcceptableException("406 error");
}

// Continue processing the request if the content type is acceptable
$response = $handler->handle($request);
return $response;

    }
    private function isContentTypeAcceptable($requestedType, $acceptedTypes)
    {
       
        return in_array($requestedType, $acceptedTypes);
    }
   
   

}


class HttpNotAcceptableException            //extends HttpSpecializedException
{
    protected $code = 406;
    protected $message = 'Not Acceptable.';
    protected $title = '406 not acceptable';
    protected $description = '';
}