<?php
	include_once("config.php");
	include_once("classes/functions.php");
  	include_once("classes/session.php");	
  	include_once("classes/security.php");
  	include_once("classes/database.php");	
  	include_once("classes/seo.php");

	
	//error_reporting(E_ALL);
	//ini_set('display_errors', 1);
	
	$db = Database::GetDatabase();
	$seo = Seo::GetSeo();
	
	//$rwnews = $db->SelectAll("news","*",NULL,"id DESC",0,5);


$hhtml.=<<<cd

<!DOCTYPE html>
<!--[if !IE]><!-->
<html lang="fa-IR">
<!--<![endif]-->
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title> $seo->Site_Title </title>
<!-- <link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="http://gazette.seoresearch.com/xmlrpc.php">
<link id="google_font" href="#font_change" rel="stylesheet" type="text/css">
<link id="google_font_body" href="#font_change" rel="stylesheet" type="text/css">
<style id="font_skins" type="text/css"></style>
<style id="font_skins_body" type="text/css"></style> -->
<link rel="stylesheet" href="./css/panel.css" type="text/css" media="screen">
<link href="./css/zebra_pagination.css" rel="stylesheet" />
<meta name="google-site-verification" content="JXoNxh7OugEcHZ1x-aSZOBEl1eZXGnaA7phMGYtLwC4" />
<meta name="msvalidate.01" content="A92EDE738075648B70C10A8E52AFBCA6" />
<meta name="description" content="$seo->Site_Describtion" />
<meta name="keywords" content="$seo->Site_KeyWords" />
<meta name="author" content="Mediateq.ir" />
<meta name="generator" content="Powered by Mediateq.ir CMS panel" />
<meta name="googlebot" content="INDEX,FOLLOW" />
<meta name="robots" content="INDEX,FOLLOW" />
<meta name="format-detection" content="telephone=yes" />
<!-- <link href="http://fonts.googleapis.com/css?family=Raleway:100,200,300,regular,500,600,700,800,900" rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,300italic,regular,italic,600,600italic,700,700italic,800,800italic" rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,300italic,regular,italic,600,600italic,700,700italic,800,800italic" rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/css?family=Roboto+Condensed:300,300italic,regular,italic,700,700italic" rel="stylesheet" type="text/css"> -->
<link rel="stylesheet" href="./css/royalslider.css" type="text/css" media="screen">
<link rel="stylesheet" href="./css/rs-minimal-white.css" type="text/css" media="screen">
<link rel="stylesheet" href="./css/slick.css" type="text/css" media="screen">
<link rel="stylesheet" href="./css/style.css" type="text/css" media="screen">
<link rel="stylesheet" id="su-box-shortcodes-css" href="./css/box-shortcodes.css" type="text/css" media="all">
<link rel="stylesheet" href="./css/responsive.css" type="text/css" media="screen">
<link id="ss" rel="stylesheet" href="./css/light.css" type="text/css" media="screen">
<link rel="stylesheet" href="./css/review_system.css" type="text/css" media="screen">
<!--[if lt IE 7]> <link rel="stylesheet" type="text/css" href="http://gazette.seoresearch.com/wp-content/themes/gazette/skins/_ie/ie7.css"> <![endif]-->
<!--[if IE 8]> <link rel="stylesheet" type="text/css" href="http://gazette.seoresearch.com/wp-content/themes/gazette/skins/_ie/ie8.css"> <![endif]-->
<!--[if IE 9]> <link rel="stylesheet" type="text/css" href="http://gazette.seoresearch.com/wp-content/themes/gazette/skins/_ie/ie9.css"> <![endif]-->
<!--[if lt IE 10]> <link rel="stylesheet" type="text/css" href="http://gazette.seoresearch.com/wp-content/themes/gazette/skins/_ie/ie.css"> <![endif]-->

<style type="text/css">
body,html{     
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;  
}
	.category-color-f7a4a3:hover{background:#f7a4a3!important}
	.main_navigation .current-menu-item a.category-color-f7a4a3{background:#f7a4a3!important}
	.category-color-736086:hover{background:#736086!important}
	.main_navigation .current-menu-item a.category-color-736086{background:#736086!important}
	.category-color-FDD01C:hover{background:#FDD01C!important}
	.main_navigation .current-menu-item a.category-color-FDD01C{background:#FDD01C!important}
	.category-color-9ab821:hover{background:#9ab821!important}
	.main_navigation .current-menu-item a.category-color-9ab821{background:#9ab821!important}
	.category-color-0aa699:hover{background:#0aa699!important}
	.main_navigation .current-menu-item a.category-color-0aa699{background:#0aa699!important}
	.category-color-f35958:hover{background:#f35958!important}
	.main_navigation .current-menu-item a.category-color-f35958{background:#f35958!important}
	.category-color-606a70:hover{background:#606a70!important}
	.main_navigation .current-menu-item a.category-color-606a70{background:#606a70!important}
	.category-color-fa5300:hover{background:#fa5300!important}
	.main_navigation .current-menu-item a.category-color-fa5300{background:#fa5300!important}
	#body_inner{background:#fff }
	.container{max-width:1260px}
	#navigation{position:fixed}
	#navigation{top:0}
	header{padding:120px 0 60px 0}
	header .container .col12{text-align:center}
	footer .widget .custom_logo{color:#fff}
	footer .widget{margin-bottom:0px}
	.page_block{padding:0!important}
	.custom_logo em{letter-spacing:1px}
	.titled_box_title,.colored_box,.dropcap4,.pullquote4,.highlight,.tabs_button a.current,.styled_header span,.default_table th,.flex-control-nav li a.active,.wp-pagenavi a:hover,.button_link,.styled_button,.tabs_vertical li.current,.tabs_vertical li:hover,.article_grid_image a,.article_list_image a,.single_post_image a,.nt-icon-search:hover,.nt-search.nt-search-open .nt-icon-search, .header_social .social_icon a:hover,#buddypress #item-nav ul li a span,#sidebar .buddypress.widget .item-options a.selected,.error-404 #content #searchsubmit:hover,#content #searchform #searchsubmit:hover,#scroll_top a:hover,#buddypress .item-list-tabs ul li a span,.social-count-plus .default li.count-posts:hover,.single_post_module .item_rating,#review-box .progress-bar, .review-item-box .progress-bar,#buddypress .item-list-tabs ul li a:hover,#buddypress .item-list-tabs ul li.selected a,#sidebar .buddypress.widget .item-options a:hover,.buddypress.widget.widget_bp_core_login_widget #bp-login-widget-form label, th{background-color:#0090d9}
	#buddypress .item-list-tabs, #sidebar .buddypress.widget .item-options{border-bottom:2px solid #0090d9}
	#buddypress .item-list-tabs ul li a:hover span, #buddypress #activity-stream .activity-meta a:hover, #buddypress .item-list-tabs ul li.selected a span{color:#0090d9}
	#navigation,footer,#h1.page_title{background-color:#1b1e24}
	.sticky{background-color:}a:hover, a.post_more_link,#sidebar .article_heading a:hover,.post_nav_module .previous_post a:hover, .post_nav_module .next_post a:hover,.post_meta a:hover,#submit, input[type="submit"], input[type="reset"], input[type="button"]{color:#0090d9}#submit, input[type="submit"], input[type="reset"], input[type="button"], #buddypress #item-nav ul li a:hover, #buddypress #item-nav ul li a:hover span, #buddypress #item-nav ul li.selected a span{border-color:#0090d9!important}
	.button:hover,button:hover,a.button_link:hover,input[type="submit"]:hover,input[type="reset"]:hover,input[type="button"]:hover,#submit:hover,.styled_button:hover,.button_link:hover,.button:hover,#searchsubmit:hover,#buddypress #item-nav ul li a:hover,#buddypress #item-nav ul li.current a,footer .widget_wysija_cont .wysija-submit,.post_meta_bottom .meta_post_tag a:hover,a.gtc:hover,#buddypress #activity-stream .activity-meta a:hover{background-color:#0090d9}
	.meta_category a:hover, body.single_post #main .single_post_meta .meta_date a:hover{background-color:#0090d9!important}
	.widget_tag_cloud a:hover{color:#0090d9}
	.post_meta_bottom .meta_post_tag a:hover:before{border-right:8px solid #0090d9}
	.fade-in{opacity:0}.blog_layout2 .article_list_image img{width:px;height:px}::selection{background-color:#8e44ad}
	#navigation{background-color:#2c3e50}.main_navigation ul ul{background-color:#1b1e24}
	.main_navigation ul ul:before{border-color:transparent transparent #1b1e24 transparent}
	.main_navigation ul ul ul{background-color:#1b1e24}
	.main_navigation ul ul ul:before{border-color:transparent #1b1e24 transparent transparent}
	.main_navigation li.current_page_item > a,.main_navigation a:hover, .main_navigation li:hover{background:#066287}
	.nt-icon-search:hover, .nt-search.nt-search-open .nt-icon-search{background-color:#d35400;color:#fff}
	footer{background-color:#1b1e24}
	.article_grid_image,.article_list_image,.single_post_image{background-color:#c0392b}
	h1.page_title{background-color:#1b1e24}
	#review-box .progress-bar, .review-item-box .progress-bar{background-color:#0090d9}
	.review-item i, .user-rate-wrap i{color:#0090d9}
	#review-box{background:#fff;border:1px solid rgba(0,0,0,.3)!important;color:rgba(0,0,0,.66)}
	#review-box .review-summary{border-top:1px solid rgba(0,0,0,.1)!important;border-bottom:1px solid rgba(0,0,0,.1)!important}
	#review-box .review-summary .review-final-score h3{color:rgba(0,0,0,1)}
	#review-box .progress{background-color:rgba(0,0,0,.1)}
	#review-box h2{color:rgba(0,0,0,.9)}
	#review-box h5{color:rgba(0,0,0,.75)}
	#main #review-box h4{color:rgba(0,0,0,.75)}h1, h2, h2 a, h3, h3 a, h4:not(.widgettitle), h4 a, h5, h5 a, .author_name, .article_heading a, .videoGallery .slider_title, .flex-caption .slider_title,.post_nav_module .previous_post a, .post_nav_module .next_post a, .buddypress.widget .item-title a, #buddypress #activity-stream .activity-content .activity-header p a:nth-child(2), #buddypress #activity-stream .activity-content .activity-header p a:nth-child(3), .buddypress.widget .bp-login-widget-user-link a, li.bbp-forum-info .bbp-forum-title, li.bbp-topic-title .bbp-topic-permalink{font-family:"Raleway", sans-serif}
	#navigation{font-family:"Open Sans", sans-serif}.uneditable-input,textarea,input[type="text"],input[type="password"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="number"],input[type="email"],input[type="url"],input[type="search"],input[type="tel"],input[type="color"],#nt_slider .flex-caption .slider_desc,.about_author_title, #reply-title, #related_module, #comments_title,.button, button, a.button_link, a.post_more_link, #submit, input[type="submit"], input[type="reset"], input[type="button"], #buddypress #item-nav ul li a:hover,a.post_more_link, .social-count-plus .count, .post_meta .meta_comments, .post_meta .meta_comments a, .featured_tabs li a, .infoBlock .slider_title, h4.widgettitle, .widgettitle span,.post_meta_bottom .meta_post_tag a, .post_nav_module .previous_post a span, .post_nav_module .next_post a span,footer .gazette_logo, .logo a.site_logo .gazette_logo, textarea, input[type="text"], input[type="password"], input[type="datetime"], input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], input[type="week"], input[type="number"], input[type="email"], input[type="url"], input[type="search"], input[type="tel"], input[type="color"],.textfield, .password, .textarea, #s, #comment, #main h4, .comment-text .date, #buddypress .generic-button a, .comment-text cite, .comment-text cite a, .item_meta, .post_meta, .item_meta a, .post_meta a, #sidebar .buddypress.widget .item-options a, #buddypress .item-list-tabs ul li a{font-family:"Roboto Condensed", "Helvetica Neue", Helvetica, Arial, sans-serif}
	body, textarea,input[type="text"],input[type="password"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="number"],input[type="email"],input[type="url"],input[type="search"],input[type="tel"],input[type="color"],.textfield,.password,.textarea,#s,#comment{font-family:"Open Sans", Helvetica, Arial, sans-serif}
	#main h4:before, footer .widgettitle:before, h1.page_title:before, #sidebar h4.widgettitle:before, .about_author_title:before, #reply-title:before, #comments_title:before{content:"|||"}
	.main_navigation ul li a{font-weight:700}.article_list_image .meta_category, .article_grid_image .meta_category{position:absolute;top:0;left:0}
	#sidebar .meta_category, footer .meta_category{padding:0;top:10px;left:10px}
	.single_post_image .meta_category{position:absolute;left:20px;top:20px}
	.videoGallery .rsThumb.rsNavSelected, #content-slider .rsNavSelected{background-color:#0090d9!important}
	.videoGallery .rsThumb.rsNavSelected:before{border-color:transparent #0090d9 transparent transparent}
	.rsMinW, .rsMinW .rsOverflow, .rsMinW .rsSlide, .rsMinW .rsVideoFrameHolder, .rsMinW .rsThumbs{background:#fff}
	.rsTmb .slider_title{color:rgba(0,0,0,.85)}
	.videoGallery .rsThumb:hover{background:#fff}
	.rsMinW.rsWithThumbsVer .rsThumbsArrow{background:rgba(0,0,0,.5)}
	.videoGallery .slider_meta{color:rgba(0,0,0,.7)}
	footer .nt_contact_widget .contact_widget_name{color:rgba(255,255,255,.85)!important}
	.footer_links ul{border-top:1px solid rgba(255,255,255,.05)}
	.footer_links li:after{color:rgba(255,255,255,.1)}
	footer .post_meta .meta_date:before, footer .item_meta, footer .post_meta, footer .post_meta a, footer .rss-date{color:rgba(255,255,255,.35)}
	footer h2,footer h2 a,footer h3,footer h3 a,footer h5,footer h5 a,footer h6,footer h6 a{color:#fff}
	footer a{color:rgba(0,0,0,.99)}
	footer a:hover{color:#fff}
	footer .widgettitle{color:rgba(255,255,255,1);border-bottom:1px solid rgba(255,255,255,.15)}
	footer .article_heading a{color:rgba(255,255,255,.8)!important}
	footer{color:rgba(0,0,0,.99)}
	footer .widget_tag_cloud a{color:rgba(255,255,255,.45)}
	footer .gazette_logo, footer .widget_tag_cloud a:hover{color:#fff}
	#sub_footer{color:rgba(255,255,255,.4)}
	#sub_footer a{color:rgba(0,0,0,.99)}
	.fade-in,.appeared{-webkit-transition-property:-webkit-transform,opacity;-moz-transition-property:-moz-transform,opacity;-ms-transition-property:-ms-transform,opacity;-o-transition-property:-o-transform,opacity;transition-property:transform,opacity;-webkit-transition-duration:.8s;-moz-transition-duration:.8s;-ms-transition-duration:.8s;-o-transition-duration:.8s;transition-duration:.8s}
	.fade-in{-webkit-transform:translate(0px,100px);-moz-transform:translate(0px,100px);-o-transform:translate(0px,100px);-ms-transform:translate(0px,100px);transform:translate(0px,100px)}
	.appeared{-webkit-transform:translate(0,0);-moz-transform:translate(0,0);-o-transform:translate(0,0);-ms-transform:translate(0,0);transform:translate(0,0)}
	#breadcrumbs a:hover{color:#fff;background:#0090d9}
	#breadcrumbs a:hover:after{background:#0090d9}
	#breadcrumbs a:hover:after{box-shadow:1px -1px 0 1px #0090d9}
	#navigation{padding:35px 0}@media (max-width:1023px){.maximize .main_navigation{top:128px}}@media all and (max-width:1023px){.main_navigation, #mobile_menu a:hover, #mobile_menu.active a{background:#2980b9 }}
</style>

<div class="fit-vids-style" id="fit-vids-style" style="display: none;">­
	<style>
		.fluid-width-video-wrapper{width:100%;position:relative;padding:0;}
		.fluid-width-video-wrapper iframe,.fluid-width-video-wrapper object,.fluid-width-video-wrapper embed {position:absolute;top:0;left:0;width:100%;height:100%;}
	</style>
</div>
<!-- <script type="text/javascript">
	/* <![CDATA[ */
		var assetsUri = "http://gazette.seoresearch.com/wp-content/themes/gazette/images/assets",
	        imageNonce = "26da2ab96a";
			document.write('<style type="text/css">.noscript{visibility: hidden;}</style>');
			numina = {"ajaxurl":"http://gazette.seoresearch.com/wp-admin/admin-ajax.php" , "Your_rating":"Your Rating:"};
	/* ]]> */
</script> -->
<style type="text/css">
	.noscript{visibility: hidden;}
</style>
<!-- 	<link rel="alternate" type="application/rss+xml" title="Gazette Magazine » Feed" href="http://gazette.seoresearch.com/feed/">
<link rel="alternate" type="application/rss+xml" title="Gazette Magazine » Comments Feed" href="http://gazette.seoresearch.com/comments/feed/"> -->
<link rel="stylesheet" id="validate-engine-css-css" href="./css/validationEngine.jquery.css" type="text/css" media="all">
<link rel="stylesheet" id="nt_swipebox-css" href="./css/swipebox.css" type="text/css" media="screen">
<link rel="stylesheet" id="bbp-default-css" href="./css/bbpress.css" type="text/css" media="screen">
<link rel="stylesheet" id="bp-parent-css-css" href="./css/buddypress.css" type="text/css" media="screen">
<link rel="stylesheet" id="su-media-shortcodes-css" href="./css/media-shortcodes.css" type="text/css" media="all">
<script type="text/javascript" src="./js/jquery.js"></script>
<script type="text/javascript" src="./js/jquery-migrate.min.js"></script>
<script type="text/javascript" src="./js/widget-members.min.js"></script>
<script type="text/javascript" src="./js/widget-groups.min.js"></script>
<script type="text/javascript" src="./js/jquery.form.js"></script>
<script type="text/javascript" src="./js/jquery.slabtext.min.js"></script>
<script type="text/javascript" src="./js/waypoints.min.js"></script>
<script type="text/javascript" src="./js/jquery.fitvids.js"></script>
<script type="text/javascript" src="./js/slick.min.js"></script>
<!-- <script type="text/javascript">
	/* <![CDATA[ */
		var BP_DTheme = {"accepted":"Accepted","close":"Close","comments":"comments","leave_group_confirm":"Are you sure you want to leave this group?","mark_as_fav":"Favorite","my_favs":"My Favorites","rejected":"Rejected","remove_fav":"Remove Favorite","show_all":"Show all","show_all_comments":"Show all comments for this thread","show_x_comments":"Show all %d comments","unsaved_changes":"Your profile has unsaved changes. If you leave the page, the changes will be lost.","view":"View"};
	/* ]]> */
</script> -->
<script type="text/javascript" src="./js/buddypress.js"></script>
<!-- <script type="text/javascript">
/* <![CDATA[ */
var BP_Confirm = {"are_you_sure":"Are you sure?"};
/* ]]> */
</script> -->
<script type="text/javascript" src="./js/confirm.min.js"></script>
<!-- <script type="text/javascript">
	var ajaxurl = 'http://gazette.seoresearch.com/wp-admin/admin-ajax.php';
</script> -->
<style type="text/css">
	.recentcomments a{display:inline !important;padding:0 !important;margin:0 !important;}
</style>
<script type="text/javascript" src="./lib/js/jquery.bpopup.js"></script>
</head>
<body class="is_loading has_slider slider_royalslider royalslider has_header_social is_home right_sidebar right_sidebar" oncontextmenu="return false;">
<section id="body_inner">
	<div id="preload">
		<div>
			<style>
				#bowlG{position:relative;width:24px;height:24px}
				#bowl_ringG{position:absolute;width:24px;height:24px;border:2px solid #000000;-moz-border-radius:24px;-webkit-border-radius:24px;-ms-border-radius:24px;-o-border-radius:24px;border-radius:24px}
				.ball_holderG{position:absolute;width:6px;height:24px;left:9px;top:0px;-moz-animation-name:ball_moveG;-moz-animation-duration:1.3s;-moz-animation-iteration-count:infinite;-moz-animation-timing-function:linear;-webkit-animation-name:ball_moveG;-webkit-animation-duration:1.3s;-webkit-animation-iteration-count:infinite;-webkit-animation-timing-function:linear;-ms-animation-name:ball_moveG;-ms-animation-duration:1.3s;-ms-animation-iteration-count:infinite;-ms-animation-timing-function:linear;-o-animation-name:ball_moveG;-o-animation-duration:1.3s;-o-animation-iteration-count:infinite;-o-animation-timing-function:linear;animation-name:ball_moveG;animation-duration:1.3s;animation-iteration-count:infinite;animation-timing-function:linear}
				.ballG{position:absolute;left:0px;top:-6px;width:10px;height:10px;background:#FFFFFF;-moz-border-radius:8px;-webkit-border-radius:8px;-ms-border-radius:8px;-o-border-radius:8px;border-radius:8px}@-moz-keyframes ball_moveG{0%{-moz-transform:rotate(0deg)}100%{-moz-transform:rotate(360deg)}}@-webkit-keyframes ball_moveG{0%{-webkit-transform:rotate(0deg)}100%{-webkit-transform:rotate(360deg)}}@-ms-keyframes ball_moveG{0%{-ms-transform:rotate(0deg)}100%{-ms-transform:rotate(360deg)}}@-o-keyframes ball_moveG{0%{-o-transform:rotate(0deg)}100%{-o-transform:rotate(360deg)}}@keyframes ball_moveG{0%{transform:rotate(0deg)}100%{transform:rotate(360deg)}}
			</style>
			<div id="bowlG">
				<div id="bowl_ringG">
					<div class="ball_holderG">
						<div class="ballG"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="clearboth"></div>
	<div id="navigation" class="maximize">
		<div class="container">
			<div class="col12">
				<div class="logo">
					<a rel="home" href="./" title="رهیاب کلینیک">
						<div class="custom_logo">
							<img src="./images/logo.png" style="width:100px;height:auto" alt="کلینیک رهیاب" />
						</div>
					</a>
				</div>
				<span id="mobile_menu" data-effect="st-effect-1">
					<a href=""></a>
				</span>
				
						
					
cd;
	
	
	
	$rows = $db->SelectAll("submenues","*",NULL,"pos ASC,id ASC"); 
	 
	function has_children($rows,$id) 
	{
		foreach ($rows as $row) 
		{
			if ($row['pid'] == $id)
			  return true;
		}
		return false;
	}
	
	function build_menu($rows, $parent=0)
	{
		if ($parent == 0)
		{
			$result = <<<cd
				<div class="main_navigation">
					<ul id="menu-main-nav" class="">
						<li class="index">
							<a href="./">صفحه اصلی</a>
						</li>
cd;
				
		}
	  else $result = "<ul class='sub-menu'>";
	  foreach ($rows as $row)
	  {
		if ($row['pid'] == $parent)
		{
			if ($row['level']==0)
			{	
				if (!has_children($rows, $row['id']))
				{
					$class = " menu-item-has-children'";
				}
				else
				{
					$class = " class='menu_arrow menu-item-has-children'";
				}
					$href="";
			}
			else
			if ($row['level']==1)
			{		if (!has_children($rows, $row['id']))
					{	
						$class = "";
					}
					else
					{
						$class = " class='menu_arrow'";
					}					
					$href=""; 
					if (!has_children($rows, $row['id']))
						$href=" href= 'menues{$row[id]}-{$row[level]}.html' ";
			}
			else
			if ($row['level']==2)
			{
					$class = "";
					$href=" href= 'menues{$row[id]}-{$row[level]}.html' ";
			}
			
		  $result .= "<li$class><a {$href}><span style='display:inline-block;text-align:right;direction:rtl'>{$row['name']}</span></a>";
		  if (has_children($rows, $row['id']))
			$result.= build_menu($rows, $row['id']);
		  $result.= "</li>";
		}
	  }
	  $result.= "</ul>";
	  if ($parent == 0)
		$result .= "</div>";
	  return $result;
	}
	$menues = build_menu($rows);
	//echo $menues;
$hhtml.=<<<cd
				{$menues}
			</div>
		</div>
	</div>
	<div id="scroll_top"><a href="#top"></a></div>	
	<header>
		<div class="container">
			<div class="col12"></div>
		</div>
	</header>
	<div class="container">
		<div id="content">
			<div id="content_inner">
cd;
	echo $hhtml;
?>	