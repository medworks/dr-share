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
		<div class="article_grid four_column_blog">
			<h4>اخبار و تازه ها</h4>
			<div class="col3">
				<div>
					<div class="article_grid_image">
						<img class="morph" src="./images/slides/1.jpg" alt="" width="280" height="160" />
						<div class="hover_buttons">
							<div>
								<div>
									<a href="#" class="hb-image-link" title=""></a>
								</div>
							</div>
						</div>
					</div>
					<div class="article_grid_content">
						<h3 class="article_heading">
							<a href="#" title="" rel="bookmark">
								عنوان خبر
							</a>
						</h3>
						<p class="post_meta">
							<span class="meta_date">
								<a href="#" title="">29 فروردین 1393</a>
							</span>
							<span class="meta_author">
								<a href="#">Admin</a>
							</span>
						</p>
						<div class="post_excerpt">
							<p>
								خبر پنجم
							</p>
							<p>
								<a class="post_more_link" href="#">ادامه خبر</a>
							</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col3">
				<div>
					<div class="article_grid_image">
						<img class="morph" src="./images/slides/2.jpg" alt="" width="280" height="160" />
						<div class="hover_buttons">
							<div>
								<div>
									<a href="#" class="hb-image-link" title=""></a>
								</div>
							</div>
						</div>
					</div>
					<div class="article_grid_content">
						<h3 class="article_heading">
							<a href="#" title="" rel="bookmark">
								عنوان خبر
							</a>
						</h3>
						<p class="post_meta">
							<span class="meta_date">
								<a href="#" title="">29 فروردین 1393</a>
							</span>
							<span class="meta_author">
								<a href="#">Admin</a>
							</span>
						</p>
						<div class="post_excerpt">
							<p>
								خبر پنجم
							</p>
							<p>
								<a class="post_more_link" href="#">ادامه خبر</a>
							</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col3">
				<div>
					<div class="article_grid_image">
						<img class="morph" src="./images/slides/3.jpg" alt="" width="280" height="160" />
						<div class="hover_buttons">
							<div>
								<div>
									<a href="#" class="hb-image-link" title=""></a>
								</div>
							</div>
						</div>
					</div>
					<div class="article_grid_content">
						<h3 class="article_heading">
							<a href="#" title="" rel="bookmark">
								عنوان خبر
							</a>
						</h3>
						<p class="post_meta">
							<span class="meta_date">
								<a href="#" title="">29 فروردین 1393</a>
							</span>
							<span class="meta_author">
								<a href="#">Admin</a>
							</span>
						</p>
						<div class="post_excerpt">
							<p>
								خبر پنجم
							</p>
							<p>
								<a class="post_more_link" href="#">ادامه خبر</a>
							</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col3 last">
				<div>
					<div class="article_grid_image">
						<img class="morph" src="./images/slides/4.jpg" alt="" width="280" height="160" />
						<div class="hover_buttons">
							<div>
								<div>
									<a href="#" class="hb-image-link" title=""></a>
								</div>
							</div>
						</div>
					</div>
					<div class="article_grid_content">
						<h3 class="article_heading">
							<a href="#" title="" rel="bookmark">
								عنوان خبر
							</a>
						</h3>
						<p class="post_meta">
							<span class="meta_date">
								<a href="#" title="">29 فروردین 1393</a>
							</span>
							<span class="meta_author">
								<a href="#">Admin</a>
							</span>
						</p>
						<div class="post_excerpt">
							<p>
								خبر پنجم
							</p>
							<p>
								<a class="post_more_link" href="#">ادامه خبر</a>
							</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col3">
				<div>
					<div class="article_grid_image">
						<img class="morph" src="./images/slides/5.jpg" alt="" width="280" height="160" />
						<div class="hover_buttons">
							<div>
								<div>
									<a href="#" class="hb-image-link" title=""></a>
								</div>
							</div>
						</div>
					</div>
					<div class="article_grid_content">
						<h3 class="article_heading">
							<a href="#" title="" rel="bookmark">
								عنوان خبر
							</a>
						</h3>
						<p class="post_meta">
							<span class="meta_date">
								<a href="#" title="">29 فروردین 1393</a>
							</span>
							<span class="meta_author">
								<a href="#">Admin</a>
							</span>
						</p>
						<div class="post_excerpt">
							<p>
								خبر پنجم
							</p>
							<p>
								<a class="post_more_link" href="#">ادامه خبر</a>
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