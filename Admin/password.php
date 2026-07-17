<?php
declare(strict_types=1);

require_once __DIR__ . '/../config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/*
|--------------------------------------------------------------------------
| Admin Authentication
|--------------------------------------------------------------------------
*/

if (empty($_SESSION['admin'])) {
    header('Location: ../index.php?r=0');
    exit;
}

if (empty($_SESSION['admin']) || empty($_SESSION['id'])) {
    header('Location: ../index.php?r=0');
    exit;
}

/*
|--------------------------------------------------------------------------
| Variables
|--------------------------------------------------------------------------
*/

$msg = 0;
$error = '';

$oldPassword = '';
$newPassword = '';
$confirmPassword = '';

/*
|--------------------------------------------------------------------------
| Form Processing
|--------------------------------------------------------------------------
*/

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $oldPassword     = trim($_POST['pass0'] ?? '');
    $newPassword     = trim($_POST['pass'] ?? '');
    $confirmPassword = trim($_POST['pass1'] ?? '');

    /*
    |--------------------------------------------------------------------------
    | Validation
    |--------------------------------------------------------------------------
    */

    if ($oldPassword === '') {

        $msg = 3;
        $error = 'Old Password cannot be empty.';

    } elseif ($newPassword === '') {

        $msg = 4;
        $error = 'New Password cannot be empty.';

    } elseif ($confirmPassword === '') {

        $msg = 5;
        $error = 'Confirm Password cannot be empty.';

    } elseif ($newPassword !== $confirmPassword) {

        $msg = 6;
        $error = 'New Password and Confirm Password do not match.';

    } else {

        /*
        |--------------------------------------------------------------------------
        | Verify Existing Password
        |--------------------------------------------------------------------------
        */

        $encodedOldPassword = base64_encode($oldPassword);

        $stmt = mysqli_prepare(
    $con,
    "SELECT uid
     FROM admin
     WHERE uid = ?
     AND pass = ?
     LIMIT 1"
);

$adminId = (int)$_SESSION['id'];

mysqli_stmt_bind_param(
    $stmt,
    "is",
    $adminId,
    $encodedOldPassword
);

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) === 1) {

            mysqli_stmt_close($stmt);

            /*
            |--------------------------------------------------------------------------
            | Update Password
            |--------------------------------------------------------------------------
            */

            $encodedNewPassword = base64_encode($newPassword);

            $stmt = mysqli_prepare(
                $con,
                "UPDATE admin
                 SET pass = ?
                 WHERE uid = ?"
            );

            if ($stmt === false) {
                die('Database error.');
            }

            $adminId = (int)$_SESSION['id'];

            mysqli_stmt_bind_param(
                $stmt,
                "si",
                $encodedNewPassword,
                $adminId
            );

            if (mysqli_stmt_execute($stmt)) {

                $msg = 1;

            } else {

                $msg = 7;
                $error = 'Unable to update password.';
            }

            mysqli_stmt_close($stmt);

        } else {

            $msg = 2;
            $error = 'Old Password is incorrect.';

            mysqli_stmt_close($stmt);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Language" content="en-us">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Online Directory : Admin Panel</title>

    <link rel="stylesheet" href="../akc.css">

    <style>
        body {
            margin: 0;
            padding: 0;
            background: #70828F url('img/bg.png') repeat-x;
            font-family: Arial, Helvetica, sans-serif;
        }

        .message-success {
            color: green;
            font-weight: bold;
            padding: 10px;
        }

        .message-error {
            color: red;
            font-weight: bold;
            padding: 10px;
        }
    </style>
</head>

<body>

<div align="center">

<table
    border="0"
    width="980"
    cellpadding="0"
    cellspacing="0"
    style="border-collapse:collapse;"
>

    <tr>
        <td height="50" align="center" valign="top">
            <?php require_once "../header.php"; ?>
        </td>
    </tr>

    <tr>
        <td height="12" bgcolor="#697779"></td>
    </tr>

    <tr>

        <td>

            <table
                border="0"
                width="100%"
                cellpadding="0"
                cellspacing="0"
                style="border-collapse:collapse;"
            >

                <tr>

                    <td
                        width="228"
                        valign="top"
                        bgcolor="#E3E3E3"
                    >

                        <?php
                        if (!empty($_SESSION['id'])) {
                            require_once "sidemenu.php";
                        }
                        ?>

                    </td>

                    <td
                        valign="top"
                        bgcolor="#FFFFFF"
                        align="center"
                    >

                        <br>

                        <?php if ($msg === 1): ?>

                            <div class="message-success">
                                Password changed successfully.
                            </div>

                        <?php elseif ($msg > 1): ?>

                            <div class="message-error">
                                <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
                            </div>

                        <?php endif; ?>

                        <form
                            name="frmhlp"
                            id="frmhlp"
                            method="post"
                            action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>"
                            onsubmit="return vfhfn();"
                            autocomplete="off"
                        >

                            <table
                                border="0"
                                width="80%"
                                cellpadding="5"
                                cellspacing="0"
                                style="border-collapse:collapse;"
                            >

                                <tr>

                                    <td width="170">
                                        Old Password
                                    </td>

                                    <td width="250">

                                        <input
                                            class="txtbox"
                                            type="password"
                                            name="pass0"
                                            id="pass0"
                                            value=""
                                        >

                                    </td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td>
                                        New Password
                                    </td>

                                    <td>

                                        <input
                                            class="txtbox"
                                            type="password"
                                            name="pass"
                                            id="pass"
                                            value=""
                                        >

                                    </td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td>
                                        Confirm Password
                                    </td>

                                    <td>

                                        <input
                                            class="txtbox"
                                            type="password"
                                            name="pass1"
                                            id="pass1"
                                            value=""
                                        >

                                    </td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td></td>

                                    <td>

                                        <input
                                            class="subbox"
                                            type="submit"
                                            name="submit"
                                            value="Change Password"
                                        >

                                    </td>

                                    <td></td>

                                </tr>

                            </table>

                        </form>

                        <br>
                        <br>
						                        <br>
                        <br>

                    </td>

                </tr>

            </table>

        </td>

    </tr>

    <tr>

        <td height="57" align="center" valign="top">

            <?php require_once "../footer.php"; ?>

        </td>

    </tr>

</table>

</div>

<script>

function vfhfn()
{
    const oldPass = document.getElementById("pass0");
    const newPass = document.getElementById("pass");
    const confirmPass = document.getElementById("pass1");

    if (oldPass.value.trim() === "")
    {
        alert("Please enter your old password.");
        oldPass.focus();
        return false;
    }

    if (newPass.value.trim() === "")
    {
        alert("Please enter a new password.");
        newPass.focus();
        return false;
    }

    if (confirmPass.value.trim() === "")
    {
        alert("Please confirm your new password.");
        confirmPass.focus();
        return false;
    }

    if (newPass.value !== confirmPass.value)
    {
        alert("New Password and Confirm Password do not match.");
        confirmPass.focus();
        return false;
    }

    if (newPass.value.length < 4)
    {
        alert("Password must contain at least 4 characters.");
        newPass.focus();
        return false;
    }

    return true;
}

</script>

</body>

</html>