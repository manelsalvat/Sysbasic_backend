<?php

/**
 * @author azrak 2014
 */
class Entity {

    function __construct() {
        
    }

    public function save() {
        $db = new db();
        $db->setTable(get_called_class());
        $db->add_new($this->getProperty_Values());
    }

    public function update() {
        $db = new db();
        $db->setTable(get_called_class());
        $db->update_by_columns_name($this->getProperty(), $this->getProperty_Values());
    }

    public function get_from_table($id) {
        $db = new db();
        $db->setTable(get_called_class());
        return $db->find_by_Column($this, 'codigo', $id);
    }

    // return propriety name as array of string
    public function getProperty() {
        return array_keys(get_object_vars($this)); // or get_class_vars(get_called_class()));
    }

    // return propriety value as array of mixed
    public function getProperty_Values() {
        return array_values(get_object_vars($this));
    }

}
