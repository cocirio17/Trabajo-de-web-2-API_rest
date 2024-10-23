<?php
require_once './app/views/json.view.php';
require_once './app/models/boleto.modelo.php';
class BoletoControlador{
    private $vista;
    private $modelo;

    public function __construct(){
        $this->vista = new JSONVvista();
        $this->modelo = new BoletoModelo();        
    }

    // api/boleto
    public function mostrarBoletos ($req, $res){
        $orderBy = null;
        $orderDirection = null;

        if(isset($req->query->orderBy)){
            $orderBy = $req->query->orderBy;
        }
        if(isset($req->query->orderDirection)){
            $orderDirection =$req->query->orderDirection;
        }

        $boleto = $this->modelo->traerBoletos($orderBy, $orderDirection);

        return $this->vista->response($boleto);
    }

    // api/boleto/:id
    public function mostrarBoleto($req, $res) {
        $id = $req->params->id;
        $boleto = $this->modelo->traerBoleto($id);
        if(!$boleto) {
            return $this->vista->response("La tarea con el id=$id no existe", 404);
        }
        return $this->vista->response($boleto);
    }

    // api/boleto/:id
    public function borrarBoleto ($req, $res){
        $id = $req->params->id;

        $boleto = $this->modelo->traerboleto($id);

        if(!$boleto){
            $this->vista->response('no se encontro el boleto', 404);
        }
        $this->modelo->borrarBoleto($id);
        $this->vista->response('se a borrado el boleto con id=$id', 200 );
    }
    // api/boleto/:id
    public function editarBoleto ($req, $res){
        $id = $req->params->id;
        // verifico que exista
        $boleto = $this->modelo->traerBoleto($id);
        if (!$boleto) {
            return $this->vista->response("El boleto con el id=$id no existe", 404);
        }
            // valido los datos
        if (!isset($req->body->destino_inicio) || empty($req->body->destino_inicio) ||
            !isset($req->body->destino_fin) || empty($req->body->destino_fin) ||
            !isset($req->body->fecha_salida) || empty($req->body->fecha_salida) ||
            !isset($req->body->precio) || empty($req->body->precio)){
            return $this->vista->response('Faltan completar datos', 400);
        }

        $destino_inicio = $req->body->destino_inicio;       
        $destino_fin = $req->body->destino_fin;       
        $fecha_salida = $req->body->fecha_salida;
        $precio = $req->body->precio;

        $this->modelo->editarBoleto($id, $destino_inicio, $destino_fin, $fecha_salida, $precio);

        $boleto = $this->modelo->traerBoleto($id);
        $this->vista->response($boleto, 200);
        
    }

}