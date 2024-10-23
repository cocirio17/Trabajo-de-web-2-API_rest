<?php
    
    require_once './libs/response.php';
    require_once './libs/request.php'; 
    require_once './libs/router.php'; 
    
    require_once './app/controllers/BoletoControlador.php';

    $router = new Router();

    //               endpoint     |  verbo   |     controller      |    método
    $router->addRoute('boleto'      , 'GET'    , 'BoletoControlador'  , 'mostrarBoletos');
    $router->addRoute('boleto/:id'  , 'GET'    , 'BoletoControlador'  , 'mostrarBoleto');
    $router->addRoute('boleto/:id'  , 'DELETE' , 'BoletoControlador'  , 'borrarBoletoe');
    $router->addRoute('boleto'      , 'POST'   , 'BoletoControlador'  , 'nuevoBoleto');
    $router->addRoute('boleto/:id'  , 'PUT'    , 'BoletoControlador'  , 'editarBoleto');
    $router->addRoute('boleto'      , 'GET'    , 'BoletoControlador'  , 'traerBoleto');


    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);