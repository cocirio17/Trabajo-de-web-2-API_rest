<?php
class Autenticar{
    public function run($eq, $res){

        $autenticar = $_SERVER['HTTP_AUTHORIZATION'];
        $autenticar = explode(' ', $autenticar);
        
        if (count($autenticar) != 2){
            return;
        }
        if ($autenticar[0] != 'Bearer'){
            return;
        }
        $res->usuario = validateJWT($autenticar[1]);
    }
}
