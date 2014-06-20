<?php

/**
 *
 * @author azrak 2014
 */
require_once './db.php';

class Entity {

    private $codigo;
    private $table_name;

    function __construct($id, $table) {
        $this->codigo = $id;
        $this->table_name = $table;
    }

    public function store() {
        $db = new db();
        $db->setTable('productos');
    }

    public function update() {
        $db = new db();
        $db->setTable($this->table_name);
        $db->update_by_columns_name($this->getColumnNames(), $this->getColumnValue());
    }

    function find_By_ID($id) {
        
    }

    function getColumnNames() {
        return array_keys(get_class_vars(get_class($this)));
    }

    public function getColumnValue() {
        return array_values(get_class_vars(get_class($this)));
    }

}
