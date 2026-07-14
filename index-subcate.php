<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/** Escapes a value for safe HTML output. */
function h(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES | ENT_HTML5, 'UTF-8');
}

/**
 * Normalizes a stored "website" value into a safe absolute URL, same
 * helper used on index.php. Old code always prepended "http://", which
 * breaks if a row already stores a full URL.
 */
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

$catDetails = [];
$stmt = $con->prepare(
    'SELECT DISTINCT cdname, catdid FROM catedetail ORDER BY cdname'
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
$catDetailChunks = array_chunk($catDetails, (int) ceil(count($catDetails) / 4) ?: 1);

// ---------------------------------------------------------------------
// Verified Business & Services adverts (same query/shape as index.php)
// ---------------------------------------------------------------------
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

// ---------------------------------------------------------------------
// Homepage lightbox images ("homeimg") — same source/behaviour as
// index.php's popup, rebuilt as a native <dialog> instead of the
// Colorbox jQuery plugin (which, together with a second, separate copy
// of jQuery loaded from Google's CDN, was pulled in only for this one
// popup).
// ---------------------------------------------------------------------
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Look8US : Business Directory Kota, Rajasthan, India — Online Business Directory, Yellow Pages, Verified Businesses, Exporters, Manufacturers, Suppliers Directory, B2B Business Directory</title>
<meta name="description" content="Look8us.com from Kota Rajasthan is your local business directory and yellow pages. Business details, contacts, products, services and verified businesses, exporters, manufacturers, suppliers directory.">
<meta name="keywords" content="Look8us.com, yellow pages Kota Rajasthan, business directory Kota Rajasthan India, business search engine, Indian business directory, online business directory, Indian manufacturers, suppliers, Indian exporters directory, b2b portal, b2b business directory, manufacturer, importers, traders, dealers, buyers">
<link rel="stylesheet" href="akc.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/form.css">
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

/* --- Added for index-old.php (Home / Enquiry / New listings / Carousel) --- */

/* Enquiry ("Tell Us Your Need") form */
.enquiry-form {
    display: flex;
    flex-direction: column;
    gap: 6px;
    padding: 16px;
}
.enquiry-form label { font-size: 0.85rem; color: #555; }
.enquiry-form select,
.enquiry-form input.txtbox {
    padding: 8px 10px;
    border: 1px solid #ccc;
    border-radius: var(--radius);
    margin-bottom: 6px;
    font-size: 0.95rem;
    width: 100%;
}
.enquiry-form .subbox { align-self: center; margin-top: 6px; width: 70%; }

/* "New on Look8us.com" section */
.new-listings { margin-bottom: var(--gap); }
.new-listings-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: var(--gap);
    padding: 16px;
}
@media (min-width: 800px) {
    .new-listings-grid { grid-template-columns: repeat(3, 1fr); }
}
.new-listings-card { border: 1px solid var(--color-border); border-radius: var(--radius); overflow: hidden; }
.new-listings-card h3 {
    margin: 0;
    padding: 10px 12px;
    color: #fff;
    font-size: 0.95rem;
}
.new-listings-card ul {
    list-style: none;
    margin: 0;
    padding: 10px 12px;
    background: var(--color-bg-alt);
    font-size: 0.9rem;
    line-height: 1.7;
}
/* per-card accent colors, same intent as the old inline bgcolor per <td> */
.new-listings-card--1 h3 { background: #0033cc; }
.new-listings-card--2 h3 { background: #0066ff; }
.new-listings-card--3 h3 { background: #0385af; }
.new-listings-card--4 h3 { background: #6600ff; }
.new-listings-card--5 h3 { background: #333399; }
.new-listings-card--6 h3 { background: #000099; }

/* Verified Business & Services carousel — replaces jQuery simplyScroll */
.carousel-panel { margin-bottom: var(--gap); }
.carousel {
    display: flex;
    gap: var(--gap);
    overflow-x: auto;
    scroll-snap-type: x mandatory;
    padding: 16px;
    scrollbar-width: thin;
}
.carousel figure {
    flex: 0 0 240px;
    scroll-snap-align: start;
    margin: 0;
    text-align: center;
}
.carousel img {
    width: 100%;
    height: 145px;
    object-fit: cover;
    border-radius: var(--radius);
    display: block;
}
.carousel figcaption { margin-top: 6px; font-size: 0.9rem; }
.carousel-controls {
    display: flex;
    justify-content: center;
    gap: 8px;
    padding-bottom: 12px;
}
.carousel-controls button {
    border: 1px solid var(--color-border);
    background: #fff;
    border-radius: 50%;
    width: 34px;
    height: 34px;
    cursor: pointer;
    font-size: 1rem;
}
.carousel-controls button:hover { background: var(--color-bg-alt); }

/* --- Added for index-subcate.php (4-column category grid) --- */
.category-columns--4 {
    grid-template-columns: 1fr;
}
.panel-scroll--tall { max-height: 700px; }
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
    </section>

    <!-- Category in details (full list, 4 columns) -->
    <section class="panel category-details" aria-labelledby="category-details-h">
        <h2 id="category-details-h" class="panel-title">Category in details</h2>
        <div class="panel-scroll panel-scroll--tall">
            <div class="category-columns category-columns--4">
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
        </div>
    </section>

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
                                <img loading="lazy" src="user/logo/<?= h($row['img']) ?>"
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
<!--
    Lightbox popup, rebuilt with the native <dialog> element instead of
    jQuery Colorbox. The old page loaded a SECOND, different jQuery
    version (1.10.2 from Google's CDN) on top of the 1.3.2 copy already
    included at the top of the file purely to power this one popup —
    two full copies of the same library, both render-blocking. <dialog>
    needs neither.
-->
<dialog id="promoDialog" class="promo-dialog">
    <form method="dialog" class="promo-dialog__close">
        <button aria-label="Close">&times;</button>
    </form>
    <div class="promo-dialog__grid">
        <?php foreach (array_slice($homeImages, 0, 4) as $img): ?>
            <a href="<?= h(externalUrl($img['website'])) ?>" target="_blank" rel="noopener noreferrer">
                <img loading="lazy" src="user/logo/<?= h($img['img']) ?>" width="250" height="250"
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