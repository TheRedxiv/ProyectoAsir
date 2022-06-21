<?php
    session_start();
    if ( ! isset($_SESSION['usuario'])){
        header("Location: iniciaSesion.php");
    }
    $usuario = $_SESSION['usuario'];
    include("var.inc.php");
    $c = new mysqli($host,$user,$pass,$db);
    $sql = "SELECT id FROM usuario WHERE nombre = '$usuario'";
    $consulta = $c->query($sql);
    $id = $consulta->fetch_assoc()["id"]
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
.navbar {
  overflow: hidden;
  position: fixed;
  bottom: 0;
  width: 800px;
  margin-left: 300px;
  height: 30px
}
.navbar input{
    width: 80%;
}
.chat {
  margin-left: 300px;
  padding: 0;
  width: 800px;
  background-color: #f1f1f1;
  
  height: 100%;
  overflow: auto;
}
.chat span {
  text-align: right;
  font-size: 10px;
}

.chatyo span {
  text-align: left;
  font-size: 10px;
}
.chatno {
  text-align: center;
  background-color: #f1f1f1;
}
.chatyo {
  margin-left: 300px;
  padding: 0;
  width: 800px;
  background-color: #afafaf;
  height: 100%;
  overflow: auto;
  text-align: right;
}

.sidebar1 {
  margin: 0;
  padding: 0;
  width: 200px;
  background-color: #f1f1f1;
  position: fixed;
  height: 80%;
  overflow: auto;
}

/* Sidebar links */
.sidebar1 a {
  display: block;
  color: black;
  padding: 16px;
  text-decoration: none;
}

/* Active/current link */
.sidebar1 a.active {
  background-color: #04AA6D;
  color: white;
}

/* Links on mouse-over */
.sidebar1 a:hover:not(.active) {
  background-color: #555;
  color: white;
}

.sidebar2 {
  margin: 0;
  padding: 0;
  width: 200px;
  background-color: #f1f1f1;
  position: fixed;
  height: 20%;
  overflow: auto;
  bottom:0;
}

/* Sidebar links */
.sidebar2 a {
  display: block;
  color: black;
  padding: 16px;
  text-decoration: none;
}

/* Active/current link */
.sidebar2 a.active {
  background-color: #04AA6D;
  color: white;
}

/* Links on mouse-over */
.sidebar2 a:hover:not(.active) {
  background-color: #555;
  color: white;
}
.seleccionado {
  background-color: #04AA6D;
  color: white;
}
/* Page content. The value of the margin-left property should match the value of the sidebar's width property */
div.content {
  margin-left: 200px;
  padding: 1px 16px;
  height: 1000px;
}

/* On screens that are less than 700px wide, make the sidebar into a topbar */
@media screen and (max-width: 700px) {
  .sidebar {
    width: 100%;
    height: auto;
    position: relative;
  }
  .sidebar a {float: left;}
  div.content {margin-left: 0;}
}

/* On screens that are less than 400px, display the bar vertically, instead of horizontally */
@media screen and (max-width: 400px) {
  .sidebar a {
    text-align: center;
    float: none;
  }
}

    </style>
</head>
<body>
    <div class="sidebar1" id="sidebar1">

    </div>
    <div class="sidebar2" id="sidebar2">
    <form action="iniciaSesion.php">
        <p>Cerrar sesion</p>
        <input type="hidden" name="CERRAR" value="1">
        <input type="submit" value="SALIR">
    </form>
    </div>
    <div id="chatdiv">
    </div>
    <div class="navbar" id ="navbar">
        <input type="text" name="mensaje" id="mensaje">
        <button onclick="enviar()" id="Benviar">enviar</button>
    </div>
    <form action="iniciaSesion.php">
        <p>Cerrar sesion</p>
        <input type="hidden" name="CERRAR" value="1">
        <input type="submit" value="SALIR">
    </form>
    <p display="none" id="anterior">0</p>
    <p display="none" id="0"></p>
</body>
<script>
  <?php
  echo "var usuario ='".$_SESSION['usuario']."'\n";
  echo "var id = $id\n";
  ?>
    window.onload = function(){
    var ayax = new XMLHttpRequest()
    ayax.onload = function(){
      var argonauta = JSON.parse(this.responseText)
      console.log(argonauta)
      for(let i = 0; i < argonauta.length; i++){
        if(usuario.toUpperCase()  != argonauta[i].nombre.toUpperCase()){
          document.getElementById("sidebar1").innerHTML+= "<a onclick='abrir("+argonauta[i].id+")' id='"+argonauta[i].id+"'>"+argonauta[i].nombre+"</a>"
        }
      }
      conectados()
    }
    ayax.open("GET", "verUsers.php")
    ayax.send()
  }


  function conectados(){
    var ayax = new XMLHttpRequest()
    ayax.onload = function(){
      var argonauta = JSON.parse(this.responseText)
      console.log(argonauta)
      for(let i = 0; i < argonauta.length; i++){
        if(usuario.toUpperCase()  != argonauta[i].nombre.toUpperCase()){
          document.getElementById(argonauta[i].id).innerHTML+= "&#9989"
        }
      }
    }
    ayax.open("GET", "verConectado.php")
    ayax.send()
  }
    function abrir(para){
        var anterior = document.getElementById("anterior").innerHTML
        document.getElementById(anterior).className = "no"
        document.getElementById(para).className = "seleccionado";
        document.getElementById("anterior").innerHTML= para
        actualiza()
    }
        
    function actualiza(){
      setInterval(function(){
      var para = document.getElementById("anterior").innerHTML
        var ayax = new XMLHttpRequest()
        ayax.onload = function(){
          document.getElementById("chatdiv").innerHTML=""
          document.getElementById("Benviar").setAttribute('onclick','enviar('+para+')')
          console.log(this.responseText)
          if (this.responseText == "]"){
            document.getElementById("chatdiv").innerHTML= '<div class="chatno"><p text-align="center">Aun no tiene ningun mensaje intercambiado con este usuario</p></div>'
          }else{
            argonauta = JSON.parse(this.responseText)
            for(let i = 0; i < argonauta.length; i++){
              if (argonauta[i].de == para){
                document.getElementById("chatdiv").innerHTML+= "<div class='chat'><p>"+argonauta[i].texto+"<span>&nbsp;&nbsp;&nbsp;"+argonauta[i].datetime+"&nbsp;&nbsp;&nbsp;</span></p></div>"
              }else{
                document.getElementById("chatdiv").innerHTML+= "<div class='chatyo'><p><span>&nbsp;&nbsp;&nbsp;"+argonauta[i].datetime+"&nbsp;&nbsp;&nbsp;</span>"+argonauta[i].texto+"</p></div>"
              }
            }
          }
        }
        ayax.open("POST", "leerMensajes.php")
        ayax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        ayax.send("de="+id+"&para="+para)
      }, 1500);
    }
</script>
</html>
