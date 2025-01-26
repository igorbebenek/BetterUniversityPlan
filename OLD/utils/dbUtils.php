<?php
require_once '../database/config.php';

function saveStudent($pdo, $studentNumber) {
    $stmt = $pdo->prepare("INSERT INTO students (student_number) VALUES (:student_number) ON DUPLICATE KEY UPDATE id=LAST_INSERT_ID(id)");
    $stmt->execute(['student_number' => $studentNumber]);
    return $pdo->lastInsertId();
}

function saveTeacher($pdo, $teacherName) {
    $stmt = $pdo->prepare("INSERT INTO teachers (name) VALUES (:name) ON DUPLICATE KEY UPDATE id=LAST_INSERT_ID(id)");
    $stmt->execute(['name' => $teacherName]);
    return $pdo->lastInsertId();
}

function saveSchedule($pdo, $studentId, $teacherId, $schedule) {
    $stmt = $pdo->prepare("
        INSERT INTO schedules (student_id, teacher_id, subject, description, start, end, room, lesson_form)
        VALUES (:studentId, :teacherId, :subject, :description, :start, :end, :room, :lessonForm)
    ");
    $stmt->execute([
        ':studentId' => $studentId,
        ':teacherId' => $teacherId,
        ':subject' => $schedule['subject'],
        ':description' => $schedule['description'],
        ':start' => $schedule['start'],
        ':end' => $schedule['end'],
        ':room' => $schedule['room'],
        ':lessonForm' => $schedule['lesson_form']
    ]);
}
?>
