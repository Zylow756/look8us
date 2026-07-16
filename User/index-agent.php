<?php
declare(strict_types=1);
require_once __DIR__ . "/../config.php";
/*
|--------------------------------------------------------------------------
| Secure Session Handling
|--------------------------------------------------------------------------
*/if (session_status() === PHP_SESSION_NONE) {    session_set_cookie_params([
        'lifetime' => 0,
        'path'     => '/',
        'secure'   => isset($_SERVER['HTTPS']),
        'httponly' => true,
        'samesite' => 'Lax'
    ]);    session_start();
}

/*
|--------------------------------------------------------------------------
| User Authentication Check
|--------------------------------------------------------------------------
*/if (empty($_SESSION['user'])) {    header("Location: index.php?r=0");
    exit;
}

/*
|--------------------------------------------------------------------------
| Captcha Include
|--------------------------------------------------------------------------
*/require_once __DIR__ . "/../thecaptcha/captcha.function.php";
/*
|--------------------------------------------------------------------------
| Variables
|--------------------------------------------------------------------------
*/$captcha_text = "Please tell me you're not a spambot";$error = 0;
$flag  = 0;
$us    = "";/*
|--------------------------------------------------------------------------
| Helper Function
|--------------------------------------------------------------------------
*/function clean_input(string $value): string
{
    return trim(
        htmlspecialchars(
            $value,
            ENT_QUOTES | ENT_SUBSTITUTE,
            'UTF-8'
        )
    );
}

/*
|--------------------------------------------------------------------------
| Registration Processing
|--------------------------------------------------------------------------
*/if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    /*
    |--------------------------------------------------------------------------
    | Captcha Verification
    |--------------------------------------------------------------------------
    */    if (!captcha_verify_word()) {        $error = 1;        $captcha_text =
            '<span class="error-message">
                <b>Wrong image code</b>
             </span>';    }
    if ($error === 0) {
        /*
        |--------------------------------------------------------------------------
        | Collect & Sanitize User Input
        |--------------------------------------------------------------------------
        */        $email = filter_var(
            $_POST['txtmail'] ?? '',
            FILTER_SANITIZE_EMAIL
        );
        $email = strtolower(trim($email));
        $agent_code = clean_input(
            $_POST['agcode'] ?? ''
        );
        $member_name = clean_input(
            $_POST['mname'] ?? ''
        );
        $company_name = clean_input(
            $_POST['compname'] ?? ''
        );
        $city = clean_input(
            $_POST['city'] ?? ''
        );
        $mobile = clean_input(
            $_POST['mobile'] ?? ''
        );
        $password = $_POST['pass'] ?? '';        /*
        |--------------------------------------------------------------------------
        | Email Already Registered Check
        |--------------------------------------------------------------------------
        */        $stmt = $con->prepare(
            "SELECT mid 
             FROM member 
             WHERE email = ?
             LIMIT 1"
        );
        $stmt->bind_param(
            "s",
            $email
        );
        $stmt->execute();
        $result = $stmt->get_result();        if ($result->num_rows > 0) {
            $flag = 1;
        }
 else {
            /*
            |--------------------------------------------------------------------------
            | Validate Agent Code
            |--------------------------------------------------------------------------
            */
            $stmt = $con->prepare(
                "SELECT acode 
                 FROM agent 
                 WHERE acode = ?
                 LIMIT 1"
            );
            $stmt->bind_param(
                "s",
                $agent_code
            );
            $stmt->execute();
            $agent_result = $stmt->get_result();            if ($agent_result->num_rows === 0) {
                /*
                | Invalid Agent Code
                */                $flag = 3;
            }
 else {
                /*
                |--------------------------------------------------------------------------
                | Generate User ID
                |--------------------------------------------------------------------------
                */
                $prefix = strtoupper(
                    substr(
                        $member_name,
                        0,
                        3
                    )
                );
                $stmt = $con->prepare(
                    "SELECT mid 
                     FROM member 
                     ORDER BY mid DESC 
                     LIMIT 1"
                );
                $stmt->execute();
                $last_member =
                    $stmt->get_result()
                    ->fetch_assoc();                if ($last_member) {
                    $us =
                        $prefix .
                        ((int)$last_member['mid'] + 1);
                }
 else {
                    $us =
                        $prefix . "1";                }
                /*
                |--------------------------------------------------------------------------
                | Secure Password Hash
                |--------------------------------------------------------------------------
                */                $hashed_password =
                    password_hash(
                        $password,
                        PASSWORD_DEFAULT
                    );
					/*
|--------------------------------------------------------------------------
| Insert Member Record PHP 8.3
|--------------------------------------------------------------------------
*/
$tagline  = "-";
$shopno   = "-";
$address  = "-";
$area     = "-";
$state    = "-";
$pin      = "-";
$phone    = "-";
$phone1   = "-";
$mobile1  = "-";
$web      = "-";
$remark   = "-";
$remark1  = "-";$logo     = "-";
$catelog  = "-";$estyear  = "-";$x        = "-";
$y        = "-";
$z        = "-";$ytube    = "-";
$facebook = "-";
$twiter   = "-";
$linken   = "-";$gmap     = "-";$verify   = "-";$a        = "-";
$b        = "-";
$c        = "-";
$mtyp = 0;$rating = 0;$mstatus = 0;$mplan = "Demo";$mdate = date("d-m-Y");$expdate = "2000-01-01";$stmt = $con->prepare("
INSERT INTO member
(
mid,
uname,
pass,
mname,
compname,
tagline,
shopno,
address,
area,
city,
state1,
pin,
phone,
phone1,
mobile,
mobile1,
email,
web,
remark,
remark1,
mtyp,
logo,
catelog,
rating,
estyear,
x,
y,
z,
mstatus,
mplan,
mdate,
ytube,
facebook,
twiter,
linken,
expdate,
gmap,
verify,
acode,
a,
b,
c)VALUES(
NULL,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?
)");$stmt->bind_param("sssssssssssssssssssssssssssssssssssssssssss",$us,
$hashed_password,
$member_name,
$company_name,
$tagline,
$shopno,
$address,
$area,
$city,
$state,
$pin,
$phone,
$phone1,
$mobile,
$mobile1,
$email,
$web,
$remark,
$remark1,
$mtyp,
$logo,
$catelog,
$rating,
$estyear,
$x,
$y,
$z,
$mstatus,
$mplan,
$mdate,
$ytube,
$facebook,
$twiter,
$linken,
$expdate,
$gmap,
$verify,
$agent_code,
$a,
$b,
$c);if(!$stmt->execute()){
    die(
        "Member registration failed: "
        .$stmt->error
    );
}
$new_mid = $con->insert_id;
					/*
                    |--------------------------------------------------------------------------
                    | Create Session
                    |--------------------------------------------------------------------------
                    */                    $_SESSION['user']  = $email;
                    $_SESSION['mtyp']  = "0";
                    $_SESSION['mid']   = $new_mid;
                    $_SESSION['mplan'] = "Demo";                    $flag = 2;                    header(
                        "Location: home.php?user="
                        . urlencode($email)
                        . "&mid="
                        . $new_mid
                        . "&mtyp=0&mplan=Demo"
                    );
                    exit;                }

            }

        }

    }
?>
<!DOCTYPE html>
<html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Online Directory - Agent Registration</title>
<link rel="stylesheet" href="../akc.css">
<style>
body {    margin:0;
    padding:0;
    font-family:
        Arial,
        Helvetica,
        sans-serif;    background:#f5f5f5;}
.page-container {    width:100%;
    min-height:100vh;}
.registration-box {
    width:min(95%,1010px);    margin:30px auto;    background:#ffffff;    padding:20px;    border-radius:10px;    box-shadow:
        0 4px 15px rgba(0,0,0,.15);}
.form-title {
    background:#e2e2e2;    padding:12px;    text-align:center;    font-size:20px;    font-weight:bold;}
.form-row {
    display:grid;    grid-template-columns:
    1fr 1fr 1fr;    gap:15px;    align-items:center;    margin-bottom:15px;}
.form-row label {
    text-align:right;    font-weight:bold;}
.txtbox {
    width:100%;    padding:10px;    border:1px solid #ccc;    border-radius:5px;    box-sizing:border-box;}
.subbox {
    padding:10px 30px;    background:#333;    color:white;    border:none;    border-radius:5px;    cursor:pointer;}
.subbox:hover {
    background:#000;}
.error-message {    color:red;}

</style><!--
|--------------------------------------------------------------------------
| HTML BODY START
|--------------------------------------------------------------------------
--></head>
<body>
<div class="page-container">
<?php require_once __DIR__ . "/../header.php"; ?><div class="registration-box"><?php
if ($flag === 1) {    echo '
    <div class="error-message">
        This E-Mail ID Already Registered
    </div>';}

elseif ($flag === 2) {
    echo '
    <div class="success-message">
        Member Registered Successfully.
        <br>
        Your User ID :
        <strong>'
        . htmlspecialchars($us)
        .
        '</strong>
    </div>';}
elseif ($flag === 3) {
    echo '
    <div class="error-message">
        Invalid Agent Code ID
    </div>';}

?>
<form
    name="frmhlp"
    id="frmhlp"
    method="post"
    action="index-agent.php"
    onsubmit="return validateForm();"
    autocomplete="off"
><div class="form-title">Register Your Firm / Shop / Company</div>
<!-- Agent Code --><div class="form-row">
<label for="agcode">Agent Code</label>
<input
type="text"
name="agcode"
id="agcode"
class="txtbox"
tabindex="1"
placeholder="Agent Code"
value="<?= htmlspecialchars($_POST['agcode'] ?? '') ?>"
required
>
</div>
<!-- Company Name --><div class="form-row">
<label for="compname">Company / Firm / Shop Name</label>
<input type="text"name="compname"id="compname"class="txtbox"tabindex="2"placeholder="Company Name"value="<?= htmlspecialchars($_POST['compname'] ?? '') ?>"required>
</div>
<!-- Member Name --><div class="form-row">
<label for="mname">Owner / Contact Person</label>
<input type="text"name="mname"id="mname"class="txtbox"tabindex="3"placeholder="Member Name"value="<?= htmlspecialchars($_POST['mname'] ?? '') ?>"required>
</div>
<!-- City -->
<div class="form-row">
<label for="city">City</label>
<input type="text"name="city"id="city"class="txtbox"tabindex="4"placeholder="City"value="<?= htmlspecialchars($_POST['city'] ?? '') ?>"required>
</div>
<!-- Mobile -->
<div class="form-row">
<label for="mobile">Mobile Number</label>
<input type="tel"name="mobile"id="mobile"class="txtbox"maxlength="15"tabindex="5"placeholder="Mobile Number"value="<?= htmlspecialchars($_POST['mobile'] ?? '') ?>"required>
</div>
<!-- Email -->
<div class="form-row">
<label for="txtmail">Email ID</label><div>
<input type="email"name="txtmail"id="txtmail"class="txtbox"tabindex="6"placeholder="Email ID"value="<?= htmlspecialchars($_POST['txtmail'] ?? '') ?>"required>
<?php
if ($flag === 1) {
echo '<p class="error-message">
This E-Mail ID already registered.
</p>';}

?>
</div>
</div>
<!-- Password -->
<div class="form-row">
<label for="pass">Password</label><div>
<input type="password"name="pass"id="pass"class="txtbox"tabindex="7"minlength="6"required>
<p class="help-text">Minimum 6 characters.</p>
</div>
</div>
<!-- Confirm Password -->
<div class="form-row">
<label for="pass1">Confirm Password</label><input type="password"name="pass1"id="pass1"class="txtbox"tabindex="8"required>
</div>
<!-- Captcha Image -->
<div class="form-row">
<label>Captcha</label><div>
<img src="../thecaptcha/captcha.image.php?nocache=<?= md5((string)time()) ?>"alt="Captcha Image"style="max-width:220px;height:auto;">
</div>
</div>
<!-- Captcha Input -->
<div class="form-row">
<label for="magicword">Enter Captcha Code</label>
<input type="text"name="magicword"id="magicword"class="txtbox"tabindex="9"required>
<div>
<?= $captcha_text ?></div>
</div><!-- Submit Button -->
<div class="form-row">
<div></div>
<button type="submit"name="submit"class="subbox">Submit</button>
<div></div>
</div>
</form>
</div>
<script>
function validateForm()
{const email =
document.getElementById("txtmail").value.trim();const agent =
document.getElementById("agcode").value.trim();const company =
document.getElementById("compname").value.trim();const name =
document.getElementById("mname").value.trim();const mobile =
document.getElementById("mobile").value.trim();const city =
document.getElementById("city").value.trim();const pass =
document.getElementById("pass").value;const pass1 =
document.getElementById("pass1").value;if(agent === "")
{alert("Required Agent Code");document.getElementById("agcode").focus();return false;}

if(company === "")
{alert("Required Company Name");document.getElementById("compname").focus();return false;}

if(name === "")
{alert("Required Contact Person Name");document.getElementById("mname").focus();return false;}

if(city === "")
{alert("Required City");document.getElementById("city").focus();return false;}

if(mobile === "")
{alert("Required Mobile Number");document.getElementById("mobile").focus();return false;}

if(!email.includes("@"))
{alert("Enter Valid Email Address");document.getElementById("txtmail").focus();return false;}

if(pass.length < 6)
{alert("Password must be at least 6 characters");document.getElementById("pass").focus();return false;}

if(pass !== pass1)
{alert("Password and Confirm Password are not same");document.getElementById("pass1").focus();return false;}

return true;
}

</script>
<?php require_once __DIR__ . "/../footer.php"; ?>
</div>
</body></html>