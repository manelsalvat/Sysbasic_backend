<?php

use Entity;

/**
 * Clase producto que extiende de Entity relacionado con la tabla productos
 *
 * @author azrak 2014
 */
class Facturas extends Entity {

    private $numero_documento;
    private $numero_factura;
    private $tipo_de_pago;
    private $vencimiento;
    private $domicilio_pago;
    function __construct() {
        
        
    }

    public function setNumero_documento($numero_documento) {
        $this->numero_documento = $numero_documento;
        return $this;
    }


    public function setNumero_factura($numero_factura) {
        $this->numero_factura = $numero_factura;
        return $this;
    }

    public function setTipo_de_pago($tipo_de_pago) {
        $this->tipo_de_pago = $tipo_de_pago;
        return $this;
    }


    public function setVencimiento($vencimiento) {
        $this->vencimiento = $vencimiento;
        return $this;
    }

    public function setDomicilio_pago($domicilio_pago) {
        $this->domicilio_pago = $domicilio_pago;
        return $this;
    }
}
