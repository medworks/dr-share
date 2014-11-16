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
	
	$Tell_Number = GetSettingValue('Tell_Number',0);
	$Address = GetSettingValue('Address',0);
	$Contact_Email = GetSettingValue('Contact_Email',0);
	
	$About_System = GetSettingValue('About_System',0);

$html.=<<<cd
        </div>
    </div>
</div>
</section>

<footer style="background-color: rgb(41, 128, 185);">
	<div class="container">
		<div class="col12">
			<div class="col4">
				<div id="text-9" class="widget widget_text fade-in">
                    <div class="textwidget">
						<div class="custom_logo">
							<h1 class="rtl" style="color:#fff">رهیاب کلینیک</h1>
						</div>
						<p class="rtl">
							{$About_System} 
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
 								<a href="#" style="color:#ccc;">{$rwnews[$i][subject]}</a>
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
							<a href="#" style="color:#ccc;">پیوند 1</a>
						</li>
						<li>
							<a href="#" style="color:#ccc;">پیوند 2</a>
						</li>
						<li>
							<a href="#" style="color:#ccc;">پیوند 3</a>
						</li>
						<li>
							<a href="#" style="color:#ccc;">پیوند 4</a>
						</li>
						<li>
							<a href="#" style="color:#ccc;">پیوند 5</a>
						</li>
						<li>
							<a href="#" style="color:#ccc;">پیوند 6</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="col2">
				<div id="nav_menu-7" class="widget widget_nav_menu fade-in">
					<h4 class="widgettitle rtl">مقالات</h4>
					<div class="menu-galleries-container">
						<ul id="menu-galleries" class="menu">
							<li>
								<a href="#" style="color:#ccc;">عنوان رویداد</a>
							</li>
							<li>
								<a href="#" style="color:#ccc;">عنوان رویداد</a>
							</li>
							<li>
								<a href="#" style="color:#ccc;">عنوان رویداد</a>
							</li>
							<li>
								<a href="#" style="color:#ccc;">عنوان رویداد</a>
							</li>
							<li>
								<a href="#" style="color:#ccc;">عنوان رویداد</a>
							</li>
							<li>
								<a href="#" style="color:#ccc;">عنوان رویداد</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col2 last">	
        		<div id="contact-3" class="widget nt_contact_widget fade-in">
					<h4 class="widgettitle rtl">تماس با ما</h4>		
					<span class="contact_widget_address">{$Address}</span><br>
					<span class="contact_widget_phone">{$Tell_Number}</span><br>
					<span class="contact_widget_email"><a href="#" rel="{$Contact_Email}" class="eail_link_replace">{$Contact_Email}</a></span><br>
        		</div>
        	</div>
        	<div class="clearboth"></div>
        	<div id="sub_footer">
        		<div class="container">
        			<div class="col12">
        				<div class="footer_links">
        					<ul id="menu-theme-links-footer-widget-1">
        						<li>
        							<a href="#">صفحه اصلی</a>
        						</li>
								<li>
        							<a href="#">درباره ما</a>
        						</li>
        						<li>
        							<a href="#">عضویت</a>
        						</li>
        						<li>
        							<a href="#">همایش ها</a>
        						</li>
        						<li>
        							<a href="#">پرسش و پاسخ</a>
        						</li>
        						<li>
        							<a href="#">اخبار</a>
        						</li>
        						<li>
        							<a href="#">گالری تصاویر</a>
        						</li>
        						<li>
        							<a href="#">تماس با ما</a>
        						</li>
							</ul>
						</div>
						<p class="copyright_text" style="font-size:16px;margin-top:50px;">Rahyab clinic. All rights reserved. Designed by Mediateq.ir</p>
					</div><!-- columns-->
				</div><!-- container -->
			</div><!-- #sub_footer -->
		</div>
	</div>
</footer>
cd;

echo $html;
?>

