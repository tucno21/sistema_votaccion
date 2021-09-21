<?php

namespace Model;

class Template
{
    protected static $db;

    protected static $table = '';

    //recibe la coneccion a la BD
    public static function setBD($connected)
    {
        self::$db = $connected;
    }

    //BUSCAR UNA FILA POR SU ID
    public static function find($id)
    {
        $colum = "id";
        $query = "SELECT * FROM " . static::$table . " WHERE $colum = '$id'";
        $stmt = self::$db->query($query);
        return $stmt->fetch_object();

        $stmt->close();
        $stmt->null;
    }

    //BUSCAR UN DATO COLUMNA Y UN VALOR ESPECIFICO
    public static function FindColumn($colum, $valorColum)
    {
        $query = "SELECT * FROM " . static::$table . " WHERE $colum = '$valorColum'";
        $stmt = self::$db->query($query);
        return $stmt->fetch_object();

        $stmt->close();
        $stmt->null;
    }

    //BUSCAR UN VALOR POR SU COLUMNA Y TRAER EN FORMA DESCENDENTE
    public static function FindColumnDesc($colum, $valorColum)
    {
        $query = "SELECT * FROM " . static::$table . " WHERE $colum = '$valorColum' ORDER BY id DESC";
        $stmt = self::$db->query($query);
        return $stmt->fetch_object();

        $stmt->close();
        $stmt->null;
    }

    //BUSCAR TODOS VALOR POR SU COLUMNA Y EL VALOR
    public static function FindAllColum($colum, $valorColum)
    {
        $query = "SELECT * FROM " . static::$table . " WHERE $colum = '$valorColum'";
        $stmt = self::$db->query($query);
        $resultadato = mysqli_fetch_all($stmt, MYSQLI_ASSOC);
        $mi_objeto = json_decode(json_encode($resultadato));
        return $mi_objeto;

        $stmt->close();
        $stmt->null;
    }

    //TRAER TODA LA CPLUMNA EN FORMA DESCENDENTE Y CON CIERTA CANTIDAD
    public static function findColumnCant($colum, $cant)
    {
        $query = "SELECT * FROM " . static::$table . " ORDER BY $colum DESC LIMIT $cant";

        $stmt = self::$db->query($query);
        $resultadato = mysqli_fetch_all($stmt, MYSQLI_ASSOC);
        $mi_objeto = json_decode(json_encode($resultadato));
        return $mi_objeto;

        $stmt->close();
        $stmt->null;
    }

    //TRER TODA LA TABLA
    public static function All()
    {
        $query = "SELECT * FROM " . static::$table;

        $stmt = self::$db->query($query);
        $resultadato = mysqli_fetch_all($stmt, MYSQLI_ASSOC);
        $mi_objeto = json_decode(json_encode($resultadato));
        return $mi_objeto;

        $stmt->close();
        $stmt->null;
    }

    //TRAER EL ULTIMO REGISTRO
    public static function LastRecord()
    {
        $query = "SELECT * FROM " . static::$table . " ORDER BY id DESC";

        $stmt = self::$db->query($query);
        $mi_objeto = mysqli_fetch_assoc($stmt);
        return $mi_objeto;

        $stmt->close();
        $stmt->null;
    }

    //GUARDAR EN LA TABLA
    public static function Save($datos)
    {
        $columns = implode(", ", array_keys($datos));
        $values = implode("', '", array_values($datos));

        $query = "INSERT INTO " . static::$table . "($columns) VALUES ('$values')";
        $stmt = self::$db->query($query);

        if ($stmt) {
            return "ok";
        } else {
            return "error";
        }

        $stmt->close();
        $stmt->null;
    }

    //ACTUALIZAR UN REGISTRO
    public static function update($datos, $id)
    {
        $valores = [];
        foreach ($datos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        $columValue = join(', ', $valores);
        $query = "UPDATE " . static::$table . " SET $columValue WHERE id= '$id'";
        $stmt = self::$db->query($query);

        if ($stmt) {
            return "ok";
        } else {
            return "error";
        }


        $stmt->close();
        $stmt->null;
    }

    //ELIMINAR UN REGISTRO
    public static function delete($id)
    {
        $query = "DELETE FROM " . static::$table . " WHERE id='$id'";
        $stmt = self::$db->query($query);

        if ($stmt) {
            return "ok";
        } else {
            return "error";
        }
    }

    //SUMAR TODOS LOS VALORES DE UNA COLUMNA
    public static function sumColum($colum)
    {
        $query = "SELECT SUM($colum) as total FROM " . static::$table;

        $stmt = self::$db->query($query);
        $resultadato = mysqli_fetch_all($stmt, MYSQLI_ASSOC);
        $mi_objeto = json_decode(json_encode($resultadato));
        return $mi_objeto;

        if ($stmt) {
            return "ok";
        } else {
            return "error";
        }
    }

    public static function mysqlOne($colum)
    {
        $query = $colum;

        $stmt = self::$db->query($query);
        return $stmt->fetch_object();

        $stmt->close();
        $stmt->null;
    }

    public static function mysqlAll($colum)
    {
        $query = $colum;

        $stmt = self::$db->query($query);
        $resultadato = mysqli_fetch_all($stmt, MYSQLI_ASSOC);
        $mi_objeto = json_decode(json_encode($resultadato));
        return $mi_objeto;

        if ($stmt) {
            return "ok";
        } else {
            return "error";
        }
    }
}
