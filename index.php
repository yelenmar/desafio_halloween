<?php 
include('includes/conexion.php');
conectar();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Concurso de disfraces de Halloween</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="index.php">Ver Disfraces</a></li>
            <li><a href="index.php?modulo=procesar_registro">Registro</a></li>
            <li><a href="index.php?modulo=procesar_login">Iniciar Sesión</a></li>
            <li><a href="index.php?modulo=procesar_disfraz">Panel de Administración</a></li>
        </ul>
    </nav>
    <header>
        <h1>Concurso de disfraces de Halloween</h1>
    </header>
    <main>

        <?php 
            if(!empty($_GET['modulo'])){
                include('modulos/'.$_GET['modulo'].'.php');
            }else{
                $sql="SELECT *FROM disfraces ORDER BY votos DESC";
                $sql= mysqli_query($con,$sql);
                if(mysqli_num_rows($sql)!= 0){
                    while($r = mysqli_fetch_array($sql)){
                        ?>
                            <section id="disfraces-list" class="section">
                                <!-- se muestram los disfraces -->
                                <div class="disfraz">
                                    <h2><?php echo $r['nombre'];?></h2>
                                    <p> descripcion: <?php echo $r['descripcion'];?></p>
                                    <p>Votos: <?php echo $r['votos'];?></p>
                                    <p><img src="imagenes/fondo.jpg" <?php echo $r['foto'];?> width="100%"></p>
                                    <button class="votar">Votar </button></button>
                                </div>
                                <!-- Repetir la estructura para mas disfraces -->
                            </section>  
                        <?php
                    }

                }else{
                    ?>
                        <section id="disfraces-list" class="section">
                            <!-- Aqui se mostraran los disfraces -->
                            <div class="disfraz">
                                <h2>No hay datos.</h2>
                            </div>
                            <!-- Repitre la estructura para mas disfraces -->
                        </section>  

                    <?php  
                }    
            } 
        ?>    
    </main>
    <script src="js/script.js"></script>

</body>
</html>
