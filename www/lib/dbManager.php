<?php

class db_manager {

    public static $db = null;

    function __construct() {
        
    }

    public static function connect() {
        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);
        try {
            self::$db = new PDO("mysql:dbname=gestion_centro;host=localhost", "root", "", $options);
            // echo "Connection OK  <br/>";
        } catch (PDOException $e) {
            echo $e->getMessage();
            $db = null;
        }
    }

    public static function addUser($_dni, $_apellido, $_type) {
        try {
            $sql = "INSERT INTO usuario (dni, apellido, tipo_usuario) VALUES (:dni, :apellido, :tipo_usuario)";
            $query = self::$db->prepare($sql);
            $ok = $query->execute(array(':dni' => $_dni, ':apellido' => $_apellido, ':tipo_usuario' => $_type));
            //echo "Query= $ok";
            $query = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
            $query = null;
        }
    }

    public static function deleteUser($user_dni) {
        $sql = "DELETE FROM usuario WHERE dni = :user_dni";
        $query = self::$db->prepare($sql);
        $query->execute(array(':user_dni' => $user_dni));
        $query = null;
    }

    public static function getAllData($table) {

        try {
            $sql = "SELECT * FROM $table";
            $query = self::$db->prepare($sql);
            $query->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            $query = null;
        }


        return $query->fetchAll();
    }

    public static function getUser($user_dni) {

        try {
            $sql = "SELECT * FROM usuario WHERE dni = :user_dni";
            $query = self::$db->prepare($sql);
            $query->execute(array(':user_dni' => $user_dni));
        } catch (PDOException $e) {
            echo $e->getMessage();
            $query = null;
        }


        return $query->fetchAll();
    }

    public static function getNotas($user_dni) {

        try {
            $sql = "SELECT asignatura.nombre , "
                    . "nota.nota FROM nota INNER JOIN "
                    . "asignatura ON asignatura.identificador=nota.asignatura "
                    . "where nota.alumno = :user_dni";
            $query = self::$db->prepare($sql);
            $query->execute(array(':user_dni' => $user_dni));
        } catch (PDOException $e) {
            echo $e->getMessage();
            $query = null;
        }


        return $query->fetchAll();
    }

    public static function updateUser($user_dni, $user_apellido, $user_type) {
        $sql = "UPDATE usuario SET dni=?,apellido=?,tipo_usuario=? WHERE dni=?";
        $query = self::$db->prepare($sql);
        $query->execute(array($user_dni, $user_apellido, $user_type, $user_dni));
        $query = null;
    }

    public static function updateAsignatura($id, $nombre) {
        $sql = "UPDATE asignatura SET identificador=?,nombre=? WHERE identificador=?";
        $query = self::$db->prepare($sql);
        $query->execute(array($id, $nombre, $id));
        $query = null;
    }

    public static function deleteAsignatura($id) {
        $sql = "DELETE FROM asignatura WHERE identificador = :id";
        $query = self::$db->prepare($sql);
        $query->execute(array(':id' => $id));
        $query = null;
    }

    public static function getNotas_ByAsignatura($asign_id) {
        try {
            $sql = "SELECT usuario.apellido , "
                    . "nota.nota FROM nota INNER JOIN "
                    . "usuario ON nota.alumno=usuario.dni "
                    . "where nota.asignatura = :user_dni";
            $query = self::$db->prepare($sql);
            $query->execute(array(':user_dni' => $asign_id));
        } catch (PDOException $e) {
            echo $e->getMessage();
            $query = null;
        }


        return $query->fetchAll();
    }

    public static function addAsignatura($_id, $_nombre) {
        try {
            $sql = "INSERT INTO asignatura (identificador , nombre) VALUES (:id, :nombre)";
            $query = self::$db->prepare($sql);
            $ok = $query->execute(array(':id' => $_id, ':nombre' => $_nombre));
            $query = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
            $query = null;
        }
    }

    public static function addNota($al, $nt, $as) {
        try {
            $sql = "INSERT INTO nota (alumno , asignatura, nota) VALUES (:al, :as , :nt)";
            $query = self::$db->prepare($sql);
            $ok = $query->execute(array(':al' => $al, ':as' => $as, ':nt' => $nt));
            $query = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
            $query = null;
        }
    }

    public static function updateNota($al, $as, $nt) {

        self::deleteNota($al);
        self::addNota($al, $as, $nt);
    }

    public static function deleteNota($dni) {
        $sql = "DELETE FROM nota WHERE alumno = :dni";
        $query = self::$db->prepare($sql);
        $query->execute(array(':dni' => $dni));
        $query = null;
    }

    public static function update_alumn_nota($al, $nt, $as) {

//        self::delete_alumn_nota($al, $nt, $as);
//        self::addNota($al, $as, $nt);
        try {
            $sql = "UPDATE nota SET nota=? WHERE alumno=? AND asignatura=?";
            $query = self::$db->prepare($sql);
            $query->execute(array($nt, $al, $as));
            $query = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
            $query = null;
        }
    }

    public static function delete_alumn_nota($al, $nt, $as) {

        try {
            $sql = "DELETE FROM nota WHERE alumno = :dni and asignatura= :as ";
            $query = self::$db->prepare($sql);
            $query->execute(array(':dni' => $al, ':as' => $as));
            $query = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
            $query = null;
        }
    }

}
