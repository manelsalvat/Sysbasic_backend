<?php

/**
 * Clase documentos que extiende de Entity relacionado con la tabla documentos
 *
 * @author azrak 2014 / pepo1966 2014
 */
class Documentos extends Entity {

    public $tipo;
    public $numero;
    public $fecha;
    public $importe;
    public $nif_usuario;
    public $nif_cliente;

    function __construct() {
        
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
        return $this;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
        return $this;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
        return $this;
    }

    public function setImporte($importe) {
        $this->importe = $importe;
        return $this;
    }

    public function setNifUsuario($nif_usuario) {
        $this->nif_usuario = $nif_usuario;
        return $this;
    }

    public function setNifCliente($nif_cliente) {
        $this->nif_cliente = $nif_cliente;
        return $this;
    }

}
?>