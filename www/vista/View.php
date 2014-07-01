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

    public static function get_table_head($prop) {
        $table_head_row = NULL;

        foreach ($prop as $th) {
            $table_head_row .= '<th>' . $th . '</th>';
        }
        return '<th>Ver</th>' . $table_head_row;
    }

    public static function get_table_body($entity_data) {
        $table_body_rows = NULL;

        foreach ($entity_data as $rows) {
            $td = '';
            foreach ($rows as $row) {
                if (!$td) {

                    $td .= '<td><button type="submit" name="id" value="' . $row . '"  class="btn btn-info btn-xs">'
                            . '<span class="glyphicon glyphicon-eye-open"></span></button></td>';
                }

                $td .= '<td>' . $row . '</td>';
            }

            $table_body_rows .='<tr>' . $td . '</tr>';
        }


        return $table_body_rows;
    }

    public static function getCategory_menu($category_data) {
        $category_li = '';
        foreach ($category_data as $category) {
            $category_li .= '<li>
                <button name="id" value="' . $category->codigo . '" class="btn btn-default" >' . $category->nombre . ' </button>
                </li>';
        }
        $menu = '<div class="col-sm-2">
                <nav class="navbar navbar-default" role="navigation">
                    <div class="navbar-header">
                        <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav1"><span class="sr-only">Toggle navigation</span>  <span class="icon-bar"></span>  <span class="icon-bar"></span>  <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div style="height: 0px;" class="navbar-collapse collapse" id="nav1">
                    <form method="post" action="process.php">
                    <input type="hidden" name="action" value="showByCategory">
                        <ul class="nav nav-pills nav-stacked">
                            ' . $category_li . '
                        </ul>
                        </form>
                    </div>
                </nav>
            </div>';

        return $menu;
    }

    public static function getGrid_menu($user) {

        // ToDo process $user privilege to show hide menusItems
        $grid = ' <div class = "col-md-9 col-md-push-2">
                <div class = "row">
                <div class = "col-xs-6 col-md-3">
                
                <form method="POST" action="process.php">
                    <input type="hidden" name="action" value="show">
                            
                <button name="show" value="usuarios" class = "thumbnail">
                <img src = "imgs/Entypo_d83d(0)_256.png" alt = "usuarios" class = "img-responsive img-circle" width = "150">
                <span><b>Usuarios</b></span>
                </button>
                </div>
                
                <div class = "col-xs-6 col-md-3">
                <button name="show" value="clientes" class = "thumbnail">
                <img src = "imgs/Entypo_e7a6(0)_256.png" alt = "clientes" class = "img-responsive img-circle" width = "150">
                <span><b>Clientes</b></span>
                </button>
                </div>
                
                <div class = "col-xs-6 col-md-3">
                <button name="show" value="productos" class = "thumbnail">
                <img src = "imgs/icomoon_e65b(0)_256.png" alt = "productos" class = "img-responsive img-circle" width = "150">
                <span><b>Productos</b></span>
                </button>
                </div>
                
                <div class = "col-xs-6 col-md-3">
                <button name="show" value="categorias" class = "thumbnail">
                <img src = "imgs/icomoon_e65b(0)_256.png" alt = "categorias" class = "img-responsive img-circle" width = "150">
                <span><b>Categorias</b></span>
                </button>
                </div>

                <div class = "col-xs-6 col-md-3">
                <button name="show" value="proveedores" class = "thumbnail">
                <img src = "imgs/icomoon_e657(0)_256.png" alt = "proveedores" class = "img-responsive img-circle" width = "150">
                <span><b>Proveedores</b></span>
                </button>
                </div>

                <div class = "col-xs-6 col-md-3">
                <button name="show" value="presupuestos" class = "thumbnail">
                <img src = "imgs/linecons_e020(0)_256.png" alt = "presupuestos" class = "img-responsive img-circle" width = "150">
                <span><b>Presupuestos</b></span>
                </button>
                </div>

                <div class = "col-xs-6 col-md-3">
                <button name="show" value="pedidos" class = "thumbnail">
                <img src = "imgs/icomoon_e65a(0)_256.png" alt = "pedidos" class = "img-responsive img-circle" width = "150">
                <span><b>Pedidos</b></span>
                </button>
                </div>
                
                <div class = "col-xs-6 col-md-3">
                <button name="show" value="facturas" class = "thumbnail">
                <img src = "imgs/icomoon_e653(0)_256.png" alt = "facturas" class = "img-responsive img-circle" width = "150">
                <span><b>Facturas</b></span>
                </button>
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
                <link href = "' . self::$path . 'bootstrap/css/bootstrap.min.css" rel = "stylesheet" type = "text/css">
                <link href = "' . self::$path . 'costume.css" rel = "stylesheet" type = "text/css">
                <script type = "text/javascript" src = "' . self::$path . 'bootstrap/js/jquery.min.js"></script>
<script type="text/javascript" src="' . self::$path . 'bootstrap/js/bootstrap.min.js"></script>
</head>';
        return $header;
    }

    public static function getTopMenu($user) {
        $tMenu = '<div class="navbar navbar-default navbar-inverse navbar-static-top">

            <div class="container">
                <div class="navbar-header">

                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                </div>
                <div style="height: 0px;" class="navbar-collapse  navbar-ex1-collapse collapse">



                    <div class="col-md-12 pull-right">
                        <div class="col-md-3">
                            <img src="' . self::$path . 'imgs/logo.png" class="img-responsive img-circle" width="200">
                            
                        </div> 
                        <form method="POST" action="process.php">
                            <input type="hidden" name="action" value="show">

                            
                        <ul class="nav nav-pills pull-left navbar-inverse menu-top">
                           
                            <li>
                                <button class="btn btn-primary" name="show" value="home">Inicio</button>
                            </li>
                            <li>   
                                <button class="btn btn-primary" name="show" value="usuarios">Usuarios</button>
                            </li>
                            <li>
                                <button class="btn btn-primary" name="show" value="clientes">Clientes</button>
                            </li>
                            <li>
                                <button class="btn btn-primary" name="show" value="productos">Productos</button>
                            </li>
                            <li>
                                <button class="btn btn-primary" name="show" value="categorias">Categorias</button>
                            </li>
                            <li>
                                <button class="btn btn-primary" name="show" value="proveedores">Proveedores</button>
                            </li>
                            <li>
                                <button class="btn btn-primary" name="show" value="presupuestos">Presupuestos</button>
                            </li>
                            <li>
                                <button class="btn btn-primary" name="show" value="pedidos">Pedidos</button>
                            </li>
                            <li>
                                <button class="btn btn-primary" name="show" value="facturas">Facturas</button>
                            </li>
                           
                        </ul> 
                         <div class="nav nav-pills pull-right navbar-inverse menu-top">
                            <p class="label label-sm"><b>' . $user . '</b></p>
                                <button class="btn btn-default btn-sm"  name="action" value="logout">Salir</button>
                            <p class="label label-sm"><b>  </b>
                            </p><a class="btn btn-danger btn-sm"  href="process.php/?action=config">Configuracion</a> 
                            <a class="btn btn-danger btn-sm" href="./help/Manual-BackEnd.html">?</a> 
                        </div></form>
        <hr>
                    </div>

                </div>
            </div>
            <hr>
        </div>';
        return $tMenu;
    }

    public static function getCategory_list($category_data, $selected) {
        
        $list = '';
        $selected = '';
        foreach ($category_data as $key) {
            if ($key->codigo === $selected) {
                $selected = "selected='selected'";
            }
            $list .= "<option value=$key->codigo  $selected  >$key->nombre</option>";
        }
        return $list;
    }

    public static function getIva_list($iva_data, $selected) {
        
        $list = '';
        $selected = '';
        foreach ($iva_data as $key) {
            if ($key->id_tipo === $selected) {
                $selected = "selected='selected'";
            }
            $list .= "<option value=$key->id_tipo  $selected  >$key->nombre_tipo</option>";
        }
        return $list;
    }
}
