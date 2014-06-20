<?php

class db {

    public $con;
    private $db_name;
    private $host;
    private $user;
    private $pass;
    private $table_name;

    function __construct() {
        $this->con = NULL;
        $iniVars = parse_ini_file('../conf.ini', TRUE);
        $this->db_name = $iniVars['db_name'];
        $this->host = $iniVars['host'];
        $this->host = $iniVars['user'];
        $this->host = $iniVars['pass'];

        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);
        try {
            $this->con = new PDO("mysql:dbname='.$this->db_name.';host='.$this->host.'", "'.$this->user.'", "'.$this->pass.'", $options);
        } catch (PDOException $e) {
            echo $e->getMessage();
            $this->con = null;
        }

    }

    public function setTable($table) {
        $this->table_name = $table;
    }

    function get_values_by_tableName($table_name) {
        try {
            $sql = "SELECT * FROM $table_name";
            $query = $this->con->prepare($sql);
            $query->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            $query = null;
        }

        return $query->fetchAll();
    }

    function find_by_columnName($column_name, $value) {
        try {
            $sql = "SELECT * FROM '.$this->table_name.' WHERE '.$column_name.' = :value";
            $query = $this->con->prepare($sql);
            $query->execute(array(':value' => $value));
        } catch (PDOException $e) {
            echo $e->getMessage();
            $query = null;
        }

        return $query->fetchColumn();
    }

    //Params1: name of columns to update ,
    //Params2: new values as array in same size.
    function update_by_columns_name($columns_array_names, $new_values_array) {

        //shift and get the first element as key 

        $key = array_shift($columns_array_names);
        $key_value = array_shift($new_values_array);

        // convert column_array to strings separated by comma ','
        $sql_columns = implode(", ", $columns_array_names);

        // convert column_array values to char '?'
        array_walk($columns_array_names, function(&$item) {
            $item = '?';
        });
        // convert column_array to strings separated by comma ','
        $bind_columns = implode(", ", $columns_array_names);

        try {
            $sql = "UPDATE $this->table_name"
                    . " SET ('.$sql_columns.') "
                    . "VALUES ('.$bind_columns.')"
                    . " WHERE '.$key.' = '.$key_value.'";

            $query = $this->con->prepare($sql);
            $ok = $query->execute($new_values_array);

            $query = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
            $query = null;
        }
    }

    function delete_by_ID($key_name, $value) {

        $sql = "DELETE FROM '.$this->table_name.' WHERE '.$key_name.' = :value";
        $query = self::$db->prepare($sql);
        $query->execute(array(':value' => $value));
        $query = null;
    }

    // get limited list page=offset
    function getList_for_pagination($page, $limit) {

        try {

            $start = $page * $limit;

            $this->con->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
            $sth = $this->con->prepare("SELECT * FROM '.$this->table_name.' LIMIT ?,?");
            $sth->execute(array($start, $limit));
            $query = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
            $query = null;
        }

        return $query->fetchAll();
    }

}
