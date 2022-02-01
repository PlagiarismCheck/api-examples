<?php

DEFINE('API_TOKEN', 'default.user');

$curl = \curl_init();

\curl_setopt_array(
    $curl,
    [
        CURLOPT_URL => 'https://plagiarismcheck.org/api/v1/text',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_HTTPHEADER => [
            'X-API-TOKEN: ' . API_TOKEN,
        ],
        CURLOPT_POSTFIELDS => http_build_query([
            'language' => 'en',
            'text'=> "Plagiarism might not be the same in all countries. Some countries, such as India and Poland, consider plagiarism to be a crime, and there have been cases of people being imprisoned for plagiarizing.[18] In other instances, plagiarism might be the complete opposite of \"academic dishonesty\"; in fact, in some countries the act of plagiarizing a professional's work is seen as flattering.[19] Students who move to the United States and other Western countries from countries where plagiarism is not frowned upon often find the transition difficult"
        ])
    ]
);

$response = \curl_exec($curl);

\curl_close($curl);
if ($response && $json = \json_decode($response)) {
    var_dump($json);
}
