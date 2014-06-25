<?php

use Entity;

/**
 * Clase producto que extiende de Entity relacionado con la tabla productos
 *
 * @author azrak 2014
 */
class Facturas extends Entity {

    private $numero_documento;
    private $numero_presupuesto;
    private $dias_de_validez_presupuesto;
    function __construct() {
        
        
    }

    public function setNumero_documento($numero_documento) {
        $this->numero_documento = $numero_documento;
        return $this;
    }


    public function setNumero_presupuesto($numero_presupuesto) {
        $this->numero_presupuesto = $numero_presupuesto;
        return $this;
    }

    public function setDias_de_validez_presupuesto($dias_de_validez_presupuesto) {
        $this->dias_de_validez_presupuesto = $dias_de_validez_presupuesto;
        return $this;
    }


}
