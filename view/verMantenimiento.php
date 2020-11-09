<?php
require_once '../model/camareroDAO.php';
$camareroDAO = new camareroDAO();
echo "<table>";
    $camareroDAO->verMantenimiento();
echo "</table>";

echo "<h2><a href='./zonaRestaurante.php?espacio=Terraza'>Volver Proyecto</a></h2>";
echo "<h2><a href='./zonaAdmin.php'>Volver admin</a></h2>";

