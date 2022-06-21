<?php
$host="mysqlmagno.cwnl289itiyn.us-east-1.rds.amazonaws.com";
$user="magno";
$pass="alejandro";
$bd="magno";
if ($mysqli_connection->connect_error) {
   echo "Not connected, error: " . $mysqli_connection->connect_error;
}
else {
        $c = new mysqli($host, $user, $pass, $bd);
        $sql = "SELECT nombre FROM nombre WHERE id = 1";
        $consulta = $c->query($sql);
        $linea = $consulta->fetch_assoc();
        $salida = $linea["nombre"];
        echo "Buenas $salida";
}
?>

