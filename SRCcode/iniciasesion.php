<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="#" method="GET">
        Usuario<input type="text" name="user" id=""><br>
        Contraseña<input type="text" name="pass" id=""><br>
        <input type="submit" value="Conectarse">
    </form>
    <form action="registra.html" method="get">
        <input type="submit" value="Registrarse">
    </form>
</body>
</html>
<?php
session_start();
session_unset();
if (isset($_GET['user']) && isset($_GET['pass']) && ! isset($_SESSION["usuario"])){
    $usuario = $_GET["user"];
    $contrasena = $_GET["pass"];
    $sql = "SELECT nombre FROM usuario WHERE nombre = '$usuario' AND pass = '$contrasena'";
    //echo $sql;
    //echo $usuario;
    include("var.inc.php");

    $c = new mysqli($host,$user,$pass,$db);
    $consulta = $c->query($sql);
    if ($consulta->num_rows == 1){
        echo "sesion iniciada";
        $_SESSION["usuario"]= $usuario;
        $sql = "SELECT id FROM usuario WHERE nombre = '$usuario'";
        $consulta = $c->query($sql);
        $id = $consulta->fetch_assoc()["id"];
        $datetime = date('Y-m-d H:i:s');
        $sql = "UPDATE usuario SET laston = '$datetime' WHERE id = $id";
        echo $sql;
        $c->query($sql);
        header('Location: chat.php');
    }else{
        echo "<p style='color:red' >Sesion no iniciada";
    }
}
if(isset($_SESSION["usuario"])){
    header('Location: chat.php');
}
?>
