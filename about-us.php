<?php
	include_once("config.php");
	include_once("classes/functions.php");
  	  	  
    $About_System = GetSettingValue('About_System',0);
	
$ahtml =<<<cd
		<!-- Main content alpha -->
		<div id="main" class="col9 clearfix">
			<div id="main_inner">
				<div class="article_grid four_column_blog">
					<h4>درباره ما</h4>
				</div>
				<div class="entry">
					<p style="font-size:22px;font-weight:normal;">
						{$About_System}
					</p>
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
  	