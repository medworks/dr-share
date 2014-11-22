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
	if ($_POST["mark"]=="saveexam")
	{
		$fields = array("`subject`","`text`");		
		$values = array("'{$_POST[edtsubject]}'","'{$_POST[edttext]}'");	
		if (!$db->InsertQuery('exam',$fields,$values)) 
		{			
			header('location:exammgr.php?act=new&msg=2');			
		} 	
		else 
		{  										
			header('location:exammgr.php?act=new&msg=1');
		}  		
	}
	else
	if ($_POST["mark"]=="editexam")
	{			    
		$values = array("`subject`"=>"'{$_POST[edtsubject]}'",						
		                "`text`"=>"'{$_POST[edttext]}'");
        $db->UpdateQuery("exam",$values,array("id='{$_GET["eid"]}'"));		
		header('location:exammgr.php?act=new&msg=1');
	}	
	if ($_GET['act']=="new")
	{
		$insertoredit = "
			<button type='submit' class='btn btn-default'>ثبت</button>
			<input type='hidden' name='mark' value='saveexam' /> ";
	}
	if ($_GET['act']=="edit")
	{
	    $row=$db->Select("exam","*","id='{$_GET["eid"]}'",NULL);		
		$insertoredit = "
			<button type='submit' class='btn btn-default'>ویرایش</button>
			<input type='hidden' name='mark' value='editexam' /> ";
	}
	if ($_GET['act']=="del")
	{
		$db->Delete("exam"," id",$_GET["eid"]);		
		header('location:exammgr.php?act=new');	
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
                        <h3 class="ls-top-header">تعریف آزمون ها</h3>
                        <!--Top header end -->
                        <!--Top breadcrumb start -->
                        <ol class="breadcrumb">
                            <li><a href="admin.php"><i class="fa fa-home"></i></a></li>
                            <li class="active">تعریف آزمون</li>
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
                                    <h3 class="panel-title">تعریف آزمون</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <input id="edtsubject" name="edtsubject" type="text" class="form-control" placeholder="اسم آزمون" value="{$row['subject']}"/>
                                    </div>
                                    <div class="col-md-10 ls-group-input">
                                            <textarea class="animatedTextArea form-control " id="edttext" name="edttext"> {$row["text"]}</textarea>
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
                                    <h3 class="panel-title">لیست آزمون ها</h3>
                                </div>
                                <div class="panel-body">
                                    <!--Table Wrapper Start-->
                                    <div class="table-responsive ls-table">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>ردیف</th>
                                                    <th> نام آزمون</th>                                                 
                                                    <th>عملیات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
cd;
$rows = $db->SelectAll("exam","*",NULL," id ASC");
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
				<a href="?act=del&eid={$rows[$i]["id"]}" title="پاک کردن" style="margin-left:5px"><span class="glyphicon glyphicon-remove"></span></a>
				<a href="?act=edit&eid={$rows[$i]["id"]}" title="ویرایش"><span class="glyphicon glyphicon-edit"></span></a>
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