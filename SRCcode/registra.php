<?php
$passw = $_POST["pass"];
$nombre = $_POST["user"];
$datetime = date('Y-m-d H:i:s');
include("var.inc.php");
$c = new mysqli($host,$user,$pass,$db);
$sql = "INSERT INTO usuario VALUES (null, '$nombre', '$passw', '$datetime')";
if ($consulta = $c->query($sql)){
    echo "Y";
}

?>