<?php

/**
 * Clase producto que extiende de Entity relacionado con la tabla productos
 *
 * @author azrak 2014
 */
class Presupuestos extends Entity {

    public $numero_documento;
    public $numero_presupuesto;
    public $dias_de_validez_presupuesto;
    
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
