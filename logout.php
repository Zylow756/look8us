<?php
declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Configuration
|--------------------------------------------------------------------------
*/
require_once __DIR__ . '/config.php';

/*
|--------------------------------------------------------------------------
| Secure Session
|--------------------------------------------------------------------------
*/
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_set_cookie_params([
        'lifetime' => 0,
        'path'     => '/',
        'domain'   => '',
        'secure'   => !empty($_SERVER['HTTPS']),
        'httponly' => true,
        'samesite' => 'Lax'
    ]);

    session_start();
}

/*
|--------------------------------------------------------------------------
| Prevent Browser Cache
|--------------------------------------------------------------------------
*/
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');
header('Expires: Thu, 01 Jan 1970 00:00:00 GMT');

// Empty all session data
$_SESSION = [];

// Delete session cookie
if (ini_get('session.use_cookies')) {
    $params = session_get_cookie_params();

    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params['path'],
        $params['domain'],
        $params['secure'],
        $params['httponly']
    );
}

// Destroy session
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta
    name="viewport"
    content="width=device-width, initial-scale=1.0"
>

<meta
    http-equiv="X-UA-Compatible"
    content="IE=edge"
>

<title>Logout | Admin Panel</title>

<link
    rel="stylesheet"
    href="akc.css"
>

<style>

:root{
    --primary:#0d6efd;
    --success:#198754;
    --bg:#f4f7fb;
    --card:#ffffff;
    --text:#222;
    --shadow:0 12px 30px rgba(0,0,0,.12);
}

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{

    font-family:
        Arial,
        Helvetica,
        sans-serif;

    background:
        #70828F url("img/bg.png")
        repeat-x;

    color:var(--text);

    min-height:100vh;

    display:flex;
    flex-direction:column;
}

main{

    flex:1;

    display:flex;

    justify-content:center;

    align-items:center;

    padding:40px 20px;
}

.logout-card{

    width:min(95%,700px);

    background:var(--card);

    border-radius:16px;

    box-shadow:var(--shadow);

    padding:50px 30px;

    text-align:center;
}

.logout-card h1{

    color:var(--success);

    font-size:clamp(28px,4vw,42px);

    margin-bottom:20px;
}

.logout-card p{

    font-size:18px;

    margin-bottom:30px;

    color:#555;
}

.home-btn{

    display:inline-block;

    background:var(--primary);

    color:#fff;

    text-decoration:none;

    padding:14px 34px;

    border-radius:8px;

    font-weight:bold;

    transition:.3s;
}

.home-btn:hover{

    background:#0b5ed7;

    transform:translateY(-2px);
}
</style>

</head>
<body>
<header>
    <?php require_once __DIR__ . '/header.php'; ?>
</header>
<main>

    <section class="logout-card">

        <h1>✔ You Have Successfully Logged Out</h1>

        <p>
            Your session has been securely terminated.
            Thank you for using the Admin Panel.
        </p>

        <a
            href="index.php"
            class="home-btn"
        >
            Go to Home →
        </a>

    </section>

</main>
<footer>
    <?php require_once __DIR__ . '/footer.php'; ?>
</footer>

</body>
</html>