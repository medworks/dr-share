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
	
	if ($_GET['act']=="new")
	{
		$insertoredit = "
			<button id='submit' type='submit' class='btn btn-default'>ثبت</button>
			<input type='hidden' name='mark' value='savenews' /> ";
		$menues = $db->SelectAll("menues","*");	
		$cbmenu = DbSelectOptionTag("cbmenu",$menues,"name",NULL,NULL,"form-control",NULL,"  منو  ");
			
		$group = $db->SelectAll("categories","*");	
		$cbgroup = DbSelectOptionTag("categories",$group,"name",NULL,NULL,"form-control",NULL,"  منو  ");	
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
	    $row=$db->Select("menusubjects","*","id='{$_GET["did"]}'",NULL);		
		$insertoredit = "
			<button id='submit' type='submit' class='btn btn-default'>ویرایش</button>
			<input type='hidden' name='mark' value='editdata' /> ";

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
                <form class="form-inline ls_form" role="form">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">انتخاب منو و زیر منو</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="radio-inline">
                                        <label class="radio-inline">
                                            <input type="radio" name="optionsRadios2" id="optionsRadios3" value="option3" checked="" />
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
                                            <input type="radio" name="optionsRadios2" id="optionsRadios3" value="option3" />
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
                                        <input id="" name="" type="text" class="form-control" />
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
                                            <textarea class="animatedTextArea form-control " id="bio" name="bio"></textarea>
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
                                                <input kl_virtual_keyboard_secure_input="on" id="file-1" class="file" multiple="true" data-preview-file-type="any" type="file" />
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
                                    <button type="submit" class="btn btn-default">ثبت</button>
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