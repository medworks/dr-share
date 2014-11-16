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
	
$html.=<<<cd
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
$html.=<<<cd
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
$html.=<<<cd
				</div>
			</div>
			<div class="clearboth"></div>
		</div><!-- #main_inner -->
	</div>
				
cd;
	include_once('./inc/header.php');
	echo $html;
	include_once('./inc/sidebar.php');
	include_once('./inc/footer.php');
?>