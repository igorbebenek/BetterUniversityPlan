<?php
require_once '../utils/dbUtils.php';

$pdo = getDatabaseConnection();
$studentNumber = isset($_GET['student_number']) ? $_GET['student_number'] : ($_COOKIE['student_number'] ?? '');
$teacher = isset($_GET['teacher']) ? $_GET['teacher'] : ($_COOKIE['teacher'] ?? '');
$room = isset($_GET['room']) ? $_GET['room'] : ($_COOKIE['room'] ?? '');
$subject = isset($_GET['subject']) ? $_GET['subject'] : ($_COOKIE['subject'] ?? '');
$viewMode = isset($_GET['view']) ? $_GET['view'] : ($_COOKIE['view'] ?? 'week');
$currentDay = isset($_GET['day']) ? $_GET['day'] : ($_COOKIE['day'] ?? date('l'));
$currentMonth = isset($_GET['month']) ? $_GET['month'] : ($_COOKIE['month'] ?? date('m'));
$currentYear = isset($_GET['year']) ? $_GET['year'] : ($_COOKIE['year'] ?? date('Y'));

setcookie('student_number', $studentNumber, time() + (86400 * 30), '/');
setcookie('teacher', $teacher, time() + (86400 * 30), '/');
setcookie('room', $room, time() + (86400 * 30), '/');
setcookie('subject', $subject, time() + (86400 * 30), '/');
setcookie('view', $viewMode, time() + (86400 * 30), '/');
setcookie('day', $currentDay, time() + (86400 * 30), '/');
setcookie('month', $currentMonth, time() + (86400 * 30), '/');
setcookie('year', $currentYear, time() + (86400 * 30), '/');


$studentNumber = isset($_GET['student_number']) ? $_GET['student_number'] : '';
$teacher = isset($_GET['teacher']) ? $_GET['teacher'] : '';
$room = isset($_GET['room']) ? $_GET['room'] : '';
$subject = isset($_GET['subject']) ? $_GET['subject'] : '';
$viewMode = isset($_GET['view']) ? $_GET['view'] : 'week';
$currentDay = isset($_GET['day']) ? $_GET['day'] : date('l');
$currentMonth = isset($_GET['month']) ? $_GET['month'] : date('m');
$currentYear = isset($_GET['year']) ? $_GET['year'] : date('Y');

if ($viewMode === 'month') {
    $startDate = date('Y-m-01', strtotime("$currentYear-$currentMonth-01"));
    $endDate = date('Y-m-t', strtotime("$currentYear-$currentMonth-01"));
} else {
    $startDate = '2025-01-13';
    $endDate = '2025-01-17';
}

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

$scheduleData = [];
$weekSchedule = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $date = date('Y-m-d', strtotime($row['start']));
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

    $scheduleData[$date][] = $lesson;
    $weekSchedule[$dayOfWeek][] = $lesson;
}

$scheduleToShow = [];
if ($viewMode === 'day') {
    if (isset($weekSchedule[$currentDay])) {
        $scheduleToShow[$currentDay] = $weekSchedule[$currentDay];
    } else {
        $scheduleToShow[$currentDay] = [];
    }
} elseif ($viewMode === 'month') {
    $scheduleToShow = $scheduleData;
} else {
    $scheduleToShow = $weekSchedule;
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
        <form method="GET" action="" id="filterForm">
            <input type="text" name="student_number" placeholder="Nr. albumu" value="<?php echo htmlspecialchars($studentNumber); ?>">
            <input type="text" name="teacher" placeholder="Wykładowca" value="<?php echo htmlspecialchars($teacher); ?>">
            <input type="text" name="room" placeholder="Sala" value="<?php echo htmlspecialchars($room); ?>">
            <input type="text" name="subject" placeholder="Przedmiot" value="<?php echo htmlspecialchars($subject); ?>">
            <input type="hidden" name="view" id="viewInput" value="<?php echo htmlspecialchars($viewMode); ?>">
            <input type="hidden" name="day" id="dayInput" value="<?php echo htmlspecialchars($currentDay); ?>">
            <button type="submit" class="search">Szukaj</button>
            <button type="button" class="clear" onclick="clearFilters()">Wyczyść</button>
        </form>
    </div>
</header>

<main>
    <div class="date-range">
        <span class="material-symbols-outlined">arrow_back_ios</span>
        <span>
            <?php
            if ($viewMode === 'month') {
                echo date('F Y', strtotime("$currentYear-$currentMonth-01"));
            } else {
                echo date('d F Y', strtotime($startDate)) . ($viewMode === 'week' ? ' - ' . date('d F Y', strtotime($endDate)) : '');
            }
            ?>
        </span>
        <span class="material-symbols-outlined">arrow_forward_ios</span>
        <div class="view-selector">
            <div class="current-view" onclick="toggleViewDropdown()">
                <span>Widok: <?php
                    if ($viewMode === 'week') echo 'Tydzień';
                    elseif ($viewMode === 'day') echo 'Dzień';
                    else echo 'Miesiąc';
                    ?></span>
                <span class="material-symbols-outlined">keyboard_arrow_down</span>
            </div>
            <div class="view-dropdown" id="viewDropdown">
                <div class="view-option" onclick="changeView('month')">Miesiąc</div>
                <div class="view-option" onclick="changeView('week')">Tydzień</div>
                <?php
                $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                foreach ($daysOfWeek as $day): ?>
                    <div class="view-option" onclick="changeView('day', '<?php echo $day; ?>')"><?php echo $day; ?></div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="schedule <?php echo $viewMode; ?>-view">
        <?php if ($viewMode === 'month'): ?>
            <div class="month-header">
                <?php foreach ($daysOfWeek as $day): ?>
                    <div class="month-day-name"><?php echo substr($day, 0, 3); ?></div>
                <?php endforeach; ?>
            </div>
            <?php
            $firstDay = date('w', strtotime("$currentYear-$currentMonth-01"));
            if ($firstDay == 0) $firstDay = 7;
            $firstDay--;

            $daysInMonth = date('t', strtotime("$currentYear-$currentMonth-01"));
            $weeksInMonth = ceil(($daysInMonth + $firstDay) / 7);

            $dayCount = 1;
            $currentDate = "$currentYear-$currentMonth-";

            for ($week = 0; $week < $weeksInMonth; $week++) {
                echo "<div class='month-week'>";
                for ($dayOfWeek = 0; $dayOfWeek < 7; $dayOfWeek++) {
                    if (($week == 0 && $dayOfWeek < $firstDay) || ($dayCount > $daysInMonth)) {
                        echo "<div class='month-day empty'></div>";
                    } else {
                        $date = $currentDate . sprintf("%02d", $dayCount);
                        echo "<div class='month-day'>";
                        echo "<div class='day-number'>" . $dayCount . "</div>";
                        if (isset($scheduleToShow[$date])) {
                            foreach ($scheduleToShow[$date] as $lesson) {
                                $lessonTypeClass = str_replace(
                                    ['ą', 'ć', 'ę', 'ł', 'ń', 'ó', 'ś', 'ź', 'ż'],
                                    ['a', 'c', 'e', 'l', 'n', 'o', 's', 'z', 'z'],
                                    mb_strtolower($lesson['lesson_form'], 'UTF-8')
                                );
                                echo "<div class='month-lesson {$lessonTypeClass}'>";
                                echo "<div class='lesson-time'>" . $lesson['start'] . "</div>";
                                echo "<div class='lesson-title'>" . htmlspecialchars($lesson['subject']) . "</div>";
                                echo "</div>";
                            }
                        }
                        echo "</div>";
                        $dayCount++;
                    }
                }
                echo "</div>";
            }
            ?>
        <?php else: ?>
            <?php
            if ($viewMode === 'week') {
                foreach ($daysOfWeek as $day) {
                    echo "<div class='day'>";
                    echo "<h3>" . ucfirst($day) . "</h3>";
                    if (isset($scheduleToShow[$day])) {
                        foreach ($scheduleToShow[$day] as $lesson) {
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
            } else {
                echo "<div class='day'>";
                echo "<h3>" . ucfirst($currentDay) . "</h3>";
                if (isset($scheduleToShow[$currentDay])) {
                    foreach ($scheduleToShow[$currentDay] as $lesson) {
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
        <?php endif; ?>
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

<script>
    function clearFilters() {
        document.cookie = "student_number=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "teacher=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "room=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "subject=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "view=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "day=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "month=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "year=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";

        const url = new URL(window.location.href);
        url.search = '';
        window.location.href = url.toString();
    }
    function clearFilters() {
        const viewMode = document.getElementById('viewInput').value;
        const currentDay = document.getElementById('dayInput').value;
        const url = new URL(window.location.href);
        url.search = `?view=${viewMode}&day=${currentDay}`;
        window.location.href = url.toString();
    }

    function toggleViewDropdown() {
        const dropdown = document.getElementById('viewDropdown');
        dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
    }

    function toggleViewDropdown() {
        const dropdown = document.getElementById('viewDropdown');
        dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
    }

    function changeView(view, day = null) {
        const form = document.getElementById('filterForm');
        document.getElementById('viewInput').value = view;
        if (day) {
            document.getElementById('dayInput').value = day;
        }
        form.submit();
    }

    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('viewDropdown');
        const viewSelector = event.target.closest('.view-selector');
        if (!viewSelector && dropdown.style.display === 'block') {
            dropdown.style.display = 'none';
        }
    });
</script>

</body>
</html>