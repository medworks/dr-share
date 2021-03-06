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
	if ($_POST["mark"]=="savehealth")
	{
		$fields = array("`subject`","`text`");		
		$values = array("'{$_POST[edtsubject]}'","'{$_POST[edttext]}'");	
		if (!$db->InsertQuery('health',$fields,$values)) 
		{			
			header('location:healthgroup.php?act=new&msg=2');			
		} 	
		else 
		{  										
			header('location:healthgroup.php?act=new&msg=1');
		}  		
	}
	else
	if ($_POST["mark"]=="edithealth")
	{			    
		$values = array("`subject`"=>"'{$_POST[edtsubject]}'",						
		                "`text`"=>"'{$_POST[edttext]}'");
        $db->UpdateQuery("health",$values,array("id='{$_GET["hid"]}'"));		
		header('location:healthgroup.php?act=new&msg=1');
	}	
	if ($_GET['act']=="new")
	{
		$insertoredit = "
			<button type='submit' class='btn btn-default'>ثبت</button>
			<input type='hidden' name='mark' value='savehealth' /> ";
	}
	if ($_GET['act']=="edit")
	{
	    $row=$db->Select("health","*","id='{$_GET["hid"]}'",NULL);		
		$insertoredit = "
			<button type='submit' class='btn btn-default'>ویرایش</button>
			<input type='hidden' name='mark' value='edithealth' /> ";
	}
	if ($_GET['act']=="del")
	{
		$db->Delete("health"," id",$_GET["hid"]);		
		header('location:healthgroup.php?act=new');	
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
                        <h3 class="ls-top-header">تعریف گروه درمانی</h3>
                        <!--Top header end -->
                        <!--Top breadcrumb start -->
                        <ol class="breadcrumb">
                            <li><a href="javascript:void(0);"><i class="fa fa-home"></i></a></li>
                            <li class="active">تعریف گروه درمانی</li>
                        </ol>
                        <!--Top breadcrumb start -->
                    </div>
                </div>
                <!-- Main Content Element  Start-->
                    <form action="" method="post" id="frmexam" class="form-inline ls_form" role="form">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">نام پزشک</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <input id="edtsubject" name="edtsubject" type="text" class="form-control" placeholder="اسم" value="{$row['subject']}"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">متن</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row ls_divider last">
                                            <div class="col-md-10 ls-group-input">
                                                <textarea class="animatedTextArea form-control " id="edttext" name="edttext"> {$row["text"]}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">ثبت اطلاعات</h3>
                                    </div>
                                    <div class="panel-body">
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
                                    <h3 class="panel-title">لیست گروه درمان</h3>
                                </div>
                                <div class="panel-body">
                                    <!--Table Wrapper Start-->
                                    <div class="table-responsive ls-table">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>ردیف</th>
                                                    <th> نام </th>                                                 
                                                    <th>عملیات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
cd;
$rows = $db->SelectAll("health","*",NULL," id ASC");
for($i = 0; $i < Count($rows); $i++)
{
$rownumber = $i+1;
$html.=<<<cd
<tr>
	<td>{$rownumber}</td>
	<td>{$rows[$i]["subject"]}</td>
	<td>
		<ul class="ls-glyphicons-list">
			<li>
				<a href="?act=del&hid={$rows[$i]["id"]}" title="پاک کردن" style="margin-left:5px"><span class="glyphicon glyphicon-remove"></span></a>
				<a href="?act=edit&hid={$rows[$i]["id"]}" title="ویرایش"><span class="glyphicon glyphicon-edit"></span></a>
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