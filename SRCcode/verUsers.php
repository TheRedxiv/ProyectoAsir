<?php
    include("var.inc.php");
    $c = new mysqli($host,$user,$pass,$db);
    $sql = "SELECT nombre,id FROM usuario";
    $consulta = $c->query($sql);
    $salida = "[";
    while ($linea = $consulta->fetch_assoc()){
        $salida .= '{"nombre":"'.$linea['nombre'].'","id":'.$linea['id'].'},';
    }
    $salida = substr($salida,0,-1)."]";
    echo $salida;
?>