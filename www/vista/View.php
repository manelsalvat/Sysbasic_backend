<?php

class View {

    private static $data;

    function __construct() {
        
    }

    public static function setData($data) {
        self::$data = $data;
    }

    public static function showEntity($entity) {
        // TODO show page based on entity name and passed data.
        self::$data['header'] = self::getHeader();
        self::$data = $data;

        self::showTemplate($entity . 'html');
    }
    public static function showHome() {
        // TODO show page based on entity name and passed data.
        self::$data['header'] = self::getHeader();
        self::$data['container'] = self::getGrid_menu(self::$data['user']);
        self::showTemplate($entity . 'html');
    }
    
    

    public static function delData() {
        self::$data = NULL;
    }

    public static function showTemplate($tplFile) {

        if (file_exists($tplFile)) {
            $output = file_get_contents($tplFile);
            foreach (self::$data as $key => $val) {
                $replace = '{' . $key . '}';
                $output = str_replace($replace, $val, $output);
            }
            echo $output;
        }
    }
    
    
    
    public static function getHeader() {

        $header = '<!DOCTYPE html>
            <html>
            <head>
            <meta charset = "utf-8">
            <title>sysBasicPro</title>
            <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
            <meta name = "description" content = "">
            <meta name = "author" content = "">
            <link href = "bootstrap/css/bootstrap.min.css" rel = "stylesheet" type = "text/css">
            <script type = "text/javascript" src = "bootstrap/js/jquery.min.js"></script>
            <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
            </head>';


        return $header;
    }
    
    public static function getNav_menu($user) {
        
        $nav=' ';
        
        return $nav;
        
    }
    public static function getGrid_menu($user) {
        
        // ToDo process $user privilege to show hide menusItems
        $grid=' <div class="col-md-9 col-md-push-2">
                <div class="row">
                    <div class="col-xs-6 col-md-3">
                        <a href="process.php/?action=show&show=usuarios" class="thumbnail">
                            <img src="imgs/Entypo_d83d(0)_256.png" alt="usuarios" class="img-responsive img-circle" width="150">
                            <span><b>Usuarios</b></span>
                        </a>
                    </div>
                    <div class="col-xs-6 col-md-3">
                        <a href="process.php/?action=show&show=clientes" class="thumbnail">
                            <img src="imgs/Entypo_e7a6(0)_256.png" alt="clientes" class="img-responsive img-circle" width="150">
                            <span><b>Clientes</b></span>
                        </a>
                    </div>
                    <div class="col-xs-6 col-md-3">
                        <a href="process.php/?action=show&show=productos" class="thumbnail">
                            <img src="imgs/icomoon_e65b(0)_256.png" alt="productos" class="img-responsive img-circle" width="150">
                            <span><b>Productos</b></span>
                        </a>
                    </div>

                    <div class="col-xs-6 col-md-3">
                        <a href="process.php/?action=show&show=proveedores" class="thumbnail">
                            <img src="imgs/icomoon_e657(0)_256.png" alt="proveedores" class="img-responsive img-circle" width="150">
                            <span><b>Proveedores</b></span>
                        </a>
                    </div>

                    <div class="col-xs-6 col-md-3">
                        <a href="process.php/?action=show&show=presupuestos" class="thumbnail">
                            <img src="imgs/linecons_e020(0)_256.png" alt="presupuestos" class="img-responsive img-circle" width="150">
                            <span><b>Presupuestos</b></span>
                        </a>
                    </div>

                    <div class="col-xs-6 col-md-3">
                        <a href="process.php/?action=show&show=pedidos" class="thumbnail">
                            <img src="imgs/icomoon_e65a(0)_256.png" alt="pedidos" class="img-responsive img-circle" width="150">
                            <span><b>Pedidos</b></span>
                        </a>
                    </div>
                    <div class="col-xs-6 col-md-3">
                        <a href="process.php/?action=show&show=facturas" class="thumbnail">
                            <img src="imgs/icomoon_e653(0)_256.png" alt="facturas" class="img-responsive img-circle" width="150">
                            <span><b>Facturas</b></span>
                        </a>
                    </div>
                </div>
            </div> ';
        
        return $grid;
        
    }
    
    public static function get_Category_menu($data) {
        
        
        
    }

}
