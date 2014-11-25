<?php
	include_once("config.php");
	include_once("classes/functions.php");
  	include_once("classes/messages.php");
  	include_once("classes/session.php");	
  	include_once("classes/security.php");
  	include_once("classes/database.php");	
	include_once("classes/login.php");
    include_once("lib/persiandate.php"); 
	
	//error_reporting(E_ALL);
	//ini_set('display_errors', 1);
	
	$db = Database::GetDatabase();
		
$chtml.=<<<cd
<div id="main" class="col9 clearfix">
	<div id="main_inner">

		<div class="single_post_module">
			<div class="post type-post status-publish format-standard has-post-thumbnail hentry category-featured category-lifestyle category-travel tag-adipiscing tag-augue tag-donec tag-etiam tag-euismod">				
					<h1 class="article_heading entry_title" style="font-size:35px !important">{$news['subject']}</h1>
					<div class="clearboth"></div>
					<div class="entry">
						<form id="frmdata" name="frmdata" enctype="multipart/form-data" action="" method="post" class="form-inline ls_form" role="form">
							<div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">نام و نام خانوادگی</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <input id="edtname" name="edtname" type="text" class="form-control" />
                                    </div>
                                </div>
                            </div>
							<div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">سال تولد</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <input id="edtbirth" name="edtbirth" type="text" class="form-control" />
                                    </div>
                                </div>
                            </div>
							<div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">نام پدر</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <input id="edtfather" name="edtfather" type="text" class="form-control" />
                                    </div>
                                </div>
                            </div>
							<div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">وضعیت تاهل</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        مجرد<input id="chbtahol" name="chbtahol" type="radio" class="form-control" value="0"/>
										متاهل<input id="chbtahol" name="chbtahol" type="radio" class="form-control" value="1"/>
                                    </div>
                                </div>
                            </div>
							<div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">کد ملی</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <input id="edtmeli" name="edtmeli" type="text" class="form-control" />
                                    </div>
                                </div>
                            </div>
							<div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">میزان تحصیلات</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <input id="edtdegri" name="edtdegri" type="text" class="form-control" />
                                    </div>
                                </div>
                            </div>
							<div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">رشته تحصیلی</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <input id="edtreshte" name="edtreshte" type="text" class="form-control" />
                                    </div>
                                </div>
                            </div>
							<div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">شغل</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <input id="edtjob" name="edtjob" type="text" class="form-control" />
                                    </div>
                                </div>
                            </div>
							<div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">استان</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <input id="edtostan" name="edtostan" type="text" class="form-control" />
                                    </div>
                                </div>
                            </div>
							<div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">شهر</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <input id="edtcity" name="edtcity" type="text" class="form-control" />
                                    </div>
                                </div>
                            </div>
							<div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">آدرس منزل یا محل کار</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
										<textarea id="txtadd" name="txtadd" > </textarea>
                                    </div>
                                </div>
                            </div>
							<div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">تلفن</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <input id="edttell" name="edttell" type="text" class="form-control" />
                                    </div>
                                </div>
                            </div>
							<div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">موبایل</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <input id="edtmob" name="edtmob" type="text" class="form-control" />
                                    </div>
                                </div>
                            </div>
							<div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">ایمیل</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <input id="edtemail" name="edtemail" type="text" class="form-control" />
                                    </div>
                                </div>
                            </div>
							<div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">پیام شما</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <textarea id="txtmsg" name="txtmsg" > </textarea>
                                    </div>
                                </div>
                            </div>
							<input type="submit" id="submit" value="ثبت نام"/>
							<input type="hidden" name="mark" value="register" />
						</form>
						<div class="clearboth"></div>									
					</div>
			</div>
		</div>
	</div><!-- #main_inner -->
</div>
cd;

	include_once('./inc/header.php');
	echo $chtml;
	include_once('./inc/sidebar.php');
	include_once('./inc/footer.php');
	include_once('./inc/last.php');
?>