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
	if ($_POST["mark"]=="savemenu")
	{
		$fields = array("`name`","`level`","`pos`");		
		$values = array("'{$_POST[edtname]}'","0","'{$_POST[edtpos]}'");	
		if (!$db->InsertQuery('submenues',$fields,$values)) 
		{			
			header('location:menu.php?act=new&msg=2');			
		} 	
		else 
		{  										
			header('location:menu.php?act=new&msg=1');
		}  		
	}
	else
	if ($_POST["mark"]=="editmenu")
	{			    
		$values = array("`name`"=>"'{$_POST[edtname]}'",
						"`level`"=>"0",
		                "`pos`"=>"'{$_POST[edtpos]}'");
        $db->UpdateQuery("submenues",$values,array("id='{$_GET["mid"]}'"));		
		header('location:menu.php?act=new&msg=1');
	}	
	if ($_GET['act']=="new")
	{
		$insertoredit = "
			<button type='submit' class='btn btn-default'>ثبت</button>
			<input type='hidden' name='mark' value='savemenu' /> ";
	}
	if ($_GET['act']=="edit")
	{
	    $row=$db->Select("submenues","*","id='{$_GET["mid"]}'",NULL);		
		$insertoredit = "
			<button type='submit' class='btn btn-default'>ویرایش</button>
			<input type='hidden' name='mark' value='editmenu' /> ";
	}
	if ($_GET['act']=="del")
	{
		$db->Delete("submenues"," id",$_GET["mid"]);		
		header('location:menu.php?act=new');	
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
                            <li class="active">تعریف منو</li>
                        </ol>
                        <!--Top breadcrumb start -->
                    </div>
                </div>
                <!-- Main Content Element  Start-->
                <form action="" method="post" id="frmmenu" class="form-inline ls_form" role="form">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">تعریف منو</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <input id="edtname" name="edtname" type="text" class="form-control" placeholder="اسم منو" value="{$row['name']}"/>
                                    </div>
                                    <div class="form-group">
                                        <input id="edtpos" name="edtpos"  type="text" class="form-control" placeholder="ترتیب" value="{$row['pos']}" />
                                    </div>
                                    {$insertoredit}
                                </div>
                            </div>
                        </div>
                    </div>
					</form>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">لیست منو ها</h3>
                                </div>
                                <div class="panel-body">
                                    <!--Table Wrapper Start-->
                                    <div class="table-responsive ls-table">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>ردیف</th>
                                                    <th>نام منو</th>
                                                    <th>ترتیب</th>
                                                    <th>عملیات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
cd;
$rows = $db->SelectAll("submenues","*"," `pid` = 0"," pos,id ASC");
for($i = 0; $i < Count($rows); $i++)
{
$rownumber = $i+1;
$html.=<<<cd
<tr>
	<td>{$rownumber}</td>
	<td>{$rows[$i]["name"]}</td>
	<td>{$rows[$i]["pos"]}</td>
	<td>
		<ul class="ls-glyphicons-list">
			<li>
				<a href="?act=del&mid={$rows[$i]["id"]}" title="پاک کردن" style="margin-left:5px"><span class="glyphicon glyphicon-remove"></span></a>
				<a href="?act=edit&mid={$rows[$i]["id"]}" title="ویرایش"><span class="glyphicon glyphicon-edit"></span></a>
			</li>
		</ul>
	</td>
</tr>
cd;
}
$html.=<<<cd
</tbody>
</table>
</div>
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