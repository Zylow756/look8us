<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ---------------------------------------------------------------------
// CSRF token — shared pattern with index.php. If both pages are live on
// the same domain/session they can safely share $_SESSION['csrf_token'].
// ---------------------------------------------------------------------
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrfToken = $_SESSION['csrf_token'];

/** Escapes a value for safe HTML output. */
function h(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES | ENT_HTML5, 'UTF-8');
}

// ---------------------------------------------------------------------
// "Tell Us Your Need" enquiry form handling (new — see note above).
// Old code built no query at all for this form; if you already have a
// working handler elsewhere (e.g. a separate enquiry.php this form used
// to point to via a template not shown to me), point the <form action>
// below at that instead and delete this handling block to avoid a
// duplicate insert path.
// ---------------------------------------------------------------------
$enquirySent = false;
$enquiryError = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $submittedToken = $_POST['csrf_token'] ?? '';

    if (!hash_equals($csrfToken, $submittedToken)) {
        $enquiryError = 'Your session expired. Please try again.';
    } else {
        $categoryId = (int) ($_POST['cname'] ?? 0); // <select name="cname"> holds catdid
        $city       = trim((string) ($_POST['city'] ?? ''));
        $mname      = trim((string) ($_POST['mname'] ?? ''));
        $mobile     = trim((string) ($_POST['mobile'] ?? ''));
        $email      = trim((string) ($_POST['txtmail'] ?? ''));
        $remark     = trim((string) ($_POST['remark'] ?? ''));

        if ($mname === '' || $mobile === '') {
            $enquiryError = 'Name and Mobile are required.';
        } elseif ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $enquiryError = 'Please enter a valid email address.';
        } else {
            $stmt = $con->prepare(
                'INSERT INTO enquiry (category_id, city, name, mobile, email, remark, created_at)
                 VALUES (?, ?, ?, ?, ?, ?, ?)'
            );

            if ($stmt === false) {
                error_log('Enquiry prepare failed: ' . $con->error);
                $enquiryError = 'Sorry, something went wrong. Please try again later.';
            } else {
                $createdAt = date('Y-m-d');
                $stmt->bind_param('issssss', $categoryId, $city, $mname, $mobile, $email, $remark, $createdAt);

                if ($stmt->execute()) {
                    $enquirySent = true;
                    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
                    $csrfToken = $_SESSION['csrf_token'];
                    // Clear so the form doesn't re-populate with stale values.
                    $_POST = [];
                } else {
                    error_log('Enquiry insert failed: ' . $stmt->error);
                    $enquiryError = 'Sorry, something went wrong. Please try again later.';
                }
                $stmt->close();
            }
        }
    }
}

// ---------------------------------------------------------------------
// Browse Categories (3-column list)
// Old code fetched the whole `category` table with no LIMIT and split
// it across 3 <table> columns by continuing to pull from the same
// mysqli result cursor across three while-loops (a "3 <= i < rno"
// pattern). That's fragile — any future change to the loop order
// silently breaks the split. Replaced with one fetch into a PHP array
// and array_chunk() for a deterministic 3-way split.
//
// Old links were literally href="#" (dead links) — every category
// looked clickable but went nowhere. That's fixed here to link to
// searchresult.php?id=<cateid>, matching how the sibling index.php
// page already links its own category list. Revert to '#' below if you
// specifically want the old (broken) behaviour preserved.
// ---------------------------------------------------------------------
$browseCategories = [];
$stmt = $con->prepare('SELECT cateid, cname FROM category ORDER BY cname');
if ($stmt) {
    $stmt->execute();
    $res = $stmt->get_result();
    while ($row = $res->fetch_assoc()) {
        $browseCategories[] = $row;
    }
    $stmt->close();
} else {
    error_log('Category query failed: ' . $con->error);
}
$browseCategoryChunks = array_chunk($browseCategories, (int) ceil(count($browseCategories) / 3) ?: 1);

// ---------------------------------------------------------------------
// Category dropdown for the enquiry form
// ---------------------------------------------------------------------
$catDetails = [];
$stmt = $con->prepare('SELECT catdid, cdname FROM catedetail ORDER BY cdname');
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

// Old code checked isset($_POST["cdname"]) to mark the selected <option>,
// but the <select> itself is named "cname" — that comparison could never
// be true, so the dropdown never actually kept the visitor's selection
// after a failed submit. Fixed to read $_POST['cname'].
$selectedCategoryId = $_POST['cname'] ?? null;

// Static "Verified Business & Services" carousel entries (unchanged
// content from the original markup; not database-driven).
$carouselItems = [
    ['img' => 'images/board_paper_solutions.jpg', 'name' => 'Tirupati Travels'],
    ['img' => 'images/HC%20Verma%20solution.png', 'name' => 'Thomas Cook'],
    ['img' => 'images/Irodo%20Solution.png', 'name' => 'Hero Cycles'],
    ['img' => 'images/NCERT%20SOLUTION%20TOP.jpg', 'name' => 'Tata Motor Finance'],
    ['img' => 'images/Previous%20AIEEE%20Papers.jpg', 'name' => 'Food Plaza'],
    ['img' => 'images/Previous%20AIPMT%20papers.jpg', 'name' => 'Surya Hotel'],
    ['img' => 'images/Puzzle.jpg', 'name' => 'Resonance'],
];

// Static "Popular Category" sidebar (unchanged content — not database-
// driven in the original either; all links were href="#").
$popularCategoryStatic = [
    'Construction Material Dealers',
    'Home Furniture Dealers',
    'Refrigerator',
    'Plumbing Contractors',
    'Orchestra & Music Organisers',
    'Department Stores',
    'Fixtures & Fittings Dealers',
    'Awnings & Canopies Contractors',
    'Electricians',
];

// Static "New on Look8us.com" section content (unchanged from original).
$newListings = [
    ['title' => 'Construction & Renovation', 'items' => ['Bathroom & Sanitaryware', 'Bathroom Fittings', 'Fixtures & Fittings Dealers', 'Construction Material Dealers']],
    ['title' => 'Decoration & Furniture', 'items' => ['Architects', 'Curtains & Blinds Dealers', 'Awnings & Canopies Contractors', 'Home Furniture Dealers']],
    ['title' => 'Electronics & Appliances', 'items' => ['Audio Music System', 'Refrigerator', 'TV', 'Inverter Dealers & Services & Rentals']],
    ['title' => 'Grocery & Home Supplies', 'items' => ['Crockery Stores', 'Department Stores', 'Grocery Stores', 'Allopathy Pharmacies']],
    ['title' => 'Home Services & Repair', 'items' => ['Plumbing Contractors', 'Cleaning Services', 'Electricians', 'Painters']],
    ['title' => 'Other Services', 'items' => ['Florists', 'Orchestra & Music Organisers', 'Cooking Gas Agencies', 'Generator Hire']],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Online Directory</title>
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
	</style>
</head>
<body>

<header class="site-header">
<?php require __DIR__ . '/header.php'; ?>
</header>

<main class="page-wrap">

    <div class="home-columns">

        <!-- Popular Category (static list, unchanged content) -->
        <nav class="panel popular-category" aria-labelledby="popular-category-h">
            <h2 id="popular-category-h" class="panel-title">Popular Category</h2>
            <div class="panel-scroll">
                <ul class="link-list">
                    <?php foreach ($popularCategoryStatic as $label): ?>
                        <li><a href="#"><?= h($label) ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </nav>

        <!-- Browse Categories -->
        <section class="panel category-details" aria-labelledby="browse-categories-h">
            <h2 id="browse-categories-h" class="panel-title">Browse Categories</h2>
            <div class="panel-scroll">
                <div class="category-columns">
                    <?php foreach ($browseCategoryChunks as $chunk): ?>
                        <ul class="link-list">
                            <?php foreach ($chunk as $row): ?>
                                <li>
                                    <a href="searchresult.php?id=<?= (int) $row['cateid'] ?>">
                                        <?= h($row['cname']) ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- Tell Us Your Need -->
        <section class="panel enquiry-panel" aria-labelledby="enquiry-h">
            <h2 id="enquiry-h" class="panel-title panel-title--accent">Tell Us Your Need, Get Instant Response!</h2>

            <?php if ($enquirySent): ?>
                <p class="alert alert-success" role="status">Thanks — we've received your request and will get back to you shortly.</p>
            <?php elseif ($enquiryError !== null): ?>
                <p class="alert alert-error" role="alert"><?= h($enquiryError) ?></p>
            <?php endif; ?>

            <form method="post" action="index-old.php" class="enquiry-form" novalidate>
                <input type="hidden" name="csrf_token" value="<?= h($csrfToken) ?>">

                <label for="cname">Category</label>
                <select class="selbox" name="cname" id="cname">
                    <option value="0">Please Select</option>
                    <?php foreach ($catDetails as $row): ?>
                        <option value="<?= (int) $row['catdid'] ?>"
                            <?= ((string) $selectedCategoryId === (string) $row['catdid']) ? 'selected' : '' ?>>
                            <?= h($row['cdname']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

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

                <label for="remark">Detail</label>
                <input class="txtbox" type="text" name="remark" id="remark" placeholder="Message"
                       value="<?= h($_POST['remark'] ?? '') ?>">

                <button class="subbox" type="submit" name="submit">Get Response</button>
            </form>
        </section>
    </div>

    <!-- New on Look8us.com -->
    <section class="panel new-listings" aria-labelledby="new-listings-h">
        <h2 id="new-listings-h" class="panel-title" style="background:#ffcc00;color:#000;">New on Look8us.com</h2>
        <div class="new-listings-grid">
            <?php foreach ($newListings as $i => $group): ?>
                <div class="new-listings-card new-listings-card--<?= $i + 1 ?>">
                    <h3><?= h($group['title']) ?></h3>
                    <ul>
                        <?php foreach ($group['items'] as $item): ?>
                            <li><?= h($item) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Verified Business & Services -->
    <section class="panel carousel-panel" aria-labelledby="carousel-h">
        <h2 id="carousel-h" class="panel-title" style="background:#ff0000;">
            Verified Business &amp; Services <small>(Advertisements)</small>
        </h2>
        <div class="carousel" id="verifiedCarousel" tabindex="0" aria-label="Verified business listings, scrollable">
            <?php foreach ($carouselItems as $item): ?>
                <figure>
                    <img loading="lazy" src="<?= h($item['img']) ?>" width="240" height="145"
                         alt="<?= h($item['name']) ?>">
                    <figcaption><?= h($item['name']) ?></figcaption>
                </figure>
            <?php endforeach; ?>
        </div>
        <div class="carousel-controls">
            <button type="button" id="carouselPrev" aria-label="Scroll left">&larr;</button>
            <button type="button" id="carouselNext" aria-label="Scroll right">&rarr;</button>
        </div>
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

<script>
// Replaces jQuery 1.3.2 + easing + timers + dualSlider + simplyScroll
// (five separate legacy script files, none maintained since ~2009-2011,
// each a potential attack surface and a render-blocking network request)
// with ~15 lines of vanilla JS. The carousel already works via native
// touch/trackpad scrolling and CSS scroll-snap with zero JS; these
// buttons are a small enhancement for mouse/keyboard users.
document.addEventListener('DOMContentLoaded', () => {
    const track = document.getElementById('verifiedCarousel');
    const prev = document.getElementById('carouselPrev');
    const next = document.getElementById('carouselNext');
    if (!track || !prev || !next) return;

    const scrollByCard = (direction) => {
        const card = track.querySelector('figure');
        const amount = card ? card.getBoundingClientRect().width + 16 : 240;
        track.scrollBy({ left: direction * amount, behavior: 'smooth' });
    };

    prev.addEventListener('click', () => scrollByCard(-1));
    next.addEventListener('click', () => scrollByCard(1));
});
</script>

</body>
</html>