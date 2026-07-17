<?php
declare(strict_types=1);

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
| Helper Function
|--------------------------------------------------------------------------
*/
if (!function_exists('e')) {
    function e(string $value): string
    {
        return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}

/*
|--------------------------------------------------------------------------
| Base Path
|--------------------------------------------------------------------------
*/
$basePath = isset($path) ? rtrim((string)$path, '/') . '/' : '';

$menuItems = [
    [
        'title' => 'Home',
        'url'   => 'home.php'
    ],
    [
        'title' => 'Career',
        'url'   => 'career.php'
    ],
    [
        'title' => 'Franchise',
        'url'   => 'Franchise.php'
    ],
    [
        'title' => 'Event & Activity',
        'url'   => 'activity.php'
    ],
    [
        'title' => 'Contact Us',
        'url'   => 'Contactus.php'
    ],
    [
        'title' => 'Subscribe',
        'url'   => 'payment/subscribe.php'
    ],
    [
        'title' => 'Jobs',
        'url'   => 'jobs.php'
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
.top-menu{
    width:100%;
    display:flex;
    justify-content:flex-end;
    align-items:center;
    padding:8px 15px;
    box-sizing:border-box;
    flex-wrap:wrap;
    gap:8px;
}

.top-menu a{
    text-decoration:none;
    color:#ffffff;
    font-family:Arial, Helvetica, sans-serif;
    font-size:15px;
    transition:.3s;
    white-space:nowrap;
}

.top-menu a:hover{
    color:#ffd700;
}

.menu-divider{
    color:#ffffff;
    user-select:none;
}
</style>

</head>

<body>

<nav class="top-menu" aria-label="Top Navigation">

<?php foreach ($menuItems as $index => $item): ?>

    <a
        href="<?= e($basePath . $item['url']); ?>"
        class="a11"
    >
        <?= e($item['title']); ?>
    </a>

    <?php if ($index < count($menuItems) - 1): ?>
        <span class="menu-divider">||</span>
    <?php endif; ?>

<?php endforeach; ?>

</nav>

</body>
</html>