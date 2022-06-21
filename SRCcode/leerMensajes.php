<?php
$para = $_POST["para"];
$de = $_POST["de"];
include("var.inc.php");
$c = new mysqli($host,$user,$pass,$db);
$sql = "SELECT * FROM mensajes WHERE (de = $de OR de = $para) AND (para = $de OR para = $para) ORDER BY DATETIME";
$consulta = $c->query($sql);
$salida = "[";
while ($linea= $consulta->fetch_assoc()){
    $salida.= '{"de":'.$linea["de"].',"para":'.$linea["para"].',"texto":"'.$linea["texto"].'","datetime":"'.$linea["DATETIME"].'"},';
}
$salida= substr($salida,0,-1)."]";
echo $salida;
?>
