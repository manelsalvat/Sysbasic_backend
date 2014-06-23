<?php

use Entity;

/**
 * Clase producto que extiende de Entity relacionado con la tabla productos
 *
 * @author azrak 2014
 */
class Categorias extends Entity {

    private $codigo;
    private $nombre;
    
    function __construct() {
        
        
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
        return $this;
    }


    public function setNombre($nombre) {
        $this->nombre = $nombre;
        return $this;
    }



}
