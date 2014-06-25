<?php

/**
 * Description of controler
 *
 * @author azrak 2014
 */
class controler {

    private static $entity;

    public static function setEntity($entity) {
        self::$entity = $entity;
    }

    public static function getEntity_table() {
        $data = NULL;
        $table_head_rows = NULL;
        $table_body_rows = NULL;

        $entity_class = new self::$entity();

        $rows = $entity_class->get_list($page, $limit);
        $prop = $entity_class->getProperty();
        $values = $entity_class->getProperty_Values();

        foreach ($prop as $th) {
            $table_head_rows = '<th>' . $th . '</th>';
        }
        $data['table_head_tr'] = $table_head_rows;



        foreach ($rows as $rows) {
            $table_body_td = '';
            foreach ($values as $value) {
                $table_body_td.= '<td>' . $value . '</td>';
            }
            $table_body_rows = '<tr>' . $table_body_td . '</tr>';
        }
        $data['table_body_rows'] = $table_body_rows;

        return $data;
    }

}
