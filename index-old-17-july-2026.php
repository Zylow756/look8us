<?php

declare(strict_types=1);
require_once __DIR__ . '/config.php';

if (session_status() === PHP_SESSION_NONE) {
	session_start();
}

/* CSRF Token*/
if (empty($_SESSION['csrf_token'])) {
	$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

/* Variables*/
$msg = 0;
$error = '';

/* Feedback Form*/
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
	if (
		!isset($_POST['csrf_token']) ||
		!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])
	) {
		die('Invalid CSRF Token.');
	}

	$city = trim($_POST['city'] ?? '');
	$name = trim($_POST['mname'] ?? '');
	$mobile = trim($_POST['mobile'] ?? '');
	$email = trim($_POST['txtmail'] ?? '');
	$remark = trim($_POST['remark'] ?? '');

	/* Remove placeholder values */
	$placeholders = [
		'City',
		'Member Name',
		'Mobile',
		'Email ID',
		'Message'
	];

	foreach ($placeholders as $placeholder) {
		if ($city === $placeholder) {
			$city = '';
		}
		if ($name === $placeholder) {
			$name = '';
		}
		if ($mobile === $placeholder) {
			$mobile = '';
		}
		if ($email === $placeholder) {
			$email = '';
		}
		if ($remark === $placeholder) {
			$remark = '';
		}
	}

	/* Validation */
	if ($city === '') {
		$error = 'Please enter city.';
	} elseif ($name === '') {
		$error = 'Please enter your name.';
	} elseif ($mobile === '') {
		$error = 'Please enter mobile number.';
	} elseif (!preg_match('/^[0-9+\-\s]{8,20}$/', $mobile)) {
		$error = 'Invalid mobile number.';
	} elseif ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$error = 'Invalid email address.';
	} elseif ($remark === '') {
		$error = 'Please enter your message.';
	}

	if ($error === '') {
		$sql = "
            INSERT INTO feedback
            (
                city,
                mname,
                mobile,
                txtmail,
                remark,
                fdate
            )
            VALUES
            (
                ?, ?, ?, ?, ?, ?
            )
        ";

		$stmt = mysqli_prepare($con, $sql);
		if ($stmt) {
			$today = date('d-m-Y');
			mysqli_stmt_bind_param(
				$stmt,
				"ssssss",
				$city,
				$name,
				$mobile,
				$email,
				$remark,
				$today
			);

			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);

			$msg = 1;
		} else {
			$error = 'Unable to save your enquiry.';
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta
		name="viewport"
		content="width=device-width, initial-scale=1.0">

	<title>
		Look8US : Business Directory Kota Rajasthan India
	</title>

	<meta
		name="description"
		content="Look8US is an online business directory for Kota Rajasthan India featuring verified manufacturers, exporters, suppliers, traders and service providers.">

	<meta
		name="keywords"
		content="Look8US, Business Directory, Kota, Rajasthan, India, Manufacturers, Suppliers, Exporters">

	<meta name="robots" content="index,follow">
	<meta name="author" content="Look8US">

	<link rel="stylesheet" href="akc.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/form.css">

	<style>
		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}

		body {
			font-family: Arial, Helvetica, sans-serif;
			background: #f4f4f4;
			color: #333;
			line-height: 1.5;
		}

		img {
			max-width: 100%;
			height: auto;
			display: block;
		}

		.container {
			width: min(1200px, 95%);
			margin: auto;
		}

		.success {
			background: #d4edda;
			color: #155724;
			padding: 12px;
			border-radius: 6px;
			margin: 15px 0;
		}

		.error {
			background: #f8d7da;
			color: #721c24;
			padding: 12px;
			border-radius: 6px;
			margin: 15px 0;
		}

		.category-details {
			width: 100%;
		}

		.category-columns {
			display: grid;
			grid-template-columns: repeat(3, 1fr);
			gap: 25px;
			padding: 15px;
		}

		.category-column {
			display: flex;
			flex-direction: column;
		}

		.category-item {
			display: block;
			padding: 8px 0;
			color: #222;
			text-decoration: none;
			border-bottom: 1px solid #eeeeee;
			transition: .25s;
			font-size: 15px;
		}

		.category-item:hover {
			color: #0d6efd;
			padding-left: 10px;
		}

		.btn-more-category {
			display: inline-block;
			margin-top: 25px;
			padding: 12px 20px;
			background: #0d6efd;
			color: #fff;
			text-decoration: none;
			border-radius: 6px;
			font-weight: bold;
			transition: .3s;
		}

		.btn-more-category:hover {
			background: #084ec1;
			transform: translateY(-2px);
		}

		.more-category {
			text-align: center;
			margin-top: 20px;
		}

		.text-muted {
			color: #777;
			padding: 10px;
			font-size: 14px;
			text-align: center;
		}

		.feedback-panel {
			width: 100%;
		}

		.feedback-form {
			display: flex;
			flex-direction: column;
			gap: 15px;
		}

		.form-group {
			display: flex;
			flex-direction: column;
		}

		.form-group label {
			font-weight: 600;
			margin-bottom: 6px;
			color: #333;
		}

		.form-control {
			width: 100%;
			padding: 12px;
			border: 1px solid #ccc;
			border-radius: 6px;
			font-size: 15px;
			transition: .3s;
		}

		.form-control:focus {
			outline: none;
			border-color: #0d6efd;
			box-shadow: 0 0 5px rgba(13, 110, 253, .2);
		}

		textarea.form-control {
			resize: vertical;
			min-height: 120px;
		}

		.btn-submit {
			border: none;
			background: #0d6efd;
			color: #fff;
			padding: 12px;
			border-radius: 6px;
			cursor: pointer;
			font-size: 16px;
			font-weight: bold;
			transition: .3s;
		}

		.btn-submit:hover {
			background: #084ec1;
		}

		.verified-business-slider {
			overflow: hidden;
			width: 100%;
			background: #fff;
			padding: 15px 0;
		}

		.verified-track {
			display: flex;
			width: max-content;
			animation: scrollBusiness 45s linear infinite;
		}

		.verified-business-slider:hover .verified-track {
			animation-play-state: paused;
		}

		.verified-card {
			width: 210px;
			margin-right: 25px;
			background: #fff;
			border: 1px solid #ddd;
			border-radius: 8px;
			padding: 10px;
			text-align: center;
			flex-shrink: 0;
			transition: .3s;
		}

		.verified-card:hover {
			transform: translateY(-4px);
			box-shadow: 0 6px 18px rgba(0, 0, 0, .15);
		}

		.verified-card img {
			width: 180px;
			height: 145px;
			object-fit: contain;
			margin: auto;
		}

		.verified-card h4 {
			margin-top: 12px;
			font-size: 15px;
			color: #333;
			font-weight: 600;
		}

		.verified-card a {
			text-decoration: none;
		}

		@keyframes scrollBusiness {
			0% {
				transform: translateX(0);
			}

			100% {
				transform: translateX(-50%);
			}
		}
		
		.home-layout{
    display:grid;
    grid-template-columns:260px 1fr 300px;
    gap:20px;
    margin-top:20px;
}

		.popular-category {
			width: 100%;
		}

		.card {
			background: #fff;
			border-radius: 8px;
			overflow: hidden;
			border: 1px solid #ddd;
			margin-bottom: 20px;
		}

		.card-header {
			padding: 14px;
			text-align: center;
			font-weight: bold;
			background: #0d6efd;
			color: #fff;
		}

		.card-header h3 {
			margin: 0;
			font-size: 20px;
		}

		.card-body {
			padding: 10px;
		}

		.category-scroll {
			max-height: 500px;
			overflow-y: auto;
		}

		.category-list {
			list-style: none;
			margin: 0;
			padding: 0;
		}

		.category-list li {
			border-bottom: 1px solid #ececec;
		}

		.category-link {
			display: block;
			padding: 10px 12px;
			text-decoration: none;
			color: #222;
			transition: .25s;
			font-size: 15px;
		}

		.category-link:hover {
			background: #f5f9ff;
			color: #0d6efd;
			padding-left: 18px;
		}

		.empty-message {
			text-align: center;
			padding: 20px;
			color: #777;
		}

		.estore-section {
			margin: 40px 0;
		}

		.estore-header {
			background: #003366;
			color: #fff;
			padding: 15px;
			text-align: center;
			border-radius: 8px 8px 0 0;
		}

		.estore-header h2 {
			margin: 0;
			font-size: 26px;
		}

		.estore-grid {
			display: grid;
			grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
			gap: 25px;
			padding: 20px;
			background: #fff;
			border: 1px solid #ddd;
			border-top: none;
		}

		.estore-card {
			background: #fff;
			border-radius: 8px;
			overflow: hidden;
			border: 1px solid #e3e3e3;
			transition: .3s;
		}

		.estore-card:hover {
			transform: translateY(-5px);
			box-shadow: 0 10px 20px rgba(0, 0, 0, .15);
		}

		.estore-card a {
			text-decoration: none;
			color: #333;
			display: block;
		}

		.estore-image {
			height: 220px;
			display: flex;
			align-items: center;
			justify-content: center;
			padding: 15px;
		}

		.estore-image img {
			max-width: 100%;
			max-height: 100%;
			object-fit: contain;
		}

		.estore-title {
			padding: 15px;
			text-align: center;
			font-size: 17px;
			font-weight: 600;
			background: #f7f7f7;
		}

		.popup-gallery {
			padding: 20px;
			background: #fff;
			max-width: 900px;
			margin: auto;
		}

		.popup-grid {
			display: grid;
			grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
			gap: 20px;
		}

		.popup-card {
			border: 1px solid #ddd;
			border-radius: 8px;
			overflow: hidden;
			background: #fff;
			transition: .3s;
		}

		.popup-card:hover {
			transform: translateY(-4px);
			box-shadow: 0 8px 18px rgba(0, 0, 0, .15);
		}

		.popup-card img {
			width: 100%;
			height: 250px;
			object-fit: contain;
			display: block;
		}

		.site-footer {
			margin-top: 40px;
			background: #f5f5f5;
			border-top: 1px solid #ddd;
		}
	</style>
</head>

<body>
	<?php require_once 'header.php'; ?>
	<div class="container">
		<?php if ($msg === 1): ?>

			<div class="success">
				Your message has been sent successfully.
			</div>

		<?php endif; ?>

		<?php if ($error !== ''): ?>

			<div class="error">
				<?= htmlspecialchars($error) ?>
			</div>

		<?php endif; ?>
		<div class="home-layout">
		<aside class="popular-category">
			<div class="card shadow">
				<div class="card-header bg-primary text-white">
					<h3>Popular Categories</h3>
				</div>

				<div class="card-body category-scroll">

					<?php
					$sql = "SELECT cateid, cname
        FROM category
        WHERE cstatus = ?
        ORDER BY cname";

					$stmt = mysqli_prepare($con, $sql);
					$status = 1;
					mysqli_stmt_bind_param(
						$stmt,
						"i",
						$status
					);

					mysqli_stmt_execute($stmt);
					$result = mysqli_stmt_get_result($stmt);

					?>

					<?php if ($result && mysqli_num_rows($result) > 0): ?>

						<ul class="category-list">

							<?php
							$count = 0;
							while (
								($row = mysqli_fetch_assoc($result))
								&& ($count < 50)
							):
							?>

								<li>
									<a
										class="category-link"
										href="searchresult.php?id=<?= (int)$row['cateid']; ?>">
										<?= htmlspecialchars($row['cname'], ENT_QUOTES, 'UTF-8'); ?>
									</a>
								</li>

							<?php
								$count++;
							endwhile;
							?>
						</ul>

					<?php else: ?>

						<div class="empty-message">
							No categories available.
						</div>
					<?php endif; ?>

					<?php
					mysqli_stmt_close($stmt);
					?>
				</div>
			</div>
		</aside>

		<?php
		$sql = "
    SELECT
        catdid,
        cdname
    FROM
        catedetail
    WHERE
        cdstatus = ?
    GROUP BY
        cdname,
        catdid
    ORDER BY
        cdname
    LIMIT 185
";

		$stmt = mysqli_prepare($con, $sql);

		$status = 1;
		mysqli_stmt_bind_param(
			$stmt,
			"i",
			$status
		);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);

		$categories = [];

		while ($row = mysqli_fetch_assoc($result)) {
			$categories[] = [
				'id'   => (int)$row['catdid'],
				'name' => $row['cdname']
			];
		}

		mysqli_stmt_close($stmt);
		$totalCategories = count($categories);
		$perColumn = (int) ceil($totalCategories / 3);

		$columnOne = array_slice(
			$categories,
			0,
			$perColumn
		);

		$columnTwo = array_slice(
			$categories,
			$perColumn,
			$perColumn
		);

		$columnThree = array_slice(
			$categories,
			$perColumn * 2
		);
		?>

		<section class="category-details">
			<div class="card shadow">
				<div class="card-header">
					<h2>
						Category Details
					</h2>
				</div>

				<div class="card-body">
					<div class="category-columns">
						<div class="category-column">

							<?php if (!empty($columnOne)): ?>

								<?php foreach ($columnOne as $category): ?>

									<a
										class="category-item"
										href="searchresult1.php?id=<?= $category['id']; ?>">
										<?= htmlspecialchars($category['name'], ENT_QUOTES, 'UTF-8'); ?>
									</a>

								<?php endforeach; ?>

							<?php else: ?>

								<p class="text-muted">
									No categories available.
								</p>

							<?php endif; ?>

						</div>
						<div class="category-column">
							<?php if (!empty($columnTwo)): ?>
								<?php foreach ($columnTwo as $category): ?>
									<a
										class="category-item"
										href="searchresult1.php?id=<?= $category['id']; ?>">
										<?= htmlspecialchars($category['name'], ENT_QUOTES, 'UTF-8'); ?>
									</a>

								<?php endforeach; ?>

							<?php else: ?>

								<p class="text-muted">
									No categories available.
								</p>

							<?php endif; ?>

						</div>

						<div class="category-column">

							<?php if (!empty($columnThree)): ?>

								<?php foreach ($columnThree as $category): ?>

									<a
										class="category-item"
										href="searchresult1.php?id=<?= $category['id']; ?>">
										<?= htmlspecialchars($category['name'], ENT_QUOTES, 'UTF-8'); ?>
									</a>

								<?php endforeach; ?>

							<?php else: ?>

								<p class="text-muted">
									No categories available.
								</p>

							<?php endif; ?>
							<div class="more-category">
								<a
									href="index-subcate.php"
									class="btn-more-category">
									More Categories →
								</a>
							</div>
						</div>
					</div>
				</div>
		</section>

		<aside class="feedback-panel">
			<div class="card shadow">
				<div class="card-header bg-info">
					<h3>Feedback &amp; Enquiry</h3>
				</div>
				<div class="card-body">
					<form
						action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>"
						method="post"
						class="feedback-form"
						autocomplete="off">
						<input
							type="hidden"
							name="csrf_token"
							value="<?= htmlspecialchars($_SESSION['csrf_token']); ?>">

						<div class="form-group">
							<label for="city">City</label>
							<input
								type="text"
								id="city"
								name="city"
								class="form-control"
								maxlength="100"
								value="<?= htmlspecialchars($city ?? ''); ?>"
								placeholder="Enter City"
								required>
						</div>

						<div class="form-group">
							<label for="mname">Name</label>
							<input
								type="text"
								id="mname"
								name="mname"
								class="form-control"
								maxlength="100"
								value="<?= htmlspecialchars($name ?? ''); ?>"
								placeholder="Enter Name"
								required>
						</div>

						<div class="form-group">
							<label for="mobile">Mobile</label>
							<input
								type="text"
								id="mobile"
								name="mobile"
								class="form-control"
								maxlength="20"
								value="<?= htmlspecialchars($mobile ?? ''); ?>"
								placeholder="Mobile Number"
								required>
						</div>

						<div class="form-group">
							<label for="txtmail">Email</label>
							<input
								type="email"
								id="txtmail"
								name="txtmail"
								class="form-control"
								maxlength="150"
								value="<?= htmlspecialchars($email ?? ''); ?>"
								placeholder="Email Address">
						</div>

						<div class="form-group">
							<label for="remark">
								Message
							</label>
							<textarea
								id="remark"
								name="remark"
								class="form-control"
								rows="5"
								maxlength="1000"
								placeholder="Write your message..."
								required><?= htmlspecialchars($remark ?? ''); ?></textarea>

						</div>
						<button
							type="submit"
							name="submit"
							class="btn-submit">
							Submit
						</button>
					</form>
				</div>
			</div>
		</aside>
							</div>
		<?php
		$sql = "
SELECT
    aid,
    aname,
    img,
    website
FROM advert
WHERE astatus = ?
ORDER BY RAND()
";

		$stmt = mysqli_prepare($con, $sql);

		$status = 'H';
		mysqli_stmt_bind_param(
			$stmt,
			"s",
			$status
		);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);

		$advertisements = [];

		while ($row = mysqli_fetch_assoc($result)) {
			if (
				!empty($row['img']) &&
				$row['img'] !== '-'
			) {
				$advertisements[] = [
					'name' => $row['aname'],
					'image' => $row['img'],
					'website' => $row['website']
				];
			}
		}
		mysqli_stmt_close($stmt);
		?>
		<?php if (!empty($advertisements)): ?>

			<div class="verified-business-slider">
				<div class="verified-track">
					<?php foreach ($advertisements as $advert): ?>
						<div class="verified-card">
							<a
								href="https://<?= htmlspecialchars($advert['website']); ?>"
								target="_blank"
								rel="noopener noreferrer">
								<img
									src="User/logo//<?= htmlspecialchars($advert['image']); ?>"
									alt="<?= htmlspecialchars($advert['name']); ?>"
									loading="lazy">
								<h4>
									<?= htmlspecialchars($advert['name']); ?>
								</h4>
							</a>
						</div>

					<?php endforeach; ?>
					<?php foreach ($advertisements as $advert): ?>

						<div class="verified-card">
							<a
								href="https://<?= htmlspecialchars($advert['website']); ?>"
								target="_blank"
								rel="noopener noreferrer">
								<img
									src="User/logo//<?= htmlspecialchars($advert['image']); ?>"
									alt="<?= htmlspecialchars($advert['name']); ?>"
									loading="lazy">
								<h4>
									<?= htmlspecialchars($advert['name']); ?>
								</h4>
							</a>
						</div>
					<?php endforeach; ?>
				</div>
			</div>

		<?php endif; ?>
		<?php
		$sql = "
SELECT
    catename,
    cateimg
FROM ecate
ORDER BY catename
";

		$stmt = mysqli_prepare($con, $sql);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);

		$estoreCategories = [];

		while ($row = mysqli_fetch_assoc($result)) {
			$estoreCategories[] = [
				'name'  => $row['catename'],
				'image' => $row['cateimg']
			];
		}
		mysqli_stmt_close($stmt);
		?>
		<section class="estore-section">
			<div class="estore-header">
				<h2>
					e-Store Product Gallery
				</h2>
			</div>

			<div class="estore-grid">
				<?php foreach ($estoreCategories as $category): ?>

					<div class="estore-card">
						<a
							href="https://www.ebydeal.com/"
							target="_blank"
							rel="noopener noreferrer">

							<div class="estore-image">
								<img
									src="User/logo//<?= htmlspecialchars($category['image']); ?>"
									alt="<?= htmlspecialchars($category['name']); ?>"
									loading="lazy">
							</div>

							<div class="estore-title">
								<?= htmlspecialchars($category['name']); ?>

							</div>
						</a>
					</div>

				<?php endforeach; ?>

			</div>
		</section>
		<?php
		$sql = "
SELECT
    aid,
    img,
    website
FROM homeimg
ORDER BY aid DESC
LIMIT 4
";

		$stmt = mysqli_prepare($con, $sql);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);

		$popupAds = [];

		while ($row = mysqli_fetch_assoc($result)) {
			if (
				!empty($row['img']) &&
				$row['img'] !== '-'
			) {
				$popupAds[] = [
					'image' => $row['img'],
					'website' => $row['website']
				];
			}
		}

		mysqli_stmt_close($stmt);

		?>
		<div id="inline_content" class="popup-gallery" hidden>
			<div class="popup-grid">
				<?php foreach ($popupAds as $advert): ?>

					<div class="popup-card">
						<a
							href="https://<?= htmlspecialchars($advert['website']); ?>"
							target="_blank"
							rel="noopener noreferrer">
							<img
								src="User/logo//<?= htmlspecialchars($advert['image']); ?>"
								alt="Advertisement"
								loading="lazy">
							<a>
					</div>

				<?php endforeach; ?>

			</div>
		</div>
		<?php
		?>

		<footer class="site-footer">

			<?php require_once __DIR__ . '/footer.php'; ?>

		</footer>

		<?php
		?>
		<a
			href="<?= htmlspecialchars($path); ?>payment/subscribe.php"
			class="demoTest"
			aria-hidden="true">
		</a>
				</div>
		<script src="js/index.js" defer></script>
</body>

</html>