<?php

namespace App\Controller;

use PDO;
use App\Service\Config;

class ApiController
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO(
            Config::get('db_dsn'),
            Config::get('db_user'),
            Config::get('db_pass')
        );
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Pobiera listę zajęć wraz z powiązanymi danymi (wykładowca, przedmiot, sala, grupa, wydział).
     */
    public function getSchedule(): string
    {
        $query = "
SELECT 
    z.*, 
    w.nazwisko_imie AS teacher_name,
    s.budynek_sala AS room_name,
    p.nazwa AS subject_name,
    p.forma AS lesson_type
FROM 
    zajecia z
LEFT JOIN 
    wykladowca w ON z.wykladowca_id = w.id
LEFT JOIN 
    sala_z_budynkiem s ON z.sala_id = s.id
LEFT JOIN 
    przedmiot p ON z.przedmiot_id = p.id
WHERE 
    1=1
        ";

        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        header('Content-Type: application/json');
        return json_encode($results);
    }

    /**
     * Pobiera szczegóły pojedynczych zajęć na podstawie ich ID.
     */
    public function getScheduleById(int $id): string
    {
        $query = "
SELECT 
    z.*, 
    w.nazwisko_imie AS teacher_name,
    s.budynek_sala AS room_name,
    p.nazwa AS subject_name,
    p.forma AS lesson_type
FROM 
    zajecia z
LEFT JOIN 
    wykladowca w ON z.wykladowca_id = w.id
LEFT JOIN 
    sala_z_budynkiem s ON z.sala_id = s.id
LEFT JOIN 
    przedmiot p ON z.przedmiot_id = p.id
WHERE 
    1=1 
 AND z.student_id = :id
        ";

        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            http_response_code(404);
            return json_encode(['error' => 'Lesson not found']);
        }

        header('Content-Type: application/json');
        return json_encode($result);
    }
}
