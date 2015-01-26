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
		$row = $db->Select("defclasses","*"," id ={$_GET[id]}");
$html=<<<cd
<b>{$row["title"]}</b>
<hr/>
<br>
	{$row["details"]}
cd;
	}
echo $html;	
	
?>
