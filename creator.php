<?php
	include_once("config.php");
	include_once("classes/functions.php");
  	include_once("classes/messages.php");
  	include_once("classes/session.php");	
  	include_once("classes/security.php");
  	include_once("classes/database.php");	
	include_once("classes/login.php");
	include_once("lib/persiandate.php"); 
	
	//error_reporting(E_ALL);
	//ini_set('display_errors', 1);
	$seo = Seo::GetSeo();
	$seo->Site_Title = "موسس (دکتر حسین شاره)";

$ohtml.=<<<cd
<div id="main" class="col9 clearfix">
	<div id="main_inner">

		<div class="single_post_module">
			<div class="post type-post status-publish format-standard has-post-thumbnail hentry category-featured category-lifestyle category-travel tag-adipiscing tag-augue tag-donec tag-etiam tag-euismod">

				<div class="single_post_image">					
					<a href="./images/creator.jpg" class="hb-image-zoom" rel="swipebox[single_post_image]" title="موسس (دکتر حسین شاره)">
						<img  class="morph" src="./images/creator.jpg"  width="874px" height="492px" />
					</a>
				</div>
				<style>
					.single_post_content h1,
					.single_post_content .entry p,
					.single_post_content .entry span,
					.single_post_content .entry strong,
					.single_post_content .entry h1,
					.single_post_content .entry h2,
					.single_post_content .entry h3,
					.single_post_content .entry h4,
					.single_post_content .entry h5,
					.single_post_content .entry h6{
						font-family:'bmitra' !important;
					}
				</style>
				<article class="single_post_content">
					<h1 class="article_heading entry_title" style="font-size:28px !important;direction:rtl;color:#555">موسس (دکتر حسین شاره)</h1>
					<div class="clearboth"></div>
					<div class="entry">
						<p style="font-size:22px;font-weight:normal!important;color:#000;line-height: 1.5;letter-spacing:0px;text-align:justify;direction:rtl">
							دکتر حسین شاره که فارغ التحصیل دکتری تخصصی روانشناسی بالینی از انستیتو روانپزشکی تهران و دارای گواهینامه سکس تراپی از انجمنمدرسان،مشاورانودرمانگرانمسایلجنسیآمریکا (AASECT) و عضو هیات علمی دانشگاه است، در دانشگاههایعلوم پزشكي ايران (انستیتو روانپزشکی تهران)، تربیت معلم تهران،فردوسي مشهد، علوم پزشكي مشهد وعلوم پرشکی وارستگان،سمنان،حکیم سبزواری، علوم تحقیقات خراسان رضوي....در مقاطع کارشناسی، کارشناسی ارشد و دکتری تدریس نموده و در داخل و خارج کشور دوره های تخصصی روانکاوی، هیپنوتراپی، زوج درمانی، خانواده درمانی و درمان و مشاوره در زمینه مسایل جنسی و زناشویی را گذرانده است. دکتر شاره بیش از 50 مقاله علمی-پژوهشی فارسی و انگلیسی به چاپ رسانده و در همایشها و سمینارهای بیش از 10 کشور دنیا سخنرانی های علمی ارائه نموده است و بیش از 100 دوره کلاس، کارگاه و همایشهای آموزشی برگزار نمودهاند. دکتر شاره که راهنمایی بیش از 50 پروژه تحقیقاتی را عهده¬دار بوده،عضو هیأت مدیره و دبیر انجمن علمی روانشناسی بالینی ایرانشعبه مشهد، عضو انجمن روانشناسان آمریکا، عضو انجمن بین المللی پزشکی جنسی (ISSM)گران مسایل جنسی آمریکا (AASECT)، انجمنجهای سلامت جنسی (WAS)،انجمنهای پیشرفت علم و هنر در مسایل جنسی(NAASAS)، عضو سازمان نظام مشاوره و روانشناسي و داراي پروانه تخصصي فعاليت در زمينه رواندرماني، روانكاوي و درمان مسايل زوج و زناشويي از سازمان نظام مشاوره و روانشناسي و سازمان بهزيستي كشور است.دکتر شاره بیش از 10 سال به روانکاوی، درمان مشکلات روانی، شخصیتی، جنسی، زناشویی و ارتباطی زوجین و خانواده ها در شهر تهران و مشهد پرداخته و سابقه کار حرفهای با بیماران خارجی را در پرونده خود دارد. در حال حاضر دکتر شاره مسئولیت سوپرویژن علمی و نظارت بر کار درمانی دانشجویان و فارغ التحصیلان کارشناسی ارشد و دکتری تخصصی را در دانشگاهها و مراکز درمانی از جمله کلینیک تخصصی رهیاب برعهده دارد.
						</p>
						<div class="clearboth"></div>									
					</div>
				</article>
			</div>
		</div>
	</div><!-- #main_inner -->
</div>
cd;

	include_once('./inc/header.php');
	echo $ohtml;
	include_once('./inc/sidebar.php');
	include_once('./inc/footer.php');
	include_once('./inc/last.php');
?>