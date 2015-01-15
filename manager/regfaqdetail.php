<?php
    include_once("../config.php");
    include_once("../classes/functions.php");
    include_once("../classes/messages.php");
    include_once("../classes/session.php"); 
    include_once("../classes/security.php");
    include_once("../classes/database.php");    
    include_once("../classes/login.php");
    include_once("../lib/persiandate.php");
    include_once("../lib/class.phpmailer.php");

    $login = Login::GetLogin();
    if (!$login->IsLogged())
    {
        header("Location: ../index.php");
        die(); // solve a security bug
    }
    $db = Database::GetDatabase(); 
           
    if (isset($_GET["act"]) and $_GET["act"]=="rep")
    {
	$row = $db->Select("ask","*","id ={$_GET['did']}");
	$regdate = ToJalali($row["regdate"]," l d F  Y ساعت H:i");
    }
	
    if ((isset($_POST["mark"]) and $_POST["mark"]=="confirm"))
    {
	$values = array("`answer`"=>"'1'","`answertxt`"=>"'$_POST[txtanswer]'");
	$db->UpdateQuery("ask",$values,array("id='{$_GET[did]}'"));
	
	$Contact_Email = GetSettingValue('Contact_Email',0);
	$Email_Sender_Name = GetSettingValue('Email_Sender_Name',0);
	$email = $row["email"];
	$message = $_POST["txtanswer"];

	SendEmail($Contact_Email, $Email_Sender_Name,array($email), "پاسخ سوال شما",$message);
	
	header('location:regfaq.php?act=new');
	//echo $db->cmd;
    }
    
$html=<<<cd
    <!--Page main section start-->
    <section id="min-wrapper">
        <div id="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!--Top header start-->
                        <h3 class="ls-top-header">مشخصات پرسشگر</h3>
                        <!--Top header end -->
                        <!--Top breadcrumb start -->
                        <ol class="breadcrumb">
                            <li><a href="javascript:void(0);"><i class="fa fa-home"></i></a></li>
                            <li class="active">مشخصات پرسشگر</li>
                        </ol>
                        <!--Top breadcrumb start -->
                    </div>
                </div>
                <!-- Main Content Element  Start-->
                <form id="frmdata" name="frmdata"  action="" method="post" class="form-inline ls_form" role="form">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">تاریخ</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        {$regdate}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">نام و نام خانوادگی</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <input id="edtname" name="edtname" type="text" class="form-control" value="{$row["name"]}"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">میزان تحصیلات</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <input id="edtdegri" name="edtdegri" type="text" class="form-control" value="{$row["degri"]}"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">رشته تحصیلی</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <input id="edtreshte" name="edtrshte" type="text" class="form-control" value="{$row["reshte"]}"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">ایمیل</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <input id="edtemail" name="edtemail" type="text" class="form-control" value="{$row["email"]}"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">تلفن</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <input id="edttel" name="edttel" type="text" class="form-control" value="{$row["tel"]}"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">موبایل</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <input id="edtmobile" name="edtmobile" type="text" class="form-control" value="{$row["mobile"]}"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">سوال مد نظر</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <input id="edtask" name="edtask" type="text" class="form-control" value="{$row["question"]}"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">جواب سوال</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <textarea id="txtanswer" name="txtanswer" >
                    					   {$row["answertxt"]}
                    					</textarea>
                                        <script>
                                            CKEDITOR.replace( 'txtanswer',{
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
                                    <h3 class="panel-title">ارسال</h3>
                                </div>
                                <div class="panel-body">
                                    <button id="submit" type="submit" class="btn btn-default">ارسال</button>
                                    <input type="hidden" name="mark" value="confirm"> 
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