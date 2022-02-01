<?php

DEFINE('API_TOKEN', 'default.user');

$curl = \curl_init();

\curl_setopt_array(
    $curl,
    [
        CURLOPT_URL => 'https://plagiarismcheck.org/api/v1/text/report/13',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            'X-API-TOKEN: ' . API_TOKEN,
        ],
    ]
);

$response = \curl_exec($curl);

\curl_close($curl);
if ($response && $json = \json_decode($response)) {
    var_dump($json);
}
