<!doctype html>
<html lang="es">

<?php
include "Includes/head.php";
include "Includes/nav.php";
require "php/Modelo/Usuario.php";
require "php/Modelo/classes.bd.php";
require "php/Controlador/Controller.php";
?>

<link rel="stylesheet" href="Css/claseStyle.css">
<?php
if (isset($_GET) && !empty($_GET)){

    $controller = new controller();
    $clases =  $controller->leerEnDB("classes2", $_GET);
    echo "<script type='module'>imprimirClases(".$clases.")</script>";
    echo "<script type='module'>mostrarClase(".$clases.")</script>";

//    $exito =  $controller->leerEnDB("classes", $_GET);
 //   $datos = json_encode($exito);

   // $descripcionClase = $contenido;
    //$id=$id_modulo;

    //echo "<script type='module'>llenarDatosClase(". $datos . ")</script>";


}
?>

<script>
    function imprimirClases(clases){
        let lecciones = document.querySelector(".listaLecciones");
        let leccion ="";
        for (let i =0; i<clases.length; i++) {
            leccion += '<li><a href="#" class="menuClases" onclick="desplegarSubmenu2()">Leccion '+(i+1)+' <strong>'+(parseInt(clases[i]["cduracion"])+parseInt(clases[i]["eduracion"]))+' min</strong><i class="fa-solid fa-angle-down"></i></></a><ul class="desplegableClases"><li><a href="classAsset.php?id='+clases[i]["id_modulo"]+'&c='+clases[i]["codigo_clase"]+'">Estudia<strong>'+clases[i]["cduracion"]+' min</strong></a></li><li><a href="examAsset.php?id='+clases[i]["codigo_examen"]+'">Practica<strong>'+clases[i]["eduracion"]+' min</strong></a></li></ul></li>';
        }
        lecciones.innerHTML = leccion;
    }

    function mostrarClase(datos){
        datos = datos[0];
        let tituloModulo = document.getElementsByClassName('tituloModulo')[0];
        tituloModulo.innerHTML = datos['titulo'];
        let tituloClase = document.getElementsByClassName('tituloClase')[0];
        tituloClase.innerHTML = datos['nombre'];
        let resumenTema = document.getElementById('resumenTema');
        resumenTema.setAttribute('href', "classAssetIntroduction.php?id="+datos['id_modulo']);
        let lecciones = document.getElementById('leccionesNum');
        lecciones.innerHTML = datos['numLecciones'];
        let video = document.getElementById('video');
        video.src = datos['video'];
        let module = document.getElementById('module');
        module.setAttribute('href', "examAsset.php?id="+datos['id_modulo']);
        document.querySelector(".contenidoClase").innerHTML = "<p><br>"+datos['contenido']+"</p><br><a class= 'editarClase' href='classCreator.php?id="+datos['id_modulo']+"&c="+datos['codigo_clase']+"' >Editar Clase</a>";


    }
</script>
<main>
    <h5 class="tituloModulo"></h5>
    <h1 class="tituloClase"></h1>
    <aside class="claseContenido">
        <ul class="listaClases">
            <li><a id="resumenTema" href="#">Resumen del tema</a></li>
            <li id="lecciones">Lecciones <strong id="leccionesNum"></strong></li>
            <ul class="listaLecciones"></ul>
        </ul>
    </aside>
    <section class="claseContenido">
        <div id="reproductor">
            <iframe id="video" width="100%" height="100%" src=""
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
        </div>
        <a id="module" href="#"><button id="testUnidad">Comprueba tus conocimientos</button></a>
        <div class="contenidoClase">
        </div>
    </section>
</main>

<?php include "Includes/footer.php" ?>
</body>
</html>
