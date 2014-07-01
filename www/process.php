<?php

/**
 * Description of controler
 *
 * @author azrak
 */
include_once './vista/View.php';

function __autoload($className) {
    include_once("modelo/$className.php");
}

if (filter_input(INPUT_POST, 'action')) {
    $actions_array = filter_input_array(INPUT_POST);

    switch (filter_input(INPUT_POST, 'action')) {

        case 'login':
            authenticate($actions_array ['usuario'], $actions_array['password']);
            break;

        case 'logout':
            echo 'cerrando session ...';
            session_start();
            session_destroy();
            echo "<script type='text/javascript'> alert('Has cerrado session ,adios.!'); </script>";
            header("refresh:0,url=index.html");
            break;

        case 'show':
            $entity = $actions_array['show'];
            if ($entity === 'home') {
                go_home();
                return;
            }
            db::init();
            db::setTable($entity);
            $entity_class = new $entity();
            $visible_entity_property = $entity_class->get_visble_columns();
            $entity_data = db::get_columns_value($visible_entity_property, NULL);

            renderTable($entity, $visible_entity_property, $entity_data);
            break;

        case 'showByCategory':
            db::init();
            db::setTable('productos');
            $entity_class = new Productos();
            $visible_entity_property = $entity_class->get_visble_columns();
            $entity_data = $entity_data = db::get_columns_value($visible_entity_property, $actions_array['id']);

            renderTable('productos', $visible_entity_property, $entity_data);

            break;

        case 'edit':
            $entity = $actions_array['entity'];
            showForm($entity, $actions_array['id']);
            break;

        case 'save':
            $entity = $actions_array['entity'];
//            db::init();
//            db::setTable($entity);
            $entity_class = new $entity();
            foreach ($entity_class as $key => $value) {
                $value = $actions_array[$key];
            }
            $entity_class->save();
            break;

        default:
            header("refresh:0,url=../../process.php");
            break;
    }
}

function renderTable($entity, $visible_entity_property, $entity_data) {
    $data = array();

    session_start();
    $data['entity'] = $entity;
    $data['user'] = $_SESSION['user'];
    $data['header'] = View::getHeader();
    $data['top_menu'] = View::getTopMenu($_SESSION['user']);
    //show category Menu
    if ($entity === 'productos') {
        $category_data = db::get_values_by_tableName('categorias');
        $data['category_menu'] = View::getCategory_menu($category_data);
    } else {
        $data['category_menu'] = '';
    }
    $data['table_head_tr'] = View::get_table_head($visible_entity_property);
    $data['table_body_rows'] = View::get_table_body($entity_data);

    View::setData($data);
    View::showTemplate('entity.html');
}

function showForm($entity, $id) {

    $data = array();
    $entity_class = new $entity();
    $entity_property = $entity_class->getProperty();

    $entity_data = $entity_class->get_from_table($entity_property[0], $id);
    foreach ($entity_data[0] as $key => $value) {
        $data[$key] = $value;
    }
 

    session_start();

    $data['entity'] = $entity;
    $data['user'] = $_SESSION['user'];
    $data['header'] = View::getHeader();
    $data['top_menu'] = View::getTopMenu($_SESSION['user']);

    if ($entity === 'productos') {
        db::init();
        $category_data = db::get_values_by_tableName('categorias');
        $data['id_categoria'] = View::getCategory_list($category_data, $data['id_categoria']);
    }
    //var_dump($data);
    View::setData($data);
    $file = $entity . 'Form.html';
    View::showTemplate($file);
}

function authenticate($user, $pass) {


    $res = NULL;
    try {

        db::init();
        db::setTable('usuarios');
        $sql = "SELECT * FROM usuarios WHERE nombre = :user";
        $query = db::getConnection()->prepare($sql);
        $query->execute(array(':user' => $user));
        $res = $query->fetchObject();
    } catch (PDOException $e) {
        echo $e->getMessage();
        $query = null;
    }
    if ($res) {

        if (($res->password) == $pass) {
            //setcookie($_dni, $_apellido, time()+3600);
            //if (!(session_status() === PHP_SESSION_ACTIVE)) {
            session_start();
            //}

            $_SESSION['pass'] = $res->password;
            $_SESSION['user'] = $res->nombre;
            go_home();
        } else {
            echo "<script type='text/javascript'> alert('contaseña incorrecto'); </script>";
            header("refresh:0,url=index.html");
        }
    } else {
        echo "<script type='text/javascript'> alert('no existe tal usuario'); </script>";
        header("refresh:0,url=index.html");
    }
}

function go_home() {
//session_start();
    if (!(session_status() === PHP_SESSION_ACTIVE)) {
        session_unset();
        session_start();
        if (!empty($_SESSION['pass'])) {

            //authenticate($_SESSION['loged'], $_SESSION['apellido']);
        } else {
            header("refresh:0,url=index.html");
        }
    }

    $data['user'] = $_SESSION['user'];
    $data['header'] = View::getHeader();
    $data['top_menu'] = View::getTopMenu($_SESSION['user']);
    $data['container'] = View::getGrid_menu('');
    View::setData($data);

    View::showTemplate('home.html');
}
