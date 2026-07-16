<?php

declare(strict_types=1);
require_once __DIR__ . "/config.php";
/*
|--------------------------------------------------------------------------
| Secure Session Handling
|--------------------------------------------------------------------------
*/
if (session_status() === PHP_SESSION_NONE) {
	session_set_cookie_params([
		'lifetime' => 0,
		'path' => '/',
		'secure' => (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'),
		'httponly' => true,
		'samesite' => 'Lax'
	]);
	session_start();
}
/*
|--------------------------------------------------------------------------
| Helper Function
|--------------------------------------------------------------------------
| Secure HTML output
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
$jobSeeker = null;
if (isset($_GET['id']) && ctype_digit($_GET['id'])) {
	$id = (int) $_GET['id'];
	/*
    |--------------------------------------------------------------------------
    | Prepared Statement Query
    |--------------------------------------------------------------------------
    */
	$stmt = mysqli_prepare(
		$con,
		"SELECT 
            cid,
            cate,
            atitle,
            discr,
            pdate,
            city,
            jtype,
            qual,
            exper,
            expsal,
            yname,
            phone,
            email
        FROM postcv
        WHERE cid = ?
        LIMIT 1"
	);
	if ($stmt) {
		mysqli_stmt_bind_param(
			$stmt,
			"i",
			$id
		);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		if ($result) {
			$jobSeeker = mysqli_fetch_assoc($result);
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
		Look8US : Business Directory Kota Rajasthan India | Job Seeker Details
	</title>
	<meta name="description"
		content="Look8US.com Kota Rajasthan Business Directory. View verified business listings, job seekers, suppliers, manufacturers and service providers.">
	<meta name="keywords"
		content="Look8US, Kota business directory, Rajasthan yellow pages, job seekers, employers, suppliers directory">
	<link rel="stylesheet" href="akc.css">
	<style>
		* {
			box-sizing: border-box;
		}

		body {
			margin: 0;
			padding: 0;
			background: #f5f5f5;
			font-family:
				Arial,
				Helvetica,
				sans-serif;
			color: #333;
		}

		.container {
			width: 100%;
			max-width: 1020px;
			margin: auto;
			background: #fff;
		}

		.page-title {
			background: #d2d2d2;
			padding: 15px;
			font-size: clamp(22px, 3vw, 32px);
			color: #333;
		}

		.content-box {
			padding: 20px;
		}

		.detail-card {
			width: 95%;
			margin: auto;
			border-collapse: collapse;
		}

		.section-title {
			background: #ddd;
			padding: 10px;
			font-size: 15px;
			font-weight: bold;
			color: #003366;
		}

		.detail-row {
			padding: 8px;
			font-size: 14px;
			line-height: 1.6;
		}

		.detail-label {
			font-weight: bold;
		}

		.back-link {
			float: right;
			color: #003366;
			text-decoration: none;
			font-size: 14px;
		}

		.back-link:hover {
			text-decoration: underline;
		}

		.divider {
			height: 3px;
			background: #e2e2e2;
			margin: 20px 0;
		}
	</style>
</head>

<body>
	<div class="container">
		<?php require_once __DIR__ . "/header.php"; ?>
		<header class="page-title"> View Job Seekers</header>
		<main class="content-box">
			<section class="job-details">
				<div class="section-title"> Job Seeker Detail <a href="javascript:history.back()" class="back-link">
						&laquo; Back
					</a></div><?php if ($jobSeeker): ?>
					<table class="detail-card">
						<tr>
							<td class="detail-row"> <strong>
									<?= e($jobSeeker['cate']) ?>
								</strong></td>
						</tr>
						<tr>
							<td class="detail-row"> <strong>
									<?= e($jobSeeker['atitle']) ?>
								</strong></td>
						</tr>
						<tr>
							<td class="detail-row"> <span class="detail-label">
									Description :
								</span> <?= e($jobSeeker['discr']) ?></td>
						</tr>
						<tr>
							<td class="detail-row"> <span class="detail-label">
									Post Date :
								</span> <?= e($jobSeeker['pdate']) ?>
							</td>
						</tr>
						<tr>
							<td class="detail-row"> <span class="detail-label">
									Location :
								</span> <?= e($jobSeeker['city']) ?>
							</td>
						</tr>
						<tr>
							<td class="detail-row"> <?= e($jobSeeker['jtype']) ?>
							</td>
						</tr>
						<tr>
							<td class="detail-row"> <span class="detail-label">
									Qualification :
								</span> <?= e($jobSeeker['qual']) ?>
							</td>
						</tr>
						<tr>
							<td class="detail-row"> <span class="detail-label">
									Experience :
								</span> <?= e($jobSeeker['exper']) ?>
							</td>
						</tr>
						<tr>
							<td class="detail-row"> <span class="detail-label">
									Expected Salary :
								</span> <?= e($jobSeeker['expsal']) ?>
							</td>
						</tr>
						<tr>
							<td class="section-title"> Personal Detail</td>
						</tr>
						<tr>
							<td class="detail-row">
								<span class="detail-label">Applicant Name :</span>
								<?= e($jobSeeker['yname']) ?>
							</td>
						</tr>
						<tr>
							<td class="detail-row">
								<span class="detail-label">Contact No. :</span>
								<?= e($jobSeeker['phone']) ?>
							</td>
						</tr>
						<tr>
							<td class="detail-row">
								<span class="detail-label">Email ID :</span>
								<?= e($jobSeeker['email']) ?>
							</td>
						</tr>
					</table>
					<div class="divider"></div><?php else: ?>
					<div class="detail-row"> <strong>
							Job seeker record not found.
						</strong></div>
				<?php endif; ?>
			</section>
		</main>
	</div>
	<div class="container"><?php require_once __DIR__ . "/footer.php"; ?></div>
</body>

</html>