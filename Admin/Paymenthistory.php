<?php
declare(strict_types=1);

require_once __DIR__ . '/../config.php';

/*
|--------------------------------------------------------------------------
| Session
|--------------------------------------------------------------------------
*/
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/
if (empty($_SESSION['admin'])) {
    header('Location: index.php?r=0');
    exit;
}

/*
|--------------------------------------------------------------------------
| CSRF Token
|--------------------------------------------------------------------------
*/
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

/*
|--------------------------------------------------------------------------
| Variables
|--------------------------------------------------------------------------
*/
$msg = 0;

$allowedStatus = ['success', 'failure', 'All'];
$status = 'success';

$result = false;
$stmt   = null;

/*
|--------------------------------------------------------------------------
| Handle Form Submit
|--------------------------------------------------------------------------
*/
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Validate CSRF
    if (
        !isset($_POST['csrf_token']) ||
        !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])
    ) {
        die('Invalid CSRF Token.');
    }

    if (isset($_POST['mid'])) {

        $postedStatus = trim((string)$_POST['mid']);

        if (in_array($postedStatus, $allowedStatus, true)) {
            $status = $postedStatus;
        }
    }
}

/*
|--------------------------------------------------------------------------
| SQL Query
|--------------------------------------------------------------------------
*/
if ($status === 'All') {

    $sql = "
        SELECT DISTINCT
            payreq.txnid,
            member.mname,
            member.compname,
            payreq.rdate,
            payreq.status,
            payreq.amount,
            payreq.productinfo
        FROM payreq
        INNER JOIN member
            ON member.email = payreq.email
        ORDER BY payreq.payid DESC
        LIMIT 50
    ";

    $result = mysqli_query($con, $sql);

    if ($result === false) {
        die('Database Error : ' . mysqli_error($con));
    }

} else {

    $sql = "
        SELECT DISTINCT
            payreq.txnid,
            member.mname,
            member.compname,
            payreq.rdate,
            payreq.status,
            payreq.amount,
            payreq.productinfo
        FROM payreq
        INNER JOIN member
            ON member.email = payreq.email
        WHERE payreq.status = ?
        ORDER BY payreq.payid DESC
        LIMIT 50
    ";

    $stmt = mysqli_prepare($con, $sql);

    if ($stmt === false) {
        die('Prepare Failed : ' . mysqli_error($con));
    }

    mysqli_stmt_bind_param($stmt, 's', $status);

    if (!mysqli_stmt_execute($stmt)) {
        die('Execute Failed : ' . mysqli_stmt_error($stmt));
    }

    $result = mysqli_stmt_get_result($stmt);

    if ($result === false) {
        die('Result Error : ' . mysqli_error($con));
    }
}

/*
|--------------------------------------------------------------------------
| Helper Function
|--------------------------------------------------------------------------
*/
function e(?string $value): string
{
    return htmlspecialchars(
        $value ?? '',
        ENT_QUOTES | ENT_SUBSTITUTE,
        'UTF-8'
    );
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Online Directory : Admin Panel</title>

<link rel="stylesheet" href="../akc.css">

<style>

body{
    margin:0;
    padding:0;
    background:#70828F url('img/bg.png') repeat-x;
    font-family:Arial, Helvetica, sans-serif;
}

</style>

</head>

<body>

<div align="center">

<table border="0"
       width="980"
       cellpadding="0"
       cellspacing="0"
       style="border-collapse:collapse;">

<tr>

<td>

<?php require_once "../header.php"; ?>

</td>

</tr>

<tr>

<td height="12" bgcolor="#697779"></td>

</tr>

<tr>

<td>

<table border="0"
       width="100%"
       cellpadding="0"
       cellspacing="0"
       style="border-collapse:collapse;">

<tr>

<td width="228"
    valign="top"
    bgcolor="#E3E3E3">

<?php include "sidemenu.php"; ?>

</td>

<td valign="top"
    bgcolor="#FFFFFF"
    style="padding:15px;">

<h3 style="margin-top:0;">
View Payment History
</h3>

<form method="post"
      action="<?= e($_SERVER['PHP_SELF']); ?>">

<input
type="hidden"
name="csrf_token"
value="<?= e($_SESSION['csrf_token']); ?>">

<table border="0"
       cellpadding="5">

<tr>

<td>

<b>Payment Status</b>
(Last 50 Transaction)

</td>

<td>

<select
name="mid"
class="selbox1">

<option value="success"
<?= $status=='success' ? 'selected' : ''; ?>>
Success
</option>

<option value="failure"
<?= $status=='failure' ? 'selected' : ''; ?>>
Failure
</option>

<option value="All"
<?= $status=='All' ? 'selected' : ''; ?>>
All
</option>

</select>

</td>

<td>

<input
type="submit"
name="submit"
value="Show"
class="submit1">

</td>

</tr>

</table>

</form>

<br>

<table
class="table2"
border="1"
width="100%"
cellpadding="5"
style="border-collapse:collapse;">

<tr bgcolor="#E0E2FE">

<th align="left">Member Name</th>

<th align="left">Company Name</th>

<th align="left">Payment Date</th>

<th align="left">Status</th>

<th align="left">Amount</th>

<th align="left">Payment For Plan</th>

<th align="left">Transfer ID</th>

</tr>

<?php
if (mysqli_num_rows($result) > 0):
?>

<?php
while ($row = mysqli_fetch_assoc($result)):
?>

<tr>

<td><?= e($row['mname']); ?></td>

<td><?= e($row['compname']); ?></td>

<td><?= e($row['rdate']); ?></td>

<td><?= e($row['status']); ?></td>

<td><?= e($row['amount']); ?></td>

<td><?= e($row['productinfo']); ?></td>

<td><?= e($row['txnid']); ?></td>

</tr>

<?php endwhile; ?>

<?php else: ?>

<tr>

<td colspan="7"
    align="center">

No payment history found.

</td>

</tr>

<?php endif; ?>

</table>

</td>

</tr>

</table>

</td>

</tr>
        </td>
    </tr>

</table>

</td>
</tr>

<tr>

<td align="center" valign="top" height="57">

<?php require_once "../footer.php"; ?>

</td>

</tr>

</table>

</div>

<?php
/*
|--------------------------------------------------------------------------
| Cleanup
|--------------------------------------------------------------------------
*/

if ($result instanceof mysqli_result) {
    mysqli_free_result($result);
}

if ($stmt instanceof mysqli_stmt) {
    mysqli_stmt_close($stmt);
}

// Optional:
// mysqli_close($con);
// Usually not required because PHP closes the connection automatically.
?>

</body>
</html>