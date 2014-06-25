<?php

use Entity;

/**
 * Clase producto que extiende de Entity relacionado con la tabla productos
 *
 * @author azrak 2014
 */
class Producto_por_documento extends Entity {

    public $numero_documento;
    public $codigo_producto;
    public $nombre_producto;
    public $marca_producto;
    public $descripcion_producto;
    public $precio_producto;
    public $cantidad;
    public $iva;
    public $recargo_equivalencia;
    public $descuento;
    

    
    function __construct() {
        
        
    }

    public function setNumero_documento($numero_documento) {
        $this->numero_documento = $numero_documento;
        return $this;
    }

    public function setCodigo_producto($codigo_producto) {
        $this->codigo_producto = $codigo_producto;
        return $this;
    }

    public function setNombre_producto($nombre_producto) {
        $this->nombre_producto = $nombre_producto;
        return $this;
    }

    public function setMarca_producto($marca_producto) {
        $this->marca_producto = $marca_producto;
        return $this;
    }

    public function setDescripcion_producto($descripcion_producto) {
        $this->descripcion_producto = $descripcion_producto;
        return $this;
    }

    public function setPrecio_producto($precio_producto) {
        $this->precio_producto = $precio_producto;
        return $this;
    }

    public function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
        return $this;
    }
    public function setIva($iva) {
        $this->iva = $iva;
        return $this;
    }
     
    public function setRecargo_equivalencia($recargo_equivalencia) {
        $this->recargo_equivalencia = $recargo_equivalencia;
        return $this;
    }

    public function setDescuento($descuento) {
        $this->descuento = $descuento;
        return $this;
    }



}
