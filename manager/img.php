<?php
    include_once("../config.php");
	include_once("../classes/functions.php");
  	include_once("../classes/security.php");
  	include_once("../classes/database.php");	

	$db = Database::GetDatabase();
//	$db->cmd = "SELECT * FROM `pics` WHERE `sid`= {$_GET[did]}" ;		
	//$res = $db->RunSQL();
	//while($row = mysqli_fetch_assoc($res)) 
	//{
	//	$img = $row["img1"];
	//}
    $pic = $db->Select("pics","*","`sid`='{$_GET[did]}'",NULL);
	//echo $db->cmd;
	header("Content-type: {$pic['itype']}");
	//{$pic['itype']}
	//echo base64_decode($pic['img']);
	echo $pic["img"];
	//echo $img;
?>