<?php

/**
 * Description of controler
 *
 * @author azrak
 */
function __autoload($className) {
    include_once("modelo/$className.php");
}

if (filter_input(INPUT_POST, 'action')) {
    $actions_array = filter_input_array(INPUT_POST);

    switch (filter_input(INPUT_POST, 'action')) {

        case 'login':
            authenticate(filter_input(INPUT_POST, 'usuario'), filter_input(INPUT_POST, 'password'));
            break;

        case 'logout':
            echo 'cerrando session ...';
            session_start();
            session_destroy();
            echo "<script type='text/javascript'> alert('Has cerrado session ,adios.!'); </script>";
            header("refresh:0,url=index.html");
            break;

        case 'show':
            page_controler::init();
            page_controler::shwNotas($actions_array['dni'], $actions_array['apellido']);
            break;

        case 'add_user':
            $empty = (empty($actions_array['dni']) || empty($actions_array['apellido']) || empty($actions_array['tipo_usuario']) );
            if ($empty) {
                echo "<script type='text/javascript'> alert('introduzca todos los datos !'); </script>";
                header("refresh:0,url=../../process.php");
            } else {
                db_manager::connect();
                db_manager::addUser($actions_array['dni'], $actions_array['apellido'], $actions_array['tipo_usuario']);
                header("refresh:0,url=../../process.php");
            }
            break;

        default:
            header("refresh:0,url=../../process.php");
            break;
    }
}

function authenticate($_dni, $_apellido) {


    $res = NULL;
    try {

        db::init();
        db::setTable('usuarios');
        $sql = "SELECT * FROM usuarios WHERE dni = :dni";
        $query = db_manager::$db->prepare($sql);
        $query->execute(array(':dni' => $_dni));
        $res = $query->fetchAll();
    } catch (PDOException $e) {
        echo $e->getMessage();
        $query = null;
    }
    if ($res) {

        if ($res[0]->apellido == $_apellido) {
            //setcookie($_dni, $_apellido, time()+3600);
            //if (!(session_status() === PHP_SESSION_ACTIVE)) {
            session_start();
            //}
            $_SESSION['loged'] = $_dni;
            $_SESSION['apellido'] = $res[0]->apellido;
            page_controler::showPage();
        } else {
            echo "<script type='text/javascript'> alert('apellido incorrecto'); </script>";
            header("refresh:0,url=index.html");
        }
    } else {
        echo "<script type='text/javascript'> alert('no existe tal usuario'); </script>";
        header("refresh:0,url=index.html");
    }
}
