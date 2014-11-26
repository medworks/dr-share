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
	

$html.=<<<cd
<div id="main" class="col9 clearfix">
	<div id="main_inner">
		<div class="article_grid four_column_blog">
			<h4>تماس با ما</h4>	
			<div class="hentry">	
				<div class="entry rtl">
					<p class="teaser">
						<span>
							شما می توانید به صورت حضوری به آدرس زیر مراجعه نمایید:
						</span>
					</p>
					<div class="su-gmap su-responsive-media-yes">
						<iframe width="800" height="300" src="http://maps.google.com/maps?q=London%2C+UK&amp;output=embed"></iframe>
					</div>
					<div class="divider"></div>
					<p style="font-size:20px;">
						یا با ارسال نامه با ما در ارتباط باشید:
					</p>
					<div id="nt_form1" class="nt_form">
						<form class="formdata" action="" method="post">
							<div class="nt_form_row name_row" style="margin-top:30px;">
								<label for="nt_field01">نام و نام خانوادگی
									<span class="star">*</span>
								</label>
								<input type="text" name="nt_field01" id="nt_field01" class="textfield name validate[required]" data-prompt-position="topLeft:-100" value="" />
							</div>
							<div class="nt_form_row email_row">
								<label for="nt_field11">ایمیل
									<span class="star">*</span>
								</label>
								<input type="text" name="nt_field11" id="nt_field11" class="textfield validate[required,custom[email]] email" data-prompt-position="topLeft:-150" value="" />
							</div>
							<div class="nt_form_row textarea_row">
								<label for="nt_field21">پیام
									<span class="star">*</span>
								</label>
								<textarea name="nt_field21" id="nt_field21" class="textarea required validate[required]" data-prompt-position="topLeft:550" rows="5" cols="40"></textarea>
							</div>
							<!-- <div class="nt_form_row captcha_row">
								<label for="nt_field31">8 + 2 </label>
								<input type="text" name="nt_field31" id="nt_field31" class="textfield captcha required" value="" />
							</div> -->
							<div class="nt_form_row">
								<input type="submit" value="ارسال" class="contact_form_submit styled_button" />
								<!-- <div class="nt_contact_feedback">
									<img src="./images/transparent.gif" style="background-image: url(./images/preloader-white.gif);" />
								</div> -->
							</div>
							<!-- <div class="nt_form_row nt_required">
								<input type="text" name="nt_required" id="nt_required" />
							</div>
							<div class="nt_form_row nt_zip_required">
								<input type="text" name="nt_zip_required" id="nt_zip_required" />
							</div>
							<div class="nt_form_row" style="display:none;">
								<input type="hidden" name="_nt_form" value="1" />
								<input type="hidden" name="_nt_form_encode" value="rVPLboMwEPwVTr1UqoA8mjqXXnpsfyFazDa4wYZgW2pa8e-FxGtIAYVDjsyMZ2fHBtia_Wq2YQ9HW5itMjuUIPLL11azOCbGSqHAZChRv-5bzRMvpNdFYeegbfKF3DguYWHDPztaW85Ra3_uxeGt4U6jMp6hE3AQWuKEm0gxgeqKWzvuU2Ce0iC4rNlPeebDyAsWrWDpeHMq0SchUIHswJUDc0gwH6AfjZR5lNqt8GhFhenA2VSWnOuRlNGclDT6-v7GY1JHb612Rs4x77Gg8ZygNMXgt4EK4UZWkr83zwb2d2x10YVdToall8ahNDyDmb1ugscgDm4nnXIfx0Wzw3mTqNvknyWwqP87DwYSkRUKT2VhevWsOtMfUd7LuK7_AA" />
							</div> -->
						</form>
					</div>
					<div class="clearboth"></div>										
				</div><!-- .entry -->		
			</div>
		</div>
	</div><!-- #main_inner -->
</div>
cd;

	include_once('./inc/header.php');
	include_once('./inc/sidebar.php');
	include_once('./inc/footer.php');
	include_once('./inc/last.php');
?>