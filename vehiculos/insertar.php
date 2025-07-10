<?php

if (!isset($_POST['matricula'])) {
    // Mueve el navegador hasta otra página si no se llegadesde el formulario
    header('Location:registro.php');
}
require_once('../plantillas/cabecera.php');

    $matricula = $_POST['matricula'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $tipo = $_POST['tipo'];
    $color= $_POST['color'];
    $fechaMat= $_POST['fecha_matriculacion'];
    $cilindrada=$_POST['cilindrada'];
    // $itv=$_POST['itv'] al ser checkbox llega ON, y la base de datos es un tinyINT, dara error siempre, hay que transformar string ON en un valor, se implementa mediante un operador ternario
    $itv = isset($_POST['itv']) && $_POST['itv'] == 'on' ? 1 : 0;

    
    // problema es que en la tabla ahora se muestra 1 o 0, para ello, otra variable, itv a texto, de nuevo con operador ternario
    $itvTexto = ($itv == 1) ? 'SI' : 'NO';
?>


    ?>

    <h2>Asignatura a insertar</h2>
    <ul>
        <li>Matricula: <?=$matricula?></li>
        <li>Marca: <?=$marca?></li>
        <li>Modelo: <?=$modelo?></li>
        <li>Tipo: <?=$tipo?></li>
        <li>Color: <?=$color?></li>
        <li>Fecha de Matriculación:<?=$fechaMat?></li>
        <li>Cilindrada:<?=$cilindrada?></li>
        <li>ITV pasada:<?=$itvTexto?></li>
    </ul>

    <?php 
        $consulta =     "INSERT INTO vehiculos(matricula,marca,modelo,tipo,color,fecha_matriculacion,cilindrada,itv_pasada)
     VALUES('$matricula','$marca','$modelo','$tipo','$color','$fechaMat',$cilindrada,$itv)";

           // ejecutamos la consulta
           $resultado = mysqli_query($conexion, $consulta);
           if ($resultado>0) {
                echo '<p>Se ha insertado la asignatura satisfactoriamente</p>';
           } else {
                echo "<p class='error'> Error al insertar la asignatura </p>";
           }
?>



<?php require_once('../plantillas/pie.php'); ?>