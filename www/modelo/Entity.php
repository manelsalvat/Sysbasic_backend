<?php

/**
 * @author azrak 2014
 */
class Entity {

    function __construct() {
        
    }

    public function save() {
        db::init();
        db::setTable(get_called_class());
        db::add_new($this->getProperty_Values());
    }

    public function update() {
        db::init();
        db::setTable(get_called_class());
        db::update_by_columns_name($this->getProperty(), $this->getProperty_Values());
    }

    public function get_from_table($id) {
        db::init();
        db::setTable(get_called_class());
        return db::find_by_Column('codigo', $id);
    }
    
    public function get_list($page,$limit) {
        db::init();
        db::setTable(get_called_class());
        return db::getList_for_pagination($page, $limit);
    }

    // return propriety name as array of string
    public function getProperty() {
        return array_keys(get_object_vars($this)); // or get_class_vars(get_called_class()));
    }

    // return propriety value as array of mixed
    public function getProperty_Values() {
        return array_values(get_object_vars($this));
    }
    
    public function get_visble_columns() {
        // visible column as array
        $visible_columns=array(
            'Productos'=>array('codigo','nombre','descripcion','estoc','precio'),
            'Clientes'=>array('nif','nombre','apellidos','telefono','poblacion'),
            'Proveedores'=>array('nif','nombre','direccion','CP','activo'),
            'Categorias'=>array('codigo','nombre'),
            'Presupuestos'=>array('numero_documento','numero_presupuesto','dias_de_validez_presupuesto'),
            'Facturas'=>array('numero_factura','numero_documento','tipo_de_pago','vencimiento'),
            'Pedidos'=>array('numero_pedido','numero_documento'),
            'Usuarios'=>array('nif','nombre','apellidos','telefono','poblacion')
        );
        return $visible_columns[get_called_class()];
    }
    
    // get visible property for tables header
    public function get_visible_property() {
       
       // return $out;
    }
  
    // get visible value for tables rows
    public function get_visible_values() {
        $property = $this->getProperty_Values();
        $out = array();
        
        array_walk($property, function(&$item) {
            foreach ($this->get_visble_columns() as $selected) {
               if($item === $selected) {
                   array_push($out, $item);
               } 
            }
            
        });
        return $out;
    }

}
