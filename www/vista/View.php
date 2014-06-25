<?php

class View {

    private static $data;

    function __construct() {
        
    }

    public static function setData($data) {
        self::$data = $data;
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
            </head>
            <body>';


        return $header;
    }

    public static function showEntity($entity) {
        // TODO show page based on entity name and passed data.
        self::$data['header'] = self::getHeader();
        self::$data = $data;

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

}
