<?php

use Entity;

/**
 * Clase producto que extiende de Entity relacionado con la tabla productos
 *
 * @author azrak 2014
 */
class Producto extends Entity {

    private $codigo;
    private $table_name;
    private $nombre;
    private $marca;
    private $precio;
    private $iva;
    private $descuento;
    private $unidad_medida;
    private $descripcion;
    private $estoc;
    private $vendible;
    private $favorito;
    private $categoria;

    function __construct() {
        parent::__construct($this->codigo, $this->table_name);
        
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
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

    public function setIva($iva) {
        $this->iva = $iva;
        return $this;
    }

    public function setDescuento($descuento) {
        $this->descuento = $descuento;
        return $this;
    }

    public function setUnidad_medida($unidad_medida) {
        $this->unidad_medida = $unidad_medida;
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

    public function setCategoria($categoria) {
        $this->categoria = $categoria;
        return $this;
    }

}
