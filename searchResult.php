<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';

/*
|--------------------------------------------------------------------------
| Secure Session Handling
|--------------------------------------------------------------------------
*/
if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'domain' => '',
        'secure' => !empty($_SERVER['HTTPS']),
        'httponly' => true,
        'samesite' => 'Lax'
    ]);

    session_start();
}

/*
|--------------------------------------------------------------------------
| Security Headers
|--------------------------------------------------------------------------
*/
header('X-Frame-Options: SAMEORIGIN');
header('X-Content-Type-Options: nosniff');
header('Referrer-Policy: strict-origin-when-cross-origin');

/*
|--------------------------------------------------------------------------
| Validate Search Redirect
|--------------------------------------------------------------------------
*/
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sea'])) {

    if ($_POST['sea'] === '1') {

        $item = trim($_POST['item'] ?? '');
        $loc  = trim($_POST['loc'] ?? '');

        header(
            'Location: searchResult2.php?item=' .
            urlencode($item) .
            '&loc=' .
            urlencode($loc)
        );
        exit;
    }
}

/*
|--------------------------------------------------------------------------
| Search Variables
|--------------------------------------------------------------------------
*/
$itemSearch = trim($_POST['item'] ?? '');
$categoryId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

$pageTitle = "Search by Category | Online Directory Service";
?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta
    name="viewport"
    content="width=device-width, initial-scale=1.0">

<title><?= htmlspecialchars($pageTitle) ?></title>

<meta
    name="description"
    content="Browse categories and refine your search using our online directory service.">

<meta
    name="keywords"
    content="directory, category search, business directory">

<meta
    name="robots"
    content="index,follow">

<link
    rel="stylesheet"
    href="akc.css">

<style>

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

    background:#f5f5f5 url("images/bg.png") repeat;

    color:#333;

    line-height:1.6;
}

a{

    color:#0066cc;
    text-decoration:none;
    transition:.25s;
}

a:hover{

    color:#d60000;
}

.container{

    width:min(1200px,96%);
    margin:auto;
}

.page-header{

    background:#d2d2d2;
    padding:30px 20px;
    margin-bottom:20px;
}

.page-header h1{

    font-size:clamp(28px,4vw,42px);
    color:#333;
    font-weight:600;
}

.content{

    background:#fff;
    padding:25px;
    border-radius:10px;

    box-shadow:
        0 4px 20px rgba(0,0,0,.08);
}

.notice{

    background:#d2d2d2;
    padding:12px 18px;

    font-weight:bold;

    margin-bottom:20px;

    border-radius:6px;
}

.result-table{

    width:100%;
    border-collapse:collapse;
}

.result-table tr{

    transition:.25s;
}

.result-table tr:hover{

    background:#fafafa;
}

.result-table td{

    padding:14px 10px;

    border-bottom:
        1px dotted #ccc;

    vertical-align:middle;
}

.serial{

    width:70px;

    text-align:center;

    font-weight:bold;

    color:#555;
}

.category{

    font-size:15px;
}

.category a{

    font-weight:600;
}

.count{

    color:#666;
    font-weight:bold;
}
</style>

</head>

<body>

<?php require_once __DIR__ . '/header.php'; ?>

<section class="page-header">

    <div class="container">

        <h1>
            Search by Category
        </h1>

    </div>

</section>

<div class="container">

<div class="content">

<form
    action="Search.php"
    method="get"
    autocomplete="off">

<div class="notice">

Refine your search by clicking any of the links below.

</div>

<table class="result-table">
<?php
if ($itemSearch !== '') {

    $sql = "
        SELECT
            category.*,
            catedetail.*,
            (
                SELECT COUNT(*)
                FROM memberdetail md
                WHERE md.catdid = catedetail.catdid
            ) AS member_count
        FROM category
        INNER JOIN catedetail
            ON category.cateid = catedetail.cateid
        WHERE catedetail.cdname LIKE ?
        ORDER BY catedetail.cdname ASC
    ";

    $stmt = mysqli_prepare($con, $sql);

    if (!$stmt) {
        throw new RuntimeException(mysqli_error($con));
    }

    $searchTerm = '%' . $itemSearch . '%';

    mysqli_stmt_bind_param(
        $stmt,
        "s",
        $searchTerm
    );

} elseif ($categoryId !== null && $categoryId !== false) {

    $sql = "
        SELECT
            category.*,
            catedetail.*,
            (
                SELECT COUNT(*)
                FROM memberdetail md
                WHERE md.catdid = catedetail.catdid
            ) AS member_count
        FROM category
        INNER JOIN catedetail
            ON category.cateid = catedetail.cateid
        WHERE catedetail.cateid = ?
        ORDER BY catedetail.cdname ASC
    ";

    $stmt = mysqli_prepare($con, $sql);

    if (!$stmt) {
        throw new RuntimeException(mysqli_error($con));
    }

    mysqli_stmt_bind_param(
        $stmt,
        "i",
        $categoryId
    );

} else {

    $sql = "
        SELECT
            category.*,
            catedetail.*,
            (
                SELECT COUNT(*)
                FROM memberdetail md
                WHERE md.catdid = catedetail.catdid
            ) AS member_count
        FROM category
        INNER JOIN catedetail
            ON category.cateid = catedetail.cateid
        ORDER BY catedetail.cdname ASC
    ";

    $stmt = mysqli_prepare($con, $sql);

    if (!$stmt) {
        throw new RuntimeException(mysqli_error($con));
    }
}

/*
|--------------------------------------------------------------------------
| Execute Query
|--------------------------------------------------------------------------
*/

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if (!$result) {
    throw new RuntimeException(mysqli_error($con));
}

$serial = 1;

/*
|--------------------------------------------------------------------------
| Display Results
|--------------------------------------------------------------------------
*/

if (mysqli_num_rows($result) > 0):

while ($row = mysqli_fetch_assoc($result)):

?>
<tr>

    <td class="serial">

        <?= $serial ?>

    </td>

    <td class="category">

        <a
            class="a1"
            href="searchresult1.php?id=<?= (int)$row['catdid'] ?>">

            <?= htmlspecialchars($row['cdname'], ENT_QUOTES, 'UTF-8') ?>

        </a>

        <span class="count">

            (<?= (int)$row['member_count'] ?>)

        </span>

    </td>

</tr>

<?php

$serial++;

endwhile;

else:

?>

<tr>

    <td colspan="2" style="padding:30px;text-align:center;">

        <strong>No categories found.</strong>

    </td>

</tr>

<?php

endif;

mysqli_free_result($result);
mysqli_stmt_close($stmt);

?>

</table>

</form>

</div>

</div>
<?php require_once __DIR__ . '/footer.php'; ?>

</body>
</html>