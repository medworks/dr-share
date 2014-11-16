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
	
	$db = Database::GetDatabase();
	
	$news = $db->SelectAll("news","*",NULL,"id ASC");
	$gallery = $db->SelectAll("gpics","*",NULL,"id ASC",0,5);
	
$fhtml.=<<<cd
	<div class="container">
		<div id="content">
			<div id="content_inner">
				<div id="main" class="col9 clearfix">
					<div id="nt_slider">
						<div id="nt_slider_inner" class="slider_preload">
							<div class="royalSlider videoGallery rsMinW" id="video-gallery">
								<div>
									<a href="#">
										<img class="rsImg" src="./images/slides/1.jpg" alt="" height="492" width="874">	
									</a>
									<div class="slider_h">
										<a href="#">
											<h2>عکس اول</h2>
										</a>
									</div>
									<div class="rsTmb">
										<div class="rsTmbImg">
											<img class="rsThumbImage" src="./images/slides/1.jpg" alt="" height="160" width="280">
										</div>
										<div class="rsTmbDesc">
											<div class="slider_title">عکس اول</div>
										</div>
									</div>
								</div>
								<div>
									<a href="#">
										<img class="rsImg" src="./images/slides/2.jpg" alt="" height="492" width="874">	
									</a>
									<div class="slider_h">
										<a href="#">
											<h2>عکس دوم</h2>
										</a>
									</div>
									<div class="rsTmb">
										<div class="rsTmbImg">
											<img class="rsThumbImage" src="./images/slides/2.jpg" alt="" height="160" width="280">
										</div>
										<div class="rsTmbDesc">
											<div class="slider_title">عکس دوم</div>
										</div>
						</div>
					</div>
					<div>
						<a href="#">
							<img class="rsImg" src="./images/slides/3.jpg" alt="" height="492" width="874">	
						</a>
						<div class="slider_h">
							<a href="#">
								<h2>عکس سوم</h2>
							</a>
						</div>
						<div class="rsTmb">
							<div class="rsTmbImg">
								<img class="rsThumbImage" src="./images/slides/3.jpg" alt="" height="160" width="280">
							</div>
							<div class="rsTmbDesc">
								<div class="slider_title">عکس سوم</div>
							</div>
						</div>
					</div>
					<div>
						<a href="#">
							<img class="rsImg" src="./images/slides/4.jpg" alt="" height="492" width="874">	
						</a>
						<div class="slider_h">
							<a href="#">
								<h2>عکس چهارم</h2>
							</a>
						</div>
						<div class="rsTmb">
							<div class="rsTmbImg">
								<img class="rsThumbImage" src="./images/slides/4.jpg" alt="" height="160" width="280">
							</div>
							<div class="rsTmbDesc">
								<div class="slider_title">عکس چهارم</div>
							</div>
						</div>
					</div>
					<div>
						<a href="#">
							<img class="rsImg" src="./images/slides/5.jpg" alt="" height="492" width="874">	
						</a>
						<div class="slider_h">
							<a href="#">
								<h2>عکس پنجم</h2>
							</a>
						</div>
						<div class="rsTmb">
							<div class="rsTmbImg">
								<img class="rsThumbImage" src="./images/slides/5.jpg" alt="" height="160" width="280">
							</div>
							<div class="rsTmbDesc">
								<div class="slider_title">عکس پنجم</div>
							</div>
						</div>
					</div>
					<div>
						<a href="#">
							<img class="rsImg" src="./images/slides/6.jpg" alt="" height="492" width="874">	
						</a>
						<div class="slider_h">
							<a href="#">
								<h2>عکس ششم</h2>
							</a>
						</div>
						<div class="rsTmb">
							<div class="rsTmbImg">
								<img class="rsThumbImage" src="./images/slides/6.jpg" alt="" height="160" width="280">
							</div>
							<div class="rsTmbDesc">
								<div class="slider_title">عکس ششم</div>
							</div>
						</div>
					</div>
				</div>
				<div class="clearboth"></div>
			</div>
		</div>
		<div id="main_inner">
			<div class="page">
				<div class="article_grid four_column_blog carousel">
					<h4>اخبار</h4>
cd;
for($i = 0; $i < Count($news); $i++)
{
	//$pic=$db->Select("pics","*","tid=2 AND sid ='{$news[i][id]}'",NULL);
	$news[$i]["text"] =(mb_strlen($news[$i]["text"])>90)?mb_substr($news[$i]["text"],0,90,"UTF-8")."...":$news[$i]["text"];
	if ($i % 4 == 0)
	{
		$class = " last";
	}
	else
	{
		$class = "";
	}
$fhtml.=<<<cd
								<div class="3 {$class}">
									<div class="fade-in article_grid_module appeared">
										<div class="article_grid_image">
											<img class=" morph" src="manager/img.php?did={$news[$i]["id"]}&tid=2" width="160px" height="160px" />
											<div class="hover_buttons">
												<div>
													<div>
														<!-- <a href="http://gazette.seoresearch.com/wp-content/uploads/2014/08/tumblr_n6esribU971st5lhmo1_1280-1280x768.jpg" class="hb-image-zoom" rel="swipebox[blog_shortcode]" title="Phasellus euismod purus eget sed luctus"></a> -->
														<a href="#" class="hb-image-link" title=""></a>
													</div>
												</div>
											</div>
										</div>
										<div class="article_grid_content">
											<h3 class="article_heading rtl">
												<a href="#" title="" rel="bookmark">{$news[$i]['subject']}</a>
											</h3>
											<div class="post_excerpt">
												<p class="rtl" style="font-size:18px">{$news[$i]['text']}</p>
												<p>
													<a class="post_more_link" href="#" style="font-size:15px">ادامه خبر</a>
												</p>
											</div>
										</div>
									</div>
								</div>
cd;
}

$fhtml.=<<<cd
							</div>
						</div>
						<div class="clearboth"></div>
					</div><!-- #main_inner -->
				</div>
				<!-- #main -->
				<div id="sidebar" class="col3 last">
					<div id="sidebar_inner">
						<div id="archives-5" class="widget widget_archive fade-in">
							<h4 class="widgettitle rtl">کلینیک رهیاب</h4>
							<ul>
								<li><a href="#">گروه درمانی</a></li>
								<li><a href="#">اخبار و تازه</a></li>
								<li><a href="#">کلاسها و دوره های آموزشی</a></li>
								<li><a href="#">آرشیو مقالات</a></li>
								<li><a href="#">گالری تصاویر</a></li>
								<li><a href="#">عضویت</a></li>
								<li><a href="#">پیوندهای مفید</a></li>
								<li><a href="#">درباره ما</a></li>
								<li><a href="#">تماس با ما</a></li>
							</ul>
						</div>
						<div id="text-16" class="widget widget_text fade-in">
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
						<div id="text-18" class="widget widget_text fade-in">
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
cd;

$html.=<<<cd
				</div>
			</div>
			<div class="clearboth"></div>
		</div><!-- #main_inner -->
	</div>
				
cd;
	include_once('./inc/header.php');
	echo $fhtml;
	include_once('./inc/footer.php');
	include_once('./inc/last.php');
?>