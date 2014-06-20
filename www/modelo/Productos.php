<?php

require_once '../dbManager.php';

class Productos {

    private static $nombre;
    private static $marca;
    private static $precio;
    private static $iva;
    private static $descuento;
    private static $unidad_medida;
    private static $descripcion;
    private static $estoc;
    private static $vendible;
    private static $favorito;
    private static $categoria;

    function __construct() {
        
    }

    public static function neuvo($nombre, $marca, $precio, $iva, $descuento, $unidad_medida, $descripcion, $estoc, $vendible, $favorito, $categoria) {


        $self::$nombre = $nombre;
        $self::$marca = $marca;
        $self::$precio = $precio;
        $self::$iva = $iva;
        $self::$descuento = $descuento;
        $self::$unidad_medida = $unidad_medida;
        $self::$descripcion = $descripcion;
        $self::$estoc = $estoc;
        $self::$vendible = $vendible;
        $self::$favorito = $favorito;
        $self::$categoria = $categoria;
    }

    public static function guardar() {

        try {
            $sql = "INSERT INTO producto ( nombre,"
                    . " marca, precio, iva, descuento,"
                    . " unidad_medida, descripcion, estoc,"
                    . " vendible, favorito) VALUES (:codigo, :nombre,"
                    . " :marca, :precio, :iva, :descuento,"
                    . " :unidad_medida, :descripcion, "
                    . ":estoc, :vendible, :favorito)";
            $query = self::$db->prepare($sql);
            $ok = $query->execute(array(
                ':nombre' => self::$nombre,
                ':marca' => self::$marca,
                ':precio' => self::$precio,
                ':iva' => self::$iva,
                ':descuento' => self::$descuento,
                ':unidad_medida' => self::$unidad_medida,
                ':descripcion' => self::$descripcion,
                ':estoc' => self::$estoc,
                ':vendible' => self::$vendible,
                ':favorito' => self::$favorito
            ));
            //echo "Query= $ok";
            $query = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
            $query = null;
        }
    }

    public static function modificar($codigo) {

        try {
            $sql = "UPDATE producto SET ( nombre,"
                    . " marca, precio, iva, descuento,"
                    . " unidad_medida, descripcion, estoc,"
                    . " vendible, favorito) VALUES (:codigo, :nombre,"
                    . " :marca, :precio, :iva, :descuento,"
                    . " :unidad_medida, :descripcion, "
                    . ":estoc, :vendible, :favorito) WHERE codigo= :codigo";
            $query = self::$db->prepare($sql);
            $ok = $query->execute(array(
                ':nombre' => self::$nombre,
                ':marca' => self::$marca,
                ':precio' => self::$precio,
                ':iva' => self::$iva,
                ':descuento' => self::$descuento,
                ':unidad_medida' => self::$unidad_medida,
                ':descripcion' => self::$descripcion,
                ':estoc' => self::$estoc,
                ':vendible' => self::$vendible,
                ':favorito' => self::$favorito,
                ':codigo' => $codigo
            ));
            //echo "Query= $ok";
            $query = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
            $query = null;
        }
    }

    function optenerUno($codigo) {

        try {
            $sql = "SELECT * FROM productos WHERE codigo= :codigo";
            $query = self::$db->prepare($sql);
            $ok = $query->execute(array(
                ':codigo' => $codigo
            ));
            //echo "Query= $ok";
            $query = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
            $query = null;
        }

        return $query->fetchColumn();
    }

    // obtener lista limitada page=offset
    function listar_por_paginas($page, $limit) {

        try {

            $start = $page * $limit;

            self::$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
            $sth = self::$db->prepare("SELECT * FROM productos LIMIT ?,?");
            $sth->execute(array($start, $limit));
            $query = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
            $query = null;
        }

        return $query->fetchAll();
    }
}
