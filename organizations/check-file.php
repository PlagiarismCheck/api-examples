<?php

DEFINE('API_TOKEN', 'G-TOKEN-EXAMPLE');
DEFINE('API_USER_EMAIL', 'test@example.com');

function build_http_body_part(string $name, string $value, string $boundary): string
{
    $eol = "\r\n";

    $part = '--'.$boundary.$eol;
    $part .= 'Content-Disposition: form-data; name="'.$name.'"'.$eol.$eol;
    $part .= $value.$eol;

    return $part;
}

function build_http_body_file_part(
    string $name,
    string $value,
    string $mime,
    string $filename,
    string $boundary
): string {
    $eol = "\r\n";

    $part = '--'.$boundary.$eol;
    $part .= 'Content-Disposition: form-data; name="'.$name.'"; filename="'.$filename.'";'.$eol;
    $part .= 'Content-Type: '.$mime.$eol;
    $part .= 'Content-Length: '.\strlen($value).$eol.$eol;
    $part .= $value.$eol;

    return $part;
}

function build_http_body(string $boundary, string $content, string $mime, string $filename): string
{
    $eol = "\r\n";

    $body = '';
    $body .= build_http_body_part('author', API_USER_EMAIL, $boundary);
    $body .= build_http_body_part('group_token', API_TOKEN, $boundary);
    $body .= build_http_body_file_part('text', $content, $mime, $filename, $boundary);
    $body .= '--'.$boundary.'--'.$eol;

    return $body;
}


function send_file(string $content, string $mime, string $filename): ?\stdClass
{
    $boundary = sprintf('PLAGCHECKBOUNDARY-%s', \uniqid((string) \time(), false));

    $curl = \curl_init();

    \curl_setopt_array(
        $curl,
        [
            CURLOPT_URL => 'https://plagiarismcheck.org/api/org/text/check/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => [
                'Content-Type: multipart/form-data; boundary=' . $boundary
            ],
            CURLOPT_POSTFIELDS => build_http_body($boundary, $content, $mime, $filename),
        ]
    );

    $response = \curl_exec($curl);
    \curl_close($curl);
    if ($response && $json = \json_decode($response)) {
        if (isset($json->message)) {
            echo $json->message;
        }

        return $json;
    }

    return null;
}

$filename = 'test document.docx';

$plagcheckData = \send_file(
    \file_get_contents($filename),
    \mime_content_type($filename),
    $filename
);

var_dump($plagcheckData);
