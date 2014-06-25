<?php

/**
 * Clase proveedores que extiende de Entity relacionado con la tabla productos
 *
 * @author azrak 2014
 */
class Proveedores extends Entity {

    public $nif;
    public $nombre;
    public $direccion;
    public $cp;
    public $poblacion;
    public $telefono;
    public $mail;
    public $imagen;
    public $persona_de_contacto;
    public $activo;

    function __construct() {
        
    }

    public function setNif($nif) {
        $this->nif = $nif;
        return $this;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
        return $this;
    }

    public function setDireccion($direccion) {
        $this->direccion = $direccion;
        return $this;
    }

    public function setCp($cp) {
        $this->cp = $cp;
        return $this;
    }

    public function setPoblacion($poblacion) {
        $this->poblacion = $poblacion;
        return $this;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
        return $this;
    }

    public function setMail($mail) {
        $this->mail = $mail;
        return $this;
    }

    public function setImagen($imagen) {
        $this->imagen = $imagen;
        return $this;
    }

    public function setPersona_de_contacto($persona_de_contacto) {
        $this->persona_de_contacto = $persona_de_contacto;
        return $this;
    }

    public function setActivo($activo) {
        $this->activo = $activo;
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