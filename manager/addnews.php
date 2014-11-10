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
			$imgfp = mysql_real_escape_string(file_get_contents($_FILES['userfile']['tmp_name']));
			//echo $imgfp;
			$size = $size[3];
			$name = $_FILES['userfile']['name'];
			$maxsize = 512000;//512 kb
			//$db = Database::GetDatabase();
			//echo $db->cmd;
			if($_FILES['userfile']['size'] < $maxsize )
			{    
				//tid 1 is for menu pics, 2 for news pics, 3 for maghalat pics
				if ($mode == "insert")
				{
					$fields = array("`tid`","`sid`","`itype`","`img`","`iname`","`isize`");		
					$values = array("'2'","'{$did}'","'{$type}'","'{$imgfp}'","'{$name}'","'{$size}'");	
					$db->InsertQuery('pics',$fields,$values);
				}
				else
				{
				  $imgrow =$db->Select("pics","*","sid='{$did}'");
				  if ($imgfp != $imgrow["img"])
				  {
					$values = array("`tid`"=>"'1'","`sid`"=>"'{$did}'",
						"`itype`"=>"'{$type}'","`img`"=>"'{$imgfp}'",
						"`iname`"=>"'{$name}'","`isize`"=>"'{$size}'");
					$db->UpdateQuery("pics",$values,array("sid='{$did}'"));	
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
	
	if ($_POST["mark"]=="savenews")
	{
		if (isset($_POST["cbsm2"]) and $_POST["cbsm2"]!=0)
		{
			$sm = $_POST["cbsm2"];
		}
		else
		if (isset($_POST["cbsm1"]) and $_POST["cbsm1"]!=0)
		{
			$sm = $_POST["cbsm1"];
		}
		
		if(isset($_POST['rbselect']) and $_POST['rbselect']=="rbm")
		{
			$grp = 0;
		}
		else
		{
			$grp = $_POST["cbgroup"];
			$sm = 0;			
		}
		
		$fields = array("`gid`","`smid`","`subject`","`text`","`picid`");		
		$values = array("'{$grp}'","'{$sm}'","'{$_POST[edtsubject]}'","'{$_POST[edttext]}'","'0'");	
		if (!$db->InsertQuery('news',$fields,$values)) 
		{			
			header('location:addnews.php?act=new&msg=2');			
		} 	
		else 
		{  					
            $did = $db->InsertId();
			upload($db,$did,"insert");
			header('location:addnews.php?act=new&msg=1');
		}  		
	}
	else
	if ($_POST["mark"]=="editnews")
	{		
		if (isset($_POST["cbsm2"]) and $_POST["cbsm2"]!=0)
		{
			$sm = $_POST["cbsm2"];
		}
		else
		if (isset($_POST["cbsm1"]) and $_POST["cbsm1"]!=0)
		{
			$sm = $_POST["cbsm1"];
		}
		
		$values = array("`gid`"=>"'{$_POST[cbgroup]}'","`smid`"=>"'{$sm}'",
						"`subject`"=>"'{$_POST[edtsubject]}'","`text`"=>"'{$_POST[edttext]}'",
						"`picid`"=>"'0'");
        $db->UpdateQuery("menusubjects",$values,array("id='{$_GET[did]}'"));
		upload($db,$_GET["did"],"edit");	
		header('location:dataentry.php?act=new&msg=1');
	}
	
	
	if ($_GET['act']=="new")
	{
		$insertoredit = "
			<button id='submit' type='submit' class='btn btn-default'>ثبت</button>
			<input type='hidden' name='mark' value='savenews' /> ";
		$menues = $db->SelectAll("menues","*");	
		$cbmenu = DbSelectOptionTag("cbmenu",$menues,"name",NULL,NULL,"form-control",NULL,"  منو  ");
			
		$group = $db->SelectAll("categories","*");	
		$cbgroup = DbSelectOptionTag("cbgroup",$group,"name",NULL,NULL,"form-control",NULL,"  منو  ");	
	}

	if ($_GET['act']=="view")
	{
	    $row=$db->Select("news","*","id='{$_GET["did"]}'",NULL);
		
		$menues = $db->SelectAll("menues","*");	
		$cbmenu = DbSelectOptionTag("cbmenu",$menues,"name","{$row[mid]}",NULL,"form-control",NULL,"  منو  ");
		
		$srow=$db->Select("submenues","*","id='{$row["smid"]}'",NULL);
		if ($srow["pid"] == 0)	
		{
			$m = $srow["mid"];
			$m1 = $srow["id"];
			$m2 = 0;
		}
		else
		{			
			$srow2 = $db->Select("submenues","*","id='{$srow["pid"]}'",NULL);
			if ($srow2["pid"] == 0)
			{
				$m1 = $srow["pid"];
				$m2 = $srow["id"];
			}
			else
			{
				$m1 = 0;
				$m2 = 0;
			}	
		}
		
		$sm1 = $db->SelectAll("submenues","*","pid = 0");	
		$cbsm1 = DbSelectOptionTag("cbsm1",$sm1,"name","{$m1}",NULL,"form-control",NULL,"زیر منو");	

		$sm2 = $db->SelectAll("submenues","*","pid <> 0");	
		$cbsm2 = DbSelectOptionTag("cbsm2",$sm2,"name","{$m2}",NULL,"form-control",NULL,"زیر منو");	
		
		$pic = $db->Select("pics","*","sid='{$_GET["did"]}'",NULL);
		$imgload = "<img  src='img.php?did={$_GET[did]}'  width='200px' height='180px' />";
	}
	
	if ($_GET['act']=="edit")
	{
	    $row=$db->Select("news","*","id='{$_GET["did"]}'",NULL);		
		$insertoredit = "
			<button id='submit' type='submit' class='btn btn-default'>ویرایش</button>
			<input type='hidden' name='mark' value='editnews' /> ";

			$menues = $db->SelectAll("menues","*");	
		$cbmenu = DbSelectOptionTag("cbmenu",$menues,"name","{$row[mid]}",NULL,"form-control",NULL,"  منو  ");
		
		$srow=$db->Select("submenues","*","id='{$row["smid"]}'",NULL);
		if ($srow["pid"] == 0)	
		{
			$m = $srow["mid"];
			$m1 = $srow["id"];
			$m2 = 0;
		}
		else
		{			
			$srow2 = $db->Select("submenues","*","id='{$srow["pid"]}'",NULL);
			if ($srow2["pid"] == 0)
			{
				$m1 = $srow["pid"];
				$m2 = $srow["id"];
			}
			else
			{
				$m1 = $srow["id"];
				$m2 = $srow2["pid"];
			}	
		}
		
		$sm1 = $db->SelectAll("submenues","*","pid = 0");	
		$cbsm1 = DbSelectOptionTag("cbsm1",$sm1,"name","{$m1}",NULL,"form-control",NULL,"زیر منو");	

		$sm2 = $db->SelectAll("submenues","*","pid <> 0");	
		$cbsm2 = DbSelectOptionTag("cbsm2",$sm2,"name","{$m2}",NULL,"form-control",NULL,"زیر منو");	
		
		$pic = $db->Select("pics","*","sid='{$_GET["did"]}'",NULL);
		$imgload = "<img  src='img.php?did={$_GET[did]}'  width='200px' height='180px' />";
	}
  
$html.=<<<cd
    <!--Page main section start-->
    <section id="min-wrapper">
        <div id="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!--Top header start-->
                        <h3 class="ls-top-header">ثبت خبر</h3>
                        <!--Top header end -->
                        <!--Top breadcrumb start -->
                        <ol class="breadcrumb">
                            <li><a href="admin.php"><i class="fa fa-home"></i></a></li>
                            <li class="active">ثبت خبر</li>
                        </ol>
                        <!--Top breadcrumb start -->
                    </div>
                </div>
                <!-- Main Content Element  Start-->
                <form id="frmnews" name="frmnews" enctype="multipart/form-data" action="" method="post" class="form-inline ls_form" role="form">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">انتخاب منو و زیر منو</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="radio-inline">
                                        <label class="radio-inline">
                                            <input type="radio" name="rbselect" id="rbselect" value="rbm" checked="" />
                                            انتخاب بر اساس منو
                                        </label>
                                    </div>
                                    
									{$cbmenu}
									<div id="sm1">
											{$cbsm1}
									</div>
                                     <div id="sm2">
											{$cbsm2}
									</div>                                    
									
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">انتخاب گروه</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="radio-inline">
                                        <label class="radio-inline">
                                            <input type="radio" name="rbselect" id="rbselect" value="rbg" />
                                            انتخاب بر اساس گروه
                                        </label>
                                    </div>
                                    {$cbgroup}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">عنوان</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <input id="edtsubject" name="edtsubject" type="text" class="form-control" value = " {$row["subject"]}" />
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
                                    <h3 class="panel-title">انتخاب عکس</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="row ls_divider last">
                                        <div class="form-group">
                                            <div class="col-md-10 col-md-offset-2 ls-group-input">
                                                <input kl_virtual_keyboard_secure_input="on" id="userfile"  name="userfile" class="file" multiple="true" data-preview-file-type="any" type="file" />
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
                                    <h3 class="panel-title">ثبت اطلاعات</h3>
                                </div>
                                <div class="panel-body">
                                    {$insertoredit}
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
    include_once("./inc/footer.php")
?>