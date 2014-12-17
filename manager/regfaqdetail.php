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
    
       
           
    if (isset($_GET["act"]) and $_GET["act"]=="view")
    {
	$row = $db->Select("classes","*","id ={$_GET['did']}");
	$regdate = ToJalali($row["regdate"]," l d F  Y ساعت H:i");
        if($row["tahol"] ==0)
        {
          $row["tahol"] = "مجرد" ;
        }
        else
        {
            $row["tahol"]="متاهل" ;
        }
    
        //echo $db->cmd;
    }
	
    if ((isset($_POST["mark"]) and $_POST["mark"]=="confirm"))
    {
	$values = array("`confirm`"=>"'1'");
	$db->UpdateQuery("classes",$values,array("id='{$_GET[did]}'"));		
	header('location:regclassconf.php?act=new');
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
                            <li><a href="admin.php"><i class="fa fa-home"></i></a></li>
                            <li class="active">مشخصات پرسشگر</li>
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
                                        <input id="edtfather" name="edtfather" type="text" class="form-control" value="{$row["father"]}"/>
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
                                        <input id="edtbirth" name="edtbirth" type="text" class="form-control" value="{$row["birth"]}"/>
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
                                        <input id="edttahol" name="edttahol" type="text" class="form-control" value="{$row["tahol"]}"/>
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
                                        <input id="edtmeli" name="edtmeli" type="text" class="form-control" value="{$row["meli"]}"/>
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
                                        <input id="edttahsilat" name="edttahsilat" type="text" class="form-control" value="{$row["tahsilat"]}"/>
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
                                        <input id="edtreshte" name="edtreshte" type="text" class="form-control" value="{$row["reshte"]}"/>
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
                                        <textarea></textarea>
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