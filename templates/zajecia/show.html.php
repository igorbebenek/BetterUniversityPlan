<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plan Zajęć</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
    <h1>Plan Zajęć</h1>
    <form method="GET" action="">
        <label>
            Numer studenta:
            <input type="text" name="student_number" value="<?= htmlspecialchars($filters['student_number'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
        </label>
        <label>
            Wykładowca:
            <input type="text" name="teacher" value="<?= htmlspecialchars($filters['teacher'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
        </label>
        <label>
            Sala:
            <input type="text" name="room" value="<?= htmlspecialchars($filters['room'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
        </label>
        <label>
            Przedmiot:
            <input type="text" name="subject" value="<?= htmlspecialchars($filters['subject'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
        </label>
        <button type="submit">Szukaj</button>
    </form>
</header>

<main>
    <?php if (empty($zajecia)): ?>
        <p>Brak zajęć dla wybranych kryteriów.</p>
    <?php else: ?>
        <div class="schedule">
            <?php foreach ($zajecia as $lesson): ?>
                <div class="lesson">
                    <h2><?= htmlspecialchars($lesson->getSubjectName() ?? 'Nieznany przedmiot', ENT_QUOTES, 'UTF-8') ?></h2>
                    <p>
                        <strong>Godzina:</strong>
                        <?= htmlspecialchars($lesson->getDataStart() ?? 'Brak danych', ENT_QUOTES, 'UTF-8') ?> -
                        <?= htmlspecialchars($lesson->getDataKoniec() ?? 'Brak danych', ENT_QUOTES, 'UTF-8') ?>
                    </p>
                    <p>
                        <strong>Sala:</strong>
                        <?= htmlspecialchars($lesson->getRoom() ?? 'Brak danych', ENT_QUOTES, 'UTF-8') ?>
                    </p>
                    <p>
                        <strong>Wykładowca:</strong>
                        <?= htmlspecialchars($lesson->getTeacherName() ?? 'Brak danych', ENT_QUOTES, 'UTF-8') ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</main>

<footer>
    <p>&copy; <?= date('Y') ?> BetterUniversityPlan</p>
</footer>
</body>
</html>
