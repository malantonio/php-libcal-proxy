<?php
/**
 *  A simple proxy to bounce CORS requests to LibCal.
 */

// switch to true to force all responses from LibCal to be
// of `Content-type: application/json`
$force_json_response = false;

// set `Access-Control-Allow-Origin` header value
$cors_origin = "*";

if (strtoupper($_SERVER['REQUEST_METHOD']) !== "GET") {
    header("HTTP/1.1 403 Forbidden");
    echo "Only GET requests permitted.";
    exit();
}

$base_url = "https://api3.libcal.com";

/**
 *  if this lives in a folder on the server, strip that portion of the
 *  request uri out before making
 */

$path = $_SERVER['REQUEST_URI'];
$dirname = dirname($path);
$fixed_path = str_replace($dirname, "", $path);

if ($dirname == "/" || $fixed_path == "index.php") {
    echo "It's cool. This is just a proxy for LibCal to support CORS.";
    exit();
} else {
    header("Access-Control-Allow-Origin: " . $cors_origin);
    if ($force_json_response) {
        header("Content-type: application/json");
    }

    $ch = curl_init($base_url . $fixed_path);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_exec($ch);
    curl_close($ch);
}
