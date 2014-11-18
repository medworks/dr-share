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
	if ($_POST["mark"]=="savesubmenu")
	{
		$fields = array("`mid`","`pid`","`name`","`level`");		
		
		if (isset($_POST["cbsm1"]) and $_POST["cbsm1"]!= -1) 
		{
			$pid = $_POST["cbsm1"];
			$level = 2;
		}
		else
		{
			$pid = $_POST["cbmenu"];
			$level = 1;
		}
		$values = array("'{$_POST[cbmenu]}'","'{$pid}'","'{$_POST[edtname]}'","'{$level}'");	
		if (!$db->InsertQuery('submenues',$fields,$values)) 
		{			
			header('location:submenu.php?act=new&msg=2');			
		} 	
		else 
		{  										
			header('location:submenu.php?act=new&msg=1');
		}  		
	}
	else
	if ($_POST["mark"]=="editsubmenu")
	{		
		
		if (isset($_POST["cbsm1"]) and $_POST["cbsm1"]!= -1) 
		{
			$pid = $_POST["cbsm1"];
			$level = 2;
		}
		else
		{
			$pid = $_POST["cbmenu"];
			$level = 1;
		}
		$values = array("`mid`"=>"'{$_POST[cbmenu]}'",
						"`pid`"=>"'{$pid}'",
						"`name`"=>"'{$_POST[edtname]}'",
		                "`level`"=>"'{$level}'");
        $db->UpdateQuery("submenues",$values,array("id='{$_GET["smid"]}'"));		
		header('location:submenu.php?act=new&msg=1');
	}	
	if ($_GET['act']=="new")
	{
		$insertoredit = "
			<button type='submit' class='btn btn-default'>ثبت</button>
			<input type='hidden' name='mark' value='savesubmenu' /> ";
			$menues = $db->SelectAll("submenues","*","pid = 0");	
			$cbmenu = DbSelectOptionTag("cbmenu",$menues,"name",NULL,NULL,"form-control",NULL,"  منو  ");
	}
	
	
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
	
	if ($_GET['act']=="edit")
	{
	    $row=$db->Select("submenues","*","id='{$_GET["smid"]}'",NULL);
		$insertoredit = "
			<button type='submit' class='btn btn-default'>ویرایش</button>
			<input type='hidden' name='mark' value='editsubmenu' /> ";
		//echo $row["pid"],"\n";
		$pids =  getparrents($db,$row["id"]);		
		$menues = $db->SelectAll("submenues","*","pid = 0");	
		$cbmenu = DbSelectOptionTag("cbmenu",$menues,"name","{$pids[2]}",NULL,"form-control",NULL,"  منو  ");
		
		$menues = $db->SelectAll("submenues","*","pid <> 0");	
		$cbsm1 = DbSelectOptionTag("cbsm1",$menues,"name","{$pids[1]}",NULL,"form-control",NULL,"زیر منو");		
		//$menues = $db->SelectAll("submenues","*","pid <> 0");	
		//$cbsm2 = DbSelectOptionTag("cbsm2",$menues,"name","{$m2}",NULL,"form-control",NULL,"زیر منو");
		
	}
	if ($_GET['act']=="del")
	{
		$db->Delete("submenues"," id",$_GET["smid"]);		
		header('location:submenu.php?act=new');	
	}	
	$msgs = GetMessage($_GET['msg']);
	
	
$html.=<<<cd
    <!--Page main section start-->
    <section id="min-wrapper">
        <div id="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!--Top header start-->
                        <h3 class="ls-top-header">دسته بندی منوها</h3>
                        <!--Top header end -->
                        <!--Top breadcrumb start -->
                        <ol class="breadcrumb">
                            <li><a href="admin.php"><i class="fa fa-home"></i></a></li>
                            <li class="active">تعریف زیر منو</li>
                        </ol>
                        <!--Top breadcrumb start -->
                    </div>
                </div>
                <!-- Main Content Element  Start-->
                <form id="frmsubmenu" class="form-inline ls_form" name="frmsubmenu" action="" method="post" 
				class="form-inline ls_form" role="form">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">تعریف زیر منو</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <input id="edtname" name="edtname" type="text" 
										class="form-control" placeholder="اسم زیر منو" value="{$row['name']}"/>
										{$cbmenu}
										<div id="sm1" style="display:inline-block;">
											{$cbsm1}
										</div>
                                        <div id="sm2" style="display:inline-block;">
											{$cbsm2}
										</div>
                                        {$insertoredit}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">لیست زیر منوها</h3>
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
                                                <th>ردیف</th>
                                                <th>نام زیرمنو</th>
                                                <th>منو و زیر منو</th>
                                                <th class="text-center">عملیات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
cd;

	$records_per_page = 10;
	$pagination = new Zebra_Pagination();

	$pagination->navigation_position("right");

	$reccount = $db->CountAll("submenues");
	$pagination->records($reccount); 
	
    $pagination->records_per_page($records_per_page);	

$rows = $db->SelectAll(
				"submenues",
				"*",
				"pid <> 0",
				"id ASC",
				($pagination->get_page() - 1) * $records_per_page,
				$records_per_page);
				
for($i = 0; $i < Count($rows); $i++)
{
$rownumber = $i+1;
$vals =  getparrentsname($db,$rows[$i]["id"]);
$html.=<<<cd
							<tr>
								<td>{$rownumber}</td>
								<td>{$rows[$i]["name"]}</td>
								<td>
cd;

$html.=<<<cd
            
                                                    <span class="label label-success">{$vals[2]}</span>
                                                    <span class="label label-info">{$vals[1]}</span>
                                                    <span class="label label-warning">{$vals[0]}</span> 
cd;


$html.=<<<cd
                                                </td>
                                                <td class="text-center">													
												   <a href="?act=edit&smid={$rows[$i]["id"]}"  >
                                                    <button type="button" class="btn btn-xs btn-warning" title="ویرایش"><i class="fa fa-pencil-square-o"></i></button>
												   </a>
												   <a href="?act=del&smid={$rows[$i]["id"]}"  >
                                                    <button type="button" class="btn btn-xs btn-danger" title="پاک کردن"><i class="fa fa-minus"></i></button>
												   </a>	
                                                </td>
                                            </tr>
cd;
}

	$pgcodes = $pagination->render(true);
	
$html.=<<<cd
                                            </tbody>
                                        </table>
                                    </div>
                                    <!--Table Wrapper Finish-->
                                    {$pgcodes}
                                </div>
                            </div>
                        </div>
                    </div>
                </form>               
                <!-- Main Content Element  End-->
            </div>
        </div>
    </section>
    <!--Page main section end -->
	<script type="text/javascript">
		$(document).ready(function(){
			$("#cbmenu").change(function(){
				var id= $(this).val();
				$.get('./ajaxcommand.php?smid='+id,function(data) {			
						$('#sm1').html(data);
						/*
						$("#cbsm1").change(function(){
							var id= $(this).val();
							$.get('./ajaxcommand.php?smid2='+id,function(data) {			
								$('#sm2').html(data);
							});
						});	
						*/						
				});
			});			
		
			
		});
	</script>
cd;
	include_once("./inc/header.php");
	echo $html;
    include_once("./inc/footer.php");
?>