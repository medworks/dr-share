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
			<h4>آرشیو مقالات</h4>
			<div id="bbpress-forums">
				<ul id="forums-list-0" class="bbp-forums">
					<li class="bbp-header">
						<ul class="forum-titles">
							<li class="bbp-forum-info" style="font-size:20px">مقالات</li>
							<li class="bbp-forum-reply-count">نویسنده</li>
							<li class="bbp-forum-freshness">تاریخ</li>
						</ul>
					</li><!-- .bbp-header -->
					<li class="bbp-body">



						<ul class="forum">
							<li class="bbp-forum-info">
								<a class="bbp-forum-title" href="#">عنوان مقاله</a>	
								<div class="bbp-forum-content">
									توضیحات مقاله.... توضیحات مقاله.... توضیحات مقاله.... توضیحات مقاله.... توضیحات مقاله....
								</div>
							</li>
							<li class="bbp-forum-topic-count">Admin</li>
							<li class="bbp-forum-reply-count">3 فرودین 1393</li>
						</ul>
						<ul class="forum">
							<li class="bbp-forum-info">
								<a class="bbp-forum-title" href="#">عنوان مقاله</a>	
								<div class="bbp-forum-content">
									توضیحات مقاله.... توضیحات مقاله.... توضیحات مقاله.... توضیحات مقاله.... توضیحات مقاله....
								</div>
							</li>
							<li class="bbp-forum-topic-count">Admin</li>
							<li class="bbp-forum-reply-count">3 فرودین 1393</li>
						</ul>




					</li><!-- .bbp-body -->
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