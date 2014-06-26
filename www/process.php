<?php

/**
 * Description of controler
 *
 * @author azrak
 */
function __autoload($className) {
    include_once("modelo/$className.php");
}

if (filter_input(INPUT_GET, 'action')) {
    $actions_array = filter_input_array(INPUT_GET);

    switch (filter_input(INPUT_GET, 'action')) {

        case 'login':
            authenticate(filter_input(INPUT_GET, 'usuario'), filter_input(INPUT_GET, 'password'));
            break;

        case 'logout':
            echo 'cerrando session ...';
            session_start();
            session_destroy();
            echo "<script type='text/javascript'> alert('Has cerrado session ,adios.!'); </script>";
            header("refresh:0,url=index.html");
            break;

        case 'show':
            $entity = filter_input(INPUT_GET, 'show');
            $category_data = db::get_values_by_tableName('categorias');
            $data = View::getEntity_table($entity);
            $data['category_menu'] = View::getCategory_menu($category_data);
            View::setData($data);
            View::showTemplate($entity.'html');
            break;

        case 'save':
            $entity = filter_input(INPUT_GET, 'show');
            break;
        
        case 'update':
            $entity = filter_input(INPUT_GET, 'show');
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

            $_SESSION['pass'] = $res->password;

            $data['user'] = $_SESSION['user'] = $res->usuario;

            $data['container'] = View::getGrid_menu('');
            View::setData($data);
            View::showTemplate('home.html');
        } else {
            echo "<script type='text/javascript'> alert('contaseña incorrecto'); </script>";
            header("refresh:0,url=index.html");
        }
    } else {
        echo "<script type='text/javascript'> alert('no existe tal usuario'); </script>";
        header("refresh:0,url=index.html");
    }
}
