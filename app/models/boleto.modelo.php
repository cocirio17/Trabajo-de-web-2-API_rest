<?php
class BoletoModelo {
    private $db;

    public function __construct(){
        $this->db = new PDO('mysql:host=localhost;dbname=coletivo;charset=utf8', 'root', '');        
    }

    public function traerBoletos($orderBy = false , $orderDirection = ' ASC ', $filtrado = false, $filtradoDireccion = '=', $cantidad = 0){
        $sql = 'SELECT * FROM boleto';
    

        if ($filtrado && $cantidad !== null) {
            $sql .= ' WHERE ';
            switch ($filtrado){
                case 'destino-inicio':
                        if ($filtradoDireccion == '>') {
                            $sql .= ' destino_inicio > ?';
                        } 
                        elseif ($filtradoDireccion == '<') {
                            $sql .= ' destino_inicio < ? ';
                        } 
                        else {
                            $sql .= ' destino_inicio = ?';
                        }
                    break;
                
                case 'destino-fin':
                        if ($filtradoDireccion == '>') {
                            $sql .= 'destino_fin > ?';
                        }
                        elseif ($filtradoDireccion == '<') {
                            $sql .= ' destino_fin < ?';
                        }
                        else {
                            $sql .= ' destino_fin = ?';
                        }
                    break;
                case 'precio':
                        if ($filtradoDireccion == '>') {
                            $sql .= ' precio > ?';
                        }
                        elseif ($filtradoDireccion == '<') {
                            $sql .= ' precio < ?';
                        }
                        else {
                            $sql .= ' precio = ?';
                        }
                    break;
                default:
                    return ('el campo que etsa filtrando no existe');        
                    break;
                    
            }
        }
        

        if ($orderBy) {
            $sql .= ' ORDER BY ';     
            switch ($orderBy) {
                case 'precio':
                    $sql .= ' precio ';
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
                    // $sql .= ' id_boleto ';
                    return ('el campo no existe');
                    break;
            }
    
            if ($orderDirection === 'DESC') {
                $sql .= ' DESC';  
            } else {
                $sql .= ' ASC';  
            }
            
        } 
              
        $query = $this->db->prepare($sql);
        $query->execute([$cantidad]);

        $boleto = $query->fetchAll(PDO::FETCH_OBJ);
        return $boleto;
    }

    public function traerBoleto($id){
        $query = $this->db->prepare('SELECT * FROM boleto WHERE id_boleto = ?');
        $query->execute([$id]);   
        $boleto = $query->fetch(PDO::FETCH_OBJ);
        return $boleto;

    }
    
    public function nuevoBoleto($destino_inicio, $destino_fin, $fecha_salida,$precio) { 
        $query = $this->db->prepare('INSERT INTO boleto(destino_inicio, destino_fin, fecha_salida, precio) VALUES (?, ?, ?, ?)');
        $query->execute([$destino_inicio, $destino_fin, $fecha_salida,$precio]);    
        $id = $this->db->lastInsertId();// ID de la último que fue agrego a la base de datos   
        return $id;
    }

    public function borrarBoleto($id) {
        $query = $this->db->prepare('DELETE FROM boleto WHERE id_boleto = ?');
        $query->execute([$id]);
    }

    public function editarBoleto($id, $destino_inicio, $destino_fin, $fecha_salida, $precio){
        $query = $this->db->prepare('UPDATE boleto SET destino_inicio = ?, destino_fin = ?, fecha_salida = ?, precio = ? WHERE id_boleto = ?');
        $query->execute([$destino_inicio, $destino_fin, $fecha_salida, $precio, $id]);
    }

}