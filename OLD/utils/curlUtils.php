<?php
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
?>
