<?php
$de = $_POST["de"];
$para = $_POST["para"];
$mensaje = $_POST["mensaje"];
$datetime = date('Y-m-d H:i:s');
include("var.inc.php");
$c = new mysqli($host,$user,$pass,$db);
$sql = "INSERT INTO mensajes VALUES ($de, $para,'$mensaje','$datetime')";
$c->query($sql);
$sql = "UPDATE usuario SET laston = '$datetime' WHERE id = $de";
$c->query($sql);
?>