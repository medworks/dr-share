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
    <style>
        .entry .nt_form_row{
            margin-left:15px
        }
    </style>
        <div class="article_grid four_column_blog">
            <h4>کلاسها و دوره های آموزشی</h4>
            <div class="entry rtl">
                <p class="teaser">
                    <span>
                        ثبت نام در کلاسها و دوره های آموزشی:
                    </span>
                </p>
                <div id="frmdata" name="frmdata" class="nt_form">
                    <form action="" method="post">
                        <div class="nt_form_row name_row" style="margin-top:30px;display:inline-block">
                            <label for="nt_field01">نام و نام خانوادگی
                                <span class="star">*</span>
                            </label>
                            <input type="text" id="edtname" name="edtname" class="textfield name required" value="">
                        </div>
                        <div class="nt_form_row name_row" style="margin-top:30px;display:inline-block">
                            <label for="nt_field01">سال تولد
                                <span class="star">*</span>
                            </label>
                            <input type="text" id="edtbirth" name="edtbirth" class="textfield name required" value="">
                        </div>
                        <div class="nt_form_row name_row" style="margin-top:30px;display:inline-block">
                            <label for="nt_field01">نام پدر
                                <span class="star">*</span>
                            </label>
                            <input type="text" id="edtfather" name="edtfather" class="textfield name required" value="">
                        </div>
                        <div class="nt_form_row name_row" style="margin-top:50px;display:inline-block">
                            <label for="nt_field01">وضعیت تاهل
                                <span class="star">*</span>
                            </label>
                            متاهل<input type="radio" id="chbtahol" name="chbtahol" class="textfield name required" value="0">
                            مجرد<input type="radio" id="chbtahol" name="chbtahol" class="textfield name required" value="1">
                        </div>
                        <div class="clearboth"></div>
                        <div class="nt_form_row name_row" style="margin-top:30px;display:inline-block">
                            <label for="nt_field01">کد ملی
                                <span class="star">*</span>
                            </label>
                            <input type="text" id="edtmeli" name="edtmeli" class="textfield name required" value="">
                        </div>
                        <div class="nt_form_row name_row" style="margin-top:30px;display:inline-block">
                            <label for="nt_field01">میزان تحصیلات
                                <span class="star">*</span>
                            </label>
                            <input type="text" id="edtdegri" name="edtdegri" class="textfield name required" value="">
                        </div>
                        <div class="nt_form_row name_row" style="margin-top:30px;display:inline-block">
                            <label for="nt_field01">رشته تحصیلات
                                <span class="star">*</span>
                            </label>
                            <input type="text" id="edtreshte" name="edtreshte" class="textfield name required" value="">
                        </div>
                        <div class="nt_form_row name_row" style="margin-top:30px;display:inline-block">
                            <label for="nt_field01">شغل
                                <span class="star">*</span>
                            </label>
                            <input type="text" id="edtjob" name="edtjob" class="textfield name required" value="">
                        </div>
                        <div class="clearboth"></div>
                        <div class="nt_form_row name_row" style="margin-top:30px;display:inline-block">
                            <label for="nt_field01">استان
                                <span class="star">*</span>
                            </label>
                            <input type="text" id="edtostan" name="edtostan" class="textfield name required" value="">
                        </div>
                        <div class="nt_form_row name_row" style="margin-top:30px;display:inline-block">
                            <label for="nt_field01">شهر
                                <span class="star">*</span>
                            </label>
                            <input type="text" id="edtcity" name="edtcity" class="textfield name required" value="">
                        </div>
                        <div class="nt_form_row name_row" style="margin-top:30px;">
                            <label for="nt_field01">آدرس منزل یا محل کار
                                <span class="star">*</span>
                            </label>
                            <textarea id="txtadd" name="txtadd" class="textarea required" rows="5" cols="40" style="height:100px"></textarea>
                        </div>
                        <div class="clearboth"></div>
                        <div class="nt_form_row name_row" style="margin-top:30px;display:inline-block">
                            <label for="nt_field01">تلفن
                                <span class="star">*</span>
                            </label>
                            <input type="text" id="edttell" name="edttell" class="textfield name required" value="">
                        </div>
                        <div class="nt_form_row name_row" style="margin-top:30px;display:inline-block">
                            <label for="nt_field01">موبایل
                                <span class="star">*</span>
                            </label>
                            <input type="text" id="edtmob" name="edtmob" class="textfield name required" value="">
                        </div>
                        <div class="nt_form_row email_row" style="margin-top:30px;display:inline-block">
                            <label for="nt_field11">ایمیل
                                <span class="star">*</span>
                            </label>
                            <input type="text" id="edtemail" name="edtemail" class="textfield email required" value="">
                        </div>
                        <div class="nt_form_row textarea_row">
                            <label for="nt_field21">توضیحات
                                <span class="star">*</span>
                            </label>
                            <textarea id="txtmsg" name="txtmsg" class="textarea required" rows="5" cols="40"></textarea>
                        </div>
                        <!-- <div class="nt_form_row captcha_row">
                            <label for="nt_field31">8 + 2 </label>
                            <input type="text" name="nt_field31" id="nt_field31" class="textfield captcha required" value="">
                        </div> -->
                        <div class="nt_form_row">
                            <input type="submit" value="ثبت نام" id="submit" class="contact_form_submit styled_button">
                            <input type="hidden" name="mark" value="register" />
                            <div class="nt_contact_feedback">
                                <img src="./images/transparent.gif" style="background-image: url(./images/preloader-white.gif);">
                            </div>
                        </div>
                        <!-- <div class="nt_form_row nt_required">
                            <input type="text" name="nt_required" id="nt_required">
                        </div>
                        <div class="nt_form_row nt_zip_required">
                            <input type="text" name="nt_zip_required" id="nt_zip_required">
                        </div> 
                        <div class="nt_form_row" style="display:none;">
                            <input type="hidden" name="_nt_form" value="1">
                            <input type="hidden" name="_nt_form_encode" value="rVPLboMwEPwVTr1UqoA8mjqXXnpsfyFazDa4wYZgW2pa8e-FxGtIAYVDjsyMZ2fHBtia_Wq2YQ9HW5itMjuUIPLL11azOCbGSqHAZChRv-5bzRMvpNdFYeegbfKF3DguYWHDPztaW85Ra3_uxeGt4U6jMp6hE3AQWuKEm0gxgeqKWzvuU2Ce0iC4rNlPeebDyAsWrWDpeHMq0SchUIHswJUDc0gwH6AfjZR5lNqt8GhFhenA2VSWnOuRlNGclDT6-v7GY1JHb612Rs4x77Gg8ZygNMXgt4EK4UZWkr83zwb2d2x10YVdToall8ahNDyDmb1ugscgDm4nnXIfx0Wzw3mTqNvknyWwqP87DwYSkRUKT2VhevWsOtMfUd7LuK7_AA">
                        </div> -->
                    </form>
                </div>
                <div class="clearboth"></div>                                       
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