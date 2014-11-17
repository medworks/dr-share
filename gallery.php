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
	

$html.=<<<cd
<div id="main" class="col9 clearfix">
	<div id="main_inner">
		<div class="article_grid four_column_blog">
			<h4>گالری تصاویر</h4>
			

			<div class="col4">
				<div>
					<div class="article_grid_image">
						<img class="morph" src="./images/slides/5.jpg" alt="" width="480" height="270">
						<div class="hover_buttons">
							<div>
								<div>
									<a href="./images/slides/5.jpg" class="hb-image-zoom" rel="swipebox[portfolio_img_group_13]" title=""></a>
								</div>
							</div>
						</div>
					</div>
					<div class="article_grid_content">
						<h3 class="article_heading">
							<a href="#">عنوان سرگروه عکس</a>
						</h3>
						<div class="post_excerpt">
							<p>
								<a href="#" class="post_more_link" style="margin-right:165px">تصاویر بیشتر</a>
							</p>
						</div>
					</div>
				</div>
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