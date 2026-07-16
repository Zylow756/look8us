<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';

/*
|--------------------------------------------------------------------------
| Secure Session Initialization
|--------------------------------------------------------------------------
*/
if (session_status() !== PHP_SESSION_ACTIVE) {

    session_set_cookie_params([
        'lifetime' => 0,
        'path'     => '/',
        'domain'   => '',
        'secure'   => (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'),
        'httponly' => true,
        'samesite' => 'Lax'
    ]);

    session_start();
}

/*
|--------------------------------------------------------------------------
| Security Headers
|--------------------------------------------------------------------------
*/
header('X-Frame-Options: SAMEORIGIN');
header('X-Content-Type-Options: nosniff');
header('Referrer-Policy: strict-origin-when-cross-origin');
header('X-XSS-Protection: 1; mode=block');

/*
|--------------------------------------------------------------------------
| Page Variables
|--------------------------------------------------------------------------
*/
$pageTitle = 'Look8US | Privacy Policy';
$pageDescription = 'Read the official Privacy Policy of Look8US. Learn how we collect, use, protect and manage your personal information.';
$pageKeywords = 'Look8US Privacy Policy, Business Directory, Privacy, Data Protection, Kota Rajasthan';
?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title><?= htmlspecialchars($pageTitle) ?></title>

<meta name="description"
      content="<?= htmlspecialchars($pageDescription) ?>">

<meta name="keywords"
      content="<?= htmlspecialchars($pageKeywords) ?>">

<meta name="robots"
      content="index,follow">

<meta name="author"
      content="Look8US">

<link rel="canonical"
      href="https://look8us.com/PrivacyPolicy.php">

<link rel="stylesheet"
      href="akc.css">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

html{
    scroll-behavior:smooth;
}

body{

    font-family:Arial,Helvetica,sans-serif;
    background:#f4f6f9;
    color:#333;
    line-height:1.8;
}

a{

    color:#0d6efd;
    text-decoration:none;
}

a:hover{

    text-decoration:underline;
}

.wrapper{

    width:min(1200px,95%);
    margin:auto;
}

.page-banner{

    background:#d9d9d9;
    padding:30px 15px;
    margin-bottom:30px;
}

.page-banner h1{

    font-size:clamp(28px,4vw,42px);
    color:#333;
    font-weight:700;
}

.content-card{

    background:#fff;
    border-radius:10px;
    box-shadow:0 3px 12px rgba(0,0,0,.08);

    padding:40px;

    margin-bottom:40px;
}

.content-card h2{

    color:#222;

    margin-top:35px;

    margin-bottom:15px;

    font-size:clamp(22px,3vw,30px);
}

.content-card h3{

    margin-top:30px;

    margin-bottom:15px;

    color:#444;

    font-size:22px;
}

.content-card p{

    margin-bottom:18px;

    text-align:justify;

    font-size:16px;
}

.content-card ul{

    margin-left:25px;

    margin-bottom:20px;
}

.content-card li{

    margin-bottom:10px;
}

.contact-box{

    background:#f8f9fa;

    border-left:5px solid #0d6efd;

    padding:20px;

    margin-top:25px;

    border-radius:8px;
}
</style>

</head>

<body>

<!-- Facebook SDK (kept for existing functionality) -->
<div id="fb-root"></div>

<script>
(function(d,s,id){

    let js,
        fjs=d.getElementsByTagName(s)[0];

    if(d.getElementById(id))
        return;

    js=d.createElement(s);

    js.id=id;

    js.src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v18.0";

    fjs.parentNode.insertBefore(js,fjs);

}(document,'script','facebook-jssdk'));
</script>

<?php require_once __DIR__ . '/header.php'; ?>

<section class="page-banner">

    <div class="wrapper">

        <h1>
            Look8US – Privacy Policy
        </h1>

    </div>

</section>

<div class="wrapper">

<div class="content-card">
<section id="introduction">

    <h2>Introduction</h2>

    <p>
        We, at <strong>Look8US</strong>, are committed to respecting your
        online privacy and recognize your need for appropriate protection
        and management of any personally identifiable information
        (<strong>"Personal Information"</strong>) that you share with us.
    </p>

    <p>
        <strong>Personal Information</strong> means any information that
        may be used to identify an individual, including but not limited
        to:
    </p>

    <ul>
        <li>First Name</li>
        <li>Last Name</li>
        <li>Residential or Business Address</li>
        <li>Email Address</li>
        <li>Telephone Number</li>
        <li>Any other personally identifiable information</li>
    </ul>

    <p>
        In general, you can browse the Look8US website without revealing
        your identity or providing any personal information.
    </p>

    <p>
        By using this website, you agree to comply with our policies.
        This Privacy Policy explains how we collect, use, protect and
        manage your personal information so that you can make informed
        decisions while using our website and services.
    </p>

</section>
<section id="information-collection">

    <h2>What Information Do We Collect?</h2>

    <p>
        When you visit our website, you may provide us with two different
        categories of information:
    </p>

    <ul>

        <li>
            <strong>Personal Information</strong> that you voluntarily
            submit.
        </li>

        <li>
            <strong>Website Usage Information</strong> that is collected
            automatically while you browse our website.
        </li>

    </ul>

    <p>
        Personal information is collected individually, while website
        usage information is collected in an aggregated form for analysis
        and improvement of our services.
    </p>

</section>
<section id="personal-information">

    <h2>Personal Information You Choose to Provide</h2>

    <p>
        Certain services available on Look8US require you to provide
        personal information voluntarily. This enables us to verify your
        identity and provide secure access to products, services and
        customer support.
    </p>

    <p>
        Providing this information is completely optional. However,
        choosing not to provide it may prevent you from accessing certain
        services available on our website.
    </p>

</section>
<section id="registration-information">

    <h2>Registration Information</h2>

    <p>
        During registration or while accessing specific sections of our
        website, you may be asked to provide information that helps us
        verify your identity and improve your experience.
    </p>

    <p>
        This information may also be used for:
    </p>

    <ul>

        <li>Customer Support</li>

        <li>Technical Assistance</li>

        <li>Service Improvements</li>

        <li>Follow-up Communication</li>

        <li>Managing your account</li>

        <li>Providing requested products and services</li>

    </ul>

    <p>
        You may be requested to provide information while:
    </p>

    <ul>

        <li>Logging into secured areas of the website.</li>

        <li>Creating a new account.</li>

        <li>Registering for services.</li>

        <li>Subscribing to newsletters.</li>

        <li>Joining promotional mailing lists.</li>

        <li>Submitting online surveys.</li>

        <li>Placing product or service orders.</li>

    </ul>

    <p>
        Depending upon the service requested, we may collect:
    </p>

    <ul>

        <li>Full Name</li>

        <li>Email Address</li>

        <li>Phone Number</li>

        <li>Postal Address</li>

        <li>Username</li>

        <li>Password</li>

        <li>Other information required for account verification</li>

    </ul>

    <p>
        Occasionally, additional information may be requested to provide
        enhanced services or verify your eligibility.
    </p>

    <p>
        If you subscribe to newsletters or promotional communications,
        you may unsubscribe at any time using the unsubscribe option
        provided in the communication.
    </p>

    <p>
        Wherever Look8US collects personal information, we strive to
        provide access to this Privacy Policy so that users understand
        how their information is handled.
    </p>

</section>
<section id="how-we-use-information">

    <h2>How We Use Your Information</h2>

    <p>
        Look8US uses your personal information only for legitimate
        business purposes related to providing and improving our services.
    </p>

    <p>
        Information such as your name, email address, telephone number
        and mailing address is treated as confidential and is used for:
    </p>

    <ul>

        <li>Providing requested services.</li>

        <li>Customer support.</li>

        <li>Technical assistance.</li>

        <li>Processing registrations.</li>

        <li>Managing your account.</li>

        <li>Sending important service notifications.</li>

        <li>Informing you about new services.</li>

        <li>Providing special offers.</li>

        <li>Sending promotional communications.</li>

        <li>Improving website functionality.</li>

    </ul>

    <p>
        We may also send you carefully selected offers from trusted third
        parties that we believe may be relevant to your interests.
    </p>

    <p>
        Employees, contractors and authorized service providers who have
        access to your personal information are required to maintain its
        confidentiality and may use it only for performing services on
        behalf of Look8US.
    </p>

</section>
<section id="sharing-information">

    <h2>Sharing Information with Third Parties</h2>

    <p>
        Look8US may enhance or combine information collected through this
        website with information obtained from trusted third parties for
        the purpose of improving our services and providing relevant
        marketing communications.
    </p>

    <p>
        We may work with advertising networks or advertising service
        providers that display advertisements on behalf of multiple
        companies. Where applicable, these providers may receive limited
        information such as your username and demographic information to
        help display advertisements that are more relevant to your
        interests.
    </p>

    <p>
        These advertising providers may combine such information with
        non-personally identifiable information collected through cookies
        or similar technologies for the sole purpose of displaying
        personalized advertisements on our website.
    </p>

    <p>
        Circumstances may arise where we are required to disclose your
        personal information in connection with:
    </p>

    <ul>

        <li>Sale of business assets.</li>

        <li>Corporate merger or acquisition.</li>

        <li>Business restructuring.</li>

        <li>Legal investigations.</li>

        <li>Court orders.</li>

        <li>Government requests.</li>

        <li>Compliance with applicable laws.</li>

    </ul>

    <p>
        We may periodically send information regarding our products,
        services, updates and promotional offers that we believe may be
        useful to you.
    </p>

    <p>
        Only Look8US or authorized contractors working under strict
        confidentiality agreements are permitted to send these
        communications on our behalf.
    </p>

    <h3>Secure Information Transmission</h3>

    <p>
        Email is not considered a completely secure method of transmitting
        confidential information. Therefore, we recommend that sensitive
        personal information should not be sent through email.
    </p>

    <p>
        Internet communication always carries inherent security risks.
        Users should exercise appropriate caution while sharing
        information online.
    </p>

    <h3>Accessing or Correcting Your Information</h3>

    <p>
        You may request access to the personal information maintained by
        Look8US or request corrections whenever appropriate by contacting
        our support team.
    </p>

    <h3>Certain Disclosures</h3>

    <p>
        We may disclose personal information when required by law or when
        disclosure is necessary to:
    </p>

    <ul>

        <li>Comply with legal obligations.</li>

        <li>Respond to court orders.</li>

        <li>Protect our legal rights.</li>

        <li>Protect website users.</li>

        <li>Prevent fraud or illegal activities.</li>

        <li>Protect public safety.</li>

    </ul>

    <h3>External Websites</h3>

    <p>
        Our website may contain links to third-party websites for your
        convenience. Once you leave Look8US, this Privacy Policy no longer
        applies. Each external website maintains its own privacy policy,
        and we encourage you to review those policies before providing any
        personal information.
    </p>

</section>
<section id="cookies">

    <h2>Cookies and Other Tracking Technologies</h2>

    <p>
        Some pages on the Look8US website use cookies and similar tracking
        technologies to improve your browsing experience.
    </p>

    <p>
        A cookie is a small text file stored on your device that helps us
        recognize returning visitors, remember preferences and improve
        website functionality.
    </p>

    <p>
        Cookies may be used for:
    </p>

    <ul>

        <li>Remembering login sessions.</li>

        <li>Saving user preferences.</li>

        <li>Improving website performance.</li>

        <li>Website analytics.</li>

        <li>Displaying relevant advertisements.</li>

        <li>Preventing repeated display of the same advertisements.</li>

    </ul>

    <p>
        Most web browsers allow you to control cookies through browser
        settings. You may accept, reject or delete cookies according to
        your preference.
    </p>

    <p>
        Please note that disabling cookies may affect the functionality of
        certain sections of the website.
    </p>

    <p>
        Tracking technologies may automatically collect information such
        as:
    </p>

    <ul>

        <li>IP Address</li>

        <li>Browser Type</li>

        <li>Operating System</li>

        <li>Device Information</li>

        <li>Date and Time of Access</li>

        <li>Visited Pages</li>

        <li>Clickstream Data</li>

    </ul>

    <p>
        This information is generally analyzed in aggregate form to help
        improve website performance and user experience.
    </p>

</section>
<section id="third-party-services">

    <h2>Third Party Services</h2>

    <p>
        Look8US works with trusted third-party service providers to help
        deliver products, services, communications and website
        functionality.
    </p>

    <p>
        These providers may receive limited personal information solely
        for the purpose of performing services on behalf of Look8US.
    </p>

    <p>
        We require all authorized service providers to:
    </p>

    <ul>

        <li>Protect personal information.</li>

        <li>Maintain confidentiality.</li>

        <li>Use the information only for authorized purposes.</li>

        <li>Comply with applicable privacy regulations.</li>

    </ul>

    <p>
        Look8US does not intentionally sell personal information to third
        parties without your consent unless required by applicable law.
    </p>

</section>
<section id="children">

    <h2>Children's Privacy</h2>

    <p>
        Look8US does not knowingly collect personal information from
        children below the age of 15 years.
    </p>

    <p>
        If we become aware that personal information belonging to a child
        under the applicable age has been collected, we will take
        reasonable steps to remove such information from our systems.
    </p>

    <p>
        Personal information relating to users above the applicable age is
        collected only for providing requested services and fulfilling
        legitimate business purposes.
    </p>

</section>
<section id="spamming">

    <h2>Spamming Policy</h2>

    <p>
        Sending unsolicited commercial emails, advertisements or bulk
        communications through Look8US systems is strictly prohibited.
    </p>

    <p>
        Users must not use Look8US infrastructure for:
    </p>

    <ul>

        <li>Mass unsolicited email campaigns.</li>

        <li>Spam distribution.</li>

        <li>False identity or forged sender information.</li>

        <li>Unauthorized mailing lists.</li>

        <li>Posting unrelated content to forums or groups.</li>

        <li>Using third-party servers while routing spam through Look8US.</li>

        <li>Providing false registration information.</li>

    </ul>

    <h3>Consequences of Policy Violations</h3>

    <p>
        Whenever an alleged violation is detected, Look8US may initiate an
        investigation. During this period, access to services may be
        temporarily restricted to prevent further misuse.
    </p>

    <p>
        Depending upon the severity of the violation, Look8US may:
    </p>

    <ul>

        <li>Issue warnings.</li>

        <li>Suspend user accounts.</li>

        <li>Permanently terminate services.</li>

        <li>Seek civil remedies.</li>

        <li>Notify appropriate law enforcement authorities where required.</li>

    </ul>

</section>
<section id="your-consent">

    <h2>Your Consent</h2>

    <p>
        By accessing or using the Look8US website, you acknowledge and
        consent to the collection, storage, processing and use of your
        personal information in accordance with this Privacy Policy.
    </p>

    <p>
        Your continued use of this website after any updates to this
        Privacy Policy constitutes your acceptance of those changes.
    </p>

</section>
<section id="information-security">

    <h2>Information Security</h2>

    <p>
        Protecting your personal information is one of our highest
        priorities. We implement appropriate administrative, technical
        and physical safeguards to protect information against
        unauthorized access, disclosure, alteration or destruction.
    </p>

    <p>
        Our security measures include, but are not limited to:
    </p>

    <ul>

        <li>Controlled access to customer information.</li>

        <li>Secure server infrastructure.</li>

        <li>Restricted employee access.</li>

        <li>Regular software updates.</li>

        <li>Continuous monitoring of website security.</li>

        <li>Protection against unauthorized modification of data.</li>

    </ul>

    <p>
        Access to personal information is granted only to employees,
        contractors and authorized personnel who require the information
        for legitimate business purposes.
    </p>

</section>
<section id="update-information">

    <h2>Updating Your Information</h2>

    <p>
        We provide mechanisms that allow users to review, update and
        correct personal information maintained in our records whenever
        reasonably possible.
    </p>

    <p>
        If you believe that any personal information maintained by
        Look8US is inaccurate or incomplete, you may contact us and
        request that appropriate corrections be made.
    </p>

</section>
<section id="information-sharing">

    <h2>Information Sharing and Disclosure</h2>

    <p>
        Look8US does not rent, sell or share your personal information
        with unaffiliated third parties except in the circumstances
        described below or where your consent has been obtained.
    </p>

    <p>
        Information may be shared under the following circumstances:
    </p>

    <ul>

        <li>
            With trusted business partners working under strict
            confidentiality agreements.
        </li>

        <li>
            To provide products or services requested by you.
        </li>

        <li>
            To respond to legal notices, subpoenas, court orders or
            lawful government requests.
        </li>

        <li>
            To establish or defend our legal rights.
        </li>

        <li>
            To investigate fraud, security incidents or suspected illegal
            activities.
        </li>

        <li>
            To prevent threats to public safety.
        </li>

        <li>
            When required by applicable law.
        </li>

        <li>
            If Look8US is merged, acquired or its assets are transferred
            to another organization.
        </li>

    </ul>

    <p>
        Should ownership of Look8US change, users will be notified before
        their information becomes subject to a different privacy policy.
    </p>

    <h3>Advertising</h3>

    <p>
        Look8US may display advertisements based upon user interests and
        general demographic information.
    </p>

    <p>
        Advertisers may assume that users who interact with particular
        advertisements satisfy the targeting criteria used for those
        advertisements. However, Look8US does not disclose personally
        identifiable information to advertisers without user consent.
    </p>

    <p>
        Our advertising partners may include financial institutions,
        insurance companies, travel businesses, retailers, software
        providers and other commercial organizations.
    </p>

</section>
<section id="confidentiality-security">

    <h2>Confidentiality and Security</h2>

    <p>
        We are committed to maintaining the confidentiality of your
        personal information through appropriate organizational and
        technical safeguards.
    </p>

    <ul>

        <li>
            Access to personal information is limited to authorized
            employees who require such access to perform their duties.
        </li>

        <li>
            We maintain physical, electronic and procedural safeguards
            designed to protect personal information.
        </li>

        <li>
            Reasonable efforts are made to comply with applicable Indian
            data protection and privacy laws.
        </li>

        <li>
            Internal procedures are regularly reviewed to improve
            information security.
        </li>

    </ul>

    <p>
        Although we take commercially reasonable precautions to protect
        your information, no method of electronic transmission or storage
        can be guaranteed to be completely secure. Users should therefore
        exercise reasonable care while sharing information online.
    </p>

</section>
<section id="policy-changes">

    <h2>Changes to this Privacy Policy</h2>

    <p>
        Look8US reserves the right to update, revise, modify or replace
        this Privacy Policy at any time without prior notice whenever
        required by business, legal or operational requirements.
    </p>

    <p>
        Any revised version will become effective immediately upon being
        published on this website unless otherwise stated.
    </p>

    <p>
        We encourage users to review this Privacy Policy periodically so
        they remain informed about how their personal information is
        protected.
    </p>

</section>
<section id="contact-information">

    <h2>Contact Information</h2>

    <p>
        If you have any questions, concerns or complaints regarding this
        Privacy Policy or the processing of your personal information,
        please contact us using the details below.
    </p>

    <div class="contact-box">

        <h3>Look8US</h3>

        <p>
            <strong>Address</strong><br>

            309, Mahaveer Nagar-II<br>
            Kota – 324005<br>
            Rajasthan, India
        </p>

        <p>
            <strong>Phone</strong><br>
            <a href="tel:+918955989444">+91 89559 89444</a>
        </p>

        <p>
            <strong>Email</strong><br>

            <a href="mailto:look8us@yahoo.com">
                look8us@yahoo.com
            </a>

            <br>

            <a href="mailto:support@look8us.com">
                support@look8us.com
            </a>

        </p>

    </div>

</section>

<section id="complaint-procedure">

    <h2>Complaint Procedure</h2>

    <p>
        When submitting a complaint relating to your personal
        information, please include the following details:
    </p>

    <ul>

        <li>Identification of the information concerned.</li>

        <li>Whether the information is personal or sensitive personal information.</li>

        <li>Your full name and contact details.</li>

        <li>Your postal address.</li>

        <li>Your email address.</li>

        <li>Your telephone number.</li>

        <li>
            A clear explanation describing how you believe the information
            has been processed incorrectly or disclosed without
            authorization.
        </li>

        <li>
            A declaration that the information provided in your complaint
            is accurate and belongs to you.
        </li>

    </ul>

    <p>
        Look8US reserves the right to request additional information to
        verify the authenticity of any complaint before taking further
        action.
    </p>

</section>
<section id="how-to-contact">

    <h2>How to Contact Us</h2>

    <p>
        If you would like to contact us regarding this Privacy Policy,
        please use the contact information provided above.
    </p>

    <p>
        We will make reasonable efforts to respond to all genuine privacy
        related enquiries as quickly as possible.
    </p>

</section>
<section id="policy-revisions">

    <h2>Policy Revisions</h2>

    <p>
        Look8US reserves the right to revise, amend or modify this
        Privacy Policy at any time. Updated versions will be published on
        this page and become effective immediately unless otherwise
        specified.
    </p>

    <p>
        We encourage visitors to review this page periodically to remain
        informed about how we protect personal information.
    </p>

</section>

</div>
</div>
<?php require_once __DIR__ . '/footer.php'; ?>

</body>
</html>