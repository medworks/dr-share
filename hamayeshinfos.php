<?php
	header('Content-Type: text/html; charset=UTF-8');
	
	include_once("./config.php");
	include_once("./classes/functions.php");
  	include_once("./classes/messages.php");
  	include_once("./classes/session.php");	
  	include_once("./classes/security.php");
  	include_once("./classes/database.php");	
	include_once("./classes/login.php");
    include_once("./lib/persiandate.php"); 
	include_once("./lib/Zebra_Pagination.php"); 
	   
	$db = Database::GetDatabase(); 
	
	if (isset($_GET["id"]))
	{
		$row = $db->Select("defhamayesh","*"," id ={$_GET[id]}");
$html=<<<cd
<p style="font-size:22px;text-align:right">{$row["title"]}</p>
<p style="font-size:22px;text-align:right">{$row["subject"]}</p>
<p style="font-size:22px;text-align:right">{$row["period"]}</p>
<p style="font-size:20px;text-align:right">{$row["details"]}</p>

cd;
	}
echo $html;	
	
?>
