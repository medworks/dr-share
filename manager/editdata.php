<?php
	include_once("../config.php");
	include_once("../classes/functions.php");
  	include_once("../classes/messages.php");
  	include_once("../classes/session.php");	
  	include_once("../classes/security.php");
  	include_once("../classes/database.php");	
	include_once("../classes/login.php");
    include_once("../lib/persiandate.php"); 
	include_once("../lib/Zebra_Pagination.php"); 
	
	
	$login = Login::GetLogin();
    if (!$login->IsLogged())
	{
		header("Location: ../index.php");
		die(); // solve a security bug
	} 
	$db = Database::GetDatabase(); 
	if ($_GET['act']=="del")
	{
		$db->Delete("menusubjects"," id",$_GET["did"]);		
		header('location:editdata.php?act=new');	
	}		
    
$html.=<<<cd
    <!--Page main section start-->
    <section id="min-wrapper">
        <div id="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!--Top header start-->
                        <h3 class="ls-top-header">ویرایش اطلاعات</h3>
                        <!--Top header end -->
                        <!--Top breadcrumb start -->
                        <ol class="breadcrumb">
                            <li><a href="javascript:void(0);"><i class="fa fa-home"></i></a></li>
                            <li class="active">ویرایش اطلاعات</li>
                        </ol>
                        <!--Top breadcrumb start -->
                    </div>
                </div>
                <!-- Main Content Element  Start-->
                <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">لیست اطلاعات</h3>
                                </div>
                                <div class="panel-body">
                                    <!--Table Wrapper Start-->
                                    <div class="table-responsive ls-table">
                                        <div id="ls-editable-table_filter" class="dataTables_filter">
                                            <label>جستجو:<input type="search" class="" aria-controls="ls-editable-table"></label>
                                        </div>
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
											<th>#</th>
                                                <th>عنوان</th>
                                                <!-- <th>متن</th> -->
                                                <th>منو و زیر منو</th>
                                                <th class="text-center">عملیات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
cd;

	$records_per_page = 10;
	$pagination = new Zebra_Pagination();

	$pagination->navigation_position("right");

	$reccount = $db->CountAll("menusubjects");
	$pagination->records($reccount); 
	
    $pagination->records_per_page($records_per_page);	

$rows = $db->SelectAll("menusubjects",
			"*",
			NULL,
			"id ASC",
			($pagination->get_page() - 1) * $records_per_page,
			$records_per_page);
				
	

	function getparrents($db,$child_id)
	{
	  $ids = array();	  
	  //$ids[] = $child_id;
	  //$db = Database::GetDatabase();	  	  
	  $db->cmd="select * from `submenues` WHERE `id` = {$child_id}";
	  $res=$db->RunSQL($sql);
	  $mrow = mysqli_fetch_array($res);	
		//echo $mrow["pid"],"\n";
	  while($mrow["pid"]!=0)
	  {			
		  $ids[] = $mrow["id"];
		 // echo $mrow["pid"],"\n";
		  $db->cmd="select * from `submenues` WHERE `id` = {$mrow['pid']}";
		  $res=$db->RunSQL($sql);                          
		  $mrow = mysqli_fetch_array($res);
		 // mysqli_free_result($res);	
  		 
	  }
	  if (count($ids)==1)
		$ids[]="";
	  $ids[] = $mrow["id"];
	  return $ids;
	}
	
	function getparrentsname($db,$child_id)
	{
	  $ids = array();	  
	  //$ids[] = $child_id;
	  //$db = Database::GetDatabase();	  	  
	  $db->cmd="select * from `submenues` WHERE `id` = {$child_id}";
	  $res=$db->RunSQL($sql);
	  $mrow = mysqli_fetch_array($res);	
		//echo $mrow["pid"],"\n";
	  while($mrow["pid"]!=0)
	  {			
		  $ids[] = $mrow["name"];
		 // echo $mrow["pid"],"\n";
		  $db->cmd="select * from `submenues` WHERE `id` = {$mrow['pid']}";
		  $res=$db->RunSQL($sql);                          
		  $mrow = mysqli_fetch_array($res);
		 // mysqli_free_result($res);	
  		 
	  }
	  if (count($ids)==1)
		$ids[]=null;
	  $ids[] = $mrow["name"];
	  return $ids;
	}
	

$vals = array();
for($i = 0; $i < Count($rows); $i++)
{
	$rownumber = $i+1;
	$rows[$i]["subject"] =(mb_strlen($rows[$i]["subject"])>30)?mb_substr($rows[$i]["subject"],0,30,"UTF-8")."...":$rows[$i]["subject"];
	$rows[$i]["text"] =(mb_strlen($rows[$i]["text"])>20)?mb_substr($rows[$i]["text"],0,20,"UTF-8")."...":$rows[$i]["text"];
	$vals =  getparrentsname($db,$rows[$i]["smid"]);
$html.=<<<cd

                                                
                                            <tr>
                                                <td>{$rownumber}</td>
                                                <td>{$rows[$i]["subject"]}</td>
                                                <!-- <td>{$rows[$i]["text"]}</td> -->
                                                <td>
                                                    <span class="label label-success">{$vals[2]}</span>
                                                    <span class="label label-info">{$vals[1]}</span>
                                                    <span class="label label-warning">{$vals[0]}</span>                        
                                                </td>
                                                <td class="text-center">
												<a href="dataentry.php?act=edit&did={$rows[$i]["id"]}"  >					
                                                    <button class="btn btn-xs btn-warning" title="ویرایش"><i class="fa fa-pencil-square-o"></i></button>
												</a>
												<a href="?act=del&did={$rows[$i]["id"]}"  >												
                                                    <button class="btn btn-xs btn-danger" title="پاک کردن"><i class="fa fa-minus"></i></button>
												</a>	
                                                </td>
                                            </tr>
cd;
}

	$pgcodes = $pagination->render(true);
	//var_dump($pagination);
$html.=<<<cd
                                            </tbody>
                                        </table>
                                    </div>
									{$pgcodes}
                                    <!--Table Wrapper Finish-->                                    
                                </div>
                            </div>
                        </div>
                    </div>           
                <!-- Main Content Element  End-->
            </div>
        </div>
    </section>
    <!--Page main section end -->
cd;
	include_once("./inc/header.php");
	echo $html;
    include_once("./inc/footer.php");
?>