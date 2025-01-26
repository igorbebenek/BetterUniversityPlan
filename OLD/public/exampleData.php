<?php
require_once '../utils/dbUtils.php';

$pdo = getDatabaseConnection();

function seedDatabase($pdo) {
    $tablesToClear = ['schedules', 'teachers', 'students'];
    foreach ($tablesToClear as $table) {
        $pdo->exec("DELETE FROM $table");
    }

    $studentNumber = '50001';
    $stmt = $pdo->prepare("INSERT INTO students (student_number) VALUES (:student_number)");
    $stmt->execute([':student_number' => $studentNumber]);
    $studentId = $pdo->lastInsertId();

    $teachers = [
        ['name' => 'Jan Kowalski'],
        ['name' => 'Anna Nowak'],
        ['name' => 'Piotr Wiśniewski'],
        ['name' => 'Marta Zielińska'],
        ['name' => 'Tomasz Wójcik'],
    ];

    $teacherIds = [];
    foreach ($teachers as $teacher) {
        $stmt = $pdo->prepare("INSERT INTO teachers (name) VALUES (:name)");
        $stmt->execute([':name' => $teacher['name']]);
        $teacherIds[] = $pdo->lastInsertId();
    }

    $schedules = [];
    $startTime = strtotime('2025-01-13 08:00:00');
    $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
    $lessonForms = ['Laboratorium', 'Wykład', 'Projekt', 'Ćwiczenia'];
    $rooms = ['A101', 'B202', 'C303', 'D404'];

    foreach ($daysOfWeek as $dayIndex => $day) {
        $currentTime = $startTime + ($dayIndex * 24 * 60 * 60);
        for ($i = 0; $i < 6; $i++) {
            $start = date('Y-m-d H:i:s', $currentTime + ($i * 90 * 60));
            $end = date('Y-m-d H:i:s', $currentTime + (($i + 1) * 90 * 60));
            $subject = "Przedmiot " . ($i + 1) . " ($day)";
            $lessonForm = $lessonForms[$i % count($lessonForms)];
            $room = $rooms[$i % count($rooms)];
            $teacherId = $teacherIds[$i % count($teacherIds)];

            $schedules[] = [
                'subject' => $subject,
                'start' => $start,
                'end' => $end,
                'room' => $room,
                'lesson_form' => $lessonForm,
                'student_id' => $studentId,
                'teacher_id' => $teacherId,
            ];
        }
    }

    foreach ($schedules as $schedule) {
        $stmt = $pdo->prepare("
            INSERT INTO schedules (subject, start, end, room, lesson_form, student_id, teacher_id) 
            VALUES (:subject, :start, :end, :room, :lesson_form, :student_id, :teacher_id)
        ");
        $stmt->execute([
            ':subject' => $schedule['subject'],
            ':start' => $schedule['start'],
            ':end' => $schedule['end'],
            ':room' => $schedule['room'],
            ':lesson_form' => $schedule['lesson_form'],
            ':student_id' => $schedule['student_id'],
            ':teacher_id' => $schedule['teacher_id'],
        ]);
    }

}

seedDatabase($pdo);
