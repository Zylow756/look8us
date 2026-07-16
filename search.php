<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';

/*
|--------------------------------------------------------------------------
| Secure Session Handling
|--------------------------------------------------------------------------
*/
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_set_cookie_params([
        'lifetime' => 0,
        'path'     => '/',
        'domain'   => '',
        'secure'   => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
        'httponly' => true,
        'samesite' => 'Lax',
    ]);

    session_start();
}

/*
|--------------------------------------------------------------------------
| Database Connection Validation
|--------------------------------------------------------------------------
*/
if (!isset($con) || !$con instanceof mysqli) {
    die('Database connection failed.');
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$con->set_charset('utf8mb4');

/*
|--------------------------------------------------------------------------
| Read Search Query
|--------------------------------------------------------------------------
*/
$q = trim((string)filter_input(INPUT_GET, 'q', FILTER_UNSAFE_RAW));
?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>
Look8US | Business Directory Kota Rajasthan | Search Categories
</title>

<meta name="description"
      content="Search businesses, products, manufacturers, exporters, suppliers and service providers in Kota Rajasthan using Look8US Business Directory.">

<meta name="keywords"
      content="Look8US, Kota business directory, Rajasthan business directory, manufacturers, exporters, suppliers, yellow pages, business search">

<meta name="robots"
      content="index,follow">

<meta name="author"
      content="Look8US">

<link rel="canonical"
      href="https://look8us.com/search.php">

<link rel="stylesheet"
      href="akc.css">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{

    font-family:Arial,Helvetica,sans-serif;
    background:#f5f6fa url("images/bg.png");
    color:#333;
    line-height:1.6;

}

img{
    max-width:100%;
    height:auto;
}

a{
    text-decoration:none;
}

.wrapper{

    width:min(1200px,95%);
    margin:auto;

}

.page-title{

    background:#d2d2d2;
    padding:25px 15px;
    margin-bottom:25px;

}

.page-title h1{

    font-size:clamp(28px,4vw,42px);
    font-weight:600;
    color:#333;

}

.search-card{

    background:#fff;
    border-radius:10px;
    padding:30px;
    margin-bottom:30px;
    box-shadow:0 5px 15px rgba(0,0,0,.08);

}

.search-form{

    display:flex;
    flex-wrap:wrap;
    gap:15px;
    align-items:center;

}

.search-form label{

    font-weight:bold;
    font-size:15px;
    min-width:220px;

}

.search-form input[type=text]{

    flex:1;
    min-width:260px;
    padding:12px 14px;
    border:1px solid #ccc;
    border-radius:6px;
    font-size:15px;
    transition:.3s;

}

.search-form input[type=text]:focus{

    border-color:#0077cc;
    outline:none;
    box-shadow:0 0 6px rgba(0,119,204,.25);

}

.search-form button{

    background:#0077cc;
    color:#fff;
    border:none;
    padding:12px 28px;
    border-radius:6px;
    cursor:pointer;
    font-size:15px;
    transition:.3s;

}

.search-form button:hover{

    background:#005fa3;

}

.results-card{

    background:#fff;
    border-radius:10px;
    padding:25px;
    box-shadow:0 5px 15px rgba(0,0,0,.08);

}

.table-responsive{

    width:100%;
    overflow-x:auto;

}

.result-table{

    width:100%;
    border-collapse:collapse;
    min-width:650px;

}

.result-table th{

    background:#d2d2d2;
    color:#222;
    padding:14px;
    text-align:left;

}

.result-table td{

    padding:14px;
    border-bottom:1px solid #ececec;

}

.result-table tr:nth-child(even){

    background:#fafafa;

}

.result-table tr:hover{

    background:#f2f8ff;

}

.no-result{

    padding:20px;
    background:#fff8e5;
    border-left:5px solid orange;
    margin-top:20px;

}
</style>

</head>

<body>

<div id="fb-root"></div>

<script async defer crossorigin="anonymous"
src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v20.0">
</script>

<?php require_once __DIR__ . '/header.php'; ?>

<div class="page-title">

    <div class="wrapper">

        <h1>Search by Category</h1>

    </div>

</div>

<div class="wrapper">

<div class="search-card">

<form
      class="search-form"
      action="search.php"
      method="get"
      autocomplete="off">

<label for="q">

Enter Category / Product

</label>

<input
type="text"
name="q"
id="q"
maxlength="150"
placeholder="Type category or product..."
value="<?= htmlspecialchars($q, ENT_QUOTES, 'UTF-8'); ?>">

<button type="submit">

Search

</button>

</form>

</div>
<?php

if ($q !== ''):

?>

<div class="results-card">

    <h2 style="margin-bottom:20px;">
        Search Results
    </h2>

<?php

try {
    $search = '%' . $q . '%';

    $sql = "
        SELECT
            category.cateid,
            catedetail.cdid,
            catedetail.cdname
        FROM category
        INNER JOIN catedetail
            ON category.cateid = catedetail.cateid
        WHERE catedetail.cdname LIKE ?
        ORDER BY catedetail.cdname ASC
    ";

    $stmt = $con->prepare($sql);

    $stmt->bind_param('s', $search);

    $stmt->execute();

    $result = $stmt->get_result();

    ?>

    <div class="table-responsive">

    <table class="result-table">

        <thead>

        <tr>

            <th style="width:90px;">
                S.No.
            </th>

            <th>
                Category Name
            </th>

        </tr>

        </thead>

        <tbody>

<?php

if ($result->num_rows > 0):

    $i = 1;

    while ($row = $result->fetch_assoc()):

?>

<tr>

    <td>

        <?= $i++; ?>

    </td>

    <td>

        <?= htmlspecialchars(
            $row['cdname'],
            ENT_QUOTES,
            'UTF-8'
        ); ?>

    </td>

</tr>

<?php

    endwhile;

else:

?>

<tr>

<td colspan="2">

<div class="no-result">

<strong>No matching category found.</strong>

<br><br>

Please try another category or product name.

</div>

</td>

</tr>

<?php

endif;

?>

        </tbody>

    </table>

    </div>

<?php

$stmt->close();

} catch (mysqli_sql_exception $e) {

?>

<div class="no-result">

<strong>Unable to complete your search.</strong>

<br><br>

Please try again later.

<?php
/*
|--------------------------------------------------------------------------
| Development Only
|--------------------------------------------------------------------------
| Uncomment while debugging
|
| echo '<pre>' .
| htmlspecialchars($e->getMessage()) .
| '</pre>';
|--------------------------------------------------------------------------
*/
?>

</div>

<?php

}

?>

</div>

<?php

endif;
?>
<?php require_once __DIR__ . '/footer.php'; ?>

</body>
</html>