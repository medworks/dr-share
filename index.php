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
	$slide = $db->SelectAll("slide","*",NULL,"id ASC");
	
$fhtml.=<<<cd
<div id="main" class="col9 clearfix">
	<div id="nt_slider">
		<div id="nt_slider_inner" class="slider_preload">
			<div class="royalSlider videoGallery rsMinW" id="video-gallery">
cd;
for($i = 0; $i < Count($slide); $i++)
{
	$img = base64_encode($slide[$i]['img']);
	$src = 'data: '.$slide[$i]['itype'].';base64,'.$img;
	
$fhtml.=<<<cd
				<div>
					<a href="#">
						<!--
						<img class="rsImg" src="manager/img.php?slide=yes&did={$slide[$i]['id']}" alt ="{$rows[$i]['subject']}" width="492" height="874" />
						-->
						 <img class="rsImg" src="{$src}" alt ="{$rows[$i]['subject']}" width="492" height="874" />
					</a>
					<div class="slider_h">
						<a href="#">
							<h2>{$slide[$i]['subject']}</h2>
						</a>
					</div>
					<div class="rsTmb">
						<div class="rsTmbImg">
						   <!--
							<img class="rsThumbImage" src="manager/img.php?slide=yes&did={$slide[$i]['id']}" alt ="{$rows[$i]['subject']}"  width="160" height="280" />
						   -->
						   <img class="rsThumbImage" src="{$src}" alt ="{$rows[$i]['subject']}" width="160" height="280" />
						</div>
						<div class="rsTmbDesc">
							<div class="slider_title">{$slide[$i]['subject']}</div>
						</div>
					</div>
				</div>
cd;
}
$fhtml.=<<<cd
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
	$pic = $db->Select("pics","*","`sid`='{$news[$i][id]}' AND `tid`='2'");
	$img = base64_encode($pic['img']);
	$src = 'data: '.$pic['itype'].';base64,'.$img;
	//$pic=$db->Select("pics","*","tid=2 AND sid ='{$news[i][id]}'",NULL);
	$news[$i]["text"] =(mb_strlen($news[$i]["text"])>120)?mb_substr($news[$i]["text"],0,120,"UTF-8")."...":$news[$i]["text"];
        $body=strip_tags($news[$i]["text"]);
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
						<img class="morph" src="{$src}" alt ="{$news[$i]['subject']}" style="width:201px !important;height:115px !important" />
							<div class="hover_buttons">
								<div>
									<div>
										<a href="one-news{$news[$i]['id']}.html" class="hb-image-link" title="{$news[$i]['subject']}" target="_blank"></a>
									</div>
								</div>
							</div>
						</div>
						<div class="article_grid_content rtl">
							<h3 class="article_heading rtl">
								<a href="one-news{$news[$i]['id']}.html" title="{$news[$i]['subject']}" rel="bookmark" target="_blank">{$news[$i]['subject']}</a>
							</h3>
							<div class="post_excerpt">
								<!-- <p class="rtl" style="font-size:18px">{$body}</p> -->
								<p>
									<a class="post_more_link" href="one-news{$news[$i]['id']}.html" style="font-size:15px" target="_blank">ادامه خبر</a>
								</p>
							</div>
						</div>
					</div>
				</div>
cd;
}

$fhtml.=<<<cd
			</div>
			<div class="clearboth"></div>
		</div>
	</div><!-- #main_inner -->
</div><!-- #main -->
cd;

	include_once('./inc/header.php');
	echo $fhtml;
	include_once('./inc/sidebar.php');
	include_once('./inc/footer.php');
	include_once('./inc/last.php');
?>