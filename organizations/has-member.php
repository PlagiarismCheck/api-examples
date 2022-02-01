<?php

DEFINE('API_TOKEN', 'G-TOKEN-EXAMPLE');
DEFINE('API_USER_EMAIL', 'test@example.com');

$curl = \curl_init();

\curl_setopt_array(
    $curl,
    [
        CURLOPT_URL => 'https://plagiarismcheck.org/api/org/group/has-member/',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => http_build_query([
            'email' => API_USER_EMAIL,
            'group_token' => API_TOKEN
        ])
    ]
);

$response = \curl_exec($curl);

\curl_close($curl);
if ($response && $json = \json_decode($response)) {
    var_dump($json);
}
