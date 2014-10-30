<?php    
	include_once("../config.php");
	include_once("../classes/functions.php");
  	include_once("../classes/messages.php");
  	include_once("../classes/session.php");	
  	include_once("../classes/security.php");
  	include_once("../classes/database.php");	
	include_once("../classes/login.php");
    include_once("../lib/persiandate.php"); 
	
		
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
		if (isset($_POST["cbsm2"]) and $_POST["cbsm2"]!= -1) 
		{
			$pid = $_POST["cbsm2"];
			$level = 3;
		}
		else
		if (isset($_POST["cbsm1"]) and $_POST["cbsm1"]!= -1) 
		{
			$pid = $_POST["cbsm1"];
			$level = 2;
		}
		else
		{
			$pid = 0;
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
		if (isset($_POST["cbsm2"]) and $_POST["cbsm2"]!= -1) 
		{
			$pid = $_POST["cbsm2"];
			$level = 3;
		}
		else
		if (isset($_POST["cbsm1"]) and $_POST["cbsm1"]!= -1) 
		{
			$pid = $_POST["cbsm1"];
			$level = 2;
		}
		else
		{
			$pid = 0;
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
			$menues = $db->SelectAll("menues","*");	
			$cbmenu = DbSelectOptionTag("cbmenu",$menues,"name",NULL,NULL,"form-control",NULL,"  منو  ");
	}
	if ($_GET['act']=="edit")
	{
	    $row=$db->Select("submenues","*","id='{$_GET["smid"]}'",NULL);		
		$insertoredit = "
			<button type='submit' class='btn btn-default'>ویرایش</button>
			<input type='hidden' name='mark' value='editsubmenu' /> ";
		$menues = $db->SelectAll("menues","*");	
		$cbmenu = DbSelectOptionTag("cbmenu",$menues,"name","{$row['mid']}",NULL,"form-control",NULL,"  منو  ");
		if ($row["pid"]!= 0)
		{
			$menues = $db->SelectAll("submenues","*","id={$row['pid']}");	
			$cbsm1 = DbSelectOptionTag("cbsm1",$menues,"name","{$row['pid']}",NULL,"form-control",NULL,"زیر منو");
			if ($menues["pid"]!=0)
			{
				$menues = $db->SelectAll("submenues","*","id={$menues['pid']}");	
				$cbsm2 = DbSelectOptionTag("cbsm2",$menues,"name","{$menues['pid']}",NULL,"form-control",NULL,"زیر منو");
			}
		}
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
                <form id="frmsubmenu" name="frmsubmenu" action="" method="post" 
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
                                    </div>
                                    <div class="panel-body">
                                        {$cbmenu}
										<div id="sm1">
											{$cbsm1}
										</div>
                                        <div id="sm2">
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
$rows = $db->SelectAll("submenues","*",NULL,"id ASC");
$vals = array();
for($i = 0; $i < Count($rows); $i++)
{
$rownumber = $i+1;
$html.=<<<cd
							<tr>
								<td>{$rownumber}</td>
								<td>{$rows[$i]["name"]}</td>
								<td>
cd;
$vals = "";
if ($rows[$i]['pid']!=0)
{
	$row = $db->Select("submenues","*","id={$rows[$i]['pid']}","id ASC");	
	if ($row["pid"]==0) {$vals[] = "";}
	$vals[] = $row["name"];
	
	
	while($row["pid"]!=0)
	{
		$row = $db->Select("submenues","*","id={$row['pid']}","id ASC");
		$vals[] = $row["name"];
	}
    
	$row = $db->Select("menues","*","id={$rows[$i]['mid']}","id ASC");	
	$vals[] = $row["name"];
}
else
{
		$row = $db->Select("menues","*","id={$rows[$i]['mid']}","id ASC");	
		$vals[] = "";
		$vals[] = "";
		$vals[] = $row["name"];
}	
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
$html.=<<<cd
                                            </tbody>
                                        </table>
                                    </div>
                                    <!--Table Wrapper Finish-->
                                    <div class="dataTables_paginate paging_full_numbers" id="ls-editable-table_paginate">
                                        <a class="paginate_button first disabled" aria-controls="ls-editable-table" tabindex="0" id="ls-editable-table_first">اولین</a>
                                        <a class="paginate_button previous disabled" aria-controls="ls-editable-table" tabindex="0" id="ls-editable-table_previous">قبلی</a>
                                        <span>
                                            <a class="paginate_button current" aria-controls="ls-editable-table" tabindex="0">1</a>
                                            <a class="paginate_button " aria-controls="ls-editable-table" tabindex="0">2</a>
                                            <a class="paginate_button " aria-controls="ls-editable-table" tabindex="0">3</a>
                                            <a class="paginate_button " aria-controls="ls-editable-table" tabindex="0">4</a>
                                            <a class="paginate_button " aria-controls="ls-editable-table" tabindex="0">5</a>
                                            <a class="paginate_button " aria-controls="ls-editable-table" tabindex="0">6</a>
                                        </span>
                                        <a class="paginate_button next" aria-controls="ls-editable-table" tabindex="0" id="ls-editable-table_next">بعدی</a>
                                        <a class="paginate_button last" aria-controls="ls-editable-table" tabindex="0" id="ls-editable-table_last">آخرین</a>
                                    </div>
                                    <div class="dataTables_info" id="ls-editable-table_info" role="alert" aria-live="polite" aria-relevant="all">نمایش 1 تا 10 از 577 فیلد</div>
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
						
						$("#cbsm1").change(function(){
							var id= $(this).val();
							$.get('./ajaxcommand.php?smid2='+id,function(data) {			
								$('#sm2').html(data);
							});
						});			
				});
			});			
		
			
		});
	</script>
cd;
	include_once("./inc/header.php");
	echo $html;
    include_once("./inc/footer.php");
?>