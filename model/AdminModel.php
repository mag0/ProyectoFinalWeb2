<?php

class AdminModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getUsuarios()
    {
        return $this->database->query("SELECT * FROM usuario WHERE nombreUsuario NOT IN ('admin', 'editor') ORDER BY puntaje_total DESC");
    }

    public function getTrampasTotal()
    {
        return $this->database->query("SELECT trampas AS total_trampas FROM usuario WHERE nombreUsuario = 'admin'");
    }

    public function getMonedasTotal()
    {
        return $this->database->query("SELECT monedas AS total_monedas FROM usuario WHERE nombreUsuario = 'admin'");
    }

    public function cantidadJugadores()
    {
        return $this->database->query("SELECT COUNT(*) AS cantidad_usuarios FROM usuario");
    }

    public function cantidadPartidas()
    {
        return $this->database->query("SELECT COUNT(*) AS cantidad_partidas FROM partida");
    }

    public function cantidadPreguntas()
    {
        return $this->database->query("SELECT COUNT(*) AS cantidad_preguntas FROM pregunta");
    }

    public function cantidadPreguntasCreadas()
    {
        return $this->database->query("SELECT COUNT(*) AS cantidad_preguntas_creadas FROM pregunta_sugerida");
    }

    public function cantidadUsuariosPorPais()
    {
        return $this->database->query("SELECT pais, COUNT(*) AS cantidad_pais FROM usuario");
    }

    public function porcentajePreguntasBienRespondidas()
    {
        return $this->database->query("SELECT FLOOR(COUNT(CASE WHEN respondidas_correctamente > 0 THEN 1 END) * 100.0 / COUNT(*)) 
                                        AS porcentaje_respondidas_correctamente FROM pregunta");
    }

    public function getPorcentajesDePreguntasBienRespondidas()
    {
        return $this->database->query("SELECT nombreUsuario, CASE WHEN preguntas_respondidas = 0 THEN 0 ELSE 
                                        ROUND((preguntas_bien_respondidas / preguntas_respondidas) * 100)
                                            END AS porcentaje_preguntas_correctas FROM usuario");
    }

    public function getUsuariosPorPais()
    {
        return $this->database->query("SELECT pais, COUNT(*) AS cantidad_usuarios FROM usuario GROUP BY pais");
    }

    public function getUsuariosPorSexo()
    {
        return $this->database->query("SELECT genero, COUNT(*) AS cantidad_usuarios FROM usuario GROUP BY genero");
    }

    public function getUsuariosPorEdad()
    {
        return $this->database->query("SELECT CASE WHEN TIMESTAMPDIFF(YEAR, anioDeNacimiento, CURDATE()) < 18 THEN 'menores' WHEN 
                                        TIMESTAMPDIFF(YEAR, anioDeNacimiento, CURDATE()) BETWEEN 18 AND 60 THEN 'medio' ELSE 'jubilados' 
                                        END AS grupo_edad, COUNT(*) AS cantidad_usuarios FROM usuario GROUP BY grupo_edad");
    }

    public function getUsuariosRegistradosDia()
    {
        return $this->database->query("SELECT DATE_FORMAT(fechaRegistro, '%m/%d') AS dia, COUNT(*) AS cantidad_usuarios FROM 
                                        usuario WHERE fechaRegistro >= CURDATE() - INTERVAL 0 DAY GROUP BY dia ORDER BY dia");
    }

    public function getUsuariosRegistradosSemana()
    {
            return $this->database->query("SELECT DATE_FORMAT(fechaRegistro, '%m/%d') AS dia, COUNT(*) AS cantidad_usuarios FROM 
                                            usuario WHERE fechaRegistro >= CURDATE() - INTERVAL 7 DAY GROUP BY dia ORDER BY dia");
    }
    public function getUsuariosRegistradosMes()
    {
            return $this->database->query("SELECT DATE_FORMAT(fechaRegistro, '%d') AS dia, COUNT(*) AS cantidad_usuarios FROM 
                                            usuario WHERE fechaRegistro >= CURDATE() - INTERVAL 30 DAY GROUP BY dia ORDER BY dia");
    }

    public function getUsuariosRegistradosAnio()
    {
        return $this->database->query("SELECT YEAR(fechaRegistro) AS anio, MONTHNAME(fechaRegistro) AS dia, COUNT(*) AS cantidad_usuarios FROM 
                                        usuario WHERE fechaRegistro >= CURDATE() - INTERVAL 365 DAY GROUP BY anio, dia ORDER BY  anio, MONTH(fechaRegistro)");
    }

    public function getPartidasDelDia()
    {
        return $this->database->query("SELECT DATE_FORMAT(fecha, '%m/%d') AS dia, COUNT(*) AS cantidad_partidas FROM 
                                        partida WHERE fecha >= CURDATE() - INTERVAL 0 DAY GROUP BY dia ORDER BY dia");
    }

    public function getPartidasDeLaSemana()
    {
        return $this->database->query("SELECT DATE_FORMAT(fecha, '%m/%d') AS dia, COUNT(*) AS cantidad_partidas FROM 
                                        partida WHERE fecha >= CURDATE() - INTERVAL 7 DAY GROUP BY dia ORDER BY dia");
    }
    public function getPartidasDelMes()
    {
        return $this->database->query("SELECT DATE_FORMAT(fecha, '%m/%d') AS dia, COUNT(*) AS cantidad_partidas FROM 
                                        partida WHERE fecha >= CURDATE() - INTERVAL 30 DAY GROUP BY dia ORDER BY dia");
    }

    public function getPartidasDelAnio()
    {
        return $this->database->query("SELECT YEAR(fecha) AS anio, MONTHNAME(fecha) AS dia, COUNT(*) AS cantidad_partidas 
                                        FROM partida WHERE fecha >= CURDATE() - INTERVAL 365 DAY GROUP BY anio, dia ORDER BY anio, MONTH(fecha)");
    }

    public function getPreguntasDelDia()
    {
        return $this->database->query("SELECT DATE_FORMAT(fecha, '%m/%d') AS dia, COUNT(*) AS cantidad_preguntas FROM 
                                        pregunta WHERE fecha >= CURDATE() - INTERVAL 0 DAY GROUP BY dia ORDER BY dia");
    }

    public function getPreguntasDeLaSemana()
    {
        return $this->database->query("SELECT DATE_FORMAT(fecha, '%m/%d') AS dia, COUNT(*) AS cantidad_preguntas FROM 
                                            pregunta WHERE fecha >= CURDATE() - INTERVAL 7 DAY GROUP BY dia ORDER BY dia");
    }
    public function getPreguntasDelMes()
    {
        return $this->database->query("SELECT DATE_FORMAT(fecha, '%m/%d') AS dia, COUNT(*) AS cantidad_preguntas FROM 
                                            pregunta WHERE fecha >= CURDATE() - INTERVAL 30 DAY GROUP BY dia ORDER BY dia");
    }

    public function getPreguntasDelAnio()
    {
        return $this->database->query("SELECT YEAR(fecha) AS anio, MONTHNAME(fecha) AS dia, COUNT(*) AS cantidad_preguntas FROM 
                                        pregunta WHERE fecha >= CURDATE() - INTERVAL 365 DAY GROUP BY anio, dia ORDER BY  anio, MONTH(fecha)");
    }

    public function getPaisesDelDia()
    {
        return $this->database->query("SELECT DATE_FORMAT(fechaRegistro, '%m/%d') AS dia, pais, COUNT(*) AS cantidad_pais
FROM usuario
WHERE fechaRegistro >= CURDATE() - INTERVAL 1 DAY
GROUP BY pais, dia
ORDER BY dia");
    }

    public function getPaisesDeLaSemana()
    {
        return $this->database->query("SELECT DATE_FORMAT(fechaRegistro, '%x/%v') AS semana, pais, COUNT(*) AS cantidad_pais
FROM usuario
WHERE fechaRegistro >= CURDATE() - INTERVAL 1 WEEK
GROUP BY pais, semana
ORDER BY semana");
    }
    public function getPaisesDelMes()
    {
        return $this->database->query("SELECT DATE_FORMAT(fechaRegistro, '%Y/%m') AS mes, pais, COUNT(*) AS cantidad_pais
FROM usuario
WHERE fechaRegistro >= CURDATE() - INTERVAL 1 MONTH
GROUP BY pais, mes
ORDER BY mes");
    }

    public function getPaisesDelAnio()
    {
        return $this->database->query("SELECT DATE_FORMAT(fechaRegistro, '%Y') AS año, pais, COUNT(*) AS cantidad_pais
FROM usuario
WHERE fechaRegistro >= CURDATE() - INTERVAL 1 YEAR
GROUP BY pais, año
ORDER BY año");
    }

    public function getSexoDelDia()
    {
        return $this->database->query("SELECT DATE_FORMAT(fechaRegistro, '%m/%d') AS dia, pais, COUNT(*) AS cantidad_genero
FROM usuario
WHERE fechaRegistro >= CURDATE() - INTERVAL 1 DAY
GROUP BY pais, dia
ORDER BY dia");
    }

    public function getSexoDeLaSemana()
    {
        return $this->database->query("SELECT DATE_FORMAT(fechaRegistro, '%x/%v') AS semana, genero, COUNT(*) AS cantidad_genero
FROM usuario
WHERE fechaRegistro >= CURDATE() - INTERVAL 1 WEEK
GROUP BY genero, semana
ORDER BY semana");
    }
    public function getSexoDelMes()
    {
        return $this->database->query("SELECT DATE_FORMAT(fechaRegistro, '%Y/%m') AS mes, pais, COUNT(*) AS cantidad_genero
FROM usuario
WHERE fechaRegistro >= CURDATE() - INTERVAL 1 MONTH
GROUP BY genero, mes
ORDER BY mes");
    }

    public function getSexoDelAnio()
    {
        return $this->database->query("SELECT DATE_FORMAT(fechaRegistro, '%Y') AS año, pais, COUNT(*) AS cantidad_genero
FROM usuario
WHERE fechaRegistro >= CURDATE() - INTERVAL 1 YEAR
GROUP BY genero, año
ORDER BY año");
    }

    public function getEdadDelDia()
    {
        return $this->database->query("SELECT 
    CASE 
        WHEN TIMESTAMPDIFF(YEAR, anioDeNacimiento, CURDATE()) < 18 THEN 'Menor'
        WHEN TIMESTAMPDIFF(YEAR, anioDeNacimiento, CURDATE()) BETWEEN 18 AND 60 THEN 'Medio'
        ELSE 'Jubilado'
    END AS categoria_edad,
    COUNT(*) AS cantidad_usuarios
FROM usuario
WHERE DATE(fechaRegistro) = CURDATE()
GROUP BY categoria_edad
ORDER BY cantidad_usuarios DESC");
    }

    public function getEdadDeLaSemana()
    {
        return $this->database->query("SELECT 
    CASE 
        WHEN TIMESTAMPDIFF(YEAR, anioDeNacimiento, CURDATE()) < 18 THEN 'Menor'
        WHEN TIMESTAMPDIFF(YEAR, anioDeNacimiento, CURDATE()) BETWEEN 18 AND 60 THEN 'Medio'
        ELSE 'Jubilado'
    END AS categoria_edad,
    COUNT(*) AS cantidad_usuarios
FROM usuario
WHERE YEARWEEK(fechaRegistro, 1) = YEARWEEK(CURDATE(), 1)
GROUP BY categoria_edad
ORDER BY cantidad_usuarios DESC");
    }
    public function getEdadDelMes()
    {
        return $this->database->query("SELECT 
    CASE 
        WHEN TIMESTAMPDIFF(YEAR, anioDeNacimiento, CURDATE()) < 18 THEN 'Menor'
        WHEN TIMESTAMPDIFF(YEAR, anioDeNacimiento, CURDATE()) BETWEEN 18 AND 60 THEN 'Medio'
        ELSE 'Jubilado'
    END AS categoria_edad,
    COUNT(*) AS cantidad_usuarios
FROM usuario
WHERE MONTH(fechaRegistro) = MONTH(CURDATE())
AND YEAR(fechaRegistro) = YEAR(CURDATE())
GROUP BY categoria_edad
ORDER BY cantidad_usuarios DESC");
    }

    public function getEdadDelAnio()
    {
        return $this->database->query("SELECT 
    CASE 
        WHEN TIMESTAMPDIFF(YEAR, anioDeNacimiento, CURDATE()) < 18 THEN 'Menor'
        WHEN TIMESTAMPDIFF(YEAR, anioDeNacimiento, CURDATE()) BETWEEN 18 AND 60 THEN 'Medio'
        ELSE 'Jubilado'
    END AS categoria_edad,
    COUNT(*) AS cantidad_usuarios
FROM usuario
WHERE YEAR(fechaRegistro) = YEAR(CURDATE())
GROUP BY categoria_edad
ORDER BY cantidad_usuarios DESC");
    }

    public function getPorcentajesDePreguntasBienRespondidasDelDia()
    {
        return $this->database->query("SELECT nombreUsuario, 
       CASE WHEN preguntas_respondidas = 0 THEN 0 
            ELSE ROUND((preguntas_bien_respondidas / preguntas_respondidas) * 100) 
       END AS porcentaje_preguntas_correctas
FROM usuario
WHERE DATE(fechaRegistro) = CURDATE()");
    }

    public function getPorcentajesDePreguntasBienRespondidasDeLaSemana()
    {
        return $this->database->query("SELECT nombreUsuario, 
       CASE WHEN preguntas_respondidas = 0 THEN 0 
            ELSE ROUND((preguntas_bien_respondidas / preguntas_respondidas) * 100) 
       END AS porcentaje_preguntas_correctas
FROM usuario
WHERE YEARWEEK(fechaRegistro, 1) = YEARWEEK(CURDATE(), 1)");
    }
    public function getPorcentajesDePreguntasBienRespondidasDelMes()
    {
        return $this->database->query("SELECT nombreUsuario, 
       CASE WHEN preguntas_respondidas = 0 THEN 0 
            ELSE ROUND((preguntas_bien_respondidas / preguntas_respondidas) * 100) 
       END AS porcentaje_preguntas_correctas
FROM usuario
WHERE YEAR(fechaRegistro) = YEAR(CURDATE()) 
  AND MONTH(fechaRegistro) = MONTH(CURDATE())");
    }

    public function getPorcentajesDePreguntasBienRespondidasDelAnio()
    {
        return $this->database->query("SELECT nombreUsuario, 
       CASE WHEN preguntas_respondidas = 0 THEN 0 
            ELSE ROUND((preguntas_bien_respondidas / preguntas_respondidas) * 100) 
       END AS porcentaje_preguntas_correctas
FROM usuario
WHERE YEAR(fechaRegistro) = YEAR(CURDATE())");
    }
}


