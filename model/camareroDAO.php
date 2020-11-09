<?php
class camareroDAO {
    // ATRIBUTOS
    private $pdo;

    // CONSTRUCTOR
    public function __construct() {
        include_once '../db/connection.php';
        $this->pdo=$pdo;
    }

    // VALIDACIÓN DEL LOGIN
    // DEVUELVE TRUE EN CASO DE QUE EN LA BASE DE DATOS HAYA UN CAMARERO CON NOMBRE Y CONTRASEÑA IGUALES A LA QUE EL
    // USUARIO APORTA EN EL FORMULARIO DEL LOGIN. FALSE, EN CUALQUIER OTRO CASO
    public function login($camarero){
        $query = "SELECT * FROM `camareros` WHERE `nombre_camarero`=? AND `pass_camarero`=?";
        $sentencia=$this->pdo->prepare($query);
        $nombre = $camarero->getNombre_camarero();
        $pass = $camarero->getPass_camarero();
        $sentencia->bindParam(1,$nombre);
        $sentencia->bindParam(2,$pass);
        $sentencia->execute();
        $result=$sentencia->fetch(PDO::FETCH_ASSOC);
        $numRow=$sentencia->rowCount();
        if(!empty($numRow) && $numRow==1){
            $camarero->setId_camarero($result['id_camarero']);
            $camarero->setIdMantenimiento($result['idMantenimiento']);
            session_start();
            $_SESSION['camarero']=$camarero;
            return true;
        } else {
            return false;
        }
    }

    public function verEmpleados(){
        $query = "SELECT nombre_camarero, pass_camarero, idMantenimiento AS mantenimiento FROM camareros";
        $sentencia=$this->pdo->prepare($query);
        $sentencia->execute();
        $listaCamareros = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        echo "<table>";
        foreach ($listaCamareros as $lista) {
            
            echo "<tr>";
            echo "<td>Nombre: {$lista['nombre_camarero']}</td>";
            echo "<td>Password: {$lista['pass_camarero']}</td>";
            if ($lista['mantenimiento'] == null) {
                echo "<td>Mantenimiento: NO</td>";
            }else{
                echo "<td>Mantenimiento: SI</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }

    public function verCamareros(){
        $query = "SELECT nombre_camarero, pass_camarero FROM camareros WHERE idMantenimiento = 2 or 1";
        $sentencia=$this->pdo->prepare($query);
        $sentencia->execute();
        $listaCamareros = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        echo "<table>";
        foreach ($listaCamareros as $lista) {
            
            echo "<tr>";
            echo "<td>Nombre: {$lista['nombre_camarero']}</td>";
            echo "<td>Password: {$lista['pass_camarero']}</td>";
            echo "</tr>";
        }
        echo "</table>";
    }

    public function verMantenimiento(){
        $query = "SELECT nombre_camarero, pass_camarero, idMantenimiento FROM camareros WHERE idMantenimiento IS NULL";
        $sentencia=$this->pdo->prepare($query);
        $sentencia->execute();
        $listaCamareros = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        echo "<table>";
        foreach ($listaCamareros as $lista) {
            
            echo "<tr>";
            echo "<td>Nombre: {$lista['nombre_camarero']}</td>";
            echo "<td>Password: {$lista['pass_camarero']}</td>";
            echo "<td>Mantenimiento: SI</td>";
            echo "</tr>";
        }
        echo "</table>";
    }

}

?>