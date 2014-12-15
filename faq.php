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
    $seo = Seo::GetSeo();
    
    $seo->Site_Title = 'پرسش و پاسخ';  
    
	if (isset($_POST["mark"]) and $_POST["mark"]="register" )
	{
	    $date = date('Y-m-d H:i:s');
		$fields = array("`name`","`degri`","`reshte`","`tel`","`mobile`",
		                "`email`","`question`","`regdate`");
		$values = array("'{$_POST[edtname]}'","'{$_POST[edtdegri]}'","'{$_POST[edtreshte]}'",
						"'{$_POST[edttell]}'","'{$_POST[edtmob]}'","'{$_POST[edtemail]}'",
						"'{$_POST[txtask]}'","'{$date}'");	
		if (!$db->InsertQuery('ask',$fields,$values)) 
		{			
			header('location:faq.html?act=new&msg=2');			
		} 	
		else 
		{  			
			header('location:faq.html?act=new&msg=1');			
		}  		
		//echo $db->cmd;
	}	
$ashtml.=<<<cd
<div id="main" class="col9 clearfix">
	<div id="main_inner">
        <div class="article_grid four_column_blog">
            <h4>پرسش و پاسخ</h4>
            <div class="entry rtl">
                <p class="teaser">
                    <span>
                        در این صفحه می توانید سوالاتتان را بپرسید
                    </span>
                </p>
                <div id="frmdata" name="frmdata" class="formdata">
                    <form action="" method="post">
                        <div class="nt_form_row name_row" style="margin-top:30px;display:inline-block">
                            <label for="nt_field01">نام و نام خانوادگی
                                <span class="star">*</span>
                            </label>
                            <input type="text" id="edtname" name="edtname" class="textfield name validate[required]" data-prompt-position="topLeft:-60" value="">
                        </div>
                        <div class="nt_form_row name_row" style="margin-top:30px;display:inline-block">
                            <label for="nt_field01">میزان تحصیلات
                                <span class="star">*</span>
                            </label>
                            <input type="text" id="edtdegri" name="edtdegri" class="textfield name validate[required]" data-prompt-position="topLeft:-60" value="">
                        </div>
                        <div class="nt_form_row name_row" style="margin-top:30px;display:inline-block">
                            <label for="nt_field01">رشته تحصیلی
                                <span class="star">*</span>
                            </label>
                            <input type="text" id="edtreshte" name="edtreshte" class="textfield name validate[required]" data-prompt-position="topLeft:-60" value="">
                        </div>
                        <div class="clearboth"></div>
                        <div class="nt_form_row email_row" style="margin-top:30px;display:inline-block">
                            <label for="nt_field11">ایمیل
                                <span class="star">*</span>
                            </label>
                            <input type="text" id="edtemail" name="edtemail" class="textfield email validate[required,custom[email]]" data-prompt-position="topLeft:-50" placeholder="info@rahyabclinic.com" value="">
                        </div>
                        <div class="nt_form_row name_row" style="margin-top:30px;display:inline-block">
                            <label for="nt_field01">تلفن
                                <span class="star"></span>
                            </label>
                            <input type="text" id="edttell" name="edttell" class="textfield name required" placeholder="5138417740" value="">
                        </div>
                        <div class="nt_form_row name_row" style="margin-top:30px;display:inline-block">
                            <label for="nt_field01">موبایل
                                <span class="star"></span>
                            </label>
                            <input type="text" id="edtmob" name="edtmob" class="textfield name required" placeholder="9359856189" value="">
                        </div>
                        <div class="clearboth"></div>
                        <div class="nt_form_row textarea_row">
                            <label for="nt_field21">سوال مورد نظر
                                <span class="star">*</span>
                            </label>
                            <textarea id="txtask" name="txtask" class="textarea validate[required]" data-prompt-position="topLeft:600" rows="5" cols="40"></textarea>
                        </div>
                        <!-- <div class="nt_form_row captcha_row">
                            <label for="nt_field31">8 + 2 </label>
                            <input type="text" name="nt_field31" id="nt_field31" class="textfield captcha required" value="">
                        </div> -->
                        <div class="nt_form_row">
                            <input type="submit" value="ارسال" id="submit" class="contact_form_submit styled_button">
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
	echo $ashtml;
	include_once('./inc/sidebar.php');
	include_once('./inc/footer.php');
	include_once('./inc/last.php');
?>