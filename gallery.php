<?php
	include_once("config.php");
	include_once("classes/functions.php");
  	include_once("classes/messages.php");
  	include_once("classes/session.php");	
  	include_once("classes/security.php");
  	include_once("classes/database.php");	
	include_once("classes/login.php");
    include_once("lib/persiandate.php");
    include_once("./lib/Zebra_Pagination.php"); 	
	
	//error_reporting(E_ALL);
	//ini_set('display_errors', 1);
	
	$db = Database::GetDatabase();	

$ghtml.=<<<cd
<div id="main" class="col9 clearfix">
	<div id="main_inner">
		<div class="article_grid four_column_blog">
			<h4>گالری تصاویر</h4>
cd;


	$records_per_page = 10;
	$pagination = new Zebra_Pagination();

	$pagination->navigation_position("right");

	$reccount = $db->CountAll("gcategories");
	$pagination->records($reccount); 
	
    $pagination->records_per_page($records_per_page);	

$grows = $db->SelectAll(
				"gcategories",
				"*",
				NULL,
				"id ASC",
				($pagination->get_page() - 1) * $records_per_page,
				$records_per_page);
for($i = 0; $i < Count($grows); $i++)
{
$gpics = $db->Select("gallerypics","*","gcid = {$grows[$i]['id']}");
//echo $db->cmd;
$ghtml.=<<<cd
			<div class="col4">
				<div>
					<div class="article_grid_image">
						<img class="morph" src="manager/img.php?did={$gpics['id']}&type=gall" width="480px" height="270px" /> 						
						<div class="hover_buttons">
							<div>
								<div>
									<a href="manager/img.php?did={$gpics['id']}&type=gall" class="hb-image-zoom" rel="swipebox[portfolio_img_group_13]" title=""></a>
								</div>
							</div>
						</div>
					</div>
					<div class="article_grid_content">
						<h3 class="article_heading">
							<a href="one-gallery{$grows[$i]['id']}.html">آلبوم : {$grows[$i]['name']}</a>
						</h3>
						<!-- <div class="post_excerpt">
							<p>
								<a href="one-gallery{$grows[$i]['id']}.html" class="post_more_link" style="margin-right:165px">تصاویر بیشتر</a>
							</p>
						</div> -->
					</div>
				</div>
			</div>
cd;
}
$pgcodes = $pagination->render(true);
$ghtml.=<<<cd
		</div>
		{$pgcodes}
	</div><!-- #main_inner -->
</div>
cd;

	include_once('./inc/header.php');
	echo $ghtml;
	include_once('./inc/sidebar.php');
	include_once('./inc/footer.php');
	include_once('./inc/last.php');
?>