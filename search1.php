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
        'path' => '/',
        'secure' => !empty($_SERVER['HTTPS']),
        'httponly' => true,
        'samesite' => 'Lax'
    ]);

    session_start();
}

/*
|--------------------------------------------------------------------------
| Database Connection Check
|--------------------------------------------------------------------------
*/
if (!isset($con) || !$con instanceof mysqli) {
    die('Database connection failed.');
}

$con->set_charset('utf8mb4');

/*
|--------------------------------------------------------------------------
| Search Input
|--------------------------------------------------------------------------
*/
$q = trim($_GET['q'] ?? '');

$searchResults = [];
$totalRows = 0;

if ($q !== '') {

    $sql = "
        SELECT
            compname,
            mname,
            address,
            area,
            city,
            mobile
        FROM member
        WHERE compname LIKE ?
        ORDER BY compname ASC,
                 mname ASC
    ";

    $stmt = $con->prepare($sql);

    if (!$stmt) {
        die('Prepare failed : ' . $con->error);
    }

    $search = "%{$q}%";

    $stmt->bind_param("s", $search);

    $stmt->execute();

    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $searchResults[] = $row;
    }

    $totalRows = count($searchResults);

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        Look8US | Business Directory Kota, Rajasthan, India |
        Search Company
    </title>

    <meta name="description"
          content="Look8US is your trusted online business directory of Kota, Rajasthan. Search verified businesses, manufacturers, exporters, suppliers and service providers.">

    <meta name="keywords"
          content="Look8US, Kota Business Directory, Rajasthan Business Directory, Yellow Pages, Exporters, Manufacturers, Suppliers, Dealers, Traders">

    <meta name="robots" content="index,follow">

    <link rel="stylesheet" href="akc.css">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family:Arial,Helvetica,sans-serif;
            background:#f5f5f5 url("images/bg.png") repeat;
            color:#333;
            line-height:1.6;
        }

        a{
            text-decoration:none;
            color:inherit;
        }

        img{
            max-width:100%;
            height:auto;
        }

        .container{
            width:min(1200px,96%);
            margin:auto;
        }

        .page-title{

            background:#d2d2d2;
            padding:25px 15px;
            margin-bottom:20px;

        }

        .page-title h1{

            font-size:clamp(1.6rem,2.5vw,2.2rem);
            font-weight:600;
            color:#333;

        }

        .search-card{

            background:#fff;
            border-radius:8px;
            padding:25px;
            box-shadow:0 4px 15px rgba(0,0,0,.08);
            margin-bottom:25px;

        }

        .search-form{

            display:flex;
            gap:15px;
            flex-wrap:wrap;
            align-items:center;

        }

        .search-form label{

            font-weight:bold;
            width:100%;

        }

        .search-form input[type=text]{

            flex:1;
            min-width:280px;
            padding:12px 15px;
            border:1px solid #ccc;
            border-radius:6px;
            font-size:15px;
            transition:.3s;

        }

        .search-form input[type=text]:focus{

            outline:none;
            border-color:#0d6efd;
            box-shadow:0 0 6px rgba(13,110,253,.25);

        }

        .search-form button{

            background:#0d6efd;
            color:#fff;
            border:none;
            border-radius:6px;
            padding:12px 28px;
            cursor:pointer;
            font-size:15px;
            transition:.3s;

        }

        .search-form button:hover{

            background:#084dbb;

        }

        .result-count{

            margin-top:20px;
            font-weight:bold;
            color:#444;

        }
		.table-responsive{

    width:100%;
    overflow-x:auto;
    margin-top:25px;

}

.results-table{

    width:100%;
    border-collapse:collapse;
    background:#fff;

}

.results-table th{

    background:#d2d2d2;
    color:#333;
    padding:12px;
    text-align:left;
    font-weight:600;
    border:1px solid #ddd;

}

.results-table td{

    padding:12px;
    border:1px solid #e3e3e3;
    vertical-align:top;

}

.results-table tbody tr:nth-child(even){

    background:#fafafa;

}

.results-table tbody tr:hover{

    background:#f2f8ff;

}
.no-results{

    margin-top:30px;
    padding:30px;
    text-align:center;
    background:#fff8f8;
    border:1px solid #ffd5d5;
    border-radius:8px;

}

.no-results h3{

    color:#c62828;
    margin-bottom:12px;

}

.no-results p{

    color:#555;
    margin:8px 0;

}

.site-footer{

    margin-top:40px;

}
    </style>

</head>

<body>

<div id="fb-root"></div>

<script async defer crossorigin="anonymous"
src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v23.0">
</script>

<?php require_once __DIR__ . '/header.php'; ?>

<section class="page-title">

    <div class="container">

        <h1>Search by Company</h1>

    </div>

</section>

<div class="container">

    <div class="search-card">

        <form
            class="search-form"
            action="search1.php"
            method="get"
            autocomplete="off"
        >

            <label for="q">

                Enter Company Name

            </label>

            <input
                type="text"
                id="q"
                name="q"
                maxlength="150"
                value="<?= htmlspecialchars($q, ENT_QUOTES, 'UTF-8'); ?>"
                placeholder="Enter Company Name..."
            >

            <button type="submit">

                Search

            </button>

        </form>

<?php if ($q !== ''): ?>

    <div class="result-count">

        Search Results for:

        <strong>

            <?= htmlspecialchars($q, ENT_QUOTES, 'UTF-8'); ?>

        </strong>

        (<?= $totalRows ?> Record<?= $totalRows == 1 ? '' : 's' ?> Found)

    </div>

<?php endif; ?>
<?php if ($q !== ''): ?>

    <div class="results-wrapper">

        <?php if ($totalRows > 0): ?>

            <div class="table-responsive">

                <table class="results-table">

                    <thead>

                    <tr>

                        <th>S.No.</th>

                        <th>Company Name</th>

                        <th>Contact Person</th>

                        <th>Address</th>

                        <th>Area</th>

                        <th>City</th>

                        <th>Mobile</th>

                    </tr>

                    </thead>

                    <tbody>

                    <?php
                    $i = 1;

                    foreach ($searchResults as $row):
                    ?>

                        <tr>

                            <td>

                                <?= $i++; ?>

                            </td>

                            <td>

                                <?= htmlspecialchars(
                                    $row['compname'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                ); ?>

                            </td>

                            <td>

                                <?= htmlspecialchars(
                                    $row['mname'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                ); ?>

                            </td>

                            <td>

                                <?= htmlspecialchars(
                                    $row['address'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                ); ?>

                            </td>

                            <td>

                                <?= htmlspecialchars(
                                    $row['area'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                ); ?>

                            </td>

                            <td>

                                <?= htmlspecialchars(
                                    $row['city'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                ); ?>

                            </td>

                            <td>

                                <?= htmlspecialchars(
                                    $row['mobile'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                ); ?>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                    </tbody>

                </table>

            </div>
        <?php else: ?>

            <div class="no-results">

                <h3>No companies found.</h3>

                <p>
                    No business records matched your search for
                    <strong><?= htmlspecialchars($q, ENT_QUOTES, 'UTF-8'); ?></strong>.
                </p>

                <p>
                    Please try another company name.
                </p>

            </div>

        <?php endif; ?>

    </div>

<?php endif; ?>

    </div>

</div>

<footer class="site-footer">

    <?php require_once __DIR__ . '/footer.php'; ?>

</footer>

</body>
</html>