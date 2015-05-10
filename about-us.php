<?php
	include_once("config.php");
	include_once("classes/functions.php");
  	  	  
    $About_System = GetSettingValue('About_System',0);
    $seo = Seo::GetSeo();
    
    $seo->Site_Title = 'درباره ما';  
	
$ahtml =<<<cd
		<!-- Main content alpha -->
		<div id="main" class="col9 clearfix">
			<div id="main_inner">
				<div class="article_grid four_column_blog">
					<h4>درباره ما</h4>
				</div>
				<style>
					.entry p,
					.entry span,
					.entry strong,
					.entry h1,
					.entry h2,
					.entry h3,
					.entry h4,
					.entry h5,
					.entry h6{
						font-family:'bmitra' !important;
						line-height: 2;
					}
				</style>
				<div class="entry">
					{$About_System}
					<div class="clearboth"></div>									
				</div>				
			</div><!-- #main_inner -->
		</div>					
		<!-- /Main content alpha -->
	
cd;
   	include_once('./inc/header.php');
	echo $ahtml;
	include_once('./inc/sidebar.php');
	include_once('./inc/footer.php');
	include_once('./inc/last.php');
?>
  	