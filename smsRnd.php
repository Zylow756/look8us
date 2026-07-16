<?php

declare(strict_types=1);
require_once __DIR__ . "/config.php";
/*
|--------------------------------------------------------------------------
| Secure Session Handling
|--------------------------------------------------------------------------
*/
if (session_status() === PHP_SESSION_NONE) {

    session_set_cookie_params([

        'lifetime' => 0,

        'path' => '/',

        'secure' => isset($_SERVER['HTTPS']),

        'httponly' => true,

        'samesite' => 'Lax'

    ]);
    session_start();
}
/*
|--------------------------------------------------------------------------
| SMS API SETTINGS
|--------------------------------------------------------------------------
*/
$apiUrl = "https://sms.websoftsolutions.org/api/v3/index.php";
$apiKey = defined('SMS_API_KEY')
    ? SMS_API_KEY
    : '';
/*
|--------------------------------------------------------------------------
| SMS DATA
|--------------------------------------------------------------------------
*/
$mobileNumbers = [

    "9352621248",

    "9785743421"

];
$message = "testing";
$senderId = "BULKSMS";
/*
|--------------------------------------------------------------------------
| Validate API Key
|--------------------------------------------------------------------------
*/
if (empty($apiKey)) {

    $status = false;

    $responseMessage =
        "SMS API key is missing. Please configure SMS_API_KEY.";
} else {    /*
    |--------------------------------------------------------------------------
    | Prepare CURL Request
    |--------------------------------------------------------------------------
    */
    $smsData = [

        "method" => "sms",

        "api_key" => $apiKey,

        "to" => implode(",", $mobileNumbers),

        "sender" => $senderId,

        "message" => $message,

        "format" => "json",

        "custom" => "1,2",

        "flash" => "0",

        "dlrurl" =>
        "https://look8us.com/smsreponse.php"

    ];
    /*
    |--------------------------------------------------------------------------
    | CURL Initialization
    |--------------------------------------------------------------------------
    */
    $curl = curl_init();
    curl_setopt_array(

        $curl,

        [

            CURLOPT_URL => $apiUrl,

            CURLOPT_POST => true,

            CURLOPT_POSTFIELDS =>
            http_build_query($smsData),

            CURLOPT_RETURNTRANSFER => true,

            CURLOPT_TIMEOUT => 30,

            CURLOPT_CONNECTTIMEOUT => 10,

            CURLOPT_SSL_VERIFYPEER => true,

            CURLOPT_SSL_VERIFYHOST => 2

        ]

    );
    /*
    |--------------------------------------------------------------------------
    | Execute API Request
    |--------------------------------------------------------------------------
    */
    $apiResponse = curl_exec($curl);
    $curlError = curl_error($curl);
    $httpCode = curl_getinfo(
        $curl,
        CURLINFO_HTTP_CODE
    );
    curl_close($curl);

    /*
    |--------------------------------------------------------------------------
    | Error Handling
    |--------------------------------------------------------------------------
    */
    if ($apiResponse === false) {
        $status = false;
        $responseMessage =
            "Unable to connect with SMS server.";
        error_log(
            "SMS CURL ERROR : " . $curlError
        );
    } else {        /*
        |--------------------------------------------------------------------------
        | Decode JSON Response
        |--------------------------------------------------------------------------
        */
        $jsonResponse =
            json_decode(
                $apiResponse,
                true
            );
        if (
            json_last_error() !== JSON_ERROR_NONE
        ) {
            $status = false;
            $responseMessage =
                "Invalid response received from SMS provider.";
            error_log(
                "SMS INVALID JSON : "
                    . $apiResponse
            );
        } else {            /*
            |--------------------------------------------------------------------------
            | Check SMS Provider Response
            |--------------------------------------------------------------------------
            */
            if ($httpCode === 200) {
                $status = true;
                $responseMessage =
                    "SMS sent successfully.";
            } else {
                $status = false;
                $responseMessage =
                    "SMS sending failed.";
                error_log(
                    "SMS API RESPONSE : "
                        . print_r(
                            $jsonResponse,
                            true
                        )
                );
            }
        }
    }
}
?>
<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">
    <title>
        SMS Status
    </title>
    <style>
        * {

            box-sizing: border-box;

        }

        body {

            margin: 0;

            min-height: 100vh;

            display: flex;

            align-items: center;

            justify-content: center;

            background: #f4f6f8;

            font-family:
                Arial,
                Helvetica,
                sans-serif;

        }

        .sms-box {
            width: 90%;

            max-width: 500px;

            background: white;

            padding: 35px;

            border-radius: 12px;

            box-shadow:
                0 5px 25px rgba(0, 0, 0, .15);

            text-align: center;
        }

        .sms-box h2 {
            margin-bottom: 20px;
        }

        .success {
            color: #198754;

            font-size: 20px;

        }

        .error {
            color: #dc3545;

            font-size: 20px;
        }

        button {
            margin-top: 25px;

            padding: 12px 25px;

            border: none;

            border-radius: 6px;

            background: #0066cc;

            color: white;

            cursor: pointer;
        }

        button:hover {
            background: #004999;
        }
    </style>
</head>

<body>
    <div class="sms-box"><?php if ($status): ?><h2 class="success">

                ✔ SMS Sent

            </h2>
            <p>

                <?= htmlspecialchars(
                                    $responseMessage,
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>

            </p>
        <?php else: ?><h2 class="error">

                ✖ SMS Failed

            </h2>
            <p>

                <?= htmlspecialchars(
                                    $responseMessage,
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>

            </p>
        <?php endif; ?>
        <button onclick="history.back()">

            Go Back

        </button>
    </div>
</body>

</html>