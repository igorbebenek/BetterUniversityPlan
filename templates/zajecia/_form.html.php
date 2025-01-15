<?php
/** @var \App\Model\Zajecia|null $zajecia */
?>

<div class="form-group">
    <label for="data_start">Start Date</label>
    <input type="datetime-local" id="data_start" name="zajecia[data_start]" value="<?= htmlspecialchars($zajecia ? $zajecia->getDataStart() : '', ENT_QUOTES, 'UTF-8') ?>">
</div>

<div class="form-group">
    <label for="data_koniec">End Date</label>
    <input type="datetime-local" id="data_koniec" name="zajecia[data_koniec]" value="<?= htmlspecialchars($zajecia ? $zajecia->getDataKoniec() : '', ENT_QUOTES, 'UTF-8') ?>">
</div>

<div class="form-group">
    <label for="zastepca">Substitute Teacher</label>
    <input type="text" id="zastepca" name="zajecia[zastepca]" value="<?= htmlspecialchars($zajecia ? $zajecia->getZastepca() : '', ENT_QUOTES, 'UTF-8') ?>">
</div>

<div class="form-group">
    <label for="semestr">Semester</label>
    <input type="number" id="semestr" name="zajecia[semestr]" value="<?= htmlspecialchars($zajecia ? $zajecia->getSemestr() : '', ENT_QUOTES, 'UTF-8') ?>">
</div>

<div class="form-group">
    <label for="wykladowca_id">Teacher ID</label>
    <input type="number" id="wykladowca_id" name="zajecia[wykladowca_id]" value="<?= htmlspecialchars($zajecia ? $zajecia->getWykladowcaId() : '', ENT_QUOTES, 'UTF-8') ?>">
</div>

<div class="form-group">
    <label for="wydzial_id">Department ID</label>
    <input type="number" id="wydzial_id" name="zajecia[wydzial_id]" value="<?= htmlspecialchars($zajecia ? $zajecia->getWydzialId() : '', ENT_QUOTES, 'UTF-8') ?>">
</div>

<div class="form-group">
    <label for="grupa_id">Group ID</label>
    <input type="number" id="grupa_id" name="zajecia[grupa_id]" value="<?= htmlspecialchars($zajecia ? $zajecia->getGrupaId() : '', ENT_QUOTES, 'UTF-8') ?>">
</div>

<div class="form-group">
    <label for="tok_studiow_id">Study Course ID</label>
    <input type="number" id="tok_studiow_id" name="zajecia[tok_studiow_id]" value="<?= htmlspecialchars($zajecia ? $zajecia->getTokStudiowId() : '', ENT_QUOTES, 'UTF-8') ?>">
</div>

<div class="form-group">
    <label for="przedmiot_id">Subject ID</label>
    <input type="number" id="przedmiot_id" name="zajecia[przedmiot_id]" value="<?= htmlspecialchars($zajecia ? $zajecia->getPrzedmiotId() : '', ENT_QUOTES, 'UTF-8') ?>">
</div>

<div class="form-group">
    <label for="sala_id">Room ID</label>
    <input type="number" id="sala_id" name="zajecia[sala_id]" value="<?= htmlspecialchars($zajecia ? $zajecia->getSalaId() : '', ENT_QUOTES, 'UTF-8') ?>">
</div>

<div class="form-group">
    <label for="student_id">Student ID (Optional)</label>
    <input type="number" id="student_id" name="zajecia[student_id]" value="<?= htmlspecialchars($zajecia ? $zajecia->getStudentId() : '', ENT_QUOTES, 'UTF-8') ?>">
</div>

<div class="form-group">
    <input type="submit" value="Submit">
</div>
