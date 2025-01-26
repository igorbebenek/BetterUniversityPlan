<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plan Zajęć</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
</head>
<style>
    body {
        font-family: "Inter", serif;
        background-color: var(--background-light);
        color: var(--text-light);
        font-size: var(--font-size-base);
        margin: 0;
        padding: 0;
        transition: background-color var(--transition-speed), color var(--transition-speed);
    }

    header {
        padding: 20px;
        text-align: left;
        background: #fff;
        border-bottom: 1px solid #ddd;
    }

    .filters {
        display: flex;
        justify-content: left;
        gap: 10px;
        margin-top: 10px;
    }

    .filters input {
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 10px;
    }

    .filters button {
        padding: 8px;
        border-radius: 10px;
        border: 0;
    }

    .filters .search {
        background-color: #007AFF;
        color: white;
    }

    .filters .clear {
        background-color: #EFEFF4;
        color: #007AFF;
    }

    .filters button:hover {
        background-color: #0056b3;
    }

    .date-range {
        padding: 15px;
        text-align: left;
        background: #fff;
        border-bottom: 1px solid #ddd;
        display: flex;
        justify-content: flex-start;
        align-items: center;
        gap: 15px;
    }

    .date-range span {
        display: flex;
        align-items: center;
    }

    .date-range .material-symbols-outlined {
        font-variation-settings: 'FILL' 0, 'wght' 500, 'GRAD' 0, 'opsz' 36;
        cursor: pointer;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 1000px;
        transition: background-color 0.3s ease;
    }

    .date-range .material-symbols-outlined:hover {
        background-color: #f0f0f0;
    }

    .schedule {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 0em;
        padding: 20px;
    }

    .day-view .lesson {
        margin: 15px auto;
        width: 100%;
    }

    .day {
        border-radius: 5px;
        padding: 10px;
        text-align: center;
    }

    .day h3 {
        margin: 0;
        font-size: 18px;
        background-color: #E0E0E0;
        color: black;
        padding: 5px;
        border-radius: 5px;
    }

    .lesson {
        background-color: white;
        border-radius: 5px;
        padding: 10px;
        margin-top: 10px;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
    }

    .lesson.green {
        background-color: #CCFFD8;
    }

    .lesson h4 {
        margin: 0;
        font-size: 16px;
    }

    .lesson p {
        margin: 5px 0;
        font-size: 14px;
        text-align: left;
        display: flex;
        justify-content: flex-start;
        align-items: center;
        gap: 5px;
    }

    .lesson.laboratorium {
        background-color: #6BCB77;
    }

    .lesson.wyklad {
        background-color: #4D96FF;
    }

    .lesson.audytoryjne {
        background-color: #FFD93D;
    }

    .lesson.projekt {
        background-color: #FF6B6B;
    }

    .lesson.lektorat {
        background-color: #FF8E00;
    }


    .lesson .material-symbols-outlined {
        font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
    }

    .lesson p i {
        color: #007bff;
        font-size: 16px;
    }

    footer {
        padding: 20px;
        background-color: #fff;
        text-align: center;
        border-top: 1px solid #ddd;
    }

    .legend {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 20px;
    }

    .legend-item {
        display: flex;
        align-items: center;
        font-size: 14px;
    }

    .legend-item .laboratorium {
        background-color: #6BCB77;
    }

    .legend-item .wyklad {
        background-color: #4D96FF;
    }

    .legend-item .audytoryjne {
        background-color: #FFD93D;
    }

    .legend-item .projekt {
        background-color: #FF6B6B;
    }

    .legend-item .lektorat {
        background-color: #FF8E00;
    }


    .legend-color {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        margin-right: 8px;
    }

    /*
    tablet
    */
    @media (min-width: 769px) and (max-width: 1024px) {
        .schedule {
            padding: 10px;
            gap: 0.5em;
        }

        .lesson {
            padding: 8px;
        }

        .lesson h4 {
            font-size: 14px;
        }

        .lesson p {
            font-size: 12px;
        }

        .filters {
            flex-wrap: wrap;
            padding: 0 10px;
        }

        .filters input {
            flex: 1;
            min-width: 150px;
        }

        .legend {
            padding: 10px;
            gap: 10px;
        }

        .legend-item {
            font-size: 12px;
        }
    }

    /*
    mobilka
    */
    @media (max-width: 768px) {
        .schedule {
            grid-template-columns: 1fr;
            padding: 10px;
        }

        .filters {
            flex-direction: column;
            padding: 0 10px;
        }

        .filters input,
        .filters button {
            width: 100%;
        }

        .date-range {
            flex-direction: column;
            padding: 10px;
            gap: 10px;
        }

        .legend {
            flex-direction: column;
            align-items: flex-start;
            padding: 10px;
            gap: 8px;
        }

        .day {
            margin-bottom: 15px;
        }

        .day h3 {
            font-size: 16px;
        }

        .lesson {
            margin: 8px 0;
        }

        .lesson h4 {
            font-size: 14px;
        }

        .lesson p {
            font-size: 12px;
        }

    }


    :root {
        --font-size-base: 16px;
        --font-size-large: 20px;
        --font-size-small: 14px;
        --background-light: #f0f0f0;
        --background-dark: #121212;
        --text-light: #000;
        --text-dark: #fff;
        --card-light: #fff;
        --card-dark: #1e1e1e;
        --transition-speed: 0.3s;
    }

    .dark-mode {
        background-color: var(--background-dark);
        color: var(--text-dark);
    }

    .dark-mode .day {
        background-color: #333;
        color: var(--text-dark);
    }

    .dark-mode .day h3 {
        background-color: #555;
        color: var(--text-dark);
    }
    .scale-buttons {
        position: absolute;
        top: 20px;
        right: 20px;
        z-index: 100;
        display: flex;
        gap: 10px;
    }

    #toggleTheme {
        margin-left: 20px;
    }

    .scale-buttons button,
    #toggleTheme {
        background-color: #007bff;
        color: white;
        padding: 10px 15px;
        font-size: var(--font-size-base);
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color var(--transition-speed), color var(--transition-speed);
    }

    .scale-buttons button:hover,
    #toggleTheme:hover {
        background-color: #0056b3;
    }


    .container {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
    }

    .lesson {
        background-color: var(--card-light);
        margin-bottom: 15px;
        padding: 15px;
        border-radius: 8px;
        transition: background-color var(--transition-speed);
    }

    .dark-mode .lesson {
        background-color: var(--card-dark);
    }

    button {
        padding: 10px 15px;
        margin: 5px;
        font-size: var(--font-size-base);
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color var(--transition-speed), color var(--transition-speed);
    }

    .dark-mode button {
        background-color: #333;
        color: var(--text-dark);
    }

    .scale-buttons {
        display: flex;
        gap: 10px;
    }

    .scale-buttons button {
        background-color: #007bff;
        color: white;
    }

    .dark-mode .scale-buttons button {
        background-color: #0056b3;
    }

    h1 {
        font-size: var(--font-size-large);
    }

    .dark-mode h1 {
        color: var(--text-dark);
    }

    .dark-mode h1,
    .dark-mode h2,
    .dark-mode h3,
    .dark-mode h4,
    .dark-mode p {
        color: var(--text-dark);
    }

    .dark-mode .lesson {
        background-color: var(--card-dark);
    }

    .dark-mode .filters input,
    .dark-mode .filters button {
        background-color: var(--background-dark);
        color: var(--text-dark);
    }

    .dark-mode .filters button:hover {
        background-color: #333;
    }
    .dark-mode header {
        background-color: #333;
        color: var(--text-dark);
    }
    .dark-mode .date-range {
        background-color: #333;
        color: var(--text-dark);
    }

    .calendar th,
    .calendar td {
        text-align: center;
        padding: 10px;
        width: 15%;
        height: 100px;
        border: 1px solid #ddd;
        box-sizing: border-box;
        word-wrap: break-word;
    }

    .calendar th {
        background-color: #E0E0E0;
        font-weight: bold;
    }

    .calendar td {
        background-color: #fff;
        vertical-align: top;
    }

    .calendar td .day-number {
        font-size: 16px;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .calendar td .lesson-indicator {
        display: block;
        width: 100%;
        height: 10px;
        background-color: #4D96FF;
    }

    .calendar td.empty {
        background-color: #f5f5f5;
    }

    @media (max-width: 768px) {
        .calendar td {
            height: 80px;
        }
    }




</style>
<body>
<header>
    <h1>Plan zajęć</h1>
    <div class="filters">
        <form method="GET" action="">
            <input type="text" name="teacher" placeholder="Wykładowca" value="<?= htmlspecialchars($filters['teacher'] ?? '') ?>">
            <input type="text" name="room" placeholder="Sala" value="<?= htmlspecialchars($filters['room'] ?? '') ?>">
            <input type="text" name="subject" placeholder="Przedmiot" value="<?= htmlspecialchars($filters['subject'] ?? '') ?>">
            <input type="text" name="group" placeholder="Grupa" value="<?= htmlspecialchars($filters['group'] ?? '') ?>">
            <input type="text" name="student_number" placeholder="Nr. albumu" value="<?= htmlspecialchars($filters['student_number'] ?? '') ?>">
            <button type="reset" class="clear">Wyczyść</button>
            <button type="submit" class="search">Szukaj</button>

            <label for="day-select">Wybierz widok:</label>
            <select name="day" id="day-select" onchange="this.form.submit()">
                <option value="Week" <?= (isset($_GET['day']) && $_GET['day'] === 'Week') ? 'selected' : '' ?>>Tydzień</option>
                <option value="Month" <?= (isset($_GET['day']) && $_GET['day'] === 'Month') ? 'selected' : '' ?>>Miesiąc</option>
                <option value="Monday" <?= (isset($_GET['day']) && $_GET['day'] === 'Monday') ? 'selected' : '' ?>>Poniedziałek</option>
                <option value="Tuesday" <?= (isset($_GET['day']) && $_GET['day'] === 'Tuesday') ? 'selected' : '' ?>>Wtorek</option>
                <option value="Wednesday" <?= (isset($_GET['day']) && $_GET['day'] === 'Wednesday') ? 'selected' : '' ?>>Środa</option>
                <option value="Thursday" <?= (isset($_GET['day']) && $_GET['day'] === 'Thursday') ? 'selected' : '' ?>>Czwartek</option>
                <option value="Friday" <?= (isset($_GET['day']) && $_GET['day'] === 'Friday') ? 'selected' : '' ?>>Piątek</option>
                <option value="Saturday" <?= (isset($_GET['day']) && $_GET['day'] === 'Saturday') ? 'selected' : '' ?>>Sobota</option>
                <option value="Sunday" <?= (isset($_GET['day']) && $_GET['day'] === 'Sunday') ? 'selected' : '' ?>>Niedziela</option>
            </select>

            <button type="submit" name="weekend_change" value="previous" class="arrow-button">←</button>
            <label for="start_date">Start Date</label>
            <input type="date" id="start_date" name="start_date" value="<?= htmlspecialchars($filters['start_date'] ?? '') ?>">

            <label for="end_date">End Date</label>
            <input type="date" id="end_date" name="end_date" value="<?= htmlspecialchars($filters['end_date'] ?? '') ?>">

            <button type="submit" name="weekend_change" value="next" class="arrow-button">→</button>
        </form>
    </div>
    <div class="container">
        <div class="scale-buttons">
            <button id="increaseFont">Powiększ tekst</button>
            <button id="decreaseFont">Pomniejsz tekst</button>
            <button id="toggleTheme">Zmień motyw</button>

        </div>
    </div>

</header>
<main>
    <div class="schedule">
        <?php

        $startDate = '2025-01-10';
        $endDate = '2025-01-20';

        $startDateTime = new DateTime($startDate);
        $endDateTime = new DateTime($endDate);

        $startOfMonth = $startDateTime->modify('first day of this month')->format('Y-m-d');
        $endOfMonth = $startDateTime->modify('last day of this month')->format('Y-m-d');

        $startDateTime = new DateTime($startDate);

        $groupedClasses = [];
        foreach ($zajecia as $lesson) {
            $dayOfWeek = date('l', strtotime($lesson->getDataStart()));
            $groupedClasses[$dayOfWeek][] = $lesson;
        }

        $daysOfWeek = [
            'Monday' => 'Poniedziałek',
            'Tuesday' => 'Wtorek',
            'Wednesday' => 'Środa',
            'Thursday' => 'Czwartek',
            'Friday' => 'Piątek',
            'Saturday' => 'Sobota',
            'Sunday' => 'Niedziela',
        ];

        $selectedDay = $_GET['day'] ?? 'Week';

        if ($selectedDay !== 'Week' && $selectedDay !== 'Month') {
            echo '<div class="day">';
            echo '<h3>' . htmlspecialchars($daysOfWeek[$selectedDay]) . '</h3>';

            if (!empty($groupedClasses[$selectedDay])) {
                foreach ($groupedClasses[$selectedDay] as $lesson) {
                    echo '<div class="lesson ' . htmlspecialchars($lesson->getLessonType() ?? '') . '">';
                    echo '<h4>' . htmlspecialchars($lesson->getSubjectName() ?? 'Nieznany przedmiot') . '</h4>';
                    echo '<p><span class="material-symbols-outlined">home_pin</span>' . htmlspecialchars($lesson->getRoomName() ?? 'Nieznana sala') . '</p>';
                    echo '<p><span class="material-symbols-outlined">person_pin</span>' . htmlspecialchars($lesson->getTeacherName() ?? 'Nieznany wykładowca') . '</p>';
                    echo '<h4>' . htmlspecialchars(date('H:i', strtotime($lesson->getDataStart())) ?? 'Brak godziny') . ' - ' . htmlspecialchars(date('H:i', strtotime($lesson->getDataKoniec())) ?? 'Brak godziny') . '</h4>';
                    echo '</div>';
                }
            } else {
                echo '<p>Brak zajęć</p>';
            }

            echo '</div>';
        } else if($selectedDay == 'Week'){
            foreach ($daysOfWeek as $dayEnglish => $dayPolish) {
                echo '<div class="day">';
                echo '<h3>' . htmlspecialchars($dayPolish) . '</h3>';

                if (!empty($groupedClasses[$dayEnglish])) {
                    foreach ($groupedClasses[$dayEnglish] as $lesson) {
                        echo '<div class="lesson ' . htmlspecialchars($lesson->getLessonType() ?? '') . '">';
                        echo '<h4>' . htmlspecialchars($lesson->getSubjectName() ?? 'Nieznany przedmiot') . '</h4>';
                        echo '<p><span class="material-symbols-outlined">home_pin</span>' . htmlspecialchars($lesson->getRoomName() ?? 'Nieznana sala') . '</p>';
                        echo '<p><span class="material-symbols-outlined">person_pin</span>' . htmlspecialchars($lesson->getTeacherName() ?? 'Nieznany wykładowca') . '</p>';
                        echo '<h4>' . htmlspecialchars(date('H:i', strtotime($lesson->getDataStart())) ?? 'Brak godziny') . ' - ' . htmlspecialchars(date('H:i', strtotime($lesson->getDataKoniec())) ?? 'Brak godziny') . '</h4>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>Brak zajęć</p>';
                }

                echo '</div>';
            }
            }
        else if($selectedDay == 'Month') {
            $firstDayOfMonth = date('N', strtotime($startOfMonth)); // 1 - Poniedziałek, 7 - Niedziela
            $totalDays = date('t', strtotime($startOfMonth)); // Liczba dni w miesiącu

            $day = 1;
            echo '<table class="calendar">';
            echo '<tr><th>Pn</th><th>Wt</th><th>Śr</th><th>Cz</th><th>Pt</th><th>Sb</th><th>Nd</th></tr>';
            echo '<tr>';

            for ($i = 1; $i < $firstDayOfMonth; $i++) {
                echo '<td></td>';
            }

            // Wypełnianie dniami miesiąca
            while ($day <= $totalDays) {
                if (($firstDayOfMonth + $day - 1) % 7 == 1) {
                    echo '<tr>';
                }

                $currentDate = date('Y-m-d', strtotime("$startOfMonth +$day days -1 day"));
                echo '<td>';
                echo '<div class="day-number">' . $day . '</div>';

                if ($currentDate >= $startDate && $currentDate <= $endDate) {
                    $dayOfWeek = date('l', strtotime($currentDate));
                    if (isset($groupedClasses[$dayOfWeek])) {
                        foreach ($groupedClasses[$dayOfWeek] as $lesson) {
                            echo '<div class="lesson ' . htmlspecialchars($lesson->getLessonType() ?? '') . '">';
                            echo '<h4>' . htmlspecialchars($lesson->getSubjectName() ?? 'Nieznany przedmiot') . '</h4>';
                            echo '<p><span class="material-symbols-outlined">home_pin</span>' . htmlspecialchars($lesson->getRoomName() ?? 'Nieznana sala') . '</p>';
                            echo '<p><span class="material-symbols-outlined">person_pin</span>' . htmlspecialchars($lesson->getTeacherName() ?? 'Nieznany wykładowca') . '</p>';
                            echo '<h4>' . htmlspecialchars(date('H:i', strtotime($lesson->getDataStart())) ?? 'Brak godziny') . ' - ' . htmlspecialchars(date('H:i', strtotime($lesson->getDataKoniec())) ?? 'Brak godziny') . '</h4>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>Brak zajęć</p>';
                    }
                }

                echo '</td>';

                if (($firstDayOfMonth + $day) % 7 == 0) {
                    echo '</tr>';
                }

                $day++;
            }

            echo '</tr>';
            echo '</table>';
        }
        ?>
    </div>
</main>


<footer>
    <div class="legend">
        <div class="legend-item">
<!--            <span class="legend-color laboratorium"></span>-->
            <span>Laboratorium</span>
        </div>
        <div class="legend-item">
<!--            <span class="legend-color wyklad"></span>-->
            <span>Wykład</span>
        </div>
        <div class="legend-item">
<!--            <span class="legend-color audytoryjne"></span>-->
            <span>Audytoryjne</span>
        </div>
        <div class="legend-item">
<!--            <span class="legend-color projekt"></span>-->
            <span>Projekt</span>
        </div>
        <div class="legend-item">
<!--            <span class="legend-color lektorat"></span>-->
            <span>Lektorat</span>
        </div>
    </div>
</footer>
</body>
<script>
    const toggleThemeButton = document.getElementById('toggleTheme');
    const increaseFontButton = document.getElementById('increaseFont');
    const decreaseFontButton = document.getElementById('decreaseFont');
    const body = document.body;

    // Toggle dark mode
    toggleThemeButton.addEventListener('click', () => {
        body.classList.toggle('dark-mode');
    });

    // Scale font size
    increaseFontButton.addEventListener('click', () => {
        document.querySelectorAll('body, h1, h2, h3, h4, p, button, .lesson').forEach((el) => {
            const currentSize = parseFloat(getComputedStyle(el).fontSize);
            el.style.fontSize = `${currentSize + 2}px`;
        });
    });

    decreaseFontButton.addEventListener('click', () => {
        document.querySelectorAll('body, h1, h2, h3, h4, p, button, .lesson').forEach((el) => {
            const currentSize = parseFloat(getComputedStyle(el).fontSize);
            el.style.fontSize = `${currentSize - 2}px`;
        });
    });

</script>
</html>
