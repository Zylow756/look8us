<?php
require_once "config.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['user'])) {
    header("Location: index.php?r=0");
    exit;
}
?>

<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta charset="UTF-8">
<title>Online Directory Service</title>
 <link rel="stylesheet" type="text/css" href="akc.css" />

</head>

<body topmargin="0" leftmargin="0" rightmargin="0" bottommargin="2" background="images/bg.png">
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=1403091889904611";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>




<div align="center">
<?php require_once "header.php"; ?>
<table border="0" width="100%" height="100" cellpadding="0" style="border-collapse: collapse">
	<tr>
		<td bgcolor="#D2D2D2">
		<div align="center">
			<table border="0" width="1010" id="table33" style="border-collapse: collapse" height="40" cellpadding="0">
				<tr>
					<td><font size="6">&nbsp;</font><font color="#333333" size="5">Terms of Use </font></td>
				</tr>
			</table>
		</div>
		</td>
	</tr>
</table>
	<table border="0" width="1020" id="table1" style="border-collapse: collapse" bordercolor="#F2F2F2" bgcolor="#FFFFFF" cellpadding="0">
		<tr>
			<td valign="top">
			<div align="center">
			<table border="0" width="100%" id="table2" cellpadding="0" style="border-collapse: collapse" bordercolor="#FFFFCC">
				
				<tr>
					<td valign="top">
					<table border="0" width="100%" id="table8" height="530" cellpadding="0" style="border-collapse: collapse">
						<tr>
							<td  valign="top" bgcolor="#FFFFFF">
							<table border="0" width="100%" id="table10" cellpadding="0" style="border-collapse: collapse" >
								<tr>
									
									<td align="right" valign="top">
									<p class="p2">
Services 
									Offered</p><br>
									<p align="left" class="p1" style="text-align: justify"><font size="2">The services of Look8us .com are available 
									only to the registered users (�Users�) on a 
									single user basis, for a particular period 
									of time on making the stipulated payment and 
									abiding by the applicable terms and 
									conditions. The said services are personal 
									in nature and cannot be assigned or 
									transferred to or shared with any other 
									person other than the registered users. The 
									services offered by Look8us , the company 
									that owns and operates the Website, are 
									listed in detail on the Website.<br><br>By registering yourself as a user and 
									subscribing to avail the services of this 
									Website, it will be deemed that you have 
									read, understood and agreed to fully abide 
									by all the terms and conditions of the 
									Website as contained herein. Further, by 
									registering on the Website, you agree to:
									<br>� make your contact details available to 
									Look8us partners so that you may be 
									contacted by Look8us partners for 
									education information through email, 
									telephone and SMS; <br>� receive promotional mails/special offers 
									from the Website or any of its partner 
									websites; and/ or<br>� be contacted by Look8us in accordance 
									with the privacy settings set by you.<br>The right to use the services of the Website 
									is on revocable license / permission basis 
									as per the terms and conditions contained 
									herein. Except the usage of the services 
									during the license period, the registered 
									users shall not have any right or title over 
									the Website or any of its contents.<br><br>In order to use Look8us online services, 
									you must obtain access to the World Wide 
									Web, either directly or through devices that 
									access web-based content, and pay any 
									service fees associated with such access. In 
									addition, you will need to have access to 
									all equipment necessary to make such a 
									connection to the World Wide Web, including 
									a computer and modem or other access 
									devices.<br><br><b>User Obligations<br></b>In consideration of your use of the 
									services, you agree to provide correct, 
									precise, up-to-date and complete information 
									about yourself as required by the service's 
									registration form wherever necessary; and 
									maintain and promptly update the 
									registration data to keep it true, accurate, 
									current and complete.<br><br>If you provide any information that is 
									untrue, inaccurate, not up-to-date or 
									incomplete, or if Look8us has reasonable 
									grounds to suspect that such information is 
									untrue, inaccurate, not current or 
									incomplete, Look8us has the right to 
									suspend or terminate your account and refuse 
									any and all current or future use of the 
									services (or any portion thereof).<br><br>If you are directly subscribing as a user of 
									this Website, you represent and warrant that 
									you are at least 18 years of age and that 
									you possess the legal right and capacity to 
									use the services of Look8us in accordance 
									with the stated terms and usage policies. In 
									cases, where a minor below the age of 18 
									years of age, wants to use this website, 
									such a user shall duly register himself 
									through his parent/ guardian and such a 
									parent/ guardian hereby agrees to 
									accordingly register and supervise usage by, 
									and be responsible for the action of any 
									such minors who use the computer and/or 
									password to access the Look8us . The 
									parent/ guardian shall enter into this 
									agreement on behalf of such minor, and bind 
									himself/herself in accordance with all terms 
									and conditions herein.<br><br><b>Purchasing 
									and Ordering Disclaimer<br></b><br><b>Make Your Own Decisions:<br>
									</b>If you are making important purchasing or 
									planning decisions, whether personal or 
									business decisions, you should look at an 
									actual demonstration model of any product 
									you are considering before making your 
									important purchasing or planning decisions. 
									(Contact a supplier, store, or manufacturer 
									regarding looking at any demonstration 
									units.) All decisions made would be entirely 
									your prerogative and Look8us does not 
									claim to offer any advice, either legal or 
									financial.<br><br><b>Pricing<br></b>All prices are subject to change without 
									notice. Every effort has been made to ensure 
									accurate pricing of the products featured on 
									our website. In the event a part or 
									accessory is ordered and the listed price 
									has changed, you will be notified prior to 
									our processing your order. Purchase &quot;as is.&quot; 
									You agree that all products purchased by you 
									through this website are provided under 
									warranties, if any, of the manufacturer 
									only, and not by Look8us . All products are 
									provided by Look8us on &quot;as is&quot; basis with 
									no representations or warranties of any kind 
									from Look8us .<br><br>Password<br>Please note that the password generated by 
									you for accessing the Website should not be 
									shared by you with anyone else at any time. 
									Please also note that especially with regard 
									to the products purchased by you, the same 
									have been licensed to you by Look8us for 
									your own use only and you cannot share your 
									password with others or allow others to use 
									the paid courses. This will be a gross 
									violation of the license terms governing the 
									paid products.<br><br><b>Use of Website </b>
									<br><br><b>Prohibited Activities<br></b><br>You represent, warrant, covenant and 
									undertake that you shall not host, display, 
									upload, modify, publish, transmit, update or 
									share any information on the Website, that:</font><ul>
										<li>
										<p align="left" class="p1" style="text-align: justify">
										<font size="2">a. belongs to another person and to which 
									you do not have any right to;</font></li>
										<li>
										<p align="left" class="p1" style="text-align: justify">
										<font size="2">b. is grossly harmful, harassing, 
									blasphemous, defamatory, obscene, 
									pornographic, paedophilic, libellous, 
									invasive of another's privacy, hateful, or 
									racially, ethnically objectionable, 
									disparaging, relating or encouraging money 
									laundering or gambling, or otherwise 
									unlawful in any manner whatever;</font></li>
										<li>
										<p align="left" class="p1" style="text-align: justify">
										<font size="2">c. harm minors in any way;</font></li>
										<li>
										<p align="left" class="p1" style="text-align: justify">
										<font size="2">d. infringes any patent, trademark, 
									copyright or other proprietary rights;</font></li>
										<li>
										<p align="left" class="p1" style="text-align: justify">
										<font size="2">e. violates any law for the time being in 
									force;</font></li>
										<li>
										<p align="left" class="p1" style="text-align: justify">
										<font size="2">f. deceives or misleads the addressee about 
									the origin of such messages or communicates 
									any information which is grossly offensive 
									or menacing in nature;</font></li>
										<li>
										<p align="left" class="p1" style="text-align: justify">
										<font size="2">g. impersonate another person;</font></li>
										<li>
										<p align="left" class="p1" style="text-align: justify">
										<font size="2">h. contains software viruses or any other 
									computer code, files or programs designed to 
									interrupt, destroy or limit the 
									functionality of any computer resource;</font></li>
										<li>
										<p align="left" class="p1" style="text-align: justify">
										<font size="2">i. threatens the unity, integrity, defence, 
									security or sovereignty of India, friendly 
									relations with foreign states, or public 
									order or causes incitement to the commission 
									of any cognisable offence or prevents 
									investigation of any offence or is insulting 
									any other nation.</font></li>
									</ul>
									<p align="left" class="p1" style="text-align: justify"><font size="2">
									<br>
									<b>You further represent, warrant, covenant and 
									undertake that your use of the Website shall 
									not: <br>
									</b>1. violate any applicable local, provincial, 
									state, national or international law, 
									statute, ordinance, rule or regulation;<br>
									2. interfere with or disrupt computer 
									networks connected to the Website;<br>
									3. impersonate any other person or entity, 
									or make any misrepresentation as to your 
									employment by or affiliation with any other 
									person or entity;<br>
									4. forge headers or in any manner manipulate 
									identifiers in order to disguise the origin 
									of any user information;<br>
									5. upload, post, transmit, publish, or 
									distribute any material or information for 
									which you do not have all necessary rights 
									and licenses;<br>
									6. upload, post, transmit, publish or 
									distribute any material which infringes, 
									violates, breaches or otherwise contravenes 
									the rights of any third party, including any 
									copyright, trademark, patent, rights of 
									privacy or publicity or any other 
									proprietary right;<br>
									7. interfere with or disrupt the use of the 
									Website by any other user, nor &quot;stalk&quot;, 
									threaten, or in any manner harass another 
									user;<br>
									8. upload, post, transmit, publish, or 
									distribute any material or information which 
									contains a computer virus, or other code, 
									files or programs intending in any manner to 
									disrupt or interfere with the functioning of 
									the Website, or that of other computer 
									systems;<br>
									9. use the Website in such a manner as to 
									gain unauthorized entry or access to the 
									computer systems of others;<br>
									10. upload, post, transmit, publish or 
									distribute any material or information which 
									constitutes or encourages conduct that would 
									constitute a criminal offence, give rise to 
									other liability, or otherwise violate 
									applicable law;<br>
									11. upload, post, transmit, publish, or 
									distribute any material or information that 
									is unlawful, or which may potentially be 
									perceived as being harmful, threatening, 
									abusive, harassing, defamatory, libellous, 
									vulgar, obscene, or racially, ethnically, or 
									otherwise objectionable;<br>
									12. reproduce, copy, modify, sell, store, 
									distribute or otherwise exploit for any 
									commercial purposes the Website, or any 
									component thereof (including, but not 
									limited to any materials or information 
									accessible through the Website);<br>
									13. use any device, software or routine to 
									interfere or attempt to interfere with the 
									proper working of the Website;<br>
									14. take any action that imposes an 
									unreasonable or disproportionately large 
									load on the Website infrastructure;<br>
									15. any interpretation of test results or 
									study material other than as a tool of 
									learning and enhancing knowledge; or<br>
									16. the tests and exercises are created for 
									you to test your understanding of concepts 
									and are not to be interpreted as a sample 
									question paper for any examinations.<br>
									Any content uploaded by you on the Website 
									shall be subject to relevant laws and may be 
									disabled and/or may be subject to 
									investigation under appropriate laws. 
									Furthermore, if you are found to be in 
									non-compliance with the laws and 
									regulations, these terms, or the privacy 
									policy of the Website, Look8us may 
									terminate your account/block your access to 
									the Website and Look8us reserve the right 
									to remove any non-compliant content uploaded 
									by you on the Website.<br>
									<br>
									<b>Look8us reserves the right to remove any 
									content or links that allegedly infringes 
									any other person's copyright at any point of 
									time.<br>
									</b>
									<br>
									Software (if any) that is made available to 
									download from the Website, excluding 
									software that may be made available by 
									end-users through a Communication Service, 
									(Software) is the copyrighted work of the 
									software provider. Your use of the Software 
									is governed by the terms of the end user 
									License Agreement unless you first agree to 
									the License Agreement terms.<br>
									<br>
									Look8us reserves the right, in its sole 
									discretion, to terminate or refuse all or 
									part of its services, for any reason without 
									notice to you.<br>
									<br>
									<b>Delivery Policy<br>
									</b>Delivery means the digital download or the 
									physical delivery of subscribed content to 
									the customers. At present we have two modes 
									of delivery - online digital download from 
									the website and physical shipment like DVD.<br>
									� Online digital delivery of content is 
									through internet, i.e., downloading the 
									subscribed course content from 
									www.meritnation.com website to Look8us 
									software<br>
									� The physical delivery of the paid 
									subscription will be shipped in 2 working 
									days of the receipt of funds through speed 
									post or courier like BlueDart. The delivery 
									typically takes place in 1-2 working days to 
									metros and 3-4 working days to major towns. 
									The user may track the shipment by logging 
									into Look8us website, in cases where the 
									shipment agency provides such facility<br>
									� The physical medium associated with free 
									Demo-DVD etc. is shipped by ordinary post in 
									2 working days of receiving request<br>
									The physical medium is shipped only to 
									addresses in India as of now<br>
									<br>
									<b>Disclaimer<br>
									</b>
									<br>
									Look8us currently provides users with 
									access to a rich collection/compilation of 
									online educational information and related 
									resources etc. As a user of the Website, you 
									understand and agree that all the services 
									provided are on an AS-IS basis and Look8us 
									assume no liability for the accuracy or 
									completeness or use of, nor any liability to 
									update, the information contained on the 
									Website<br>
									<br>
									The information/material provided on the 
									Website is provided on an �As Is� basis. 
									Look8us does not warrant the accuracy, 
									completeness, non-obsolescence, 
									non-infringement, merchantability or fitness 
									for a particular purpose of the information 
									available through the services on the 
									Website. Look8us also does not guarantee 
									that the services will be error free, or 
									continuously available, or that the service 
									will be free of viruses or other harmful 
									components.<br>
									<br>
									Some contents on the site may belong to 
									third parties. Such contents have been 
									reproduced after taking prior permission 
									from the said party and the copyright of 
									such contents would remain exclusively with 
									the said third party. Look8us shall not be 
									responsible for any mistakes which might 
									appear in such contents.<br>
									<br>
									<b>Look8us disclaims all responsibility for 
									any loss, injury, liability or damage of any 
									kind resulting from and arising out of, or 
									any way related to:<br>
									</b>� Any errors in or omissions from the 
									Website and its content, including but not 
									limited to technical inaccuracies and 
									typographical errors.<br>
									� Any third party websites or content 
									therein directly or indirectly accessed 
									through links in the Website, including but 
									not limited to any errors in or omissions 
									there from.<br>
									� The unavailability of this Website or any 
									portion thereof.<br>
									� The use of any equipment or software in 
									connection with the Website by the user.<br>
									Limitation of Liability<br>
									Under no circumstances shall Look8us be 
									liable to any User for:<br>
									� Loss, injury, claim, liability or damages 
									of any kind resulting from the use of or the 
									inability to use the materials in the 
									Website, even if Look8us had been advised 
									of the possibility of such damages and 
									regardless of the form of action, whether in 
									contract, stated or otherwise.<br>
									� Special, direct, incidental, punitive, 
									exemplary or consequential damages of any 
									kind whatsoever in any way due, resulting 
									from or arising in connection with the use 
									of or the inability to use the Website or 
									its content / materials; and<br>
									� Claim attributable to errors, omission or 
									inaccuracies in or destructive properties of 
									any information. <br>
									No Liability<br>
									It is the endeavour of Look8us to ensure 
									that the information provided on the Web 
									site is accurate but does not guarantee or 
									warrant its accuracy, adequacy, correctness, 
									validity, completeness or suitability for 
									any purpose, and accepts no responsibility 
									with respect to the information on the 
									Website. Use of this Website, by 
									implication, means that you have gone 
									through and agreed to abide by the Terms and 
									Conditions and the Disclaimers of this 
									Website. Look8us does not claim that the 
									information downloaded are up to date, 
									correct and error free or that the servers 
									that make Look8us site available, are free 
									of viruses or harmful components. Any 
									reliance on the service or database 
									available through this service, is at the 
									user's own risk. Though due care has been 
									taken to make the database completely 
									reliable and error-free, Look8us claims 
									exemption from any liability arising out of 
									any such error in the data base.<br>
									<br>
									<b>Third Party Advertising<br>
									</b>There may be third party information, 
									advertisement, and schemes displayed through 
									this Web site. Look8us disclaims, to the 
									fullest extent permissible, the correctness, 
									viability, availability, merchantability or 
									fitness of such information, advertisement 
									and scheme. Look8us hereby declares that 
									the advertisers and their clients etc. are 
									neither its agent, partner or principal and 
									Look8us does not provide any guarantee or 
									warranty or any representation on behalf of 
									any of the advertisers or their clients.<br>
									<br>
									Any material downloaded and used shall be at 
									the risk of the user and no services 
									utilised by this Web site shall create any 
									warranty. Look8us shall not responsible if 
									any information/page is downloaded from 
									Look8us and after downloading 
									complete/partial, text/information is 
									altered/removed/obscured contained therein.<br>
									<br>
									Look8us and/or its respective suppliers 
									make no representations about the 
									suitability, reliability, availability, 
									timelines, of the products and services 
									contained on the Web site for any purpose. 
									All products, services are provided &quot;as is&quot; 
									without warranty of any kind. and/or its 
									respective suppliers hereby disclaim all 
									warranties and conditions with regard to 
									this information, products, services 
									including all implied warranties and 
									conditions of merchantability, fitness for a 
									particular purpose, title and 
									non-infringement.<br>
									<br>
									In no event shall Look8us and/or its 
									suppliers be liable for any direct, 
									indirect, punitive, incidental, special, 
									consequential damages or any damages 
									whatsoever including, without limitation, 
									damages for loss of use, data or profits, 
									arising out of or in any way connected with 
									the use or performance of the Look8us Web 
									site, with the delay or inability to use the 
									Look8us Web site or related services, the 
									provision of or failure to provide services, 
									or for any information, software, products 
									and services obtained through the Look8us 
									Web site, or otherwise arising out of the 
									use of Look8us Web site, whether based on 
									contract, negligence, strict liability or 
									otherwise, even if Look8us or any of its 
									suppliers has been advised of the 
									possibility of damages.<br>
									<br>
									<b>Indemnification<br>
									</b>As a user of this Web site, you agree to 
									protect and fully compensate Look8us and 
									its domain's associates, such as, service 
									providers and technology partners, from any 
									and all third party claims, liabilities, 
									damages, expenses and costs, including, but 
									not limited to, all legal expenses, arising 
									from your use of services on this domain, 
									your violation of the terms or your 
									infringement by any other use of your 
									account, of any intellectual property or 
									other right of anyone.<br>
									<br>
									<b>Legal Jurisdiction<br>
									</b>The laws of the Republic of India shall 
									govern any dispute arising from the use of 
									this Web site and the courts in New Delhi, 
									India alone shall have exclusive 
									jurisdiction to deal with all such matters.<br>
									<br>
									<b>General<br>
									</b>This Agreement does not in any manner create 
									any relationship whatsoever as between you 
									and the Look8us , either as a joint 
									venture, partnership, employment, or agency 
									relationship. Performance of this agreement 
									by Look8us is subject to existing laws and 
									legal process in India, and nothing 
									contained in this agreement is in derogation 
									of the rights of Look8us to comply with 
									governmental, court and law enforcement 
									requests or requirements relating to your 
									use of Look8us or information provided to 
									or gathered by Look8us with respect to 
									such use.<br>
									<br>
									Unless otherwise specified herein, this 
									Agreement constitutes the entire agreement 
									between the user and Look8us with respect 
									to the Look8us site and it supersedes all 
									prior communications and proposals, whether 
									electronic, oral or written, between the 
									user and Look8us with respect to the 
									Look8us site.<br>
									<br>
									<b>Copyright Information<br>
									</b>All material available on this website 
									Meritnation.com including but not limited 
									to, its design, text, graphics, screen 
									shots, files and the selection and 
									arrangement thereof is protected by 
									copyright laws. <br>
									Access to the Look8us services and content 
									is subject to these terms and conditions. 
									These Terms and Conditions contain warranty 
									disclaimers guidelines for link to other 
									websites &amp; linking disclaimer and limitation 
									on use.<br>
									<br>
									Look8us grants user of this website the 
									permission to reproduce copies of the 
									material contained therein strictly for 
									personal information/private use and non- 
									commercial use only.<br>
									<br>
									<b>Rights and Permissions<br>
									</b>Excepting for Private use and non- 
									commercial use, none of the Contents may be 
									copied, reproduced, distributed, 
									republished, downloaded, displayed, posted 
									electronically or mechanically, transmitted, 
									recorded, in any manner, photocopied, or 
									reproduced without prior written consent of 
									Look8us . Any other use of materials on 
									this website, including any commercial use, 
									reproduction for purposes other than that 
									noted above, modification, distribution, or 
									republication without the prior written 
									consent of Look8us is strictly prohibited 
									and may violate copyright or trademark laws.<br>
									<br>
									The owners of the intellectual property, 
									copyrights and trademarks are Look8us , its 
									affiliates or third party licensors. Any 
									modification, copying, reproduction, 
									republishing, uploading, posting, 
									transmitting or distributing any material on 
									this Website including text, graphics, code 
									and/or software is expressly prohibited.<br>
									<br>
									No recourse shall be taken against Look8us 
									for any alleged or actual infringement or 
									misappropriation of any proprietary rights 
									in your communications to Look8us . At any 
									stage, it is believed that the contents 
									appearing on this Website constitutes 
									copyright infringement of another person's 
									rights, the user may communicate the same to 
									us.<br>
									<br>
									Notice of Copyright Infringement We are not 
									liable for any infringement of copyright 
									arising out of materials posted on or 
									transmitted through the Website, or items 
									advertised on the Website, by end users or 
									any other third parties. In the event you 
									have any grievance in relation to any 
									content uploaded on the Website, you may 
									contact our Grievance Officer; or write at 
									the following address:<br>
									<font color="#000000"><b>M/S Look8us</b> <b><br>
									309 Mahaveer Nagar-2,
									<br>
									Kota (324005) ,
									Rajasthan</b><br>
									</font></font>
									<font size="2" face="Verdana" color="#000000">
									Phone : </font><font size="2" face="Verdana" color="#697779">8955989444</font>
									<font size="2" face="Verdana" color="#000000">
									&nbsp;<br>
									Email : </font>
									<font face="Verdana" color="#000000">
									<a href="mailto:look8us@yahoo.com">
									look8us@yahoo.com</a></font><p align="left" class="p1" style="text-align: justify">
									<font face="Verdana" color="#000000">Bank 
									:State Bank of India<br>
									Branch : Chawani Choraha (LIC Building)<br>
									A/C No. : 33934257724<br>
									IFCS : SBIN0001534</font><p align="left" class="p1" style="text-align: justify">
									<font size="2">
									<b>We request you to please provide the 
									following information in your complaint:-
									<br>
									</b>(a) A physical or electronic signature of a 
									person authorized to act on behalf of the 
									copyright owner for the purposes of the 
									complaint. <br>
									(b) Identification of the copyrighted work 
									claimed to have been infringed.<br>
									(c) Identification of the material on our 
									website that is claimed to be infringing or 
									to be the subject of infringing activity.<br>
									(d) The address, telephone number or e-mail 
									address of the complaining party.<br>
									(e) A statement that the complaining party 
									has a good-faith belief that use of the 
									material in the manner complained of is not 
									authorized by the copyright owner, its agent 
									or the law.<br>
									(f) A statement, under penalty of perjury, 
									that the information in the notice of 
									copyright infringement is accurate, and that 
									the complaining party is authorized to act 
									on behalf of the owner of the right that is 
									allegedly infringed <br>
									<br>
									<b>Mobile Services<br>
									</b>1. The subscriber availing this service 
									shall be deemed to have consented to be 
									bound by all the applicable terms and 
									conditions of this service.<br>
									2. Decision of Look8us regarding all 
									transactions under this service shall be 
									final and binding and no correspondence 
									shall be entertained in this regard.<br>
									3. Look8us reserves the right to extend, 
									cancel, discontinue, prematurely withdraw, 
									change, alter or modify this service or any 
									part thereof including charges, at its sole 
									discretion at any time as may be required in 
									view of business exigencies and/or 
									regulatory or statutory changes.<br>
									4. Your mobile phone number (MSISDN) will be 
									used during the transmission of text 
									messages through the mobile service 
									provider's server for SMS Service.<br>
									5. The subscriber understands that he/she 
									can avail SMS Services at his/her discretion 
									and the said service shall be availed in 
									such options as are made available by 
									Look8us from time to time.<br>
									6. This service is subject to 
									guidelines/directions issued by Telecom 
									Regulatory Authority of India or any other 
									statutory authority as applicable from time 
									to time.<br>
									7. The SMS or its contents once sent for 
									availing the SMS services shall be treated 
									as final and the same cannot be withdrawn, 
									changed or retrieved subsequently under any 
									circumstances.<br>
									8. WAP Services enable you to access our 
									Services and to submit and/or receive 
									Content through your wireless Device. Your 
									access to our WAP Services may be dependent 
									on the wireless Device you use to access the 
									applicable WAP services.<br>
									9. Subscription Services provide you with 
									access to certain Content for a selected 
									period of time, which will be as indicated 
									and chosen by you prior to purchase. The 
									frequency with which you will receive the 
									relevant Content will be notified to you at 
									the time you subscribe for the service.<br>
									10. You will not post or transmit any 
									content that is abusive, obscene, racial, 
									sexually oriented or against national 
									interest. Look8us reserves the right to 
									suspend your account if any prohibitive or 
									objectionable content is found and may 
									further initiate appropriate legal 
									proceedings against you.<br>
									11. The Service is an additional service 
									offered by Look8us . The functions of the 
									Service are dependent on the operator owning 
									the network to facilitate this service 
									(�Operator�), for which Look8us does not 
									undertake any responsibility for failure of 
									this network transmission or failure of 
									message transmission for any reasons 
									whatsoever. From time to time, Look8us may 
									include additional features and services.<br>
									12. Look8us reserves the right to 
									modify/delete the account contents at its 
									own discretion without prior notice if the 
									contents of profile are deemed unfit for 
									broadcast.<br>
									13. The subscriber must maintain such 
									minimum balance in his/her prepaid account 
									as is specified by Look8us for availing 
									the particular option offered under these 
									services. All incidental costs/taxes/levies, 
									if any, related to the VAS shall be entirely 
									borne by the customer.<br>
									14. The users specifically note and agree 
									that the content and service or part thereof 
									may be varied, added, withdrawn, withheld or 
									suspended by Look8us at its sole 
									discretion without prior notice to the 
									users.<br>
									15. Look8us shall not be liable for any 
									costs, loss or damage (whether direct or 
									indirect), or for loss of revenue, loss of 
									profits or any consequential loss whatsoever 
									as a result of the user using the Service.<br>
									16. No reversal of deducted charges shall be 
									allowed under any circumstances.<br>
									17. The users shall remain solely 
									responsible for all content, information, 
									data originated from the users and 
									transmitted via the Service (content), and 
									the users shall accordingly indemnify 
									Look8us and / or the Operator, against all 
									third party claims relating to the users 
									content or due to the users act, negligence 
									or omission.<br>
									18. You are bound by the terms and 
									conditions as mentioned herein and as stated 
									on the Website.<br>
									19. Message delivery is conditional to 
									mobile Operator's technical infrastructure 
									and its network uptime.<br>
									20. By using various SMS based services from 
									Look8us , you agree to receive phone calls, 
									messages etc. from Look8us and/or its 
									associates tailored to provide with better 
									education related opportunities.<br>
									21. Subscribing or using various paid/free 
									services of Look8us on SMS/Voice/WAP 
									either directly or indirectly doesn't in any 
									manner guarantee the user an admissions.<br>
									22. Look8us and/or its respective 
									suppliers make no representations about the 
									suitability, reliability, availability, 
									timeliness, lack of viruses or other harmful 
									components and accuracy of the information, 
									software, products, services and related 
									graphics contained within the, Look8us 
									sites/services for any purpose. All such 
									information, software, products, services 
									and related graphics are provided &quot;as is&quot; 
									without warranty of any kind. Look8us 
									and/or its respective suppliers hereby 
									disclaim all warranties and conditions with 
									regard to this information, software, 
									products, services and related graphics, 
									including all implied warranties and 
									conditions of merchantability, fitness for a 
									particular purpose, workmanlike effort, 
									title and non-infringement. Look8us shall 
									not be responsible or liable for any 
									consequential damages arising thereto.<br>
									23. By agreeing to register at Look8us 
									Mobile alerts, a user allows Look8us to 
									get in touch with him/her from time to time 
									on events or offers regarding careers, 
									admissions, jobs and ancillary services on 
									mobile. This can include exciting offers, 
									information, as well as promotions.<br>
									24. The subscriber shall be required to 
									comply with all directions/instructions etc. 
									issued by Look8us relating to the network, 
									the services and any/all matters connected 
									therewith and provide Look8us all other 
									and further information and co-operation as 
									Look8us may require from time to time.<br>
									25. This service is live in India only.<br>
									<br>
									<b>Copyright � 2014 Look8us .com. All rights 
									reserved. </b> </font><b><br>
&nbsp;</b></td>
								</tr>
							</table>
							</td>
						</tr>
						</table>
					</td>
				</tr>
			</table>
			</div>
			</td>
		</tr>
	</table>
</div>

<div align="center">
	<?php require_once "footer.php"; ?>
</div>

</body>

</html>