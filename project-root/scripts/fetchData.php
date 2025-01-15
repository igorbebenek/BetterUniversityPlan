<?php
require_once '../utils/curlUtils.php';
require_once '../utils/dbUtils.php';

$startDate = '2025-01-13T00:00:00+01:00';
$endDate = '2025-01-20T00:00:00+01:00';
$batchSize = 100;
$maxIndex = 51555;

$pdo = getDatabaseConnection();

function checkTeacherExists($pdo, $teacherId) {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM teachers WHERE id = ?");
    $stmt->execute([$teacherId]);
    return $stmt->fetchColumn() > 0;
}

for ($startIndex = 50000; $startIndex <= $maxIndex; $startIndex += $batchSize) {
    $urls = [];
    for ($i = $startIndex; $i < $startIndex + $batchSize && $i <= $maxIndex; $i++) {
        $studentNumber = str_pad($i, 5, "0", STR_PAD_LEFT);
        $urls[$studentNumber] = "https://plan.zut.edu.pl/schedule_student.php?number=$studentNumber&start=$startDate&end=$endDate";
    }

    $results = fetchWithCurl($urls);

    foreach ($results as $studentNumber => $data) {
    if (!empty($data)) {
        $studentId = saveStudent($pdo, $studentNumber);

        if (!$studentId || $studentId <= 0) {
            echo "Pominiêto zapis harmonogramu: Student o numerze {$studentNumber} nie istnieje.\n";
            continue;
        }

        foreach ($data as $lesson) {
            if (!empty($lesson['worker'])) {
                $teacherId = saveTeacher($pdo, $lesson['worker']);

                // Te sprawdzenie nie ma sensu bo zapisujemy konkretne imie i nazwisko które odpowiada jakims zajecia ale nic nie ruszam bo dzia³a
                if (!$teacherId || $teacherId <= 0) {
                    echo "Pominiêto zapis harmonogramu: Nauczyciel o nazwie {$lesson['worker']} nie istnieje.\n";
                    continue;
                }

                saveSchedule($pdo, $studentId, $teacherId, $lesson);
            }
        }
    }
}

}
?>
