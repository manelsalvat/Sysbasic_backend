<?php


/**
* Clase producto que extiende de Entity relacionado con la tabla clientes
*
* @author azrak 2014
*/

class Clientes extends Entity {

    public $nif;
    public $nombre;
    public $apellidos;
    public $direccion;
    public $CP;
    public $poblacion;
    public $telefono;
    public $mail;
    public $imagen;
    public $domicilio_pago;
    public $activo;
    public $tipo_cliente;

    function __construct() {

        
    }

    public function setNif($nif) {
        $this->nif= $nif;
        return $this;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
        return $this;
    }

    public function setApellidos($apellidos) {
        $this->apellidos= $apellidos;
        return $this;
    }

    public function setDireccion($direccion) {
        $this->direccion = $direccion;
        return $this;
    }

    public function setCP($CP) {
        $this->CP = $CP;
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

    public function setDomicilio_pago($domicilio_pago) {
        $this->domicilio_pago = $domicilio_pago;
        return $this;
    }

    public function setActivo($activo) {
        $this->activo= $activo;
        return $this;
    }

    public function setTipo_cliente($tipo_cliente) {
        $this->tipo_cliente = $tipo_cliente;
        return $this;
    }

}