<?php
	include_once("config.php");
	include_once("classes/functions.php");
  	include_once("classes/security.php");
  	include_once("classes/database.php");	
    include_once("./lib/persiandate.php");
	include_once("./lib/Zebra_Pagination.php"); 	
	
	//error_reporting(E_ALL);
	//ini_set('display_errors', 1);
	
	$db = Database::GetDatabase();
	
	$records_per_page = 10;
	$pagination = new Zebra_Pagination();

	$pagination->navigation_position("right");

	$reccount = $db->CountAll("news");
	$pagination->records($reccount); 
	
    $pagination->records_per_page($records_per_page);	

$rows = $db->SelectAll(
				"news",
				"*",
				NULL,
				"id ASC",
				($pagination->get_page() - 1) * $records_per_page,
				$records_per_page);
				

$nhtml.=<<<cd
<div id="main" class="col9 clearfix">
	<div id="main_inner">
		<div class="article_grid four_column_blog">
			<h4>اخبار و تازه ها</h4>
cd;

for($i = 0; $i < Count($rows); $i++)
{
	$rows[$i]["regdate"] = ToJalali($rows[$i]["regdate"],"Y/m/d H:i");
$nhtml.=<<<cd
			<div class="col3">
				<div>
					<div class="article_grid_image">
						<img class=" morph" src="manager/img.php?did={$rows[$i]["id"]}&tid=2" width="280px" height="160px" />
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
								{$rows[$i]["subject"]}
							</a>
						</h3>
						<p class="post_meta">
							<span class="meta_date">
								<a href="#" title="">{$rows[$i]["regdate"]}</a>
							</span>							
						</p>
						<div class="post_excerpt">							
							<p>
								<a class="post_more_link" href="#">ادامه خبر</a>
							</p>
						</div>
					</div>
				</div>
			</div>
cd;
}
$pgcodes = $pagination->render(true);
$nhtml.=<<<cd
		</div>
	</div><!-- #main_inner -->
	{$pgcodes}
</div>
cd;

	include_once('./inc/header.php');
	echo $nhtml;
	include_once('./inc/sidebar.php');
	include_once('./inc/footer.php');
	include_once('./inc/last.php');
?>