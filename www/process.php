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



        default:
            header("refresh:0,url=../../process.php");
            break;
    }
}

function authenticate($user, $pass) {


    $res = NULL;
    try {

        db::init();
        db::setTable('usuarios');
        $sql = "SELECT * FROM usuarios WHERE password = :user";
        $query = db::getConnection()->prepare($sql);
        $query->execute(array(':user' => $user));
        $res = $query->fetchColumn();
    } catch (PDOException $e) {
        echo $e->getMessage();
        $query = null;
    }
    if ($res) {

        if (crypt($res->password, $pass) == $pass) {
            //setcookie($_dni, $_apellido, time()+3600);
            //if (!(session_status() === PHP_SESSION_ACTIVE)) {
            session_start();
            //}
            $_SESSION['secret'] = $res->password;
            $_SESSION['user'] = $res[0]->usuario;
            header("refresh:0,url=index.html");
        } else {
            echo "<script type='text/javascript'> alert('contaseña incorrecto'); </script>";
            header("refresh:0,url=index.html");
        }
    } else {
        echo "<script type='text/javascript'> alert('no existe tal usuario'); </script>";
        header("refresh:0,url=index.html");
    }
}
