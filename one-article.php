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
			

			<h4>اسم مقاله</h4>
			<div id="bbpress-forums">
				<ul class="forums bbp-replies">
					<li class="bbp-header">
						<div class="bbp-reply-author" style="font-size:18px">نویسنده: دکتر شارع</div>
					</li><!-- .bbp-header -->
					<div class="bbp-reply-header">
						<div class="bbp-meta">
							<span class="bbp-reply-post-date">29 فرودین 1393</span>
							<span class="bbp-admin-links"></span>
						</div><!-- .bbp-meta -->
					</div><!-- #post-3480 -->
					<div class="hentry">
						<div class="bbp-reply-content">
							<p>
								توضیحات... توضیحات... توضیحات... توضیحات... توضیحات... 
							</p>
						</div><!-- .bbp-reply-content -->
					</div><!-- .reply -->

					<li class="bbp-footer">
						<div class="tr">
							<p class="td colspan4">&nbsp;</p>
						</div><!-- .tr -->
					</li><!-- .bbp-footer -->
				</ul>
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