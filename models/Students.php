<?php

namespace Model;

class Students extends Template
{
    protected static $table = 'students';

    public static function AllStudents()
    {
        $query = "SELECT S.id, S.name, S.dni, S.voto, S.last_access, 
                        A.gradosec,  
                        T.turno  
                    FROM students S 
                    INNER JOIN aulas A ON S.aulaId = A.id 
                    INNER JOIN turnos T ON S.turnoId = T.id";

        $stmt = self::$db->query($query);
        $resultadato = mysqli_fetch_all($stmt, MYSQLI_ASSOC);
        $mi_objeto = json_decode(json_encode($resultadato));
        return $mi_objeto;

        $stmt->close();
        $stmt->null;
    }
}
