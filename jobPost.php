<?php

declare(strict_types=1);

require_once __DIR__ . '/config.php';

if (session_status() === PHP_SESSION_NONE) {
	session_start();
}

/** Escape text written into HTML. */
function h(string $value): string
{
	return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

if (empty($_SESSION['job_post_csrf'])) {
	$_SESSION['job_post_csrf'] = bin2hex(random_bytes(32));
}

$categories = [
	'IT Services/Development',
	'DTP-Data Entry/Online',
	'Marketing',
	'Customer Service',
	'Advertising & PR',
	'Sales',
	'Clerical & Administration',
	'Human Resource',
	'Education/School/Coaching',
	'Hotel & Tourism',
	'Hospital-Nursing',
	'Account & Finance',
	'Industry/Manufacturing',
	'Other',
];
$salaryPeriods = ['Yearly', 'Monthly', 'Weekly', 'Hourly'];
$jobTypes = ['Full Time', 'Part Time', 'Contract'];

$values = [
	'atitle' => '',
	'cate' => $categories[0],
	'discr' => '',
	'stype' => $salaryPeriods[0],
	'srange' => '',
	'jtype' => $jobTypes[0],
	'jobloc' => '',
	'ename' => '',
	'email' => '',
	'mobile' => '',
	'city' => '',
	'website' => '',
];
$errors = [];
$submitted = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	foreach ($values as $name => $default) {
		$values[$name] = trim((string) ($_POST[$name] ?? $default));
	}

	if (!hash_equals($_SESSION['job_post_csrf'], (string) ($_POST['csrf_token'] ?? ''))) {
		$errors[] = 'Your form session has expired. Please reload the page and try again.';
	}
	if ($values['atitle'] === '' || mb_strlen($values['atitle']) > 100) {
		$errors[] = 'Ads Title is required and must be 100 characters or fewer.';
	}
	if ($values['discr'] === '' || mb_strlen($values['discr']) > 200) {
		$errors[] = 'Description is required and must be 200 characters or fewer.';
	}
	if ($values['ename'] === '' || mb_strlen($values['ename']) > 50) {
		$errors[] = 'Company/Organisation is required and must be 50 characters or fewer.';
	}
	foreach (['srange', 'jobloc', 'email', 'mobile', 'city', 'website'] as $field) {
		if (mb_strlen($values[$field]) > 35) {
			$errors[] = ucfirst($field) . ' must be 35 characters or fewer.';
		}
	}
	if (
		!in_array($values['cate'], $categories, true)
		|| !in_array($values['stype'], $salaryPeriods, true)
		|| !in_array($values['jtype'], $jobTypes, true)
	) {
		$errors[] = 'One or more selected options are invalid.';
	}
	if ($values['email'] !== '' && !filter_var($values['email'], FILTER_VALIDATE_EMAIL)) {
		$errors[] = 'Please enter a valid email address.';
	}
	if ($values['website'] !== '' && !filter_var($values['website'], FILTER_VALIDATE_URL)) {
		$errors[] = 'Please enter a valid website URL, including http:// or https://.';
	}

	if ($errors === []) {
		// Keeps the original table column order and stored date format.
		$sql = "
INSERT INTO postjob
(
    atitle,
    cate,
    discr,
    stype,
    srange,
    jtype,
    jobloc,
    ename,
    email,
    mobile,
    city,
    website,
    status,
    postdate
)
VALUES
(
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
    '0',
    ?
)";
		$statement = mysqli_prepare($con, $sql);
		if ($statement === false) {
			error_log('Unable to prepare job post insert: ' . mysqli_error($con));
			$errors[] = 'Unable to submit the job at this time. Please try again later.';
		} else {
			$postedOn = date('d-m-Y');
			mysqli_stmt_bind_param(
				$statement,
				'sssssssssssss',
				$values['atitle'],
				$values['cate'],
				$values['discr'],
				$values['stype'],
				$values['srange'],
				$values['jtype'],
				$values['jobloc'],
				$values['ename'],
				$values['email'],
				$values['mobile'],
				$values['city'],
				$values['website'],
				$postedOn
			);
			if (mysqli_stmt_execute($statement)) {
				$submitted = true;
				foreach ($values as $name => $default) {
					$values[$name] = in_array($name, ['cate', 'stype', 'jtype'], true) ? $values[$name] : '';
				}
				$_SESSION['job_post_csrf'] = bin2hex(random_bytes(32));
			} else {
				error_log('Unable to execute job post insert: ' . mysqli_stmt_error($statement));
				$errors[] = 'Unable to submit the job at this time. Please try again later.';
			}
			mysqli_stmt_close($statement);
		}
	}
}
?>
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Look8US: Post Job Details</title>
	<meta name="description" content="Post a job to the Look8US Kota business directory.">
	<link rel="stylesheet" href="akc.css">
	<style>
		* {
			box-sizing: border-box;
		}

		body {
			margin: 0;
			color: #1f2937;
			background: #f3f4f6 url('images/bg.png');
			font: 16px/1.45 Arial, sans-serif;
		}

		main {
			padding-bottom: 2rem;
		}

		.page-heading {
			background: #d2d2d2;
		}

		.page-heading>div,
		.job-post-card {
			width: min(100% - 2rem, 1020px);
			margin: 0 auto;
		}

		.page-heading h1 {
			margin: 0;
			padding: 1rem 0;
			color: #333;
			font-size: clamp(1.5rem, 3vw, 2rem);
			font-weight: 500;
		}

		.job-post-card {
			margin-top: 1rem;
			overflow: hidden;
			background: #fff;
			border: 1px solid #e5e7eb;
			border-radius: .5rem;
			box-shadow: 0 1px 3px rgb(0 0 0 / 12%);
		}

		.form-heading {
			display: flex;
			align-items: center;
			justify-content: space-between;
			gap: 1rem;
			padding: .75rem 1rem;
			background: #ddd;
		}

		.form-heading h2 {
			margin: 0;
			font-size: 1rem;
			font-weight: 600;
		}

		.form-heading a {
			color: #1d4ed8;
			text-decoration: none;
		}

		.form-heading a:hover,
		.form-heading a:focus {
			text-decoration: underline;
		}

		.job-form {
			padding: 1.25rem;
		}

		.field {
			display: grid;
			grid-template-columns: minmax(11rem, 23%) 1fr;
			align-items: center;
			gap: .75rem;
			padding: .55rem 0;
		}

		label span {
			color: #b91c1c;
		}

		input,
		select,
		button {
			font: inherit;
		}

		input,
		select {
			width: 100%;
			min-height: 2.5rem;
			padding: .45rem .6rem;
			border: 1px solid #9ca3af;
			border-radius: .25rem;
			background: #fff;
		}

		input:focus,
		select:focus,
		button:focus {
			outline: 3px solid #93c5fd;
			outline-offset: 1px;
		}

		.form-actions {
    padding-top:1rem;
    padding-left:24%;
		}

		button {
			min-height: 2.5rem;
			padding: .45rem 1.25rem;
			color: #fff;
			background: #1d4ed8;
			border: 0;
			border-radius: .25rem;
			cursor: pointer;
		}

		button:hover {
			background: #1e40af;
		}

		.notice {
			margin: 1.25rem;
			padding: 1rem;
			border-radius: .25rem;
		}

		.notice p {
			margin-top: 0;
		}

		.notice ul {
			margin-bottom: 0;
		}

		.success {
			text-align: center;
			background: #ecfdf5;
		}

		.success img {
			max-width: 100%;
			height: auto;
		}

		.error {
			color: #7f1d1d;
			background: #fef2f2;
			border: 1px solid #fecaca;
		}
	</style>
</head>

<body>
	<?php require_once __DIR__ . '/header.php'; ?>
	<main>
		<section class="page-heading">
			<div>
				<h1>Post Job Details</h1>
			</div>
		</section>
		<section class="job-post-card" aria-labelledby="form-title">
			<div class="form-heading">
				<h2 id="form-title">Upload job detail</h2><a href="javascript:history.back()">&laquo; Back</a>
			</div>
			<?php if ($submitted): ?>
				<div class="notice success" role="status">
					<img src="images/cvupload.jpg" alt="Your job details were submitted successfully">
				</div>
			<?php else: ?>
				<?php if ($errors !== []): ?>
					<div class="notice error" role="alert">
						<p>Please correct the following:</p>
						<ul><?php foreach ($errors as $error): ?><li><?= h($error) ?></li><?php endforeach; ?></ul>
					</div>
				<?php endif; ?>
				<form method="post" action="jobPost.php" class="job-form">
					<input type="hidden" name="csrf_token" value="<?= h($_SESSION['job_post_csrf']) ?>">
					<div class="field"><label for="atitle">Ads Title <span aria-hidden="true">*</span></label><input id="atitle" name="atitle" maxlength="100" required value="<?= h($values['atitle']) ?>"></div>
					<div class="field"><label for="cate">Category</label><select id="cate" name="cate"><?php foreach ($categories as $option): ?><option value="<?= h($option) ?>" <?= $values['cate'] === $option ? ' selected' : '' ?>><?= h($option) ?></option><?php endforeach; ?></select></div>
					<div class="field"><label for="discr">Description <span aria-hidden="true">*</span></label><input id="discr" name="discr" maxlength="200" required value="<?= h($values['discr']) ?>"></div>
					<div class="field"><label for="stype">Salary Period</label><select id="stype" name="stype"><?php foreach ($salaryPeriods as $option): ?><option value="<?= h($option) ?>" <?= $values['stype'] === $option ? ' selected' : '' ?>><?= h($option) ?></option><?php endforeach; ?></select></div>
					<div class="field"><label for="srange">Salary Range (Rs.)</label><input id="srange" name="srange" maxlength="35" value="<?= h($values['srange']) ?>"></div>
					<div class="field"><label for="jtype">Job Position Type</label><select id="jtype" name="jtype"><?php foreach ($jobTypes as $option): ?><option value="<?= h($option) ?>" <?= $values['jtype'] === $option ? ' selected' : '' ?>><?= h($option) ?></option><?php endforeach; ?></select></div>
					<div class="field"><label for="jobloc">Job Location</label><input id="jobloc" name="jobloc" maxlength="35" value="<?= h($values['jobloc']) ?>"></div>
					<div class="field"><label for="ename">Company/Organisation <span aria-hidden="true">*</span></label><input id="ename" name="ename" maxlength="50" required value="<?= h($values['ename']) ?>"></div>
					<div class="field"><label for="email">Email ID</label><input id="email" name="email" type="email" maxlength="35" value="<?= h($values['email']) ?>"></div>
					<div class="field"><label for="mobile">Contact No.</label><input id="mobile" name="mobile" maxlength="35" value="<?= h($values['mobile']) ?>"></div>
					<div class="field"><label for="website">Website</label><input id="website" name="website" type="url" maxlength="35" value="<?= h($values['website']) ?>"></div>
					<div class="field"><label for="city">City/State</label><input id="city" name="city" maxlength="35" value="<?= h($values['city']) ?>"></div>
					<div class="form-actions"><button type="submit" name="submit" value="1">Submit</button></div>
				</form>
			<?php endif; ?>
		</section>
	</main>
	<?php require_once __DIR__ . '/footer.php'; ?>
</body>

</html>