<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Slim\Exception\HttpNotFoundException;
use Vanier\Api\Controllers\AboutController;
use Vanier\Api\Controllers\FilmsController;

// Import the app instance into this file's scope.
global $app;

// NOTE: Add your app routes here.
// The callbacks must be implemented in a controller class.
// The Vanier\Api must be used as namespace prefix. 

// ROUTE: GET /
$app->get('/', [AboutController::class, 'handleAboutApi']); 

$app->post('/', [AboutController::class, 'handleAboutApi']); 
//GET /films
//$app->get('/films', function (Request $request, Response $response, $args) {
$app->get('/films', [FilmsController::class,'handleGetFilms']);

$app->post('/films', [FilmsController::class,'handleCreateFilms']);
/*
$app->get('/films', function (Request $request, Response $response, $args) {
   
    $response->getBody()->write("Hello! From FIlms");
    $films_model = new FilmsModel();
    
    return $response;
};*/
// ROUTE: GET /hello
$app->get('/hello', function (Request $request, Response $response, $args) {

    $response->getBody()->write("Reporting! Hello there!");            
    return $response;

});

