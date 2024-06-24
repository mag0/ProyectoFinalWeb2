<?php

class AdminModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
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
        return $this->database->query("SELECT FLOOR(COUNT(CASE WHEN respondidas_correctamente > 0 THEN 1 END) * 100.0 / COUNT(*)) AS porcentaje_respondidas_correctamente FROM pregunta");
    }

    public function getPorcentajesDePreguntasBienRespondidas()
    {
        return $this->database->query("SELECT nombreUsuario, CASE WHEN preguntas_respondidas = 0 THEN 0 ELSE ROUND((preguntas_bien_respondidas / preguntas_respondidas) * 100)
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
        return $this->database->query("SELECT CASE WHEN TIMESTAMPDIFF(YEAR, anioDeNacimiento, CURDATE()) < 18 THEN 'menores'
                                        WHEN TIMESTAMPDIFF(YEAR, anioDeNacimiento, CURDATE()) BETWEEN 18 AND 60 THEN 'medio' ELSE 'jubilados' END AS grupo_edad,
                                        COUNT(*) AS cantidad_usuarios FROM usuario GROUP BY grupo_edad;");
    }

    public function getUsuariosRegistradosDia()
    {
        return $this->database->query("SELECT DATE_FORMAT(fechaRegistro, '%m/%d') AS dia, COUNT(*) AS cantidad_usuarios FROM 
                                        usuario WHERE fechaRegistro >= CURDATE() - INTERVAL 1 DAY GROUP BY dia ORDER BY dia");
    }

    public function getUsuariosRegistradosSemana()
    {
            return $this->database->query("SELECT DATE_FORMAT(fechaRegistro, '%m/%d') AS dia, COUNT(*) AS cantidad_usuarios FROM 
                                            usuario WHERE fechaRegistro >= CURDATE() - INTERVAL 7 DAY GROUP BY dia ORDER BY dia");
    }
    public function getUsuariosRegistradosMes()
    {
            return $this->database->query("SELECT DATE_FORMAT(fechaRegistro, '%m/%d') AS dia, COUNT(*) AS cantidad_usuarios FROM 
                                            usuario WHERE fechaRegistro >= CURDATE() - INTERVAL 30 DAY GROUP BY dia ORDER BY dia");
    }

    public function getUsuariosRegistradosAnio()
    {
        return $this->database->query("SELECT MONTHNAME(u.fechaRegistro) AS dia,COUNT(u.id) AS cantidad_usuarios FROM 
                                        usuario u WHERE u.fechaRegistro >= CURDATE() - INTERVAL 1 YEAR GROUP BY  DATE(u.fechaRegistro) 
                                                                                                       ORDER BY DATE(u.fechaRegistro);");
    }

    public function getPartidasDelDia()
    {
        return $this->database->query("SELECT DATE_FORMAT(fecha, '%m/%d') AS dia, COUNT(*) AS cantidad_partidas FROM 
                                        partida WHERE fecha >= CURDATE() - INTERVAL 1 DAY GROUP BY dia ORDER BY dia");
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
                                        pregunta WHERE fecha >= CURDATE() - INTERVAL 1 DAY GROUP BY dia ORDER BY dia");
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
}


