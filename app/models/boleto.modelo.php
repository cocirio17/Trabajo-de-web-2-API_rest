<?php
class BoletoModelo {
    private $db;

    public function __construct(){
        $this->db = new PDO('mysql:host=localhost;dbname=coletivo;charset=utf8', 'root', '');        
    }

    public function traerBoletos($orderBy = false , $orderDirection = ' ASC ', $filtrado = null, $valor = null, $limite = null, $pagina = null){
        $sql = 'SELECT * FROM boleto';
    
        // filtro
        if($filtrado == 'precio' || $filtrado == 'destino_inicio' || $filtrado == 'destino_fin' || $filtrado == 'fecha_salida'){
            $sql .= ' WHERE ' . $filtrado . ' = ? ';
        }

        
        //ordenamineto 
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
            // direcion del orden
            if ($orderDirection === 'DESC') {
                $sql .= ' DESC';  
            } else {
                $sql .= ' ASC';  
            }            
        }

        if($pagina !== null){
            $paginacion = ($pagina - 1) * $limite;

            $paginacion = (int) $paginacion;
            $sql .= ' LIMIT ' . $limite;
            $sql .= ' OFFSET ' . $paginacion;
        }
        
        // Preparar la consulta
        $query = $this->db->prepare($sql);
    
        if ($valor !== null ||  $filtrado !== null) {
            $query->execute([$valor]);
        }else{        
            $query->execute([]);
        }

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