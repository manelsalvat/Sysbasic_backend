<?php

/**
 * Clase producto que extiende de Entity relacionado con la tabla productos
 *
 * @author azrak 2014
 */
class Productos extends Entity {

    public $codigo;
    public $nombre;
    public $marca;
    public $descripcion;
    public $precio;
    public $id_iva;
    public $descuento;
    public $unidad_de_medida;
    public $estoc;
    public $vendible;
    public $favorito;
    public $id_categoria;
    //protected $image_lnk;

    function __construct() {
        
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
        return $this;
    }

    public function setImage_lnk($image_lnk) {
        $this->image_lnk = $image_lnk;
        return $this;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
        return $this;
    }

    public function setMarca($marca) {
        $this->marca = $marca;
        return $this;
    }

    public function setPrecio($precio) {
        $this->precio = $precio;
        return $this;
    }

    public function setId_Iva($iva) {
        $this->id_iva = $iva;
        return $this;
    }

    public function setDescuento($descuento) {
        $this->descuento = $descuento;
        return $this;
    }

    public function setUnidad_de_medida($unidad_medida) {
        $this->unidad_de_medida = $unidad_medida;
        return $this;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
        return $this;
    }

    public function setEstoc($estoc) {
        $this->estoc = $estoc;
        return $this;
    }

    public function setVendible($vendible) {
        $this->vendible = $vendible;
        return $this;
    }

    public function setFavorito($favorito) {
        $this->favorito = $favorito;
        return $this;
    }

    public function setId_Categoria($categoria) {
        $this->id_categoria = $categoria;
        return $this;
    }
    
//    function __get($nombre) {
//        return $this->nombre;
//    }
//    
//    function __set($nombre, $value) {
//        $this->nombre=$value;
//    }

}
