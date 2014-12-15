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
                        <h3 class="ls-top-header">مشخصات ثبت نام کننده</h3>
                        <!--Top header end -->
                        <!--Top breadcrumb start -->
                        <ol class="breadcrumb">
                            <li><a href="admin.php"><i class="fa fa-home"></i></a></li>
                            <li class="active">مشخصات ثبت نام کننده</li>
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
                                    <h3 class="panel-title">نام پدر</h3>
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
                                    <h3 class="panel-title">سال تولد</h3>
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
                                    <h3 class="panel-title">وضعیت تاهل</h3>
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
                                    <h3 class="panel-title">کد ملی</h3>
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
                                    <h3 class="panel-title">تحصیلات</h3>
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
                                    <h3 class="panel-title">رشته تحصیلی</h3>
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
                                    <h3 class="panel-title">شغل</h3>
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
                                    <h3 class="panel-title">شماره فیش پرداختی</h3>
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
                                    <h3 class="panel-title">استان</h3>
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
                                    <h3 class="panel-title">شهر</h3>
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
                                    <h3 class="panel-title">آدرس</h3>
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
                                    <h3 class="panel-title">تلفن</h3>
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
                                    <h3 class="panel-title">موبایل</h3>
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
                                    <h3 class="panel-title">ایمیل</h3>
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
                                    <h3 class="panel-title">توضیحات</h3>
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
                                    <h3 class="panel-title">نام دوره</h3>
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
                                    <h3 class="panel-title">تایید</h3>
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