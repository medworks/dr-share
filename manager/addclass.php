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
	
	
	if ($_POST["mark"]=="savedata")
	{
		$fields = array("`title`","`subjects`","`starttime`","`period`","`endtime`","`details`");		
		$values = array("'{$_POST[edttitle]}'","'{$_POST[edtsubjects]}'","'{$_POST[edtstarttime]}'",
				"'{$_POST[edtperiod]}'","'{$_POST[edtendtime]}'","'{$_POST[txtdetails]}'");	
		if (!$db->InsertQuery('defclasses',$fields,$values)) 
		{			
			header('location:addclass.php?act=new&msg=2');			
		} 	
		else 
		{  
			header('location:addclass.php?act=new&msg=1');
		}  		
	}
	else
	if ($_POST["mark"]=="editdata")
	{		
		
		$values = array("`title`"=>"'{$_POST[edttitle]}'","`subjects`"=>"'{$_POST[edtsubjects]}'",
				"`starttime`"=>"'{$_POST[edtstarttime]}'","`period`"=>"'{$_POST[edtperiod]}'",
				"`endtime`"=>"'{$_POST[edtendtime]}'","`details`"=>"'{$_POST[txtdetails]}'");
		$db->UpdateQuery("defclasses",$values,array("id='{$_GET[did]}'"));
		
		header('location:addclass.php?act=new&msg=1');
		//echo $db->cmd;
	}
	
	if ($_GET['act']=="new")
	{
		$insertoredit = "
			<button id='submit' type='submit' class='btn btn-default'>ثبت</button>
			<input type='hidden' name='mark' value='savedata' /> ";
	}

		
	if ($_GET['act']=="edit")
	{
		$row=$db->Select("defclasses","*","id='{$_GET["did"]}'",NULL);		
		$insertoredit = "
			<button id='submit' type='submit' class='btn btn-default'>ویرایش</button>
			<input type='hidden' name='mark' value='editdata' /> ";
	}
	
$html=<<<cd
    <!--Page main section start-->
    <section id="min-wrapper">
        <div id="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!--Top header start-->
                        <h3 class="ls-top-header">ثبت کلاس</h3>
                        <!--Top header end -->
                        <!--Top breadcrumb start -->
                        <ol class="breadcrumb">
                            <li><a href="javascript:void(0);"><i class="fa fa-home"></i></a></li>
                            <li class="active">ثبت کلاس</li>
                        </ol>
                        <!--Top breadcrumb start -->
                    </div>
                </div>
                <!-- Main Content Element  Start-->
                <form id="frmdata" name="frmdata" enctype="multipart/form-data" action="" method="post" class="form-inline ls_form" role="form">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">عنوان کلاس</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <input id="edttitle" name="edttitle" type="text" class="form-control" value="{$row["title"]}"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">سرفصل ها</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="row ls_divider last">
                                        <div class="col-md-10 ls-group-input">
                                            <textarea id="edtsubjects" name="edtsubjects" class="form-control " >
												{$row["subjects"]}
											</textarea>
                                            <script>
                                                CKEDITOR.replace( 'edtsubjects',{
                                                      language: 'fa'
                                                  } );
                                            </script>
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
                                    <h3 class="panel-title">زمان و ساعات کلاسها</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <textarea id="edtperiod" name="edtperiod" class="form-control " >
                                            {$row["edtperiod"]}
                                        </textarea>
                                        <script>
                                            CKEDITOR.replace( 'edtperiod',{
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
                                    <h3 class="panel-title">توصیف کلاس</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="row ls_divider last">
                                        <div class="col-md-10 ls-group-input">
                                            <textarea id="txtdetails" name="txtdetails" class="form-control " >
												{$row["details"]}
											</textarea>
                                            <script>
                                                CKEDITOR.replace( 'txtdetails',{
                                                      language: 'fa'
                                                  } );
                                            </script>
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
                                    <h3 class="panel-title">ثبت کلاس</h3>
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
cd;

    include_once("./inc/header.php");
    echo $html;
    include_once("./inc/footer.php");
?>