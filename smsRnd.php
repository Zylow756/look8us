<?php
require_once "config.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['user'])) {
    header("Location: index.php?r=0");
    exit;
}
?>
<html>

<head>
<meta charset="UTF-8">
<title>New Page 1</title>
</head>

<body>
<?php


header("location: http://sms.websoftsolutions.org/api/v3/index.php?method=sms&api_key=A846ed28953585b883c9c01bbcaf4d704&to=9352621248,9785743421&sender=BULKSMS&message=testing&format=php&custom=1,2&flash=0&dlrurl=http://look8us.com/smsreponse.php");

//header("location: http://sms.websoftsolutions.org/api/web2sms.php?workingkey=A846ed28953585b883c9c01bbcaf4d704&to=9352621248&sender=BULKSMS&message=THIS+IS+A+TEST+SMS");

//http://sms.websoftsolutions.org/api/v3/index.php?method=sms&api_key=A846ed28953585b883c9c01bbcaf4d704&to=9352621248&sender=BULKSMS&message=testing&format=json&custom=1,2&flash=0 




?>


</body>

</html>
