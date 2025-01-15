<?php
require_once '../utils/dbUtils.php';

$pdo = getDatabaseConnection();

$studentNumber = isset($_GET['student_number']) ? $_GET['student_number'] : '';
$teacher = isset($_GET['teacher']) ? $_GET['teacher'] : '';
$room = isset($_GET['room']) ? $_GET['room'] : '';
$subject = isset($_GET['subject']) ? $_GET['subject'] : '';

$startDate = '2025-01-13';
$endDate = '2025-01-17';

$query = "
    SELECT DISTINCT
        schedules.subject, 
        schedules.start, 
        schedules.end, 
        schedules.room, 
        schedules.lesson_form, 
        schedules.student_id, 
        teachers.name AS teacher_name
    FROM 
        schedules
    JOIN 
        students AS s ON schedules.student_id = s.id
    LEFT JOIN 
        teachers ON schedules.teacher_id = teachers.id
    WHERE 
        schedules.start BETWEEN :startDate AND :endDate
";

if ($studentNumber) {
    $query .= " AND s.student_number = :student_number";
}
if ($teacher) {
    $query .= " AND teachers.name LIKE :teacher";
}
if ($room) {
    $query .= " AND schedules.room LIKE :room";
}
if ($subject) {
    $query .= " AND schedules.subject LIKE :subject";
}

$query .= " ORDER BY schedules.start";

$stmt = $pdo->prepare($query);

$stmt->bindParam(':startDate', $startDate);
$stmt->bindParam(':endDate', $endDate);

if ($studentNumber) {
    $stmt->bindValue(':student_number', $studentNumber);
}
if ($teacher) {
    $stmt->bindValue(':teacher', '%' . $teacher . '%');
}
if ($room) {
    $stmt->bindValue(':room', '%' . $room . '%');
}
if ($subject) {
    $stmt->bindValue(':subject', '%' . $subject . '%');
}

$stmt->execute();

$weekSchedule = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $dayOfWeek = date('l', strtotime($row['start']));
    $lessonStart = date('H:i', strtotime($row['start']));
    $lessonEnd = date('H:i', strtotime($row['end']));
    
    $lesson = [
    'subject' => $row['subject'],
    'start' => $lessonStart,
    'end' => $lessonEnd,
    'room' => $row['room'],
    'teacher' => $row['teacher_name'],
    'lesson_form' => $row['lesson_form'],
];
    $weekSchedule[$dayOfWeek][] = $lesson;
}

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plan Zajęć</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
</head>
<body>
<header>
    <h1>Plan zajęć</h1>
    <div class="filters">
        <form method="GET" action="">
            <input type="text" name="student_number" placeholder="Nr. albumu" value="<?php echo htmlspecialchars($studentNumber); ?>">
            <input type="text" name="teacher" placeholder="Wykładowca" value="<?php echo htmlspecialchars($teacher); ?>">
            <input type="text" name="room" placeholder="Sala" value="<?php echo htmlspecialchars($room); ?>">
            <input type="text" name="subject" placeholder="Przedmiot" value="<?php echo htmlspecialchars($subject); ?>">
            <button type="submit" class="search">Szukaj</button>
            <button type="button" class="clear" onclick="clearFilters()">Wyczyść</button>
        </form>
    </div>
</header>
<script>
    function clearFilters() {
        const url = new URL(window.location.href);
        url.search = '';
        window.location.href = url.toString();
    }
</script>

<main>
    <div class="date-range">
        <span class="material-symbols-outlined">arrow_back_ios</span>
        <span><?php echo date('d F Y', strtotime($startDate)) . ' - ' . date('d F Y', strtotime($endDate)); ?></span>
        <span class="material-symbols-outlined">arrow_forward_ios</span>
        <span class="view-mode">Widok: Tydzień</span>
        <span class="material-symbols-outlined">keyboard_arrow_down</span>
    </div>
    <div class="schedule">
        <?php
        $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        foreach ($daysOfWeek as $day) {
            echo "<div class='day'>";
            echo "<h3>" . ucfirst($day) . "</h3>";
            if (isset($weekSchedule[$day])) {
                foreach ($weekSchedule[$day] as $lesson) {

                    $lessonTypeClass = str_replace(
                        ['ą', 'ć', 'ę', 'ł', 'ń', 'ó', 'ś', 'ź', 'ż'],
                        ['a', 'c', 'e', 'l', 'n', 'o', 's', 'z', 'z'],
                        mb_strtolower($lesson['lesson_form'], 'UTF-8')
                    );
                    echo "<div class='lesson {$lessonTypeClass}'>";
                    echo "<h4>" . htmlspecialchars($lesson['subject']) . "</h4>";
                    echo "<p><span class='material-symbols-outlined'>home_pin</span> " . htmlspecialchars($lesson['room']) . "</p>";
                    echo "<p><span class='material-symbols-outlined'>person_pin</span> " . htmlspecialchars($lesson['teacher']) . "</p>";
                    echo "<h4>" . htmlspecialchars($lesson['start']) . " - " . htmlspecialchars($lesson['end']) . "</h4>";
                    echo "</div>";
                }
            } else {
                echo "<p>Brak zajęć</p>";
            }
            echo "</div>";
        }
        ?>
    </div>
</main>

<footer>
    <div class="legend">
        <div class="legend-item">
            <span class="legend-color laboratorium"></span>
            <span>Laboratorium</span>
        </div>
        <div class="legend-item">
            <span class="legend-color wyklad"></span>
            <span>Wykład</span>
        </div>
        <div class="legend-item">
            <span class="legend-color audytoryjne"></span>
            <span>Audytoryjne</span>
        </div>
        <div class="legend-item">
            <span class="legend-color projekt"></span>
            <span>Projekt</span>
        </div>
        <div class="legend-item">
            <span class="legend-color lektorat"></span>
            <span>Lektorat</span>
        </div>
    </div>
</footer>

</body>
</html>
