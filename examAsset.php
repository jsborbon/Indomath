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

   // $exito =  $controller->leerEnDB("classes", $_GET);
    $clases =  $controller->leerEnDB("classes2", $_GET);
    echo "<script type='module'>imprimirClases(".$clases.")</script>";
    echo "<script type='module'>mostrarClase(".$clases.")</script>";

/*
    foreach ($exito as $item=>$value){
        $$item = $value;
    }
    $tituloModulo = $titulo;
    $tituloClase = $nombre;
    $introduccion = $resumen;
    $numLecciones = $numLecciones;
    $duracionLeccion = $cduracion;
    $duracionExamen = $eduracion;
    $duracionTotal = $duracionLeccion + $duracionExamen;
    $fuenteVideo = $video;
    $descripcionClase = $contenido;
    $id=$id_modulo;
    $examen=$examenURL;
*/
}
?>

<script>
    function imprimirClases(clases){
       // console.log(clases);
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
        document.querySelector(".contenidoClase").innerHTML = "<p>"+datos['contenido']+"</p>";


    }
</script>
<main>
    <h5 class="tituloModulo"><?php //$tituloModulo ?></h5>
    <h1 class="tituloClase"><?php //$tituloClase ?></h1>
    <aside class="claseContenido">
        <ul class="listaClases">
            <li><a href="<?php // 'classAssetIntroduction.php?id='.$id?>">Resumen del tema</a></li>
            <li id="lecciones">Lecciones <strong><?php // $numLecciones?></strong></li>
            <ul class="listaLecciones"></ul>
        </ul>
    </aside>
    <section class="claseContenido">
        <div class="examenContendor">
            <?php //echo $examen?>
        </div>
    </section>
</main>

<?php include "Includes/footer.php" ?>
</body>
</html>
