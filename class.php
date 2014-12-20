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
    
	$seo->Site_Title = 'کلاسها و دوره های آموزشی';  
	
	function upload($db,$did,$mode)
	{		
		if(is_uploaded_file($_FILES['userfile']['tmp_name']) && getimagesize($_FILES['userfile']['tmp_name']) != false)
		{    
			$size = getimagesize($_FILES['userfile']['tmp_name']);		
			$type = $size['mime'];
			$imgfp = mysqli_real_escape_string($db->link,file_get_contents($_FILES['userfile']['tmp_name']));
			//echo $imgfp;
			$size = $size[3];
			$name = $_FILES['userfile']['name'];
			$maxsize = 512000;//512 kb
			//$db = Database::GetDatabase();
			//echo $db->cmd;
			if($_FILES['userfile']['size'] < $maxsize )
			{    
				//tid 1 is for class pics, 2 for hamayesh pics
				if ($mode == "insert")
				{
					$fields = array("`tid`","`cid`","`itype`","`img`","`iname`","`isize`");		
					$values = array("'1'","'{$did}'","'{$type}'","'{$imgfp}'","'{$name}'","'{$size}'");	
					$db->InsertQuery('clspics',$fields,$values);
				}
				else
				{
				  $imgrow =$db->Select("clspics","*","cid='{$did}' AND tid='1'");
				  if ($imgfp != $imgrow["img"])
				  {
					$values = array("`tid`"=>"'1'","`cid`"=>"'{$did}'",
						"`itype`"=>"'{$type}'","`img`"=>"'{$imgfp}'",
						"`iname`"=>"'{$name}'","`isize`"=>"'{$size}'");
					$db->UpdateQuery("pics",$values,array("cid='{$did}' AND tid='1'"));	
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
	if (isset($_POST["mark"]) and $_POST["mark"]="register" )
	{
	    $date = date('Y-m-d H:i:s');
		$fields = array("`name`","`clsid`","`birth`","`father`","`tahol`","`meli`",
		                "`tahsilat`","`reshte`","`shoghl`","`ostan`","`shahr`",
						"`address`","`tel`","`mobile`","`email`","`desc`","`regdate`");
		$values = array("'{$_POST[edtname]}'","'{$_POST[cbclass]}'","'{$_POST[edtbirth]}'","'{$_POST[edtfather]}'",
						"'{$_POST[chbtahol]}'","'{$_POST[edtmeli]}'","'{$_POST[edtdegri]}'",
						"'{$_POST[edtreshte]}'","'{$_POST[edtjob]}'","'{$_POST[edtostan]}'",
						"'{$_POST[edtcity]}'","'{$_POST[txtadd]}'","'{$_POST[edttell]}'",
						"'{$_POST[edtmob]}'","'{$_POST[edtemail]}'","'{$_POST[txtmsg]}'","'{$date}'");	
		if (!$db->InsertQuery('classes',$fields,$values)) 
		{			
			header('location:class.html?act=new&msg=2');			
		} 	
		else 
		{  
			if ($_FILES['userfile']['tmp_name']!="")
			{
				$did = $db->InsertId();
				upload($db,$did,"insert");
				header('location:class.html?act=new&msg=1');
			}	
			
		}  		
		//echo $db->cmd;
	}
	$class = $db->SelectAll("defclasses","*","`expire` ='0'");	
	$cbclass = DbSelectOptionTag("cbclass",$class,"title",NULL,NULL,"form-control",NULL,"  کلاس  ");	
$msgs = GetMessage($_GET['msg']);		
$chtml.=<<<cd
<div id="main" class="col9 clearfix">
	<div id="main_inner">
        <div class="article_grid four_column_blog">
            <h4>کلاسها و دوره های آموزشی</h4>
            <div class="entry rtl">
                <p class="teaser">
                    <span>
                        ثبت نام در کلاسها و دوره های آموزشی:
                    </span>
                </p>
                <div class="nt_form">
				    <!-- {$msgs} -->
                    <form id="frmclass" class="formdata" enctype="multipart/form-data" action="" method="post" role="form">
						<div class="nt_form_row name_row" style="margin-top:30px;display:inline-block">
                            <label for="nt_field01">نام کلاس
                                <span class="star">*</span>
                            </label>
                            {$cbclass}
                        </div>
					
                        <div class="nt_form_row name_row" style="margin-top:30px;display:inline-block">
                            <label for="nt_field01">نام و نام خانوادگی
                                <span class="star">*</span>
                            </label>
                            <input type="text" id="edtname" name="edtname" class="textfield name validate[required]" data-prompt-position="topLeft:-30" value="" />
                        </div>
                        <div class="nt_form_row name_row" style="margin-top:30px;display:inline-block">
                            <label for="nt_field01">سال تولد
                                <span class="star">*</span>
                            </label>
                            <input type="text" id="edtbirth" name="edtbirth" class="textfield name validate[required,custom[date]]" data-prompt-position="topLeft:-30" placeholder="1393/01/01" value="" />
                        </div>
                        <div class="nt_form_row name_row" style="margin-top:30px;display:inline-block">
                            <label for="nt_field01">نام پدر
                                <span class="star">*</span>
                            </label>
                            <input type="text" id="edtfather" name="edtfather" class="textfield name validate[required]" data-prompt-position="topLeft:-20" value="" />
                        </div>
                        <div class="nt_form_row name_row" style="margin-top:50px;display:inline-block">
                            <label for="nt_field01">وضعیت تاهل
                                <span class="star">*</span>
                            </label>
                            متاهل<input type="radio" id="chbtahol" name="chbtahol" class="textfield name validate[required]" data-prompt-position="topLeft:-200" value="1">
                            مجرد<input type="radio" id="chbtahol" name="chbtahol" class="textfield name validate[required]" data-prompt-position="topLeft:-200" value="0">
                        </div>
                        <div class="clearboth"></div>
                        <div class="nt_form_row name_row" style="margin-top:30px;display:inline-block">
                            <label for="nt_field01">کد ملی
                                <span class="star">*</span>
                            </label>
                            <input type="text" id="edtmeli" name="edtmeli" class="textfield name validate[required,custom[onlyNumberSp],maxSize[10],minSize[10]]" data-prompt-position="topLeft:-30" placeholder="0123456789" value="">
                        </div>
                        <div class="nt_form_row name_row" style="margin-top:30px;display:inline-block">
                            <label for="nt_field01">میزان تحصیلات
                                <span class="star">*</span>
                            </label>
                            <input type="text" id="edtdegri" name="edtdegri" class="textfield name validate[required]" data-prompt-position="topLeft:-70" value="">
                        </div>
                        <div class="nt_form_row name_row" style="margin-top:30px;display:inline-block">
                            <label for="nt_field01">رشته تحصیلی
                                <span class="star">*</span>
                            </label>
                            <input type="text" id="edtreshte" name="edtreshte" class="textfield name validate[required]" data-prompt-position="topLeft:-70" value="">
                        </div>
                        <div class="nt_form_row name_row" style="margin-top:30px;display:inline-block">
                            <label for="nt_field01">شغل
                                <span class="star">*</span>
                            </label>
                            <input type="text" id="edtjob" name="edtjob" class="textfield name validate[required]" data-prompt-position="topLeft:-70" value="">
                        </div>
                        <div class="clearboth"></div>
                        <div class="nt_form_row email_row" style="margin-top:30px;display:inline-block">
                            <label for="nt_field11">فیش پرداختی
                                <span class="star">*</span>
                            </label>
                            <input type="file" id="userfile" name="userfile" class="textfield file validate[required]" data-prompt-position="topLeft:-10" value="">
                        </div>
                        <div class="nt_form_row name_row" style="margin-top:30px;display:inline-block">
                            <label for="nt_field01">استان
                                <span class="star">*</span>
                            </label>
                            <input type="text" id="edtostan" name="edtostan" class="textfield name validate[required]" data-prompt-position="topLeft:-30" value="">
                        </div>
                        <div class="nt_form_row name_row" style="margin-top:30px;display:inline-block">
                            <label for="nt_field01">شهر
                                <span class="star">*</span>
                            </label>
                            <input type="text" id="edtcity" name="edtcity" class="textfield name validate[required]" data-prompt-position="topLeft:-70" value="">
                        </div>
                        <div class="nt_form_row name_row" style="margin-top:30px;">
                            <label for="nt_field01">آدرس منزل یا محل کار
                                <span class="star">*</span>
                            </label>
                            <textarea id="txtadd" name="txtadd" class="textarea validate[required]" data-prompt-position="topLeft:550" rows="5" cols="40" style="height:100px"></textarea>
                        </div>
                        <div class="clearboth"></div>
                        <div class="nt_form_row name_row" style="margin-top:30px;display:inline-block">
                            <label for="nt_field01">تلفن
                                <span class="star">*</span>
                            </label>
                            <input type="text" id="edttell" name="edttell" class="textfield name validate[required,custom[onlyNumberSp],maxSize[10],minSize[10]]" data-prompt-position="topLeft:-30" placeholder="5138417740" value="">
                        </div>
                        <div class="nt_form_row name_row" style="margin-top:30px;display:inline-block">
                            <label for="nt_field01">موبایل
                                <span class="star">*</span>
                            </label>
                            <input type="text" id="edtmob" name="edtmob" class="textfield name validate[required,custom[onlyNumberSp],maxSize[10],minSize[10]]" data-prompt-position="topLeft:-50" placeholder="9359856189" value="">
                        </div>
                        <div class="nt_form_row email_row" style="margin-top:30px;display:inline-block">
                            <label for="nt_field11">ایمیل
                                <span class="star">*</span>
                            </label>
                            <input type="text" id="edtemail" name="edtemail" class="textfield email validate[required,custom[email]]" data-prompt-position="topLeft:-150" placeholder="info@rahyabclinic.com" value="">
                        </div>
                        <div class="nt_form_row textarea_row">
                            <label for="nt_field21">توضیحات
                                <span class="star">*</span>
                            </label>
                            <textarea id="txtmsg" name="txtmsg" class="textarea validate[required]" data-prompt-position="topLeft:600" rows="5" cols="40"></textarea>
                        </div>
                        <!-- <div class="nt_form_row captcha_row">
                            <label for="nt_field31">8 + 2 </label>
                            <input type="text" name="nt_field31" id="nt_field31" class="textfield captcha required" value="">
                        </div> -->
                        <div class="nt_form_row">
							<button id='submit' type='submit' class='contact_form_submit styled_button'>ثبت نام</button>                  
                            <input type="hidden" name="mark" value="register" />
                            <div class="nt_contact_feedback">
                                <img src="./images/transparent.gif" style="background-image: url(./images/preloader-white.gif);">
                            </div>
                        </div>                        
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