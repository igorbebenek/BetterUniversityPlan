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


    .schedule {
        display: flex;
        justify-content: center;
        max-width: 1400px;
        margin: 0 auto;
        padding: 20px;
        overflow-x: auto;
    }

    .calendar {
        width: 100%;
        min-width: 900px;
        max-width: 1300px;
        border-collapse: collapse;
        table-layout: fixed;
        background: white;
        margin: 0 auto;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .calendar th,
    .calendar td {
        border: 1px solid #e0e0e0;
        padding: 10px;
        vertical-align: top;
        height: 120px; /
        width: 14.285714%;
        position: relative;
    }

    .calendar th {
        background: #f8f9fa;
        height: auto;
        padding: 15px 10px;
        font-weight: 600;
        text-align: center;
        position: sticky;
        top: 0;
        z-index: 1;
        border-bottom: 2px solid #dee2e6;
    }

    .calendar .day-number {
        position: absolute;
        top: 8px;
        left: 8px;
        font-weight: 500;
        color: #666;
        font-size: 14px;
    }

    .calendar td:empty,
    .calendar td:has(> .day-number:only-child) {
        background: #fafafa;
        height: 120px;
    }

    .calendar .lesson {
        margin: 25px 0 5px 0;
        padding: 8px;
        font-size: 12px;
        border-radius: 6px;
        overflow: hidden;
        word-wrap: break-word;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        border: 1px solid rgba(0, 0, 0, 0.1);
    }

    .calendar .lesson h4 {
        margin: 0 0 5px 0;
        font-size: 13px;
        font-weight: 600;
        line-height: 1.3;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .calendar .lesson p {
        margin: 3px 0;
        font-size: 11px;
        line-height: 1.4;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .calendar td:has(> :only-child:not(.lesson)) {
        color: #999;
        font-size: 13px;
        text-align: center;
        padding-top: 50px;
    }

    .calendar .lesson .material-symbols-outlined {
        font-size: 14px;
        vertical-align: middle;
        opacity: 0.8;
    }

    .calendar .lesson:hover {
        transform: scale(1.02);
        transition: transform 0.2s ease;
        z-index: 2;
        position: relative;
    }

    .dark-mode .calendar {
        background: #2d2d2d;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    }

    .dark-mode .calendar th {
        background: #363636;
        border-bottom: 2px solid #404040;
    }

    .dark-mode .calendar td {
        border-color: #404040;
    }

    .dark-mode .calendar td:empty,
    .dark-mode .calendar td:has(> .day-number:only-child) {
        background: #333;
    }

    .dark-mode .calendar .day-number {
        color: #bbb;
    }

    .dark-mode td:has(> :only-child:not(.lesson)) {
        color: #777;
    }

    .calendar tr {
        display: table-row;
        height: auto;
    }

    @media screen and (max-width: 1024px) {
        .calendar {
            min-width: 800px;
        }
    }

    @media screen and (min-width: 1400px) {
        .calendar .lesson h4 {
            font-size: 14px;
        }

        .calendar .lesson p {
            font-size: 12px;
        }
    }

    .calendar .week-number {
        background: #f8f9fa;
        font-weight: 600;
        text-align: center;
        padding: 10px;
        border-right: 2px solid #dee2e6;
    }

    .dark-mode .calendar .week-number {
        background: #363636;
        color: #e0e0e0;
    }

    @media screen and (max-width: 1024px) {
        .calendar .week-number {
            font-size: 12px;
            padding: 5px;
        }
    }

    /* Tablet (768px - 1024px) */
    @media (min-width: 768px) and (max-width: 1024px) {
        /* Wspólne style */
        .filters {
            flex-wrap: wrap;
            gap: 8px;
            padding: 10px;
        }

        .filters input,
        .filters select,
        .filters button {
            font-size: 14px;
            padding: 6px 10px;
        }

        .day {
            padding: 8px;
        }

        .day h3 {
            font-size: 16px;
            padding: 8px;
        }

        .lesson {
            padding: 10px;
            margin-top: 8px;
        }

        .lesson h4 {
            font-size: 14px;
        }

        .lesson p {
            font-size: 12px;
        }

        .calendar {
            min-width: 700px;
            font-size: 14px;
        }

        .calendar td {
            padding: 5px;
            height: 100px;
        }

        .calendar .lesson {
            margin: 15px 0 3px 0;
            padding: 5px;
        }

        .calendar .day-number {
            font-size: 12px;
        }

        .calendar .week-number {
            font-size: 12px;
            padding: 5px;
            min-width: 60px;
        }
    }

    @media (max-width: 767px) {
        .filters {
            flex-direction: column;
            padding: 10px;
        }

        .filters input,
        .filters select,
        .filters button {
            width: 100%;
            margin-bottom: 5px;
            font-size: 16px;
            padding: 10px;
        }

        .filters label {
            margin-top: 10px;
        }

        .schedule {
            padding: 10px;
            display: block;
        }

        .day {
            margin-bottom: 15px;
            padding: 5px;
        }

        .day h3 {
            font-size: 18px;
            padding: 10px;
        }

        .lesson {
            margin: 10px 0;
            padding: 12px;
        }

        .lesson h4 {
            font-size: 16px;
            margin-bottom: 8px;
        }

        .lesson p {
            font-size: 14px;
        }

        .calendar {
            min-width: auto;
            width: 100%;
            font-size: 12px;
        }

        .calendar th {
            padding: 5px;
            font-size: 12px;
        }

        .calendar td {
            padding: 3px;
            height: auto;
            min-height: 80px;
        }

        .calendar .lesson {
            margin: 20px 0 3px 0;
            padding: 4px;
        }

        .calendar .lesson h4 {
            font-size: 11px;
            margin-bottom: 2px;
        }

        .calendar .lesson p {
            font-size: 10px;
            margin: 1px 0;
        }

        .calendar .day-number {
            font-size: 11px;
            top: 2px;
            left: 2px;
        }

        .calendar .week-number {
            font-size: 11px;
            padding: 3px;
            min-width: 50px;
        }

        .nav-buttons {
            width: 100%;
            justify-content: space-between;
            margin-top: 10px;
        }

        .nav-btn {
            padding: 8px 15px;
        }

        .legend {
            flex-direction: column;
            align-items: flex-start;
            padding: 10px;
        }

        .legend-item {
            margin: 5px 0;
        }
    }

    /* Fix dla scrollowania na małych ekranach */
    @media (max-width: 1024px) {
        .schedule {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .calendar {
            margin: 0;
        }
    }

    /* Style dla przycisków na górze */
    .scale-buttons {
        position: static;
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        padding: 10px;
        background: #fff;
        width: 100%;
        justify-content: center;
        margin-bottom: 15px;
    }

    .scale-buttons button,
    #toggleTheme {
        flex: 1;
        min-width: 120px;
        max-width: 200px;
        padding: 12px 15px;
        font-size: 14px;
        white-space: nowrap;
        border-radius: 8px;
    }

    /* Style dla widoku semestralnego */
    .calendar {
        border-collapse: separate;
        border-spacing: 2px;
    }

    .calendar td {
        height: auto;
        min-height: 100px;
        padding: 8px;
        font-size: 13px;
    }

    .calendar .lesson {
        margin: 25px 3px 3px 3px;
        padding: 8px;
        font-size: 11px;
        line-height: 1.3;
    }

    .calendar .lesson h4 {
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 4px;
    }

    .calendar .lesson p {
        font-size: 11px;
        margin: 2px 0;
    }

    .calendar .material-symbols-outlined {
        font-size: 12px;
    }

    /* Poprawiona responsywność dla telefonów */
    @media (max-width: 767px) {
        .scale-buttons {
            padding: 8px;
        }

        .scale-buttons button,
        #toggleTheme {
            width: calc(50% - 8px);
            min-width: 0;
            font-size: 12px;
            padding: 10px;
        }

        .calendar {
            min-width: 800px;
        }

        .calendar td {
            min-width: 100px;
            padding: 4px;
        }

        .calendar .lesson {
            padding: 6px;
            margin-top: 20px;
        }

        .calendar .lesson h4 {
            font-size: 11px;
        }

        .calendar .lesson p {
            font-size: 10px;
        }

        .calendar .day-number {
            font-size: 10px;
            top: 2px;
            left: 2px;
        }

        .calendar th {
            font-size: 11px;
            padding: 8px 4px;
            white-space: nowrap;
        }

        .calendar .week-number {
            font-size: 10px;
            padding: 4px;
            min-width: 60px;
        }
    }

    /* Tablet */
    @media (min-width: 768px) and (max-width: 1024px) {
        .scale-buttons button,
        #toggleTheme {
            font-size: 13px;
            padding: 10px;
        }

        .calendar td {
            padding: 6px;
        }

        .calendar .lesson {
            padding: 6px;
            margin-top: 22px;
        }

        .calendar .lesson h4 {
            font-size: 12px;
        }
    }

    .schedule {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        padding: 10px;
        margin: 0;
        position: relative;
    }

    .calendar .lesson.laboratorium { background-color: #8BE78B; }
    .calendar .lesson.wyklad { background-color: #7BB5FF; }
    .calendar .lesson.audytoryjne { background-color: #FFE066; }
    .calendar .lesson.projekt { background-color: #FF8F8F; }
    .calendar .lesson.lektorat { background-color: #FFB366; }

    .schedule {
        max-width: 1200px;
        margin: 0 auto;
        padding: 15px;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    /* Style dla widoku tygodniowego */
    @media (max-width: 768px) {
        .schedule {
            padding: 10px;
            display: block;
        }

        .day {
            margin-bottom: 15px;
            width: 100%;
        }
    }

    /* Style dla widoku miesięcznego i semestralnego */
    @media (max-width: 768px) {
        .calendar {
            min-width: 500px;
        }

        .calendar td {
            min-height: 60px;
            padding: 4px;
        }

        .calendar .lesson {
            margin-top: 18px;
            padding: 4px;
        }
    }

    :root {
        --sepia-background: #F4ECD8;
        --sepia-text: #5B4636;
        --sepia-card: #FFF7E6;
        --sepia-border: #DED1B6;
        --sepia-button: #7B6B5B;
        --sepia-button-text: #F4ECD8;
    }

    /* Klasa dla trybu sepia */
    .sepia-mode {
        background-color: var(--sepia-background);
        color: var(--sepia-text);
    }

    .sepia-mode header,
    .sepia-mode footer,
    .sepia-mode .calendar {
        background: var(--sepia-card);
        border-color: var(--sepia-border);
    }

    .sepia-mode .filters input,
    .sepia-mode .filters select {
        background-color: var(--sepia-card);
        border-color: var(--sepia-border);
        color: var(--sepia-text);
    }

    .sepia-mode .lesson {
        background-color: var(--sepia-card);
        border-color: var(--sepia-border);
    }

    .sepia-mode button {
        background-color: var(--sepia-button);
        color: var(--sepia-button-text);
    }

    .sepia-mode .calendar th {
        background-color: var(--sepia-card);
        border-color: var(--sepia-border);
    }

    .sepia-mode .calendar td {
        background-color: var(--sepia-card);
        border-color: var(--sepia-border);
    }


    .cookie-notice {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        background: #333;
        color: white;
        padding: 1rem;
        text-align: center;
        z-index: 1000;
    }

    .cookie-notice button {
        background: #007AFF;
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        margin-left: 1rem;
        border-radius: 5px;
        cursor: pointer;
    }

    html {
        font-size: var(--font-size-base, 16px);
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
                <option value="Semester" <?= (isset($_GET['day']) && $_GET['day'] === 'Semester') ? 'selected' : '' ?>>Semestr</option>
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
            <button id="toggleSepia">Tryb sepia</button>


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

        if ($selectedDay !== 'Week' && $selectedDay !== 'Month' && $selectedDay !== 'Semester') {
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
        else if ($selectedDay == 'Month') {
            $firstDayOfMonth = date('N', strtotime($startOfMonth)); // 1 - Poniedziałek, 7 - Niedziela
            $totalDays = date('t', strtotime($startOfMonth)); // Liczba dni w miesiącu

            echo '<table class="calendar">';
            echo '<tr><th>Pn</th><th>Wt</th><th>Śr</th><th>Cz</th><th>Pt</th><th>Sb</th><th>Nd</th></tr>';

            $day = 1;
            echo '<tr>';

            for ($i = 1; $i < $firstDayOfMonth; $i++) {
                echo '<td class="empty"></td>';
            }

            while ($day <= $totalDays) {
                if (($firstDayOfMonth + $day - 2) % 7 == 0) {
                    echo '</tr><tr>'; // Nowa linia co poniedziałek
                }

                $currentDate = date('Y-m-d', strtotime("$startOfMonth +" . ($day - 1) . " days"));
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

                if (($firstDayOfMonth + $day - 1) % 7 == 0) {
                    echo '</tr>';
                }

                $day++;
            }

            while (($firstDayOfMonth + $totalDays - 1) % 7 != 6) {
                echo '<td class="empty"></td>';
                $totalDays++;
            }

            echo '</tr>';
            echo '</table>';
        }

        else if ($selectedDay == 'Semester') {
            $semesterStartDate = new DateTime('2024-10-01');
            $semesterEndDate = new DateTime('2025-06-30');

            echo '<table class="calendar">';
            echo '<tr><th>Tydzień</th><th>Pn</th><th>Wt</th><th>Śr</th><th>Cz</th><th>Pt</th><th>Sb</th><th>Nd</th></tr>';

            $currentDate = clone $semesterStartDate;
            $weekNumber = 1;

            while ($currentDate <= $semesterEndDate) {
                $weekStart = clone $currentDate;
                $weekStart->modify('monday this week');

                echo '<tr>';
                echo '<td class="week-number">Tydzień ' . $weekNumber . '</td>';

                for ($i = 1; $i <= 7; $i++) {
                    $currentDayOfWeek = clone $weekStart;
                    $currentDayOfWeek->modify('+' . ($i-1) . ' days');

                    echo '<td>';
                    echo '<div class="day-number">' . $currentDayOfWeek->format('d.m') . '</div>';

                    $dayOfWeek = $currentDayOfWeek->format('l');
                    if (isset($groupedClasses[$dayOfWeek])) {
                        foreach ($groupedClasses[$dayOfWeek] as $lesson) {
                            echo '<div class="lesson ' . htmlspecialchars($lesson->getLessonType() ?? '') . '">';
                            echo '<h4>' . htmlspecialchars($lesson->getSubjectName() ?? 'Nieznany przedmiot') . '</h4>';
                            echo '<p><span class="material-symbols-outlined">home_pin</span>' .
                                htmlspecialchars($lesson->getRoomName() ?? 'Nieznana sala') . '</p>';
                            echo '<p><span class="material-symbols-outlined">person_pin</span>' .
                                htmlspecialchars($lesson->getTeacherName() ?? 'Nieznany wykładowca') . '</p>';
                            echo '<h4>' . htmlspecialchars(date('H:i', strtotime($lesson->getDataStart())) ?? 'Brak godziny') .
                                ' - ' . htmlspecialchars(date('H:i', strtotime($lesson->getDataKoniec())) ?? 'Brak godziny') . '</h4>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>Brak zajęć</p>';
                    }

                    echo '</td>';
                }

                echo '</tr>';
                $currentDate->modify('+1 week');
                $weekNumber++;
            }

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
    const toggleSepiaButton = document.getElementById('toggleSepia');
    const increaseFontButton = document.getElementById('increaseFont');
    const decreaseFontButton = document.getElementById('decreaseFont');
    const body = document.body;


    increaseFontButton.addEventListener('click', () => {
        const currentFontSize = parseFloat(getComputedStyle(document.body).fontSize);
        const newFontSize = currentFontSize + 2;
        document.documentElement.style.fontSize = `${newFontSize}px`;
    });

    decreaseFontButton.addEventListener('click', () => {
        const currentFontSize = parseFloat(getComputedStyle(document.body).fontSize);
        const newFontSize = currentFontSize - 2;
        document.documentElement.style.fontSize = `${newFontSize}px`;
    });

    function monitorCookies() {
        const cookieInfo = {};
        document.cookie.split(';').forEach(cookie => {
            const [name, value] = cookie.trim().split('=');
            cookieInfo[name] = value;
        });
        console.table(cookieInfo);
    }

    function setCookie(name, value, days = 365) {
        const d = new Date();
        d.setTime(d.getTime() + (days * 24 * 60 * 60 * 1000));
        const expires = "expires=" + d.toUTCString();
        document.cookie = name + "=" + value + ";" + expires + ";path=/";
        monitorCookies();
    }

    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
        return null;
    }

    document.querySelector('input[name="teacher"]').addEventListener('change', function(e) {
        setCookie('teacher', e.target.value);
    });

    document.querySelector('input[name="room"]').addEventListener('change', function(e) {
        setCookie('room', e.target.value);
    });

    document.querySelector('input[name="subject"]').addEventListener('change', function(e) {
        setCookie('subject', e.target.value);
    });

    document.querySelector('input[name="group"]').addEventListener('change', function(e) {
        setCookie('group', e.target.value);
    });

    document.querySelector('input[name="student_number"]').addEventListener('change', function(e) {
        setCookie('student_number', e.target.value);
    });

    increaseFontButton.addEventListener('click', () => {
        const bodySize = parseFloat(getComputedStyle(document.body).fontSize);
        const newSize = bodySize + 2;
        document.documentElement.style.fontSize = `${newSize}px`;
        setCookie('fontSize', newSize);
    });

    decreaseFontButton.addEventListener('click', () => {
        const bodySize = parseFloat(getComputedStyle(document.body).fontSize);
        const newSize = bodySize - 2;
        document.documentElement.style.fontSize = `${newSize}px`;
        setCookie('fontSize', newSize);
    });

    toggleSepiaButton.addEventListener('click', () => {
        body.classList.remove('dark-mode');
        body.classList.toggle('sepia-mode');
        setCookie('theme', body.classList.contains('sepia-mode') ? 'sepia' : 'normal');
    });

    toggleThemeButton.addEventListener('click', () => {
        body.classList.remove('sepia-mode');
        body.classList.toggle('dark-mode');
        setCookie('theme', body.classList.contains('dark-mode') ? 'dark' : 'normal');
    });

    document.getElementById('day-select').addEventListener('change', function(e) {
        setCookie('view', e.target.value);
    });

    document.querySelector('button[type="reset"]').addEventListener('click', function() {
        // Wyczyść cookies formularza
        setCookie('teacher', '', -1);
        setCookie('room', '', -1);
        setCookie('subject', '', -1);
        setCookie('group', '', -1);
        setCookie('student_number', '', -1);
    });

    function acceptCookies() {
        setCookie('cookiesAccepted', 'true');
        document.getElementById('cookie-notice').style.display = 'none';
    }

    document.addEventListener('DOMContentLoaded', () => {
        const increaseFontButton = document.getElementById('increaseFont');
        const decreaseFontButton = document.getElementById('decreaseFont');

        const root = document.documentElement;

        function getComputedFontSize() {
            return parseFloat(getComputedStyle(root).getPropertyValue('--font-size-base'));
        }

        function changeFontSize(sizeChange) {
            let currentSize = getComputedFontSize();
            let newSize = Math.max(10, currentSize + sizeChange); // Minimalna wartość 10px, aby nie było za małe

            root.style.setProperty('--font-size-base', `${newSize}px`);

            document.cookie = `fontSize=${newSize}; path=/`;
        }

        increaseFontButton.addEventListener('click', () => changeFontSize(2));
        decreaseFontButton.addEventListener('click', () => changeFontSize(-2));

        function getCookie(name) {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);
            if (parts.length === 2) return parts.pop().split(';').shift();
            return null;
        }

        const savedFontSize = getCookie('fontSize');
        if (savedFontSize) {
            root.style.setProperty('--font-size-base', `${savedFontSize}px`);
        }
    });



</script>
</html>
