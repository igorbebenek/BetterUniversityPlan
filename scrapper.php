<?php
set_time_limit(3000);

function fetchWithCurl($urls) {
    $multiCurl = curl_multi_init();
    $curlHandles = [];
    $results = [];

    foreach ($urls as $key => $url) {
        $curlHandles[$key] = curl_init();
        curl_setopt($curlHandles[$key], CURLOPT_URL, $url);
        curl_setopt($curlHandles[$key], CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlHandles[$key], CURLOPT_TIMEOUT, 10);
        curl_multi_add_handle($multiCurl, $curlHandles[$key]);
    }

    $active = null;
    do {
        $status = curl_multi_exec($multiCurl, $active);
        curl_multi_select($multiCurl, 0.5);
    } while ($active && $status == CURLM_OK);

    foreach ($curlHandles as $key => $ch) {
        $response = curl_multi_getcontent($ch);
        $results[$key] = $response !== false ? json_decode($response, true) : null;
        curl_multi_remove_handle($multiCurl, $ch);
        curl_close($ch);
    }

    curl_multi_close($multiCurl);
    return $results;
}


function saveToFile($filename, $data) {
    $existingData = [];
    if (file_exists($filename)) {
        $existingContent = file_get_contents($filename);
        if (!empty($existingContent)) {
            $existingData = json_decode($existingContent, true);
        }
    }

    $existingData[] = $data;

    file_put_contents($filename, json_encode($existingData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

function fetchTeacherSchedule($teacherName, $startDate, $endDate) {
    $url = "https://plan.zut.edu.pl/schedule_student.php?teacher=" . urlencode($teacherName) . "&start=" . urlencode($startDate) . "&end=" . urlencode($endDate);
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    
    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true);
}

function scrapeAllStudentsWithTeachers($startDate, $endDate, $batchSize = 100) {
    $filename = 'results.txt';
    $maxIndex = 51555;
    $teachers = [];

    for ($startIndex = 50000; $startIndex <= $maxIndex; $startIndex += $batchSize) {
        $urls = [];
        $endIndex = min($startIndex + $batchSize - 1, $maxIndex);

        for ($i = $startIndex; $i <= $endIndex; $i++) {
            $studentNumber = str_pad($i, 5, "0", STR_PAD_LEFT);
            $urls[$studentNumber] = "https://plan.zut.edu.pl/schedule_student.php?number=$studentNumber&start=$startDate&end=$endDate";
        }

        $results = fetchWithCurl($urls);

$batchResults = [];

foreach ($results as $studentNumber => $data) {
    if (!empty($data) && count($data) > 1) {
        echo "Dane znalezione dla studenta: $studentNumber\n";

        foreach ($data as $lesson) {
            if (isset($lesson['worker']) && !in_array($lesson['worker'], $teachers)) {
                $teachers[] = $lesson['worker'];
            }
        }

        $batchResults[] = [
            'studentNumber' => $studentNumber,
            'schedule' => $data
        ];
    } else {
        echo "Brak danych dla studenta: $studentNumber\n";
    }

    if (count($batchResults) >= 100) {
            saveToFile($filename, $batchResults);
            $batchResults = [];
        }
    }

    if (count($batchResults) > 0) {
        saveToFile($filename, $batchResults);
    }
}

    foreach ($teachers as $teacherName) {
        echo "Scrapujê plan wyk³adowcy: $teacherName\n";
        $teacherSchedule = fetchTeacherSchedule($teacherName, $startDate, $endDate);
        if (!empty($teacherSchedule)) {

            saveToFile('teachers_results.txt', [
                'teacherName' => $teacherName,
                'schedule' => $teacherSchedule
            ]);
        } else {
            echo "Brak danych dla wyk³adowcy: $teacherName\n";
        }
    }
}

$startDate = '2025-01-13T00:00:00+01:00';
$endDate = '2025-01-20T00:00:00+01:00';

scrapeAllStudentsWithTeachers($startDate, $endDate);

?>
