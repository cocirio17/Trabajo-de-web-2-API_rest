<?php
require_once './app/models/Usuario.Modelo.php';
require_once './app/views/json.view.php';
class UsuarioController
{
    private $modelo;
    private $vistas;

    public function __construct()
    {
        $this->modelo = new UsuarioModelo();
        $this->vistas = new JSONVvista();
    }


    public function obtenerToken()
    {

        $autenticar = $_SERVER['HTTP_AUTHORIZATION'];
        $autenticar = explode(' ', $autenticar);

        if (count($autenticar) != 2) {
            return $this->vistas->response("error en los datos ingresados", 400);
        }
        if ($autenticar[0] != 'Basic') {
            return $this->vistas->response("Error en los datos ingresados", 400);
        }

        $usuario = base64_decode($autenticar[1]); // "usuario:password"
        $usuario = explode(':', $usuario); // ["usuario", "password"]
        // Buscamos El usuario en la base

        $usuario = $this->modelo->usaurioNombre($usuario[0]);
        // Chequeamos la contraseña
        if ($$usuario == null || !password_verify($usuario[1], $user->password)) {
            return $this->vistas->response("Error en los datos ingresados", 400);
        }
        // Generamos el token
        $token = createJWT(array(
            'sub' => $user->id,
            'email' => $user->email,
            'role' => 'admin',
            'iat' => time(),
            'exp' => time() + 60,
            'Saludo' => 'Hola',
        ));
        return $this->vistas->response($token);
    }
}
