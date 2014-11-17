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
	<div id="main_inner">

		<div class="single_post_module">
			<div class="post type-post status-publish format-standard has-post-thumbnail hentry category-featured category-lifestyle category-travel tag-adipiscing tag-augue tag-donec tag-etiam tag-euismod">
				<div class="single_post_image">
					<a href="./images/slides/1.jpg" class="hb-image-zoom" rel="swipebox[single_post_image]" title="">
						<img class=" morph" src="./images/slides/1.jpg" alt="" width="874" height="492">
					</a>
					<div class="meta_category">
						<a href="javascript:void();" class="cat-featured" title="">تاریخ: 29 فروردین 1393</a>
						<a href="javascript:void();" class="cat-lifestyle" title="">توسط: Admin</a>
					</div>
				</div>
				<article class="single_post_content">
					<h1 class="article_heading entry_title" style="font-size:35px !important">عنوان خبر</h1>
					<div class="clearboth"></div>
					<div class="entry">
						<p style="font-size:22px;font-weight:normal;">
							توضیحات خبر.... توضیحات خبر.... توضیحات خبر.... توضیحات خبر.... توضیحات خبر.... توضیحات خبر.... توضیحات خبر.... توضیحات خبر.... توضیحات خبر.... 
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
	include_once('./inc/sidebar.php');
	include_once('./inc/footer.php');
	include_once('./inc/last.php');
?>