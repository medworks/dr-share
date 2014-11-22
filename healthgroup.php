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
	

$hghtml.=<<<cd
<div id="main" class="col9 clearfix">
	<div id="main_inner">
		<div class="article_grid four_column_blog">
			<h4>گروه درمانی</h4>
			<div class="su-row rtl">
				<div class="su-column su-column-size-3-3">
					<div class="su-column-inner su-clearfix">
						
						<div class="su-tabs su-tabs-style-default su-tabs-vertical" data-active="1">
						<div class="su-tabs-nav">
cd;

$rows = $db->SelectAll("health","*",NULL," id ASC");
for($i = 0; $i < Count($rows); $i++)
{
$hghtml.=<<<cd
							
								<span class="">{$rows[$i]["subject"]}</span>								
							
cd;
}
$hghtml.=<<<cd
						</div>
							<div class="su-tabs-panes">
cd;
for($i = 0; $i < Count($rows); $i++)
{
$hghtml.=<<<cd
								<div class="su-tabs-pane su-clearfix" style="min-height: 180px; display: none;font-size:18px;font-family:bmitra">
									{$rows[$i]["text"]}
								</div>
cd;
}
$hghtml.=<<<cd
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div><!-- #main_inner -->
</div>
cd;

	include_once('./inc/header.php');
	echo $hghtml;
	include_once('./inc/sidebar.php');
	include_once('./inc/footer.php');
	include_once('./inc/last.php');
?>