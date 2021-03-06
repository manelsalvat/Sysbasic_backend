<?php

class db {

    private static $con;
    private static $table_name;

    static function init() {
        self::$con = NULL;
        $settings = parse_ini_file('config.ini');

        $dns = $settings['driver'] . ':host=' . $settings['host'] . ';dbname=' . $settings['db_name'];

        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);
        try {
            self::$con = new PDO($dns, $settings['user'], $settings['pass'], $options);
        } catch (PDOException $e) {
            echo $e->getMessage();
            self::$con = null;
        }
    }

    public static function setTable($table) {
        self::$table_name = $table;
    }
    public static function getConnection() {
        return self::$con;
    }

    public static function get_values_by_tableName($table_name) {
        try {
            $sql = "SELECT * FROM $table_name";
            $query = self::$con->prepare($sql);
            $query->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            $query = null;
        }

        return $query->fetchAll();
    }

    //Params1: name of columns to update ,
    //Params2: new values as array in same size.
    public static function update_by_columns_name($columns_array_names, $new_values_array) {

        //shift and get the first element as key 
        $key = array_shift($columns_array_names);
        $key_value = array_shift($new_values_array);

        // convert column_array values to  'value=?'
        array_walk($columns_array_names, function(&$item) {
            $item = $item . '=?';
        });
        // convert column_array to strings separated by comma ','
        $bind_columns = implode(", ", $columns_array_names);

        try {
            $sql = "UPDATE ".
            self::$table_name. " SET  $bind_columns  "
                    . " WHERE  $key  =  $key_value ";


            $query = self::$con->prepare($sql);
            $ok = $query->execute($new_values_array);

            $query = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
            $query = null;
        }
    }

    public static function delete_by_ID($key_name, $value) {

        try {

            $sql = "DELETE FROM '.self::table_name.' WHERE '.$key_name.' = :value";
            $query = self::$con->prepare($sql);
            $query->execute(array(':value' => $value));
            $query = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
            $query = null;
        }
    }

    public static function find_by_Column(&$class, $column_name, $value) {

        try {
            $sql = "SELECT * FROM ". self::$table_name." WHERE $column_name = :value";
            $query = self::$con->prepare($sql);
            $query->setFetchMode(PDO::FETCH_INTO, $class);
            $query->execute(array(':value' => $value));
        } catch (PDOException $e) {
            echo $e->getMessage();
            $query = null;
        }
        return $query->fetchALL();
    }

    // get limited list page=offset
    public static function getList_for_pagination($page, $limit) {

        try {

            $start = $page * $limit;
            $table=  self::$table_name;
            self::$con->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
            $query = self::$con->prepare("SELECT * FROM $table LIMIT ?,?");
            $query->execute(array($start, $limit));

        } catch (PDOException $e) {
            echo $e->getMessage();
            $query = null;
        }

        return $query->fetchAll();
    }

    public static function add_new($values) {

        // add <''> to every array value
        array_walk($values, function(&$item) {
            $item = '\'' . $item . '\'';
        });
        $sql_columns_value = implode(",", $values);
        try {
            $sql = "INSERT INTO  ".self::$table_name ."  VALUES (  $sql_columns_value  ) ";

            $query = self::$con->prepare($sql);
            $ok = $query->execute();

            $query = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
            $query = null;
        }
    }

}
