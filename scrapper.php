<?php

require_once __DIR__ . '/src/Model/Zajecia.php';
require_once __DIR__ . '/src/Service/Config.php';

use App\Model\Zajecia;

set_time_limit(0);

function fetchWithCurl($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo "cURL error: " . curl_error($ch) . "\n";
    }

    curl_close($ch);
    return json_decode($response, true);
}

function saveToTableUnique($pdo, $tableName, $uniqueFields, $data) {
    $conditions = [];
    foreach ($uniqueFields as $field) {
        $conditions[] = "$field = :$field";
    }
    $whereClause = implode(' AND ', $conditions);

    $sqlCheck = "SELECT id FROM $tableName WHERE $whereClause";
    $stmt = $pdo->prepare($sqlCheck);
    $stmt->execute(array_intersect_key($data, array_flip($uniqueFields)));
    $existing = $stmt->fetchColumn();

    if ($existing) {
        return $existing; // Zwracamy istniejące ID, jeśli rekord już istnieje
    }

    $columns = implode(',', array_keys($data));
    $placeholders = implode(',', array_map(fn($key) => ":$key", array_keys($data)));
    $sqlInsert = "INSERT INTO $tableName ($columns) VALUES ($placeholders)";
    $stmt = $pdo->prepare($sqlInsert);
    $stmt->execute($data);

    return $pdo->lastInsertId();
}

function processAndSaveData($studentNumber, $startDate, $endDate) {
    $url = "https://plan.zut.edu.pl/schedule_student.php?number=$studentNumber&start=$startDate&end=$endDate";
    $data = fetchWithCurl($url);

    if (!empty($data)) {
        $pdo = new PDO(App\Service\Config::get('db_dsn'), App\Service\Config::get('db_user'), App\Service\Config::get('db_pass'));

        foreach ($data as $lesson) {
            // Pomijamy niepełne dane
            if (empty($lesson['start']) || empty($lesson['end'])) {
                echo "Pominięto niepełne dane dla studenta $studentNumber\n";
                continue;
            }

            $workerId = saveToTableUnique($pdo, 'Wykladowca', ['nazwisko_imie'], [
                'nazwisko_imie' => $lesson['worker'] ?? 'Nieznany'
            ]);

            $roomId = saveToTableUnique($pdo, 'Sala_z_budynkiem', ['budynek_sala'], [
                'budynek_sala' => $lesson['room'] ?? 'Nieznany',
                'wydzial_id' => 1
            ]);

            $tokId = saveToTableUnique($pdo, 'Tok_studiow', ['typ_skrot', 'tryb_skrot'], [
                'typ' => 'Licencjackie',
                'tryb' => 'Stacjonarne',
                'typ_skrot' => 'Lic',
                'tryb_skrot' => 'Stacj.'
            ]);

            $subjectId = saveToTableUnique($pdo, 'Przedmiot', ['nazwa', 'forma', 'tok_studiow_id'], [
                'nazwa' => $lesson['subject'] ?? 'Nieznany',
                'forma' => $lesson['lesson_form'] ?? 'Nieznana',
                'tok_studiow_id' => $tokId
            ]);

            $groupId = saveToTableUnique($pdo, 'Grupa', ['nazwa'], [
                'nazwa' => $lesson['group_name'] ?? 'Nieznana'
            ]);

            saveToTableUnique($pdo, 'Student', ['id'], [
                'id' => $studentNumber
            ]);

            $zajeciaData = [
                'data_start' => $lesson['start'] ?? null,
                'data_koniec' => $lesson['end'] ?? null,
                'zastepca' => $lesson['worker_cover'] ?? null,
                'semestr' => 1,
                'wykladowca_id' => $workerId,
                'wydzial_id' => 1,
                'grupa_id' => $groupId,
                'tok_studiow_id' => $tokId,
                'przedmiot_id' => $subjectId,
                'sala_id' => $roomId,
                'student_id' => $studentNumber,
            ];

            $existingZajecia = saveToTableUnique($pdo, 'Zajecia', [
                'data_start', 'data_koniec', 'wykladowca_id', 'przedmiot_id', 'sala_id', 'student_id'
            ], $zajeciaData);

            if ($existingZajecia) {
                echo "Zajęcia już istnieją dla studenta $studentNumber: " . $lesson['start'] . "\n";
            } else {
                echo "Zapisano nowe zajęcia dla studenta $studentNumber\n";
            }
        }
    } else {
        echo "Brak danych dla studenta $studentNumber\n";
    }
}

$startDate = '2025-01-01T00:00:00+01:00';
$endDate = '2025-01-30T00:00:00+01:00';

for ($studentNumber = 00000; $studentNumber <= 99999; $studentNumber++) {
    processAndSaveData($studentNumber, $startDate, $endDate);
}

echo "Proces zakończony.\n";


