<?php
class BoletoModelo {
    private $db;

    public function __construct(){
        $this->db = new PDO('mysql:host=localhost;dbname=coletivo;charset=utf8', 'root', '');        
    }

    public function traerBoletos($orderBy = false , $orderDirection = ' ASC '){
        $sql = 'SELECT * FROM boleto';

        if ($orderBy) {
            $sql .= ' ORDER BY '; 
    
            switch ($orderBy) {
                case 'precio':
                    $sql .= ' precio '; // Espacio después de 'precio'
                    break;
                case 'fecha':
                    $sql .= ' fecha_salida ';
                    break;
                case 'destino-inicio':
                    $sql .= ' destino_inicio ';
                    break;
                case 'destino-fin':
                    $sql .= ' destino_fin ';
                    break;
                default:
                    break;
            }
    
            if ($orderDirection === 'DESC') {
                $sql .= ' DESC';  
            } else {
                $sql .= ' ASC';  
            }
            
        }
        
        
        
        $query = $this->db->prepare($sql);
        $query->execute();

        $boleto = $query->fetchAll(PDO::FETCH_OBJ);
        return $boleto;
    }

    public function traerBoleto($id){
        $query = $this->db->prepare('SELECT * FROM boleto WHERE id_boleto = ?');
        $query->execute([$id]);   
    
        $boleto = $query->fetch(PDO::FETCH_OBJ);
    
        return $boleto;

    }

    public function borrarBoleto($id) {
        $query = $this->db->prepare('DELETE FROM boleto WHERE id = ?');
        $query->execute([$id]);
    }

    public function editarBoleto($id, $destino_inicio, $destino_fin, $fecha_salida, $precio){
        $query = $this->db->prepare('UPDATE boleto SET destino_inicio = ?, destino_fin = ?, fecha_salida = ?, precio = ? WHERE id_boleto = ?');
        $query->execute([$destino_inicio, $destino_fin, $fecha_salida, $precio, $id]);
    }

}