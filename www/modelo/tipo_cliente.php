<?php

/**
 * Clase tipo_cliente que extiende de Entity relacionado con la tabla tipo_cliente
 *
 * @author azrak 2014 / pepo1966 2014
 */
class TipoCliente extends Entity {

    public $id_tipo;
    public $nombre_tipo;

    function __construct() {
        
    }

    public function setIdTipo($id_tipo) {
        $this->id_tipo = $id_tipo;
        return $this;
    }

    public function setNombreTipo($nombre_tipo) {
        $this->nombre_tipo = $nombre_tipo;
        return $this;
    }

}
?>