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
	$seo = Seo::GetSeo();
    
    $seo->Site_Title = 'آزمون های روانشناختی';  
	

$ehtml.=<<<cd
<div id="main" class="col9 clearfix">
	<div id="main_inner">
		<div class="article_grid four_column_blog">
			<h4>آزمون های روانشناختی</h4>
			<div class="su-row rtl">
				<div class="su-column su-column-size-3-3">
					<div class="su-column-inner su-clearfix">
						<div class="su-accordion">
cd;
$rows = $db->SelectAll("exam","*",NULL," id ASC");
for($i = 0; $i < Count($rows); $i++)
{
	$img=null;
	$img = base64_encode($rows[$i]['img']);
	$src = 'data: '.$rows[$i]['itype'].';base64,'.$img;
if (!empty($rows[$i]['iname']))
{

$img=<<<cd
                <div class="su-spoiler-title">
			  <img src="{$src}" title="{$rows[$i]['subject']}" />
                 </div>
cd;
}
else
{
	$img = "";
}

$ehtml.=<<<cd
				
				
							<div class="su-spoiler su-spoiler-style-default su-spoiler-icon-plus su-spoiler-closed">
								<div class="su-spoiler-title">
									<span class="su-spoiler-icon"></span>{$rows[$i]["subject"]}
								</div>
								<div class="su-spoiler-content su-clearfix">
									{$rows[$i]["text"]}
								</div>
								  {$img}
							</div>
cd;
}
$ehtml.=<<<cd
						</div>
					</div>
				</div>
			</div>
		</div>
	</div><!-- #main_inner -->
</div>
cd;

	include_once('./inc/header.php');
	echo $ehtml;
	include_once('./inc/sidebar.php');
	include_once('./inc/footer.php');
	include_once('./inc/last.php');
?>