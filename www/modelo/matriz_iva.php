<?php

/**
 * Clase matriz_iva que extiende de Entity relacionado con la tabla matriz_iva
 *
 * @author azrak 2014 / pepo1966 2014
 */
class MatrizIva extends Entity {

    public $id_tipo_iva;
    public $id_tipo_cliente;
    public $porcentaje_iva;
    public $porcentaje_recargo_equivalencia;

    function __construct() {
        
    }

    public function setIdTipoIva($id_tipo_iva) {
        $this->id_tipo_iva = $id_tipo_iva;
        return $this;
    }

    public function setIdTipoCliente($id_tipo_cliente) {
        $this->id_tipo_cliente = $id_tipo_cliente;
        return $this;
    }

    public function setPorcentajeIva($porcentaje_iva) {
        $this->porcentaje_iva = $porcentaje_iva;
        return $this;
    }

    public function setPorcentajeRecargoEquivalencia($porcentaje_recargo_equivalencia) {
        $this->porcentaje_recargo_equivalencia = $porcentaje_recargo_equivalencia;
        return $this;
    }

}
?>