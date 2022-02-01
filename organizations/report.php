<?php

DEFINE('API_TOKEN', 'G-TOKEN-EXAMPLE');
DEFINE('API_USER_EMAIL', 'test@example.com');

$check_id = 10;

$curl = \curl_init();

//check status 
\curl_setopt_array(
    $curl,
    [
        CURLOPT_URL => 'https://plagiarismcheck.org/api/org/text/report/'.$check_id.'/',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => http_build_query([
            'group_token' => API_TOKEN
        ])
    ]
);

$response = \curl_exec($curl);
if ($response && $json = \json_decode($response)) {
    var_dump($json);
}

\curl_close($curl);
