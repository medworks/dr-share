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
	
	function upload($db,$did,$mode)
	{
		if(is_uploaded_file($_FILES['userfile']['tmp_name']) && getimagesize($_FILES['userfile']['tmp_name']) != false)
		{    
		    $size = getimagesize($_FILES['userfile']['tmp_name']);      
		    $type = $size['mime'];
		    $imgfp = mysqli_real_escape_string($db->link,file_get_contents($_FILES['userfile']['tmp_name']));
		    //echo $imgfp;
		    $size = $size[3];
		    $name = $_FILES['userfile']['name'];
		    $maxsize = 512000;//512 kb
		    //$db = Database::GetDatabase();
		    //echo $db->cmd;
		    if($_FILES['userfile']['size'] < $maxsize )
		    {    
			//echo "my1";
			//tid 1 is for menu pics, 2 for news pics, 3 for maghalat pics
			if ($mode == "insert")
			{
			    $fields = array("`subject`","`text`","`itype`","`img`","`iname`","`isize`");     
			    $values = array("'{$_POST[edtsubject]}'","'{$_POST[edttext]}'","'{$type}'","'{$imgfp}'","'{$name}'","'{$size}'"); 
			    $db->InsertQuery('exam',$fields,$values);
			   // print_r($values);
			}
			else
			{
			  $imgrow =$db->Select("exam","*","id='{$did}'");
			  if ($imgfp != $imgrow["img"])
			  {
			    $values = array("`subject`"=>"'{$_POST[edtsubject]}'",
										"`text`"=>"'{$_POST[edttext]}'",
										"`itype`"=>"'{$type}'","`img`"=>"'{$imgfp}'",
										"`iname`"=>"'{$name}'","`isize`"=>"'{$size}'");
			    $db->UpdateQuery("exam",$values,array("id='{$did}'")); 
			  } 
			}   
			//echo $db->cmd;
		    }
		    else
		    {        
			throw new Exception("File Size Error");
		    }
		}
		else
		{       
		    throw new Exception("Unsupported Image Format!");
		}
	}   
	
	if ($_POST["mark"]=="saveexam")
	{
		upload($db,$did,"insert");								
		//header('location:exammgr.php?act=new&msg=1');		
	}
	else
	if ($_POST["mark"]=="editexam")
	{			    
		upload($db,$_GET["did"],"edit"); 	
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
                            <li><a href="javascript:void(0);"><i class="fa fa-home"></i></a></li>
                            <li class="active">تعریف آزمون</li>
                        </ol>
                        <!--Top breadcrumb start -->
                    </div>
                </div>
                <!-- Main Content Element  Start-->
                    <form action="" enctype="multipart/form-data" method="post" id="frmexam" class="form-inline ls_form" role="form">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">نام آزمون</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <input id="edtsubject" name="edtsubject" type="text" class="form-control" placeholder="اسم آزمون" value="{$row['subject']}"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
			<div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">انتخاب عکس</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="row ls_divider last">
                                        <div class="form-group">
                                            <div class="col-md-10 col-md-offset-2 ls-group-input">
                                                <input kl_virtual_keyboard_secure_input="on" id="userfile" name="userfile" class="file" multiple="true" data-preview-file-type="any" type="file" />
                                                <input type="hidden" name="MAX_FILE_SIZE" value="512000" />
                                            </div>
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
                                        <h3 class="panel-title">متن</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row ls_divider last">
                                       
                                            <div class="col-md-10 ls-group-input">
                                                <textarea class="animatedTextArea form-control " id="edttext" name="edttext"> {$row["text"]}</textarea>
                                            </div>
                                             <script>
                                                // Replace the <textarea id="editor1"> with a CKEditor
                                                // instance, using default configuration.
                                                CKEDITOR.replace( 'edttext',{
                                                    language: 'fa'
                                                } );
                                            </script>
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