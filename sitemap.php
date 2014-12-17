<?php
    include_once("./config.php");
    include_once("./classes/database.php");	
	include_once("./classes/functions.php");
	
	$db = Database::GetDatabase();
	header("Content-Type: application/xml; charset=utf-8");
    $sm = '<?xml version="1.0" encoding="UTF-8"?>
    <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
    
	$news = $db->SelectAll("news","*",null,"id ASC");
	
	$add ="http://www.rahyabclinic.com/" ;

	$sm .="
	<url>
	  <loc>http://www.rahyabclinic.com/</loc>
	</url>
	<url>
	  <loc>http://www.rahyabclinic.com/about-us.html</loc>
	</url>
	<url>
	  <loc>http://www.rahyabclinic.com/news.html</loc>
	</url>
	<url>
	  <loc>http://www.rahyabclinic.com/article.html</loc>
	</url>
	<url>
	  <loc>http://www.rahyabclinic.com/contactus.html</loc>
	</url>
	<url>
	  <loc>http://www.rahyabclinic.com/class.html</loc>
	</url>
	<url>
	  <loc>http://www.rahyabclinic.com/conferences.html</loc>
	</url>
	<url>
	  <loc>http://www.rahyabclinic.com/exam.html</loc>
	</url>
	<url>
	  <loc>http://www.rahyabclinic.com/faq.html</loc>
	</url>
	<url>
	  <loc>http://www.rahyabclinic.com/gallery.html</loc>
	</url>
	<url>
	  <loc>http://www.rahyabclinic.com/healthgroup.html</loc>
	</url>
	<url>
	  <loc>http://www.rahyabclinic.com/membership.html</loc>
	</url>
	<url>
	  <loc>http://www.rahyabclinic.com/one-article.html</loc>
	</url>
	<url>
	  <loc>http://www.rahyabclinic.com/one-news.html</loc>
	</url>
	<url>
	  <loc>http://www.rahyabclinic.com/one-gallery.html</loc>
	</url>
";
	$date = date("Y-m-d");	

	foreach($news as $key=>$val)
	{
		//$date = date("Y-m-dTH:i:s+00:00",$val['ndate']);
		//$date = date("D, d M Y H:i:s T");
		$sm.=<<<cd
		<url>
			<loc>{$add}one-news{$val["id"]}.html</loc>
			<lastmod>{$date}</lastmod>
			<changefreq>daily</changefreq>
			<priority>0.8</priority>
        </url>    		
cd;
	}
			
    $sm.= "</urlset>";
	echo $sm;