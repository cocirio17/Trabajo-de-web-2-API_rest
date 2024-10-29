<?php
    
    require_once './libs/response.php';
    require_once './libs/request.php'; 
    require_once './libs/router.php'; 
    require_once './libs/jwt.php';
    
    require_once './app/controllers/BoletoControlador.php';
    require_once './app/controllers/Usuario.controlado.php';
    require_once './app/SoftwareIntermedio/jwt.autenticar.intermerdio.php';

    $router = new Router();
    $router->addMiddleware(new Autenticar());


    //               endpoint     |  verbo   |     controller      |    método
    $router->addRoute('boleto'      ,   'GET'    , 'BoletoControlador'  , 'mostrarBoletos');
    $router->addRoute('boleto/:id'  ,   'GET'    , 'BoletoControlador'  , 'mostrarBoleto');
    $router->addRoute('boleto/:id'  ,   'DELETE' , 'BoletoControlador'  , 'borrarBoleto');
    $router->addRoute('boleto'      ,   'POST'   , 'BoletoControlador'  , 'nuevoBoleto');
    $router->addRoute('boleto/:id'  ,   'PUT'    , 'BoletoControlador'  , 'editarBoleto');
    $router->addRoute('boleto'      ,   'GET'    , 'BoletoControlador'  , 'traerBoleto');
    
    $router->addRoute('usuarios/token', 'GET'    , 'UsuarioController'  ,  'obtenerToken');


    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);