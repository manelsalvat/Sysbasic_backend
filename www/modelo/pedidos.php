<?php

use Entity;

/**
 * Clase producto que extiende de Entity relacionado con la tabla productos
 *
 * @author azrak 2014
 */
class Pedidos extends Entity {

    public $numero_documento;
    public $numero_pedido;
    public $direccion_entrega_pedido;
    public $CP_entrega_pedido;
    public $poblacion_entrega_pedido;
    public $telefono_entrega_pedido;

    function __construct() {
        
        
    }

    public function setNumero_documento($numero_documento) {
        $this->numero_documento = $numero_documento;
        return $this;
    }


    public function setNumero_pedido($numero_pedido) {
        $this->numero_pedido = $numero_pedido;
        return $this;
    }

    public function setDireccion_entrega_pedido($direccion_entrega_pedido) {
        $this->direccion_entrega_pedido = $direccion_entrega_pedido;
        return $this;
    }


    public function setCP_entrega_pedido($CP_entrega_pedido) {
        $this->CP_entrega_pedido = $CP_entrega_pedido;
        return $this;
    }

    public function setPoblacion_entrega_pedido($poblacion_entrega_pedido) {
        $this->poblacion_entrega_pedido = $poblacion_entrega_pedido;
        return $this;
    }

     public function setTelefono_entrega_pedido($telefono_entrega_pedido) {
        $this->telefono_entrega_pedido = $telefono_entrega_pedido;
        return $this;
    }
}
