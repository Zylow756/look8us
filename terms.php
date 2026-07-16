<?php
declare(strict_types=1);

require_once __DIR__ . "/config.php";/*
|--------------------------------------------------------------------------
| Secure Session Handling
|--------------------------------------------------------------------------
*/

if (session_status() === PHP_SESSION_NONE) {

    session_set_cookie_params([
        'lifetime' => 0,
        'path'     => '/',
        'domain'   => '',
        'secure'   => isset($_SERVER['HTTPS']),
        'httponly' => true,
        'samesite' => 'Lax'
    ]);

    session_start();
}/*
|--------------------------------------------------------------------------
| Security Headers
|--------------------------------------------------------------------------
| Protect against common browser attacks.
|--------------------------------------------------------------------------
*/

header("X-Frame-Options: SAMEORIGIN");
header("X-Content-Type-Options: nosniff");
header("Referrer-Policy: strict-origin-when-cross-origin");/*
|--------------------------------------------------------------------------
| Page Configuration
|--------------------------------------------------------------------------
*/

$pageTitle = "Terms of Use | Look8us";
$pageDescription = "Read the terms and conditions for using Look8us online services.";?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0"><title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?></title><meta name="description" 
content="<?= htmlspecialchars($pageDescription, ENT_QUOTES, 'UTF-8'); ?>"><meta name="robots" content="index, follow"><link rel="stylesheet" href="akc.css"><style>
* {
    box-sizing:border-box;
}body {

    margin:0;

    padding:0;

    background:#f5f5f5 url("images/bg.png") repeat;

    font-family:

    Arial,
    Helvetica,
    sans-serif;

    color:#333;

    line-height:1.6;

}/*
|--------------------------------------------------------------------------
| Main Container
|--------------------------------------------------------------------------
*/

.page-wrapper {

    width:100%;

    max-width:1200px;

    margin:auto;

    background:#ffffff;

}/*
|--------------------------------------------------------------------------
| Page Heading
|--------------------------------------------------------------------------
*/.page-title {

    background:#d2d2d2;

    padding:25px 20px;

    text-align:center;

}
.page-title h1 {

    margin:0;

    font-size:clamp(28px,4vw,40px);

    color:#333;

}/*
|--------------------------------------------------------------------------
| Terms Content Area
|--------------------------------------------------------------------------
*/.content-container {

    padding:

    clamp(15px,3vw,40px);

}
.terms-content {    font-size:15px;

    text-align:justify;

}
.terms-content h2 {    color:#333;

    font-size:24px;

    margin-top:30px;}
.terms-content h3 {    color:#444;

    margin-top:25px;}
.terms-content p {    margin-bottom:15px;}
.terms-content ul {    padding-left:25px;}
.terms-content li {    margin-bottom:10px;}
.contact-box {

    background:#f7f7f7;

    border-left:5px solid #333;

    padding:20px;

    margin:25px 0;

    border-radius:5px;

}
.contact-box a {

    color:#0066cc;

    text-decoration:none;

}
.contact-box a:hover {

    text-decoration:underline;

}
.copyright {

    text-align:center;

    margin-top:40px;

}
</style>

<div id="fb-root"></div><script async defer crossorigin="anonymous"
src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v18.0&appId=1403091889904611">
</script></head>
<body><div class="page-wrapper"><?php require_once __DIR__ . "/header.php"; ?>
<section class="page-title">

<h1>
Terms of Use
</h1>

</section>
<main class="content-container"><article class="terms-content">
	<section class="terms-content">

<h2>Services Offered</h2><p>
The services of Look8us.com are available only to the registered users
("Users") on a single user basis, for a particular period of time on
making the stipulated payment and abiding by the applicable terms and
conditions.
</p><p>
The said services are personal in nature and cannot be assigned or
transferred to or shared with any other person other than the registered
users.
</p><p>
The services offered by Look8us, the company that owns and operates the
Website, are listed in detail on the Website.
</p>
<p>
By registering yourself as a user and subscribing to avail the services
of this Website, it will be deemed that you have read, understood and
agreed to fully abide by all the terms and conditions of the Website as
contained herein.
</p>
<p>
Further, by registering on the Website, you agree to:
</p><ul>

<li>
make your contact details available to Look8us partners so that you may
be contacted by Look8us partners for education information through
email, telephone and SMS;
</li><li>
receive promotional mails/special offers from the Website or any of its
partner websites;
</li><li>
be contacted by Look8us in accordance with the privacy settings set by
you.
</li></ul>
<p>
The right to use the services of the Website is on revocable license /
permission basis as per the terms and conditions contained herein.
</p>
<p>
Except the usage of the services during the license period, the
registered users shall not have any right or title over the Website or
any of its contents.
</p>
<p>
In order to use Look8us online services, you must obtain access to the
World Wide Web, either directly or through devices that access web-based
content, and pay any service fees associated with such access.
</p>
<p>
In addition, you will need to have access to all equipment necessary to
make such a connection to the World Wide Web, including a computer and
modem or other access devices.
</p>

<h2>User Obligations</h2>
<p>
In consideration of your use of the services, you agree to provide
correct, precise, up-to-date and complete information about yourself as
required by the service's registration form wherever necessary;
and maintain and promptly update the registration data to keep it true,
accurate, current and complete.
</p>
<p>
If you provide any information that is untrue, inaccurate, not up-to-date
or incomplete, or if Look8us has reasonable grounds to suspect that such
information is untrue, inaccurate, not current or incomplete, Look8us
has the right to suspend or terminate your account and refuse any and
all current or future use of the services.
</p>

<p>
If you are directly subscribing as a user of this Website, you represent
and warrant that you are at least 18 years of age and that you possess
the legal right and capacity to use the services of Look8us in accordance
with the stated terms and usage policies.
</p>
<p>
In cases where a minor below the age of 18 years wants to use this
website, such user shall duly register himself through his parent or
guardian.
</p>
<p>
Such parent or guardian agrees to register, supervise usage and be
responsible for the actions of any such minors who use the computer
and/or password to access Look8us.
</p>

<h2>Purchasing and Ordering Disclaimer</h2>
<h3>Make Your Own Decisions</h3><p>
If you are making important purchasing or planning decisions, whether
personal or business decisions, you should look at an actual
demonstration model of any product you are considering before making
your important purchasing or planning decisions.
</p>
<p>
Contact a supplier, store, or manufacturer regarding looking at any
demonstration units.
</p>
<p>
All decisions made would be entirely your prerogative and Look8us does
not claim to offer any advice, either legal or financial.
</p>

<h3>Pricing</h3><p>
All prices are subject to change without notice.
Every effort has been made to ensure accurate pricing of the products
featured on our website.
</p>
<p>
In the event a part or accessory is ordered and the listed price has
changed, you will be notified prior to processing your order.
</p>
<p>
You agree that all products purchased by you through this website are
provided under warranties, if any, of the manufacturer only, and not by
Look8us.
</p>
<p>
All products are provided by Look8us on an "as is" basis with no
representations or warranties of any kind from Look8us.
</p>

<h2>Password</h2>
<p>
Please note that the password generated by you for accessing the Website
should not be shared by you with anyone else at any time.
</p>
<p>
Products purchased by you have been licensed to you by Look8us for your
own use only and you cannot share your password with others or allow
others to use paid courses.
</p>
<p>
This will be a gross violation of the license terms governing the paid
products.
</p>

<h2>Use of Website</h2>
<h3>Prohibited Activities</h3>
<p>
You represent, warrant, covenant and undertake that you shall not host,
display, upload, modify, publish, transmit, update or share any
information on the Website that:
</p>
<ul>

<li>
belongs to another person and to which you do not have any right;
</li><li>
is grossly harmful, harassing, blasphemous, defamatory, obscene,
pornographic, paedophilic, libellous, invasive of another's privacy,
hateful, racially or ethnically objectionable, or otherwise unlawful;
</li><li>
harms minors in any way;
</li><li>
infringes any patent, trademark, copyright or other proprietary rights;
</li><li>
violates any law for the time being in force;
</li><li>
deceives or misleads the addressee about the origin of such messages;
</li><li>
impersonates another person;
</li><li>
contains software viruses or malicious computer code designed to
interrupt, destroy or limit functionality of computer resources;
</li><li>
threatens the unity, integrity, defence, security or sovereignty of
India or causes incitement to the commission of any offence.
</li></ul>
id="terms-part2a"

<p>
You further represent, warrant, covenant and undertake that your use of
the Website shall not:
</p><ol>

<li>
violate any applicable local, provincial, state, national or international
law, statute, ordinance, rule or regulation;
</li><li>
interfere with or disrupt computer networks connected to the Website;
</li><li>
impersonate any other person or entity, or make any misrepresentation
as to your employment by or affiliation with any other person or entity;
</li><li>
forge headers or manipulate identifiers in order to disguise the origin
of any user information;
</li><li>
upload, post, transmit, publish, or distribute any material or information
for which you do not have all necessary rights and licenses;
</li><li>
upload, post, transmit, publish or distribute any material which infringes,
violates, breaches or otherwise contravenes the rights of any third party,
including copyright, trademark, patent, privacy or proprietary rights;
</li><li>
interfere with or disrupt the use of the Website by any other user,
or stalk, threaten or harass another user;
</li><li>
upload, post, transmit, publish, or distribute any material containing a
computer virus or any other code, files or programs intended to disrupt
the functioning of the Website;
</li><li>
use the Website in such a manner as to gain unauthorized access to the
computer systems of others;
</li><li>
upload, post, transmit, publish or distribute any material that constitutes
or encourages conduct that would constitute a criminal offence or violate
applicable law;
</li><li>
upload, post, transmit, publish or distribute unlawful, harmful,
threatening, abusive, defamatory, vulgar, obscene or objectionable material;
</li><li>
reproduce, copy, modify, sell, store, distribute or exploit the Website or
any component thereof for commercial purposes;
</li><li>
use any device, software or routine to interfere with the proper working
of the Website;
</li><li>
take any action that imposes an unreasonable or disproportionately large
load on Website infrastructure;
</li><li>
interpret test results or study material other than as a learning tool;
</li><li>
use tests and exercises as sample question papers for examinations.
</li></ol>
<p>
Any content uploaded by you on the Website shall be subject to relevant
laws and may be disabled and/or investigated under appropriate laws.
</p>
<p>
If you are found to be in non-compliance with the laws and regulations,
these terms, or the privacy policy of the Website, Look8us may terminate
your account, block access to the Website and remove any non-compliant
content uploaded by you.
</p>
<p>
<strong>
Look8us reserves the right to remove any content or links that allegedly
infringe any other person's copyright at any point of time.
</strong>
</p>

<h2>Software</h2><p>
Software (if any) made available to download from the Website, excluding
software made available by end-users through a Communication Service,
is the copyrighted work of the software provider.
</p><p>
Your use of such Software is governed by the terms of the End User License
Agreement unless you first agree to the License Agreement terms.
</p>
<p>
Look8us reserves the right, in its sole discretion, to terminate or refuse
all or part of its services for any reason without notice to you.
</p>

<h2>Delivery Policy</h2><p>
Delivery means the digital download or physical delivery of subscribed
content to customers.
</p>
<p>
At present we have two modes of delivery:
</p><ul>

<li>
Online digital download from the Website.
</li><li>
Physical shipment such as DVD delivery.
</li>

</ul>
<p>
Online digital delivery of content is through the internet, i.e.,
downloading the subscribed course content from the Website.
</p>
<p>
The physical delivery of paid subscriptions will be shipped within
2 working days after receipt of funds through speed post or courier
services.
</p>
<p>
Delivery typically takes place within 1-2 working days to metro cities
and 3-4 working days to major towns.
</p>
<p>
Users may track shipment by logging into the Look8us website where such
facility is provided by the shipment agency.
</p>
<p>
The physical medium associated with free Demo-DVD etc. is shipped by
ordinary post within 2 working days of receiving the request.
</p>
<p>
The physical medium is shipped only to addresses within India.
</p>

<h2>Disclaimer</h2><p>
Look8us provides users with access to a rich collection of online
educational information and related resources.
</p>
<p>
All services provided are on an <strong>"AS-IS"</strong> basis and
Look8us assumes no liability for the accuracy, completeness or use of
information contained on the Website.
</p>
<p>
The information/material provided on the Website is provided on an
"As Is" basis.
</p>
<p>
Look8us does not warrant accuracy, completeness, non-obsolescence,
non-infringement, merchantability or fitness for a particular purpose
of information available through the services.
</p>
<p>
Look8us does not guarantee that services will be error free,
continuously available, or free from viruses or harmful components.
</p>
<p>
Some contents on the Website may belong to third parties.
Such contents have been reproduced after taking prior permission from
the concerned party and copyright remains with the respective owners.
</p>
<p>
Look8us shall not be responsible for mistakes appearing in third-party
content.
</p>

<h2>Limitation of Liability</h2><p>
<strong>
Look8us disclaims all responsibility for any loss, injury, liability or
damage of any kind resulting from:
</strong>
</p>
<ul><li>
Errors or omissions from the Website and its content, including technical
inaccuracies and typographical errors.
</li><li>
Third party websites or content accessed through links provided on the
Website.
</li><li>
Unavailability of the Website or any portion thereof.
</li><li>
Use of equipment or software in connection with the Website.
</li></ul>
<p>
Under no circumstances shall Look8us be liable to any User for:
</p>
<ul>

<li>
Loss, injury, claim, liability or damages resulting from use or inability
to use Website materials.
</li><li>
Special, direct, incidental, punitive, exemplary or consequential damages.
</li><li>
Claims attributable to errors, omissions or inaccuracies.
</li></ul>
<h2>No Liability</h2><p>
It is the endeavour of Look8us to ensure that the information provided on
the Website is accurate but does not guarantee or warrant its accuracy,
adequacy, correctness, validity, completeness or suitability for any
purpose.
</p><p>
Look8us accepts no responsibility with respect to the information
available on the Website.
</p><p>
Use of this Website, by implication, means that you have gone through
and agreed to abide by the Terms and Conditions and Disclaimers of this
Website.
</p><p>
Look8us does not claim that the information downloaded is up to date,
correct and error free or that the servers that make the Look8us site
available are free of viruses or harmful components.
</p><p>
Any reliance on the services or database available through this service
is at the user's own risk.
</p><p>
Though due care has been taken to make the database reliable and
error-free, Look8us claims exemption from any liability arising out of
any such errors in the database.
</p>

<h2>Third Party Advertising</h2><p>
There may be third-party information, advertisements and schemes
displayed through this Website.
</p><p>
Look8us disclaims, to the fullest extent permissible, the correctness,
viability, availability, merchantability or fitness of such information,
advertisements and schemes.
</p><p>
Look8us declares that advertisers and their clients are neither its
agents, partners nor principals and Look8us does not provide any
guarantee or warranty on behalf of advertisers or their clients.
</p><p>
Any material downloaded and used shall be at the risk of the user and no
services utilised through this Website shall create any warranty.
</p><p>
Look8us shall not be responsible if any information/page downloaded from
the Website is altered, removed or obscured after downloading.
</p><p>
Look8us and/or its respective suppliers make no representations about
the suitability, reliability, availability or timelines of products and
services contained on the Website.
</p><p>
All products and services are provided "as is" without warranty of any
kind.
</p><p>
Look8us and/or its suppliers disclaim all warranties and conditions
including implied warranties of merchantability, fitness for a particular
purpose, title and non-infringement.
</p>

<h2>Indemnification</h2><p>
As a user of this Website, you agree to protect and fully compensate
Look8us and its domain associates, service providers and technology
partners from any and all third-party claims, liabilities, damages,
expenses and costs.
</p><p>
This includes all legal expenses arising from:
</p><ul>

<li>
Your use of services on this domain.
</li><li>
Your violation of these terms.
</li><li>
Your infringement of intellectual property or other rights of any person.
</li></ul>

<h2>Legal Jurisdiction</h2><p>
The laws of the Republic of India shall govern any dispute arising from
the use of this Website.
</p><p>
The courts in New Delhi, India alone shall have exclusive jurisdiction to
deal with all such matters.
</p>

<h2>General</h2><p>
This Agreement does not create any relationship whatsoever between you
and Look8us as a joint venture, partnership, employment or agency
relationship.
</p><p>
Performance of this agreement by Look8us is subject to existing laws and
legal processes in India.
</p><p>
Nothing contained in this agreement is in derogation of the rights of
Look8us to comply with governmental, court and law enforcement requests
relating to your use of Look8us services.
</p><p>
Unless otherwise specified herein, this Agreement constitutes the entire
agreement between the user and Look8us with respect to the Website.
</p><p>
It supersedes all prior communications and proposals, whether electronic,
oral or written, between the user and Look8us.
</p>

<h2>Copyright Information</h2><p>
All material available on this Website including but not limited to its
design, text, graphics, screenshots, files and selection and arrangement
thereof is protected by copyright laws.
</p><p>
Access to Look8us services and content is subject to these Terms and
Conditions.
</p><p>
These Terms and Conditions contain warranty disclaimers, guidelines for
links to other websites and limitations on use.
</p><p>
Look8us grants users permission to reproduce copies of material contained
on the Website strictly for personal information, private use and
non-commercial use only.
</p>

<h2>Rights and Permissions</h2><p>
Except for private and non-commercial use, none of the contents may be
copied, reproduced, distributed, republished, downloaded, displayed,
posted electronically or mechanically, transmitted, recorded,
photocopied or reproduced without prior written consent of Look8us.
</p><p>
Any commercial use, reproduction, modification, distribution or
republication without prior written consent of Look8us is strictly
prohibited and may violate copyright or trademark laws.
</p><p>
The owners of intellectual property, copyrights and trademarks are
Look8us, its affiliates or third-party licensors.
</p><p>
Any modification, copying, reproduction, republishing, uploading,
posting, transmitting or distributing any material on this Website,
including text, graphics, code and software, is expressly prohibited.
</p><p>
If any content appearing on this Website is believed to constitute
copyright infringement of another person's rights, the user may
communicate the same to Look8us.
</p>

<h2>Copyright Infringement Notice</h2><p>
Look8us is not liable for any infringement of copyright arising out of
materials posted on or transmitted through the Website, or items
advertised on the Website, by end users or any other third parties.
</p><p>
In the event you have any grievance regarding any content uploaded on the
Website, you may contact our Grievance Officer or write to the following
address:
</p>
<div class="contact-box"><p>
<strong>M/S Look8us</strong><br>

309 Mahaveer Nagar-2,<br>

Kota (324005),<br>

Rajasthan, India
</p><p>

<strong>Phone:</strong>
8955989444

</p><p>

<strong>Email:</strong>

<a href="mailto:look8us@yahoo.com">
look8us@yahoo.com
</a>

</p><p>

<strong>Bank:</strong>
State Bank of India<br>

<strong>Branch:</strong>
Chawani Choraha (LIC Building)<br>

<strong>A/C No.:</strong>
33934257724<br>

<strong>IFSC:</strong>
SBIN0001534

</p></div><h3>
Information Required in Copyright Complaint
</h3><p>
We request you to provide the following information in your complaint:
</p>
<ol><li>
A physical or electronic signature of a person authorised to act on
behalf of the copyright owner.
</li><li>
Identification of the copyrighted work claimed to have been infringed.
</li><li>
Identification of the material on our Website that is claimed to be
infringing.
</li><li>
Address, telephone number or email address of the complaining party.
</li><li>
A statement that the complaining party has a good-faith belief that use
of the material is not authorised by the copyright owner, its agent or
law.
</li><li>
A statement under penalty of perjury that the information in the notice
is accurate and that the complaining party is authorised to act on
behalf of the copyright owner.
</li></ol><h2>Mobile Services</h2>
<p>
The subscriber availing this service shall be deemed to have consented
to be bound by all applicable terms and conditions of this service.
</p>
<ol><li>
Decision of Look8us regarding all transactions under this service shall
be final and binding and no correspondence shall be entertained in this
regard.
</li>
<li>
Look8us reserves the right to extend, cancel, discontinue, withdraw,
change, alter or modify this service or any part thereof including
charges, at its sole discretion.
</li>
<li>
Your mobile phone number (MSISDN) may be used during transmission of
text messages through the mobile service provider's server for SMS
services.
</li>
<li>
The subscriber understands that SMS services may be availed at their
discretion and through options made available by Look8us from time to
time.
</li>
<li>
This service is subject to guidelines and directions issued by Telecom
Regulatory Authority of India or other statutory authorities.
</li>
<li>
SMS messages or their contents once sent for availing SMS services shall
be treated as final and cannot be withdrawn, changed or retrieved.
</li>
<li>
WAP Services enable users to access services and submit or receive
content through wireless devices.
</li>
<li>
Subscription Services provide access to selected content for a chosen
period of time.
</li>
<li>
Users shall not post or transmit content that is abusive, obscene,
racial, sexually oriented or against national interest.
</li>
<li>
Look8us reserves the right to suspend accounts if prohibited or
objectionable content is found.
</li>
<li>
Look8us shall not be responsible for failure of network transmission or
message delivery due to operator infrastructure.
</li>
<li>
Look8us may include additional features and services from time to time.
</li>
<li>
Look8us reserves the right to modify or delete account contents if
profile information is deemed unsuitable.
</li>
<li>
Subscribers must maintain required minimum balance where applicable for
availing prepaid services.
</li>
<li>
All incidental costs, taxes and levies related to services shall be
borne by the customer.
</li>
<li>
Content and services may be varied, added, withdrawn, withheld or
suspended by Look8us without prior notice.
</li>
<li>
Look8us shall not be liable for any direct or indirect loss resulting
from use of the service.
</li>
<li>
No reversal of deducted charges shall be allowed under any circumstances.
</li>
<li>
Users remain solely responsible for all content, information and data
originated by them through the service.
</li>
<li>
Users agree to indemnify Look8us and/or the operator against third
party claims relating to user content.
</li>
<li>
Users are bound by all terms and conditions mentioned herein and on the
Website.
</li>
<li>
Message delivery is conditional upon mobile operator infrastructure and
network uptime.
</li>
<li>
By using SMS based services from Look8us, users agree to receive calls,
messages and information regarding opportunities, services and offers.
</li>
<li>
Subscription or use of paid/free SMS, Voice or WAP services does not
guarantee admission, employment or any specific result.
</li>
<li>
Look8us does not guarantee suitability, reliability, availability,
timeliness or accuracy of information, software, products or services.
</li>
<li>
By registering for Look8us Mobile Alerts, users allow Look8us to contact
them regarding events, offers, careers, admissions, jobs and related
services.
</li>
<li>
This service is available in India only.
</li>
</ol><p class="copyright">

<strong>
Copyright © 2014 Look8us.com. All rights reserved.
</strong>

</p>

</article></main>
</div><div class="page-wrapper"><?php

/*
|--------------------------------------------------------------------------
| Footer Include
|--------------------------------------------------------------------------
| Uses absolute path to prevent include path issues.
|--------------------------------------------------------------------------
*/

require_once __DIR__ . "/footer.php";?></div>
</body>

</html>
