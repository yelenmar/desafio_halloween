<?php 
session_start();

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
        <?php 
            if(!empty($_SESSION['nombre_usuario'])){
                ?>
                <p>hola <?php echo $_SESSION['nombre_usuario'];?> </p>
                <a href="index.php?modulo=procesar_login&salir=ok">SALIR</a>
                <?php
            }
        ?>

        
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
                                    <?php 
                                        if(!empty($_SESSION['nombre_usuario'])){
                                            //consulto si el usuario voto por el disfraz
                                            $sql_votos= "SELECT *FROM votos where id_disfraz=".$r['id']." and id_usuario=".$_SESSION['id'];
                                            $sql_votos = mysqli_query( $con,$sql_votos);


                                            if(mysqli_num_rows($sql_votos) == 0){
                                                ?>
                                                <form method="POST" action="index.php?modulo=procesar_votos">
                                                    <input type="hidden" name="id_disfraz" id="id_disfraz" value="<?php echo $r['id'];?>">
                                                    <button class="votar">Votar </button></button>
                                                </form>
                                                <?php
                                            }
                                        }
                                    ?>
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
