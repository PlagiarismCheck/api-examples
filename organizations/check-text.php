<?php

DEFINE('API_TOKEN', 'G-TOKEN-EXAMPLE');
DEFINE('API_USER_EMAIL', 'test@example.com');


$curl = \curl_init();

\curl_setopt_array(
    $curl,
    [
        CURLOPT_URL => 'https://plagiarismcheck.org/api/org/text/check/',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_VERBOSE=>1,
        CURLOPT_POSTFIELDS => http_build_query([
            'author' => API_USER_EMAIL,
            'group_token' => API_TOKEN,
            'text'=> "Plagiarism might not be the same in all countries. Some countries, such as India and Poland, consider plagiarism to be a crime, and there have been cases of people being imprisoned for plagiarizing.[18] In other instances, plagiarism might be the complete opposite of \"academic dishonesty\"; in fact, in some countries the act of plagiarizing a professional's work is seen as flattering.[19] Students who move to the United States and other Western countries from countries where plagiarism is not frowned upon often find the transition difficult"
        ])
    ]
);


$response = \curl_exec($curl);

var_dump($response);
\curl_close($curl);
if ($response && $json = \json_decode($response)) {
    var_dump($json);
}
