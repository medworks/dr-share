<?php    
	include_once("../config.php");
	include_once("../classes/functions.php");
  	include_once("../classes/messages.php");
  	include_once("../classes/session.php");	
  	include_once("../classes/security.php");
  	include_once("../classes/database.php");	
	include_once("../classes/login.php");
    include_once("../lib/persiandate.php"); 
	
	$db = Database::GetDatabase();
	
	$login = Login::GetLogin();
    if (!$login->IsLogged())
	{
		header("Location: ../index.php");
		die(); // solve a security bug
	}
	if ($_POST["mark"]=="savesubmenu")
	{
		$fields = array("`mid`","`pid`","`name`","`level`");		
		$values = array("'{$_POST[cbmenu]}'","'0'","'{$_POST[edtname]}'","'0'");	
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
		$values = array("`mid`"=>"'{$_POST[cbmenu]}'",
						"`pid`"=>"'0'",
						"`name`"=>"'{$_POST[edtname]}'",
		                "`level`"=>"'0'");
        $db->UpdateQuery("submenues",$values,array("id='{$_GET["smid"]}'"));		
		header('location:submenu.php?act=new&msg=1');
	}	
	if ($_GET['act']=="new")
	{
		$insertoredit = "
			<button type='submit' class='btn btn-default'>ثبت</button>
			<input type='hidden' name='mark' value='savesubmenu' /> ";
	}
	if ($_GET['act']=="edit")
	{
	    $row=$db->Select("submenues","*","id='{$_GET["smid"]}'",NULL);		
		$insertoredit = "
			<button type='submit' class='btn btn-default'>ویرایش</button>
			<input type='hidden' name='mark' value='editsubmenu' /> ";
	}
	if ($_GET['act']=="del")
	{
		$db->Delete("submenues"," id",$_GET["smid"]);		
		header('location:menu.php?act=new');	
	}	
	$msgs = GetMessage($_GET['msg']);
	
	$menues = $db->SelectAll("menues","*");	
	$cbmenu = DbSelectOptionTag("cbmenu",$menues,"name",NULL,NULL,"form-control",NULL,"منو");
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
                                        <input id="edtname" name="edtname" type="text" class="form-control" placeholder="اسم زیر منو" />
                                    </div>
                                    <div class="panel-body">
                                        {$cbmenu}
                                        <select class="form-control">
                                            <option value="">زیر منو</option>
                                            <option value="">Default select</option>
                                            <option value="">Default select</option>
                                        </select>
                                        <select class="form-control">
                                            <option value="">زیر منو</option>
                                            <option value="">Default select</option>
                                            <option value="">Default select</option>
                                        </select>
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
                                    <h3 class="panel-title">ویرایش زیر منو</h3>
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
                                                <th>نام زیرمنو</th>
                                                <th>منو و زیر منو</th>
                                                <th class="text-center">عملیات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>PSD Design</td>
                                                <td>
                                                    <span class="label label-success">خانواده</span>
                                                    <span class="label label-info">ازدواج</span>
                                                    <span class="label label-warning">مشکلات ازدواج</span>
                                                    <span class="label label-danger">مشکلات...</span>
                                                </td>
                                                <td class="text-center">
                                                    <button class="btn btn-xs btn-warning" title="ویرایش"><i class="fa fa-pencil-square-o"></i></button>
                                                    <button class="btn btn-xs btn-danger" title="پاک کردن"><i class="fa fa-minus"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>PSD</td>
                                                <td>
                                                    <span class="label label-success">خانواده</span>
                                                    <span class="label label-info">ازدواج</span>
                                                    <span class="label label-warning">مشکلات ازدواج</span>
                                                    <span class="label label-danger">مشکلات...</span>
                                                </td>
                                                <td class="text-center">
                                                    <button class="btn btn-xs btn-warning" title="ویرایش"><i class="fa fa-pencil-square-o"></i></button>
                                                    <button class="btn btn-xs btn-danger" title="پاک کردن"><i class="fa fa-minus"></i></button>
                                                </td>
                                            </tr>
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
cd;
	include_once("./inc/header.php");
	echo $html;
    include_once("./inc/footer.php");
?>