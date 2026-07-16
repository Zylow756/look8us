<?php

declare(strict_types=1);/*
|--------------------------------------------------------------------------
| Database Configuration
|--------------------------------------------------------------------------
*/
require_once __DIR__ . "/config.php";
/*
|--------------------------------------------------------------------------
| Secure Session Handling
|--------------------------------------------------------------------------
*/
if (session_status() === PHP_SESSION_NONE) {
	session_set_cookie_params([
		'lifetime' => 0,
		'path'     => '/',
		'secure'   => isset($_SERVER['HTTPS']),
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
function e(?string $value): string
{
	return htmlspecialchars(
		$value ?? '',
		ENT_QUOTES | ENT_SUBSTITUTE,
		'UTF-8'
	);
}
/*
|--------------------------------------------------------------------------
| Get Job ID Safely
|--------------------------------------------------------------------------
*/
$job = null;
if (isset($_GET['id']) && ctype_digit($_GET['id'])) {
	$jid = (int) $_GET['id'];
	/*
    |--------------------------------------------------------------------------
    | Prepared Statement
    |--------------------------------------------------------------------------
    */
	$stmt = mysqli_prepare(
		$con,
		"SELECT 
            jid,
            cate,
            atitle,
            discr,
            y,
            jobloc,
            jtype,
            srange,
            stype,
            ename,
            phone,
            email,
            city,
            web
        FROM postjob
        WHERE jid = ?
        LIMIT 1"
	);
	if ($stmt) {
		mysqli_stmt_bind_param(
			$stmt,
			"i",
			$jid
		);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		if ($result) {
			$job = mysqli_fetch_assoc($result);
		}
		mysqli_stmt_close($stmt);
	}
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>
		Look8US : Business Directory Kota Rajasthan | View Job Offers
	</title>
	<meta name="description"
		content="Look8us.com Kota Rajasthan Business Directory. View verified business job offers, companies, suppliers and manufacturers.">
	<meta name="keywords"
		content="Look8US, Kota business directory, jobs Kota Rajasthan, job offers, yellow pages India">
	<link rel="stylesheet" href="akc.css">
	<style>
		body {
			margin: 0;
			padding: 0;
			background: #f5f5f5;
			font-family:
				Arial,
				Helvetica,
				sans-serif;
		}

		.container {
			width: 100%;
			max-width: 1020px;
			margin: auto;
			background: #ffffff;
		}

		.page-title {
			background: #d2d2d2;
			padding: 15px;
			font-size: 28px;
			color: #333;
			font-weight: bold;
		}

		.job-box {
			width: 94%;
			margin: 20px auto;
			border-collapse: collapse;
		}

		.job-header {
			background: #dddddd;
			padding: 10px;
			display: flex;
			justify-content: space-between;
			align-items: center;
		}

		.job-header a {
			color: #003366;
			text-decoration: none;
		}

		.job-details {
			padding: 20px;
		}

		.job-row {
			display: flex;
			flex-wrap: wrap;
			padding: 8px 0;
			border-bottom: 1px solid #eeeeee;
		}

		.job-label {
			width: 220px;
			font-weight: bold;
			color: #333;
		}

		.job-value {
			flex: 1;
		}

		.company {
			background: #e3e3e3;
			padding: 10px;
			color: #000080;
			font-weight: bold;
		}
	</style>
</head>

<body>
	<?php require_once __DIR__ . "/header.php"; ?>
	<div class="container">
		<h1 class="page-title">
			View Job Offers
		</h1>
		<section class="job-box">
			<div class="job-header">
				<strong>
					Job Offer Detail
				</strong>
				<a href="javascript:history.back()">
					&lt;&lt; Back
				</a>
			</div>
			<?php if ($job): ?>
				<div class="job-details">
					<div class="job-row">
						<div class="job-label">
							Category :
						</div>
						<div class="job-value">
							<?= e($job['cate']) ?>
						</div>
					</div>
					<div class="job-row">
						<div class="job-label">
							Job Title :
						</div>
						<div class="job-value">
							<strong>
								<?= e($job['atitle']) ?>
							</strong>
						</div>
					</div>
					<div class="job-row">
						<div class="job-label">
							Description :
						</div>
						<div class="job-value">
							<?= nl2br(e($job['discr'])) ?>
						</div>
					</div>
					<div class="job-row">
						<div class="job-label">
							Post Date :
						</div>
						<div class="job-value">
							<?= e($job['y']) ?>
						</div>
					</div>
					<div class="job-row">
						<div class="job-label">
							Location :
						</div>
						<div class="job-value">
							<?= e($job['jobloc']) ?>
						</div>
					</div>
					<div class="job-row">
						<div class="job-label">
							Job Type :
						</div>
						<div class="job-value">
							<?= e($job['jtype']) ?>
						</div>
					</div>
					<div class="job-row">
						<div class="job-label">
							Salary :
						</div>
						<div class="job-value">
							Rs.
							<?= e($job['srange']) ?>
							<?= e($job['stype']) ?>
						</div>
					</div>
					<div class="job-row company">
						<div class="job-label">
							Company / Industry / Shop Name :
						</div>
						<div class="job-value"><?= e($job['ename']) ?></div>
					</div>
					<div class="job-row">
						<div class="job-label">Contact No :</div>
						<div class="job-value"><?= e($job['phone']) ?></div>
					</div>
					<div class="job-row">
						<div class="job-label">Email ID :</div>
						<div class="job-value">
							<a href="mailto:<?= e($job['email']) ?>"><?= e($job['email']) ?></a>
						</div>
					</div>
					<div class="job-row">
						<div class="job-label">City :</div>
						<div class="job-value"><?= e($job['city']) ?></div>
					</div>
					<div class="job-row">
						<div class="job-label">Website :</div>
						<div class="job-value">
							<?php if (!empty($job['web'])): ?>
								<a
									href="<?= e($job['web']) ?>"
									target="_blank"
									rel="noopener noreferrer"><?= e($job['web']) ?></a>
							<?php else: ?>
								N/A
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php else: ?>
				<div class="job-details">
					<div class="job-row">
						<div class="job-value">
							<strong>
								Job offer not found.
							</strong>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</section>
	</div>
	<?php require_once __DIR__ . "/footer.php"; ?>
</body>

</html>