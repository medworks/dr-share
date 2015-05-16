<?php
	include_once("config.php");
	include_once("classes/functions.php");
  	include_once("classes/session.php");	
  	include_once("classes/security.php");
  	include_once("classes/database.php");	
	
	//error_reporting(E_ALL);
	//ini_set('display_errors', 1);
	
	$db = Database::GetDatabase();
	
	$rwnews = $db->SelectAll("news","*",NULL,"id DESC",0,5);
	$rwtopics = $db->SelectAll("topics","*",NULL,"id DESC",0,5);
	
	$Tell_Number = GetSettingValue('Tell_Number',0);
	$Fax_Number = GetSettingValue('Fax_Number',0);
	$Address = GetSettingValue('Address',0);
	$Contact_Email = GetSettingValue('Contact_Email',0);
	
	$About_System = GetSettingValue('About_System',0);
	$About_System= (mb_strlen($About_System)>537) ? mb_substr($About_System,0,537,"UTF-8")."..." : $body;


$html.=<<<cd
        </div>
    </div>
</div>
</section>

<footer style="background: url('./images/bg_main.gif') repeat-x center">
	<div class="container">
		<div class="col12">
			<div class="col4">
				<div id="text-9" class="widget widget_text fade-in">
                    <div class="textwidget rtl">
						<div class="custom_logo">
							<h1 class="rtl" style="color:#fff">کلینیک رهیاب</h1>
						</div>
						<p class="rtl">
							<a href="about-us.html">{$About_System} </a>
						</p>
					</div>
				</div>
 			</div>
 			<div class="col2">
 				<div id="nav_menu-5" class="widget widget_nav_menu fade-in">
 					<h4 class="widgettitle rtl">اخبار</h4>
 					<div class="menu-theme-links-footer-widget-container">
 						<ul id="menu-theme-links-footer-widget" class="menu">
cd;
for($i = 0; $i < Count($rwnews); $i++)
{
$rwnews[$i]["subject"] =(mb_strlen($rwnews[$i]["subject"])>20)?mb_substr($rwnews[$i]["subject"],0,20,"UTF-8")."...":$rwnews[$i]["subject"];
$html.=<<<cd
 							<li id="menu-item-2768" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2768">
 								<a href="one-news{$rwnews[$i]['id']}.html" style="color:#000;">{$rwnews[$i][subject]}</a>
 							</li>
cd;
}
$html.=<<<cd
						</ul>
					</div>
				</div>
			</div>
			<div class="col2">
				<div id="archives-4" class="widget widget_archive fade-in">
					<h4 class="widgettitle rtl">پیوندهای مفید</h4>
					<ul>
						<li>
							<a href="http://www.aasect.org" style="color:#000;line-height:1.3" target="_blank">انجمن مدرسان، مشاوران و درمانگران مسایل جنسیآمریکا (AASECT)</a>
						</li>
						<li>
							<a href="http://www.worldsexology.org" style="color:#000;line-height:1.3" target="_blank">انجمن جهانی سلامت جنسی (WAS)</a>
						</li>
						<li>
							<a href="http://www.naasas.com" style="color:#000;line-height:1.3" target="_blank">انجمن ملی پیشرفت علم و هنر در مسایل جنسی (NAASAS)</a>
						</li>
						<li>
							<a href="http://www.apa.org" style="color:#000;line-height:1.3" target="_blank">انجمن روانشناسی آمریکا (APA)</a>
						</li>
						<li>
							<a href="http://www.apsa.org" style="color:#000;line-height:1.3" target="_blank">انجمن روانکاوی آمریکا</a>
						</li>
						<li>
							<a href="http://www.ipa.org.uk" style="color:#000;line-height:1.3" target="_blank">انجمن بین المللی روانکاوی</a>
						</li>
<li>
							<a href="http://pcoiran.ir" style="color:#000;line-height:1.3" target="_blank">سازمان نظام روان شناسی و مشاوره جمهوری اسلامی ایران</a>
						</li>
<li>
							<a href="http://www.iranpa.org" style="color:#000;line-height:1.3" target="_blank">انجمن روانشناسی ایران</a>
						</li>
<li>
							<a href="http://www.irancpa.com" style="color:#000;line-height:1.3" target="_blank">انجمن روانشناسی بالینی ایران</a>
						</li>
<li>
							<a href="http://tip.iums.ac.ir" style="color:#000;line-height:1.3" target="_blank">انستیتو روانپزشکی تهران</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="col2">
				<div id="nav_menu-7" class="widget widget_nav_menu fade-in">
					<h4 class="widgettitle rtl">مقالات</h4>
					<div class="menu-galleries-container">
						<ul id="menu-galleries" class="menu">
cd;
for($i = 0; $i < Count($rwtopics); $i++)
{
$rwtopics[$i]["subject"] =(mb_strlen($rwtopics[$i]["subject"])>20)?mb_substr($rwtopics[$i]["subject"],0,20,"UTF-8")."...":$rwtopics[$i]["subject"];
$html.=<<<cd
							<li>
								<a href="one-article{$rwtopics[$i]['id']}.html" style="color:#000;">{$rwtopics[$i]['subject']}</a>
							</li>
cd;
}
$html.=<<<cd
						</ul>
					</div>
				</div>
			</div>
			<div class="col2 last">	
        		<div id="contact-3" class="widget nt_contact_widget fade-in">
					<h4 class="widgettitle rtl">تماس با ما</h4>		
					<span class="contact_widget_address">{$Address}</span><br>
					<span class="contact_widget_phone">{$Tell_Number}</span><br>
					<span class="contact_widget_phone">{$Fax_Number}</span><br>
					<span class="contact_widget_email"><a href="javascript:void(0);" rel="{$Contact_Email}" class="eail_link_replace" style="font-size:14px;font-family:fontello!important;">{$Contact_Email}</a></span><br>
        		</div>
        	</div>
        	<div class="clearboth"></div>
        	<div id="sub_footer">
        		<div class="container">
        			<div class="col12">
        				<div class="footer_links">
        					<ul id="menu-theme-links-footer-widget-1">
        						<li><a href="./">صفحه اصلی</a></li>
        						<li><a href="healthgroup.html">گروه درمانی</a></li>
								<li><a href="news.html">اخبار و تازه ها</a></li>
								<li><a href="gallery.html">گالری تصاویر</a></li>
								<li><a href="class.html">کلاسها و دوره های آموزشی</a></li>
								<li><a href="articles.html">آرشیو مقالات</a></li>
								<li><a href="faq.html">پرسش و پاسخ</a></li>
							</ul>
						</div>
						<p class="copyright_text" style="font-size:16px;margin-top:50px;color:#000">Rahyab clinic. All rights reserved. Designed by <a href="http://www.mediateq.ir" style="text-transform:none;padding:0">Mediateq.ir</p>
					</div><!-- columns-->
				</div><!-- container -->
			</div><!-- #sub_footer -->
		</div>
	</div>
</footer>
cd;

echo $html;
?>

