<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrfToken = $_SESSION['csrf_token'];

$feedbackSent = false;
$feedbackError = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $submittedToken = $_POST['csrf_token'] ?? '';

    if (!hash_equals($csrfToken, $submittedToken)) {
        $feedbackError = 'Your session expired. Please try again.';
    } else {
        $city   = trim((string)($_POST['city'] ?? ''));
        $mname  = trim((string)($_POST['mname'] ?? ''));
        $mobile = trim((string)($_POST['mobile'] ?? ''));
        $email  = trim((string)($_POST['txtmail'] ?? ''));
        $remark = trim((string)($_POST['remark'] ?? ''));

        if ($mname === '' || $mobile === '') {
            $feedbackError = 'Name and Mobile are required.';
        } elseif ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $feedbackError = 'Please enter a valid email address.';
        } else {
            $stmt = $con->prepare(
                'INSERT INTO feedback (city, mname, mobile, email, remark, created_at)
                 VALUES (?, ?, ?, ?, ?, ?)'
            );

            if ($stmt === false) {
                error_log('Feedback prepare failed: ' . $con->error);
                $feedbackError = 'Sorry, something went wrong. Please try again later.';
            } else {
                $createdAt = date('Y-m-d'); // ISO format is safer for a DATE column than d-m-Y
                $stmt->bind_param('ssssss', $city, $mname, $mobile, $email, $remark, $createdAt);

                if ($stmt->execute()) {
                    $feedbackSent = true;
                    // Rotate the CSRF token after a successful submit.
                    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
                    $csrfToken = $_SESSION['csrf_token'];
                } else {
                    error_log('Feedback insert failed: ' . $stmt->error);
                    $feedbackError = 'Sorry, something went wrong. Please try again later.';
                }
                $stmt->close();
            }
        }
    }
}

function h(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES | ENT_HTML5, 'UTF-8');
}

$categories = [];
$stmt = $con->prepare('SELECT cateid, cname FROM category WHERE cstatus = 1 ORDER BY cname LIMIT 50');
if ($stmt) {
    $stmt->execute();
    $res = $stmt->get_result();
    while ($row = $res->fetch_assoc()) {
        $categories[] = $row;
    }
    $stmt->close();
} else {
    error_log('Category query failed: ' . $con->error);
}

$catDetails = [];
$stmt = $con->prepare(
    'SELECT DISTINCT cdname, catdid FROM catedetail WHERE cdstatus = 1 ORDER BY cdname LIMIT 185'
);
if ($stmt) {
    $stmt->execute();
    $res = $stmt->get_result();
    while ($row = $res->fetch_assoc()) {
        $catDetails[] = $row;
    }
    $stmt->close();
} else {
    error_log('Catedetail query failed: ' . $con->error);
}
$catDetailChunks = array_chunk($catDetails, (int) ceil(count($catDetails) / 3) ?: 1);

$adverts = [];
$stmt = $con->prepare("SELECT aname, website, img FROM advert WHERE astatus = 'H' ORDER BY aname");
if ($stmt) {
    $stmt->execute();
    $res = $stmt->get_result();
    while ($row = $res->fetch_assoc()) {
        if ($row['img'] !== '-' && $row['img'] !== null && $row['img'] !== '') {
            $adverts[] = $row;
        }
    }
    $stmt->close();
} else {
    error_log('Advert query failed: ' . $con->error);
}
$advertChunks = array_chunk($adverts, 5); // preserves the old "5 per row" grouping

$homeImages = [];
$stmt = $con->prepare('SELECT aid, website, img FROM homeimg ORDER BY aid DESC');
if ($stmt) {
    $stmt->execute();
    $res = $stmt->get_result();
    while ($row = $res->fetch_assoc()) {
        if (($row['img'] ?? '-') !== '-' && $row['img'] !== '') {
            $homeImages[] = $row;
        }
    }
    $stmt->close();
} else {
    error_log('Homeimg query failed: ' . $con->error);
}

function externalUrl(?string $website): string
{
    $website = trim((string) $website);
    if ($website === '') {
        return '#';
    }
    if (!preg_match('#^https?://#i', $website)) {
        $website = 'https://' . $website;
    }
    return $website;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Look8US : Business Directory Kota, Rajasthan, India — Online Business Directory, Yellow Pages, Verified Businesses, Exporters, Manufacturers, Suppliers Directory, B2B Business Directory</title>
<meta name="description" content="Look8us.com from Kota Rajasthan is your local business directory and yellow pages. Business details, contacts, products, services and verified businesses, exporters, manufacturers, suppliers directory.">
<meta name="keywords" content="Look8us.com, yellow pages Kota Rajasthan, business directory Kota Rajasthan India, business search engine, Indian business directory, online business directory, Indian manufacturers, suppliers, Indian exporters directory, b2b portal, b2b business directory, manufacturer, importers, traders, dealers, buyers">
<style>
:root {
    --color-primary: #003366;
    --color-accent: #0099ff;
    --color-bg-panel: #ffffff;
    --color-bg-alt: #f4f4f4;
    --color-border: #e3e3e3;
    --color-link: #0066ff;
    --radius: 6px;
    --gap: 16px;
}

* { box-sizing: border-box; }

body {
    margin: 0;
    font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
    color: #222;
    background: #f7f7f7;
}

.visually-hidden {
    position: absolute;
    width: 1px; height: 1px;
    overflow: hidden;
    clip: rect(0 0 0 0);
    white-space: nowrap;
}

.page-wrap {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 var(--gap);
}

.logo-row { text-align: center; padding: 16px 0; }
.site-logo { max-width: 100%; height: auto; }

/* Search panel */
.search-panel { margin-bottom: var(--gap); }
.search-form {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    justify-content: center;
    align-items: center;
}
.search-form input[type="text"] {
    padding: 10px 12px;
    border: 1px solid #ccc;
    border-radius: var(--radius);
    font-size: 1rem;
}
.txtsea { flex: 1 1 320px; min-width: 200px; }
.txtloc { flex: 0 1 180px; }
.subsea, .subbox {
    padding: 10px 20px;
    border: none;
    border-radius: var(--radius);
    background: var(--color-accent);
    color: #fff;
    font-weight: 600;
    cursor: pointer;
}
.subsea:hover, .subbox:hover { background: #0077cc; }
.search-options {
    width: 100%;
    text-align: center;
    font-size: 0.9rem;
    margin-top: 4px;
}
.search-options label { margin-left: 12px; }

.alert {
    text-align: center;
    padding: 10px;
    border-radius: var(--radius);
    margin-top: 8px;
}
.alert-success { background: #e6f7e9; color: #1a7431; }
.alert-error { background: #fdecea; color: #b3261e; }

/* Three-column home layout, stacks on small screens */
.home-columns {
    display: grid;
    grid-template-columns: 1fr;
    gap: var(--gap);
    margin-bottom: var(--gap);
}

.panel {
    background: var(--color-bg-panel);
    border: 1px solid var(--color-border);
    border-radius: var(--radius);
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
    overflow: hidden;
}
.panel-title {
    margin: 0;
    padding: 12px 16px;
    background: var(--color-accent);
    color: #fff;
    font-size: 1rem;
}
.panel-title--accent { background: var(--color-primary); font-size: 1.2rem; }
.panel-scroll { max-height: 420px; overflow-y: auto; padding: 8px 16px; }

.link-list { list-style: none; margin: 0; padding: 0; }
.link-list li { border-bottom: 1px solid var(--color-bg-alt); }
.link-list a {
    display: block;
    padding: 8px 4px;
    color: var(--color-link);
    text-decoration: none;
}
.link-list a:hover { text-decoration: underline; }
.link-list--plain li { padding: 4px 0; color: var(--color-link); border-bottom: none; }

.category-columns {
    display: grid;
    grid-template-columns: 1fr;
    gap: var(--gap);
}
.more-link {
    display: block;
    text-align: center;
    background: var(--color-primary);
    color: #fff;
    padding: 10px;
    text-decoration: none;
    border-radius: var(--radius);
    margin-top: 8px;
}

/* Feedback form */
.feedback-form {
    display: flex;
    flex-direction: column;
    gap: 6px;
    padding: 16px;
}
.feedback-form label { font-size: 0.85rem; color: #555; }
.feedback-form input.txtbox {
    padding: 8px 10px;
    border: 1px solid #ccc;
    border-radius: var(--radius);
    margin-bottom: 6px;
}
.feedback-form .subbox { align-self: center; margin-top: 6px; width: 60%; }

/* Verified adverts */
.verified-panel { margin-bottom: var(--gap); }
.advert-row {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
    gap: var(--gap);
    list-style: none;
    padding: 16px;
    margin: 0;
}
.advert-row img { width: 100%; height: auto; border-radius: var(--radius); display: block; }
.advert-row a { color: inherit; text-decoration: none; text-align: center; display: block; }
.empty-note { padding: 16px; color: #777; }

/* Popular grid */
.popular-grid-inner {
    display: grid;
    grid-template-columns: 1fr;
    gap: var(--gap);
    padding: 16px;
}
.popular-col h3 {
    font-size: 0.95rem;
    color: var(--color-primary);
    border-bottom: 2px solid var(--color-bg-alt);
    padding-bottom: 6px;
}

/* Promo dialog (replaces the old hidden-div lightbox) */
.promo-dialog {
    border: none;
    border-radius: var(--radius);
    padding: 16px;
    max-width: 90vw;
}
.promo-dialog::backdrop { background: rgba(0, 0, 0, 0.6); }
.promo-dialog__close { text-align: right; }
.promo-dialog__close button {
    border: none;
    background: none;
    font-size: 1.4rem;
    cursor: pointer;
}
.promo-dialog__grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: var(--gap);
}
.promo-dialog__grid img { width: 100%; height: auto; border-radius: var(--radius); }
	</style>
</head>
<body>

<header class="site-header">
<?php require __DIR__ . '/header.php'; ?>
</header>

<main class="page-wrap">

    <div class="logo-row">
        <img src="logo.jpg" alt="Look8US logo" class="site-logo">
    </div>

    <!-- Search -->
    <section class="search-panel" aria-label="Business search">
        <form method="post" action="searchresult.php" class="search-form">
            <div class="search-fields">
                <label class="visually-hidden" for="item">Search product or company</label>
                <input type="text" class="txtsea" name="item" id="item"
                       placeholder="Enter your search Product or Company" autocomplete="off">

                <label class="visually-hidden" for="loc">Location</label>
                <input type="text" class="txtloc" name="loc" id="loc"
                       placeholder="Location" autocomplete="off">

                <button type="submit" class="subsea" name="submit0">Go</button>
            </div>

            <div class="search-options">
                <span>Categories</span>
                <label><input type="radio" name="sea" value="0" checked> Company</label>
                <label><input type="radio" name="sea" value="1"> Product</label>
            </div>
        </form>

        <?php if ($feedbackSent): ?>
            <p class="alert alert-success" role="status">Your message was sent successfully.</p>
        <?php elseif ($feedbackError !== null): ?>
            <p class="alert alert-error" role="alert"><?= h($feedbackError) ?></p>
        <?php endif; ?>
    </section>

    <div class="home-columns">

        <!-- Popular Category -->
        <section class="panel popular-category" aria-labelledby="popular-category-h">
            <h2 id="popular-category-h" class="panel-title">Popular Category</h2>
            <div class="panel-scroll">
                <ul class="link-list">
                    <?php foreach ($categories as $row): ?>
                        <li>
                            <a href="searchresult.php?id=<?= (int) $row['cateid'] ?>">
                                <?= h($row['cname']) ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </section>

        <!-- Category in details -->
        <section class="panel category-details" aria-labelledby="category-details-h">
            <h2 id="category-details-h" class="panel-title">Category in details</h2>
            <div class="panel-scroll">
                <div class="category-columns">
                    <?php foreach ($catDetailChunks as $chunk): ?>
                        <ul class="link-list">
                            <?php foreach ($chunk as $row): ?>
                                <li>
                                    <a href="searchresult1.php?id=<?= (int) $row['catdid'] ?>">
                                        <?= h($row['cdname']) ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endforeach; ?>
                </div>
                <a href="index-subcate.php" class="more-link">more category &raquo;</a>
            </div>
        </section>

        <!-- Feedback & Enquiry -->
        <section class="panel feedback-panel" aria-labelledby="feedback-h">
            <h2 id="feedback-h" class="panel-title">Feedback &amp; Enquiry</h2>
            <form method="post" action="index.php" class="feedback-form" novalidate>
                <input type="hidden" name="csrf_token" value="<?= h($csrfToken) ?>">

                <label for="city">City</label>
                <input class="txtbox" type="text" name="city" id="city" placeholder="City"
                       value="<?= h($_POST['city'] ?? '') ?>">

                <label for="mname">Name</label>
                <input class="txtbox" type="text" name="mname" id="mname" placeholder="Member Name" required
                       value="<?= h($_POST['mname'] ?? '') ?>">

                <label for="mobile">Mobile</label>
                <input class="txtbox" type="tel" name="mobile" id="mobile" placeholder="Mobile" required
                       pattern="[0-9+\-\s]{6,15}"
                       value="<?= h($_POST['mobile'] ?? '') ?>">

                <label for="txtmail">Email</label>
                <input class="txtbox" type="email" name="txtmail" id="txtmail" placeholder="Email ID"
                       value="<?= h($_POST['txtmail'] ?? '') ?>">

                <label for="remark">Message</label>
                <input class="txtbox" type="text" name="remark" id="remark" placeholder="Message"
                       value="<?= h($_POST['remark'] ?? '') ?>">

                <button class="subbox" type="submit" name="submit">Submit</button>
            </form>
        </section>
    </div>

    <!-- Verified Business & Services -->
    <section class="panel verified-panel" aria-labelledby="verified-h">
        <h2 id="verified-h" class="panel-title panel-title--accent">Verified Business &amp; Services</h2>

        <?php if (empty($advertChunks)): ?>
            <p class="empty-note">No verified listings to show right now.</p>
        <?php else: ?>
            <?php foreach ($advertChunks as $chunk): ?>
                <ul class="advert-row">
                    <?php foreach ($chunk as $row): ?>
                        <li>
                            <a href="<?= h(externalUrl($row['website'])) ?>" target="_blank" rel="noopener noreferrer">
                                <img loading="lazy" src="User/logo//<?= h($row['img']) ?>"
                                     width="180" height="145" alt="<?= h($row['aname']) ?>">
                                <span><?= h($row['aname']) ?></span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endforeach; ?>
        <?php endif; ?>
    </section>

    <!-- Popular Finders / Brands / Businesses / Searches / Branches -->
    <section class="panel popular-grid" aria-labelledby="popular-grid-h">
        <h2 id="popular-grid-h" class="visually-hidden">Popular links</h2>
        <div class="popular-grid-inner">
            <div class="popular-col">
                <h3>Popular Finders</h3>
                <ul class="link-list link-list--plain">
                    <li>Bus Route Finder</li>
                    <li>Pin Code Finder</li>
                    <li>School Finder</li>
                    <li>Hotel Finder</li>
                    <li>Bank SWIFT Code Finder</li>
                    <li>Bank IFSC Code Finder</li>
                    <li>Railway Station Finder</li>
                </ul>
            </div>
            <div class="popular-col">
                <h3>Popular Brands</h3>
                <ul class="link-list link-list--plain">
                    <li>Symphony Air Cooler Dealers</li>
                    <li>Onida AC</li>
                    <li>Hitachi AC</li>
                    <li>Spice Mobile Phone Dealers</li>
                    <li>Hero Cycles</li>
                    <li>Jet Airways Flight Booking</li>
                    <li><a href="#">More brands &gt;</a></li>
                </ul>
            </div>
            <div class="popular-col">
                <h3>Popular Businesses</h3>
                <ul class="link-list link-list--plain">
                    <li>DTDC Courier &amp; Cargo Ltd.</li>
                    <li>Tirupati Travels</li>
                    <li>Hotel City Home</li>
                    <li>First Flight Courier</li>
                    <li>Adarsh Kutir Udyog</li>
                    <li>Wipro Ltd.</li>
                </ul>
            </div>
            <div class="popular-col">
                <h3>Popular Searches</h3>
                <ul class="link-list link-list--plain">
                    <li>Valentine Day Party Snacks</li>
                    <li>Valentine Day Dinner</li>
                    <li>Valentine Flowers Wholesale</li>
                    <li>Valentine Candy Bouquet</li>
                    <li>Child Adoption</li>
                    <li>Birthday Party Restaurants</li>
                </ul>
            </div>
            <div class="popular-col">
                <h3>Popular Branches/Stores</h3>
                <ul class="link-list link-list--plain">
                    <li>Union Bank of India ATM</li>
                    <li>Thomas Cook</li>
                    <li>Fabindia</li>
                    <li>ICICI Prudential Life Insurance</li>
                    <li>Overnite Express Ltd.</li>
                    <li>Tata Motor Finance</li>
                </ul>
            </div>
        </div>
    </section>

</main>

<footer class="site-footer">
<?php require __DIR__ . '/footer.php'; ?>
</footer>

<a href="<?= h(($path ?? '') . 'payment/subscribe.php') ?>" class="demoTest"></a>

<?php if (!empty($homeImages)): ?>
<dialog id="promoDialog" class="promo-dialog">
    <form method="dialog" class="promo-dialog__close">
        <button aria-label="Close">&times;</button>
    </form>
    <div class="promo-dialog__grid">
        <?php foreach (array_slice($homeImages, 0, 4) as $img): ?>
            <a href="<?= h(externalUrl($img['website'])) ?>" target="_blank" rel="noopener noreferrer">
                <img loading="lazy" src="User/logo//<?= h($img['img']) ?>" width="250" height="250"
                     alt="Promoted listing">
            </a>
        <?php endforeach; ?>
    </div>
</dialog>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const dialog = document.getElementById('promoDialog');
    if (dialog && typeof dialog.showModal === 'function') {
        dialog.showModal();
    }
});
</script>
<?php endif; ?>

</body>
</html>