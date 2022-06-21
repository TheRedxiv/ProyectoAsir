<?php
$nombre = $_POST["user"];
include("var.inc.php");
$c = new mysqli($host,$user,$pass,$db);
$sql = "SELECT nombre FROM usuario WHERE nombre = '$nombre'";
$consulta = $c->query($sql);
if ($consulta->num_rows == 1){
    echo "Y";
}
?>