<?php   require_once('../plantillas/cabecera.php'); ?>

<article>
    <h2>Listado de vehiculos matriculados</h2>

    <table class="table table-striped table-bordered table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>matricula</th>
                <th>marca</th>
                <th>modelo</th>
                <th>tipo</th>
                <th>color</th>
                <th>fecha matriculacion</th>
                <th>cilindrada</th>
                <th>itv pasada</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
       
       <?php
            if (isset($_POST['filtrar'])) {
                $lamatricula = $_POST['lamatricula'];



                $consulta="SELECT * FROM vehiculos WHERE CONCAT(matricula, ' ', marca, ' ', modelo, ' ', tipo, ' ', color, ' ', fecha_matriculacion, ' ', cilindrada, ' ', itv_pasada) like '%".$lamatricula."%'";
            }
            elseif (isset($_POST['filtrar_fecha'])){
                $fecha=$_POST['fecha'];
                $consulta= "SELECT * FROM vehiculos WHERE fecha_matriculacion > '".$fecha."'";
            }

             else {
                $consulta ="SELECT * FROM vehiculos";
            }

            $filas = mysqli_query($conexion, $consulta);


            while(($fila = mysqli_fetch_array($filas))==true){
                echo "<tr>\n";
                echo "<td> ".$fila['matricula']." </td>\n";
                echo "<td> ".$fila['marca']." </td>\n";
                echo "<td> ".$fila['modelo']." </td>\n";
                echo "<td> ".$fila['tipo']." </td>\n";
                echo "<td> ".$fila['color']. " </td>\n";
                echo "<td> ".$fila['fecha_matriculacion']. " </td>\n";
                echo "<td> ".$fila['cilindrada']. " </td>\n";
                $itv_texto = ($fila['itv_pasada'] == 1) ? 'SI' : 'NO';
                echo "<td> ".$itv_texto. " </td>\n";
                echo "<td><a href='../vehiculos/editar.php?matricula=".$fila['matricula']."' class='btn btn-primary'>Editar</a></td>\n";
                echo "<td><a href='../vehiculos/borrado.php?matricula=".$fila['matricula']."' class='btn btn-primary'>Eliminar</a></td>\n";
                echo "</tr>\n";
                
            }

        ?>     
        </tbody>
    </table>
    <div class="mensaje">
        <?php 
            if (isset($_SESSION['mensaje'])) {
                echo $_SESSION['mensaje'];
                unset($_SESSION['mensaje']);
            }
            ?>
    </div>
    <div class="mensaje">
        <?php 
            if (isset($_SESSION['mensaje'])) {
                echo $_SESSION['mensaje'];
                unset($_SESSION['mensaje']);
            }
            ?>
    </div>


    <h2>Buscar:</h2>
    <form action="../vehiculos/listado.php" method="post">
        <label for="lamatricula">Filtrar por Matricula </label>
        <input type="text" name="lamatricula" id="lamatricula">

        <input type="submit" name='filtrar' value="Filtrar">
        <a href="../vehiculos/listado.php">Limpiar filtro <br><br></a>
        <label for="fecha">Filtrar por fecha de matriculacion posterior a: </label>
        <input type="date" name="fecha" id="fecha">
        <input type="submit" name="filtrar_fecha" value="Filtrar por fecha">
        <a href="../vehiculos/listado.php">Limpiar filtro <br><br></a>
    </form>
    


</article>

<?php   require_once('../plantillas/pie.php'); ?>