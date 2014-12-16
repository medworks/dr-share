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
	$seo = Seo::GetSeo();
    
	
	$news = $db->Select("menusubjects","*","smid={$_GET['id']}");
	$seo->Site_Title = $news['subject'];  

	$news["regdate"] = ToJalali($news["regdate"],"Y/m/d H:i");
	
	$pic = $db->Select("pics","*","`tid`= 1 AND `sid`='{$news['id']}'");
	$img = base64_encode($pic['img']);
	$src = 'data: '.$pic['itype'].';base64,'.$img;
$ohtml.=<<<cd
<div id="main" class="col9 clearfix">
	<div id="main_inner">

		<div class="single_post_module">
			<div class="post type-post status-publish format-standard has-post-thumbnail hentry category-featured category-lifestyle category-travel tag-adipiscing tag-augue tag-donec tag-etiam tag-euismod">
				<div class="single_post_image">					
					<a href="manager/img.php?did={$news['id']}&tid=1" class="hb-image-zoom" rel="swipebox[single_post_image]" title="{$news['subject']}">
					<!--
					  <img class=" morph" src="manager/img.php?did={$news['id']}&tid=1" width="874px" height="492px" />
					 -->
					 <img  class="morph" src="{$src}"  width="874px" height="492px" />
					</a>
					<!-- <div class="meta_category">
						<a href="javascript:void();" class="cat-featured" title="{$news['subject']}">تاریخ : {$news["regdate"]}</a>						
					</div> -->
				</div>
				<article class="single_post_content">
					<h1 class="article_heading entry_title" style="font-size:35px !important">{$news['subject']}</h1>
					<div class="clearboth"></div>
					<div class="entry">
						<p style="font-size:22px;font-weight:normal!important;color:#000;line-height: 1.5;letter-spacing:0px">
							{$news["text"]}
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