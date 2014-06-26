<?php

class View {

    private static $data;
    private static $path;

    function __construct() {
        
    }

    public static function setData($data) {
        self::$path = getcwd() . '/vista/templates/';
        self::$data = $data;
    }

    public static function delData() {
        self::$data = NULL;
    }

    public static function showTemplate($tplFile) {

        $dir = self::$path;
        if (file_exists($dir . $tplFile)) {
            var_dump($dir . $tplFile);
            $output = file_get_contents($dir . $tplFile);
            foreach (self::$data as $key => $val) {
                $replace = '{' . $key . '}';
                $output = str_replace($replace, $val, $output);
            }

            echo $output;

            return;
        } else {
            echo "<script type='text/javascript'> alert('no  existe la plantilla $dir . $tplFile '); </script>";
            header("refresh:3,url=index.html");
        }
    }

    public static function getEntity_table($entity) {
        $data = NULL;
        $table_head_rows = NULL;
        $table_body_rows = NULL;

        $entity_class = new $entity();

        $rows = db::get_values_by_tableName($entity);
        $prop = $entity_class->getProperty();


        foreach ($prop as $th) {
            $table_head_rows .= '

        <th>' . $th . '</th>';
        }
        $data['table_head_tr'] = $table_head_rows;



        foreach ($rows as $rows) {
//            foreach ($values as $value) {
//                $table_body_td .= '<td>' . $value . '</td>';
//            }
            //$table_body_rows = '<tr>' . $table_body_td . '</tr>';
        }
        $data['table_body_rows'] = $table_body_rows;

        return $data;
    }

    public static function getCategory_menu($category_data) {
        $category_li = '';
        foreach ($category_data as $category) {
            $category_li .= '<li>
                <a href = "process.php/?action=showCategory&id=' . $category->codigo . '" data-target = "#tab1" data-toggle = "tab">' . $category->nombre . ' < / a>
                </li>';
        }
        

        return $category_li;
    }

    public static function getGrid_menu($user) {

        // ToDo process $user privilege to show hide menusItems
        $grid = ' <div class = "col-md-9 col-md-push-2">
                <div class = "row">
                <div class = "col-xs-6 col-md-3">
                <a href = "process.php/?action=show&show=usuarios" class = "thumbnail">
                <img src = "imgs/Entypo_d83d(0)_256.png" alt = "usuarios" class = "img-responsive img-circle" width = "150">
                <span><b>Usuarios</b></span>
                </a>
                </div>
                <div class = "col-xs-6 col-md-3">
                <a href = "process.php/?action=show&show=clientes" class = "thumbnail">
                <img src = "imgs/Entypo_e7a6(0)_256.png" alt = "clientes" class = "img-responsive img-circle" width = "150">
                <span><b>Clientes</b></span>
                </a>
                </div>
                <div class = "col-xs-6 col-md-3">
                <a href = "process.php/?action=show&show=productos" class = "thumbnail">
                <img src = "imgs/icomoon_e65b(0)_256.png" alt = "productos" class = "img-responsive img-circle" width = "150">
                <span><b>Productos</b></span>
                </a>
                </div>

                <div class = "col-xs-6 col-md-3">
                <a href = "process.php/?action=show&show=proveedores" class = "thumbnail">
                <img src = "imgs/icomoon_e657(0)_256.png" alt = "proveedores" class = "img-responsive img-circle" width = "150">
                <span><b>Proveedores</b></span>
                </a>
                </div>

                <div class = "col-xs-6 col-md-3">
                <a href = "process.php/?action=show&show=presupuestos" class = "thumbnail">
                <img src = "imgs/linecons_e020(0)_256.png" alt = "presupuestos" class = "img-responsive img-circle" width = "150">
                <span><b>Presupuestos</b></span>
                </a>
                </div>

                <div class = "col-xs-6 col-md-3">
                <a href = "process.php/?action=show&show=pedidos" class = "thumbnail">
                <img src = "imgs/icomoon_e65a(0)_256.png" alt = "pedidos" class = "img-responsive img-circle" width = "150">
                <span><b>Pedidos</b></span>
                </a>
                </div>
                <div class = "col-xs-6 col-md-3">
                <a href = "process.php/?action=show&show=facturas" class = "thumbnail">
                <img src = "imgs/icomoon_e653(0)_256.png" alt = "facturas" class = "img-responsive img-circle" width = "150">
                <span><b>Facturas</b></span>
                </a>
                </div>
                </div>
                </div>

        ';

        return $grid;
    }

    public static function getHeader() {
        $header = '<head>
                <meta charset = "utf-8">
                <title>Productos</title>
                <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
                <meta name = "description" content = "">
                <meta name = "author" content = "">
                <link href = "'.self::$path.'bootstrap/css/bootstrap.min.css" rel = "stylesheet" type = "text/css">
                <script type = "text/javascript" src = "'.self::$path.'bootstrap/js/jquery.min.js"></script>
<script type="text/javascript" src="'.self::$path.'bootstrap/js/bootstrap.min.js"></script>
</head>';
        return $header;
    }

}
