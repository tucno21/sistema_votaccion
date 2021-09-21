<?php

namespace Model;

class Candidatos extends Template
{
    protected static $table = 'candidatos';

    public static function AllVotos()
    {
        $query = "SELECT E.canditatoId, 
                        C.name  
                    FROM students E 
                    INNER JOIN candidatos C ON E.canditatoId = C.id";

        $stmt = self::$db->query($query);
        $resultadato = mysqli_fetch_all($stmt, MYSQLI_ASSOC);
        $mi_objeto = json_decode(json_encode($resultadato));
        return $mi_objeto;

        $stmt->close();
        $stmt->null;
    }

    public static function Ganador()
    {
        $query = "SELECT E.canditatoId, C.name, COUNT(E.canditatoId) maximo 
                    FROM students E 
                    INNER JOIN candidatos C ON E.canditatoId = C.id 
                    GROUP BY canditatoId 
                    ORDER BY maximo DESC LIMIT 1";

        $stmt = self::$db->query($query);
        return $stmt->fetch_object();

        $stmt->close();
        $stmt->null;
    }
}
