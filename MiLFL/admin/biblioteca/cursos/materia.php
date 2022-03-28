<?php

    session_start();

    include '../../../assets/php/conexion_bd.php';
    include 'gestor.php';

    $id_materia = $_GET['id_materia'];

    //Obtenemos el nombre de la materia.
    $query_materia = mysqli_query($conexion, "SELECT nombre FROM materias WHERE id='$id_materia'");
    $materia_array = mysqli_fetch_array($query_materia);
    $nombre_materia = $materia_array[0];

    //Obtenemos los archivos de esta materia.
    $query_archivos = mysqli_query($conexion, "SELECT * FROM archivos WHERE id_materia='$id_materia'");
    $result_archivos = mysqli_num_rows($query_archivos);

    if (isset($_SESSION['alumnos'])) {

        $dni = $_SESSION['alumnos'];

        //Obtenemos el campo "curso_id" de la tabla de materias.
        $query_curso_id = mysqli_query($conexion, "SELECT curso_id FROM materias WHERE id='$id_materia'");
        $curso_id_array = mysqli_fetch_array($query_curso_id);
        $curso_id = $curso_id_array[0];

        //Obtenemos el curso del alumno.
        $query_curso = mysqli_query($conexion, "SELECT curso FROM alumnos WHERE dni='$dni'");
        $curso_array = mysqli_fetch_array($query_curso);
        $curso = $curso_array[0];

        //Si el alumno se mete en una materia que no corresponde a su curso, se envia a la pantalla de selección.
        if ($curso != $curso_id) {
            header("location:elegir-materias.php?curso=$curso");
        }

    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>MiLFL - Biblioteca</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../../assets/img/logo.png">
    <link rel="stylesheet" type="text/css" href="../../../assets/css/normalize.css">
    <link rel="stylesheet" type="text/css" href="../../../assets/css/general-style.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/style-materia.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/41b6154676.js" crossorigin="anonymous"></script>
</head>
<body>
    
        <!--El preloader-->
    <div class="lds-ring loader">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
    </div>

    <!--Empieza el header-->
    <header class="header">

        <!--Nav para navegar por la página-->
        <nav class="nav">

            <div class="nav__repsonsive-div">

                <div class="nav__logo">
                    <a class="nav__logo-link" href="../../../inicio.php">
                        <img class="nav__img" src="../../../assets/img/logo.png" alt="Logo del Instituto Luis Federico Leloir, Instituto Luis Federico Leloir">
                        <h1 class="nav__title">Instituto Luis Federico Leloir</h1>
                    </a>
                </div>

                <i class="nav__menu-button fas fa-bars" id="menu-button"></i>

            </div>

            <ul class="nav__options-bar">
                <li class="nav__item">
                    <a class="nav__link" href="../../../inicio.php">INICIO</a>
                </li>
                <li class="nav__item">
                    <a class="nav__link" href="../elegir-cursos.php">BIBLIOTECA</a>
                </li>
                <li class="nav__item">
                    <a class="nav__link" href="../../cuaderno/cuaderno.php">CUADERNO DE COMUNICADOS</a>
                </li>
                <li class="nav__item">
                    <a class="nav__link" href="#">MI CUENTA</a>
                </li>
                <li class="nav__item">
                    <a class="nav__link" href="../../../assets/php/cerrar_sesion.php">CERRAR SESIÓN</a>
                </li>
            </ul>

        </nav>

    </header>
    
    <main class="main">

        <section class="titulo">
            <h2 class="titulo__title"><?php echo $nombre_materia ?></h2>
        </section>

        <section class="archivos">

            <?php
                if ($result_archivos > 0) {
            ?>

            <table class="archivos__table">

                <tr class="archivos__row">
                    <td class="archivos__data">Nombre</td>
                    <td class="archivos__data">Tipo de archivo</td>
                    <td class="archivos__data">Visualizar</td>
                    <td class="archivos__data">Descargar</td>
                    <td class="archivos__data">Eliminar</td>
                </tr>

                <?php
                        //Crea una fila por archivo.
                        while ($data = mysqli_fetch_array($query_archivos)) {
                ?>

                <tr class="archivos__row">
                    <td class="archivos__data"><?php echo $data['nombre'] ?></td>
                    <td class="archivos__data"><?php echo $data['tipo'] ?></td>
                    <td class="archivos__data">

                        <!--
                            * Este <a> de abajo es el boton de visualizar. La idea de esto es que cada <a> (o algo relacionado)
                            * guarde el $data['id_archivo'], para que cuando lo clickees, envie el id_archivo a la función
                            * "obtenerArchivo()", y que esta cree la etiqueta correspondiente para el modal.  
                        -->

                        <a href="#" class="archivos__link archivos__link--visualizar">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                    </td>
                    <td class="archivos__data">
                        <a href="../archivos/<?php echo $data['nombre'] ?>"
                           download
                           class="archivos__link archivos__link--descargar">
                            <i class="fa-solid fa-download"></i>
                        </a>
                    </td>
                    <td class="archivos__data">
                        <a href="../eliminar-archivo.php?id=<?php echo $data['id_archivo'] ?>&id_materia=<?php echo $id_materia ?>"
                           class="archivos__link archivos__link--eliminar link_delete">
                            <i class="fa-solid fa-trash-can"></i>
                        </a>
                    </td>
                </tr>

                <?php
                    }
                ?>

            </table>

            <?php
                //Si no hay archivos en dicha materia, se muestra este texto:
                } else {
            ?>

            <p class="archivos__text">Aún no hay archivos cargados para esta materia.</p>

            <?php
                }
            ?>

        </section>

        <section class="modal">

            <div class="modal__background"></div>

            <div class="modal__container">

                <?php
                    /* 
                     * obtenerArchivo() agarra el id_archivo de un archivo y crea una etiqueta correspondiente a su extensión.
                     * El id_archivo 12 es de una imagen.
                     */
                    echo obtenerArchivo(12);
                ?>

            </div>

            <div href="#" class="modal__close-button">
                    <i class="modal__icon fa-solid fa-xmark"></i>
            </div>

        </section>

    </main>

    <script src="../../../assets/js/loader.js"></script>
    <script src="../../../assets/js/nav-responsive.js"></script>
    <script src="../../assets/js/modal-previsualizar.js"></script>
    <script src="../../assets/js/eliminacion.js"></script>
</body>
</html>