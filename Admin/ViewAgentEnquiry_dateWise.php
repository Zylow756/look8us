<?php
declare(strict_types=1);

require_once __DIR__ . "/../config.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/*-------------------------------------------------------
| Authentication
--------------------------------------------------------*/
if (empty($_SESSION['admin'])) {
    header("Location: index.php?r=0");
    exit;
}

/*-------------------------------------------------------
| Helper Functions
--------------------------------------------------------*/

/**
 * Validate dd-mm-yyyy format.
 */
function validateDate(string $date): bool
{
    $dt = DateTime::createFromFormat('d-m-Y', $date);

    return $dt !== false &&
        $dt->format('d-m-Y') === $date;
}

/**
 * Convert dd-mm-yyyy to yyyy-mm-dd.
 */
function toMysqlDate(string $date): string
{
    return DateTime::createFromFormat(
        'd-m-Y',
        $date
    )->format('Y-m-d');
}

/**
 * Convert yyyy-mm-dd to dd-mm-yyyy.
 */
function fromMysqlDate(string $date): string
{
    return DateTime::createFromFormat(
        'Y-m-d',
        $date
    )->format('d-m-Y');
}

/*-------------------------------------------------------
| Default Dates
--------------------------------------------------------*/

$today = date('d-m-Y');

$fromDate = $_POST['tdate0'] ?? $today;
$toDate   = $_POST['tdate'] ?? $today;

$error = '';

/*-------------------------------------------------------
| Validate Submitted Dates
--------------------------------------------------------*/

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!validateDate($fromDate) || !validateDate($toDate)) {

        $error = "Invalid date format.";

    } else {

        $fromMysql = toMysqlDate($fromDate);
        $toMysql   = toMysqlDate($toDate);

        if ($fromMysql > $toMysql) {
            $error = "From Date cannot be greater than Upto Date.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Online Directory : Admin Panel</title>

<link rel="stylesheet"
      href="../akc.css">

<style>

body{
    background:#70828F url('img/bg.png') repeat-x;
    margin:0;
    font-family:Arial,Helvetica,sans-serif;
}

table{
    border-collapse:collapse;
}

.subbox{
    cursor:pointer;
}

.error{
    color:red;
    font-weight:bold;
    margin:10px 0;
}

</style>

<script src="../CalendarPopup.js"></script>

<script>

var cal = new CalendarPopup();

function disableSelect(e){
    return false;
}

function enableSelect(){
    return true;
}

document.onselectstart = function(){
    return false;
};

if(window.sidebar){
    document.onmousedown = disableSelect;
    document.onclick = enableSelect;
}

</script>

</head>

<body>

<script>

var message="Sorry, The Right Click is Disabled!";

function clickIE4(){
    if(event.button==2){
        alert(message);
        return false;
    }
}

function clickNS4(e){

    if(document.layers ||
      (document.getElementById && !document.all))
    {
        if(e.which==2 || e.which==3){
            alert(message);
            return false;
        }
    }
}

if(document.layers){

    document.captureEvents(Event.MOUSEDOWN);
    document.onmousedown=clickNS4;

}
else if(document.all && !document.getElementById){

    document.onmousedown=clickIE4;

}

document.oncontextmenu=function(){
    alert(message);
    return false;
};

</script>

<div align="center">

<table border="0"
       width="980"
       cellpadding="0">

<tr>

<td>

<?php require_once "../header.php"; ?>

</td>

</tr>

<tr>

<td bgcolor="#697779" height="12"></td>

</tr>

<tr>

<td>

<table border="0"
       width="100%"
       cellpadding="0">

<tr>

<td width="228"
    valign="top"
    bgcolor="#EEEEEE">

<?php

if (!empty($_SESSION['id'])) {
    require_once "sidemenu.php";
}

?>

</td>

<td
    bgcolor="#FFFFFF"
    valign="top"
    align="center">

<h1>View All Agent Enquiry Date Wise</h1>

<p>

<b>

<font size="2">

<a href="ViewAgentFollow_dateWise.php">

Click for Follow up date wise >>

</a>

</font>

</b>

</p>

<form
    method="post"
    action=""
    name="frmhlp"
    id="frmhlp">

<table
    width="100%"
    border="0">

<tr>

<td width="220">

<b>From Enquiry Date</b>

</td>

<td>

<input
type="text"
name="tdate0"
value="<?= htmlspecialchars($fromDate) ?>"
size="17">

<a href="#"
onclick="cal.select(document.forms['frmhlp'].tdate0,'anchor2','dd-MM-yyyy');return false;"
id="anchor2">

<img
src="../Admin/cal.gif"
border="0"
width="16"
height="16"
alt="Calendar">

</a>

</td>

</tr>

<tr>

<td>

<b>Upto Enquiry Date</b>

</td>

<td>

<input
type="text"
name="tdate"
value="<?= htmlspecialchars($toDate) ?>"
size="17">

<a href="#"
onclick="cal.select(document.forms['frmhlp'].tdate,'anchor1','dd-MM-yyyy');return false;"
id="anchor1">

<img
src="../Admin/cal.gif"
border="0"
width="16"
height="16"
alt="Calendar">

</a>

<input
class="subbox"
type="submit"
value="Show">

</td>

</tr>

</table>

<?php if ($error !== ''): ?>

<div class="error">

<?= htmlspecialchars($error) ?>

</div>

<?php endif; ?>
<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $error === ''):

?>

<table class="table2"
       width="99%"
       border="1"
       id="table3">

<tr bgcolor="#D2D2D2">

    <td width="5%" align="center"><b>S.No.</b></td>
    <td width="10%" align="center"><b>Date</b></td>
    <td width="23%"><b>Company Name</b></td>
    <td width="13%"><b>Contact Person</b></td>
    <td width="10%"><b>Mobile</b></td>
    <td width="11%"><b>Email</b></td>
    <td width="11%"><b>Last Feedback</b></td>
    <td width="11%"><b>Agent Name</b></td>
    <td width="4%"><b>Status</b></td>
    <td width="3%" align="center"><b>View</b></td>

</tr>

<?php

$sql = "
SELECT
    agenquiry.eid,
    agenquiry.edate,
    agenquiry.ename,
    agenquiry.cate,
    agenquiry.mobile,
    agenquiry.email,
    agenquiry.cdate,
    agenquiry.estatus,
    agent.aname
FROM agenquiry
INNER JOIN agent
    ON agent.aid = agenquiry.aid
WHERE
    STR_TO_DATE(agenquiry.edate,'%d-%m-%Y')
    BETWEEN ? AND ?
ORDER BY
    STR_TO_DATE(agenquiry.edate,'%d-%m-%Y') DESC
";

$stmt = mysqli_prepare($con, $sql);

if (!$stmt) {

    die("Prepare failed : " . mysqli_error($con));

}

mysqli_stmt_bind_param(
    $stmt,
    "ss",
    $fromMysql,
    $toMysql
);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$sr = 1;

if ($result && mysqli_num_rows($result) > 0):

while ($row = mysqli_fetch_assoc($result)):

?>

<tr>

<td align="center">
<?= $sr++; ?>
</td>

<td align="center">
<?= htmlspecialchars($row['edate']); ?>
</td>

<td>
<?= htmlspecialchars($row['ename']); ?>
</td>

<td>
<?= htmlspecialchars($row['cate']); ?>
</td>

<td>
<?= htmlspecialchars($row['mobile']); ?>
</td>

<td>
<?= htmlspecialchars($row['email']); ?>
</td>

<td>
<?= htmlspecialchars($row['cdate']); ?>
</td>

<td>
<?= htmlspecialchars($row['aname']); ?>
</td>

<td align="center">
<?= htmlspecialchars($row['estatus']); ?>
</td>

<td align="center">

<a class="a2"
href="ViewEnqStatus.php?eid=<?= urlencode((string)$row['eid']); ?>">

Detail

</a>

</td>

</tr>

<?php

endwhile;

else:

?>

<tr>

<td colspan="10"
    align="center"
    style="padding:20px;">

No enquiry found for the selected date range.

</td>

</tr>

<?php

endif;

mysqli_free_result($result);
mysqli_stmt_close($stmt);

?>

</table>

<?php endif; ?>
</form>

</td>

</tr>

</table>

</td>

</tr>

<tr>

<td
    height="57"
    align="center"
    valign="top">

<?php require_once "../footer.php"; ?>

</td>

</tr>

</table>

</div>

</body>

</html>
