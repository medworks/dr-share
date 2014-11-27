<?php

	include_once("config.php");
	include_once("classes/functions.php");
  	include_once("classes/messages.php");
  	include_once("classes/session.php");	
  	include_once("classes/security.php");
  	include_once("classes/database.php");	
	include_once("classes/login.php");
    include_once("lib/persiandate.php"); 
$db = Database::GetDatabase();
$gallery = $db->SelectAll("gpics","*",NULL,"id ASC",0,5);

$html.=<<<cd
<div id="sidebar" class="col3 last">
	<div id="sidebar_inner">
		<div id="archives-5" class="widget widget_archive fade-in">
			<h4 class="widgettitle rtl">کلینیک رهیاب</h4>
			<ul>
				<li><a href="healthgroup.html">گروه درمانی</a></li>
				<li><a href="news.html">اخبار و تازه ها</a></li>
				<li><a href="gallery.html">گالری تصاویر</a></li>
				<li><a href="class.html">کلاسها و دوره های آموزشی</a></li>
				<li><a href="articles.html">آرشیو مقالات</a></li>
				<li><a href="exam.html">آزمون های روانشناختی</a></li>
				<li><a href="conferences.html">همایش ها</a></li>
				<li><a href="membership.html">عضویت در خبرنامه</a></li>
				<li><a href="faq.html">پرسش و پاسخ</a></li>
				<li><a href="about-us.html">درباره ما</a></li>
				<li><a href="contactus.html">تماس با ما</a></li>
			</ul>
		</div>
		<div class="widget widget_text fade-in">
			<h4 class="widgettitle rtl">عضویت در خبرنامه</h4>
			<div class="textwidget">
				<div class="flickr_wrap">
				<form action="membership.php" method="GET" >
					<div class="flickr_badge_image" id="flickr_badge_image1">
						<input type="text" name="email" class="wysija-input" style="float:right;" title="Email" value="" id="form-validation-field-0">
						<input class="wysija-submit wysija-submit-field rtl" type="submit" style="margin-right:0;height:42px;font-size:17px" value="ثبت!">
					</div>
				</form>	
				</div>
			</div>
		</div>

		<div class="widget widget_text fade-in">
			<h4 class="widgettitle rtl">گالری تصاویر</h4>
			<div class="textwidget">
				<div class="flickr_wrap">
cd;
for($i = 0; $i < Count($gallery); $i++)
{
$html.=<<<cd
					<div class="flickr_badge_image" id="flickr_badge_image1">
						<a href="#" target="_blank">
							<img  src="manager/img.php?did={$gallery[$i]["gid"]}&type=gall" width="75px" height="75px" />
						</a>
					</div>
cd;
}
$html.=<<<cd
				</div>
			</div>
		</div>

		<div class="widget widget_text fade-in">
			<div class="textwidget">
				<div class="social-count-plus">
					<ul class="default">
						<li class="count-twitter">
							<a class="icon" href="#" target="_blank"></a>
						</li>
						<li class="count-facebook">
							<a class="icon" href="#" target="_blank"></a>
						</li>
						<li class="count-youtube">
							<a class="icon" href="#" target="_blank"></a>
						</li>
						<li class="count-googleplus">
							<a class="icon" href="#" target="_blank"></a>
						</li>
						<li class="count-instagram">
							<a class="icon" href="#" target="_blank"></a>
						</li>
						<li class="count-posts">
							<a class="icon" href="#" target="_blank"></a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
cd;

?>