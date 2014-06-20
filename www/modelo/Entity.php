<?php

/**
 * Clase producto que extiende de Entity relacionado con la tabla productos
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
        $db->add_new($this);
    }

    public function update() {
        $db = new db();
        $db->setTable($this->table_name);
        $db->update_by_columns_name($this->getColumnsName(), $this->getColumnValues());
    }

    function find_By_ID($id) {
        $db = new db();
        $db->setTable($this->table_name);
        return $db->find_by_ID($this->codigo, $id);
    }

    function getColumnsName() {
        return array_keys(get_class_vars(get_class($this)));
    }

    public function getColumnValues() {
        return array_values(get_class_vars(get_class($this)));
    }

}
