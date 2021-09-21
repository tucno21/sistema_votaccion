<?php

namespace Model;

class Users extends Template
{
    protected static $table = 'users';

    public static function AllUsers()
    {
        $query = "SELECT U.id, U.name, U.email, U.photo, U.estado, U.access_date, 
                        C.category  
                    FROM users U 
                    INNER JOIN categories C ON U.categoryId = C.id";

        $stmt = self::$db->query($query);
        $resultadato = mysqli_fetch_all($stmt, MYSQLI_ASSOC);
        $mi_objeto = json_decode(json_encode($resultadato));
        return $mi_objeto;

        $stmt->close();
        $stmt->null;
    }
}
