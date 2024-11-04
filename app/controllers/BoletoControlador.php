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
        $filtrado = null;
        $filtradoDirecion = null;
        $cantidad = null;

        if(isset($req->query->filtro)){
            $filtrado = $req->query->filtro;
        }
        if(isset($req->query->filtraodDirecion)){
            $filtradoDirecion = $req->query->filtraodDirecion;
        }
        if(isset($req->query->cantidad)){
            $cantidad = $req->query->cantidad;
        }
        
        if(isset($req->query->orderBy)){
            $orderBy = $req->query->orderBy;
        }
        if(isset($req->query->orderDirection)){
            $orderDirection =$req->query->orderDirection;
        }

        $boleto = $this->modelo->traerBoletos($orderBy, $orderDirection, $filtrado, $filtradoDirecion, $cantidad);

        if($boleto == null){
            return $this->vista->response('no hay boletos con esas especificaciones');
        }

        return $this->vista->response($boleto);
    }

    // api/boleto/:id
    public function mostrarBoleto($req, $res) {        
        if(!$res->user) {
            return $this->vista->response("No autorizado", 401);
        }
        $id = $req->params->id;
        $boleto = $this->modelo->traerBoleto($id);
        if(!$boleto) {
            return $this->vista->response("La tarea con el id=$id no existe", 404);
        }
        return $this->vista->response($boleto);
    }
    // api/boleto
    public function nuevoBoleto($req,$res){
        // verificar si pude agregar el usuario
        if(!$res->user) {
            return $this->vista->response("No autorizado", 401);
        }

        //$destino_inicio, $destino_fin, $fecha_salida,$precio
        $Destino_inicio=$req->body->destino_inicio;
        $Destino_fin=$req->body->destino_fin;
        
        $feccha_obje = DateTime :: createFromFormat('Y-m-d', $req->body->fecha_salida);
    
        if($feccha_obje && $feccha_obje->format('Y-m-d') === $req->body->fecha_salida ){
            $Fecha_salida = $req->body->fecha_salida;
        }else{
            return $this->vista->response('La fecha no es correcta', 400);
        }
    
        if(is_numeric($req->body->precio)){
            $Precio = $req->body->precio;
        }else{
            return $this->vista->response('No es un precio correcto', 400);
        }
    
        if(empty($Fecha_salida) || empty($Destino_fin) || empty($Destino_inicio)){
            return $this->vista->response("faltan completar datos" , 400);
        }
    
        $id =$this->modelo->nuevoBoleto($Destino_fin,$Destino_inicio,$Fecha_salida,$Precio);       
        if($id){    
            return $this->vista->response("el boleto se ha creado con exito, con el id=$id",200);
        }    
    }

    // api/boleto/:id
    public function borrarBoleto ($req, $res){
        
        if(!$res->user) {
            return $this->vista->response("No autorizado", 401);
        }
        
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
        
        if(!$res->user) {
            return $this->vista->response("No autorizado", 401);
        }

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
        
        $feccha_obje = DateTime :: createFromFormat('Y-m-d', $req->body->fecha_salida);

        if($feccha_obje && $feccha_obje->format('Y-m-d') === $req->body->fecha_salida ){
            $fecha_salida = $req->body->fecha_salida;
        }else{
            return $this->vista->response('La fecha no es correcta', 400);
        }
        if(is_numeric($req->body->precio)){
            $precio = $req->body->precio;
        }else{
            return $this->vista->response('No es un precio correcto', 400);
        }

        $destino_inicio = $req->body->destino_inicio;       
        $destino_fin = $req->body->destino_fin;   

        $this->modelo->editarBoleto($id, $destino_inicio, $destino_fin, $fecha_salida , $precio);

        $boleto = $this->modelo->traerBoleto($id);
        $this->vista->response($boleto, 200);
        
    }

}