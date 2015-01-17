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
    
    $seo->Site_Title = 'عضویت در خبرنامه';  
	
	$mnu = $db->SelectAll("submenues","*",NULL,"id ASC");
	
	function haschildren($rows,$id) 
	{
		foreach ($rows as $row) 
		{
			if ($row['pid'] == $id)
			  return true;
		}
		return false;
	}
	$mnulist = array();
	function getmenu($rows,$returned,$parent=0)
	{		
	  foreach ($rows as $row)
	  {
		if ($row['pid'] == $parent)
		{
			if (!haschildren($rows, $row['id']))
			{
				$returned[] = $row['id'];
			}	
			else		  
			{			
			 $returned =getmenu($rows,$returned,$row['id']);						
			}
		}
	  }  
	  return $returned;
	}
	$mnulist = getmenu($mnu,$mnulist);
	$mnuids = implode(', ', $mnulist);
	
	$mnu = $db->SelectAll("submenues","*","id IN (".$mnuids.")"," id ASC");	
	$grp = $db->SelectAll("categories","*");
	for($i = 0; $i < Count($mnu); $i++)
	{
$chbs.=<<<cd
		<label for="cat" style="white-space:nowrap">{$mnu[$i]["name"]}
        </label>
		<input type="checkbox" name="cat[]" value="{$mnu[$i][id]}" style="margin-top:5px"/>
		<br/>
cd;
	}
	$chbs.="<hr />";
	for($i = 0; $i < Count($grp); $i++)
	{
$chbs.=<<<cd

		<label for="grp" style="white-space:nowrap">{$grp[$i]["name"]}
        </label>
		<input type="checkbox" name="grp[]" value="{$grp[$i][id]}" style="margin-top:5px"/>
		<br/>
cd;
	}	
	
	
	$inseroredit=<<<cd
	<input type="submit" style="margin-top:25px" value="ثبت نام" id="submit" class="contact_form_submit styled_button">
	<input type="hidden" name="mark" value="register" />
cd;

	if (isset($_GET["email"]))
	{
		$row=$db->Select("newsmember","*"," email='{$_GET["email"]}'");
		if ($row)
		{
		$chbs="";
$inseroredit=<<<cd
	<input type="submit" value="ویرایش اطلاعات" id="submit" class="contact_form_submit styled_button">
	<input type="hidden" name="mark" value="editinfo" />
cd;
	$cat = explode(",",$row["menu"]);
	$mnu = $db->SelectAll("submenues","*","id IN (".$mnuids.")"," pos ASC,id ASC");	
	$selgrp = explode(",",$row["group"]);
	$grp = $db->SelectAll("categories","*");
	
	for($i = 0; $i < Count($mnu); $i++)
	{
	if (in_array($mnu[$i][id],$cat))
	{
		$chb = "<input type='checkbox' name='cat[]' value='{$mnu[$i][id]}' checked />  ";
	}
	else
	{
		$chb = "<input type='checkbox' name='cat[]' value='{$mnu[$i][id]}' />  ";
	}
$chbs.=<<<cd
		<label for="cat">{$mnu[$i]["name"]}
        </label>
		{$chb}
		<br/>
cd;
	}
	$chbs.="<hr />";
	for($i = 0; $i < Count($grp); $i++)
	{
	if (in_array($grp[$i][id],$selgrp))
	{
		$chb = "<input type='checkbox' name='grp[]' value='{$grp[$i][id]}' checked />  ";
	}
	else
	{
		$chb = "<input type='checkbox' name='grp[]' value='{$grp[$i][id]}' />  ";
	}
$chbs.=<<<cd
		<label for="cat">{$grp[$i]["name"]}
        </label>
		{$chb}
		<br/>
cd;
	}
		}
	}
		
	if ($_POST["mark"]=="register")
	{			
		$date = date('Y-m-d H:i:s');
		$cats = implode(',',$_POST['cat']);
		$grps = implode(',',$_POST['grp']);
		$fields = array("`name`","`degri`","`reshte`","`email`",
						"`tell`","`mobile`","`menu`","`group`","`regdate`");		
		$values = array("'{$_POST[edtname]}'","'{$_POST[edtdegri]}'",
						"'{$_POST[edtreshte]}'","'{$_POST[edtemail]}'",
						"'{$_POST[edttell]}'","'{$_POST[edtmob]}'",
						"'{$cats}'","'{$grps}'","'{$date}'");	
						
		if (!$db->InsertQuery('newsmember',$fields,$values)) 
		{			
			header('location:membership.html?act=new&msg=2');			
		} 	
		else 
		{  				
			header('location:membership.html?act=new&msg=1');
		}
  		//echo $db->cmd;
	}
	else
	if ($_POST["mark"]=="editinfo")
	{				
		$cats = implode(',',$_POST['cat']);
		$grps = implode(',',$_POST['grp']);
		$values = array("`name`"=>"'{$_POST[edtname]}'","`degri`"=>"'{$_POST[edtdegri]}'",
						"`reshte`"=>"'{$_POST[edtreshte]}'","`email`"=>"'{$_POST[edtemail]}'",
						"`tell`"=>"'{$_POST[edttell]}'","`mobile`"=>"'{$_POST[edtmob]}'",
						"`menu`"=>"'{$cats}'","`group`"=>"'{$grps}'");
        $db->UpdateQuery("newsmember",$values,array("id='{$row["id"]}'"));		
		//echo $db->cmd;
		header('location:membership.html?act=new&msg=1');
	}	

		
$nwlhtml.=<<<cd
<div id="main" class="col9 clearfix">
	<div id="main_inner">
        <div class="article_grid four_column_blog">
            <h4>عضویت در خبرنامه</h4>
            <div class="entry rtl">
                <p class="teaser">
                    <span>
                        عضویت در گروه در خبرنامه گروه رهیاب:
                    </span>
                </p>
                <div id="frmdata" name="frmdata" class="formdata">
                    <form action="" method="post">
                        <div class="nt_form_row name_row" style="margin-top:30px;display:inline-block">
                            <label for="nt_field01">نام و نام خانوادگی
                                <span class="star">*</span>
                            </label>
                            <input type="text" id="edtname" name="edtname" class="textfield name validate[required]" data-prompt-position="topLeft:-60" value="{$row['name']}">
                        </div>
                        <div class="nt_form_row name_row" style="margin-top:30px;display:inline-block">
                            <label for="nt_field01">میزان تحصیلات
                                <span class="star">*</span>
                            </label>
                            <input type="text" id="edtdegri" name="edtdegri" class="textfield name validate[required]" data-prompt-position="topLeft:-60" value="{$row['degri']}">
                        </div>
                        <div class="nt_form_row name_row" style="margin-top:30px;display:inline-block">
                            <label for="nt_field01">رشته تحصیلی
                                <span class="star">*</span>
                            </label>
                            <input type="text" id="edtreshte" name="edtreshte" class="textfield name validate[required]" data-prompt-position="topLeft:-60" value="{$row['reshte']}">
                        </div>
                        <div class="clearboth"></div>
                        <div class="nt_form_row email_row" style="margin-top:30px;display:inline-block">
                            <label for="nt_field11">ایمیل
                                <span class="star">*</span>
                            </label>
                            <input type="text" id="edtemail" name="edtemail" class="textfield email validate[required,custom[email]]" data-prompt-position="topLeft:-50" placeholder="info@rahyabclinic.com" value="$_GET[email]">
                        </div>
                        <div class="nt_form_row name_row" style="margin-top:30px;display:inline-block">
                            <label for="nt_field01">تلفن
                                <span class="star"></span>
                            </label>
                            <input type="text" id="edttell" name="edttell" class="textfield name required" placeholder="5138417740" value="{$row['tell']}">
                        </div>
                        <div class="nt_form_row name_row" style="margin-top:30px;display:inline-block">
                            <label for="nt_field01">موبایل
                                <span class="star"></span>
                            </label>
                            <input type="text" id="edtmob" name="edtmob" class="textfield name required" placeholder="9359856189" value="{$row['mobile']}">
                        </div>
                        <!-- <div class="nt_form_row captcha_row">
                            <label for="nt_field31">8 + 2 </label>
                            <input type="text" name="nt_field31" id="nt_field31" class="textfield captcha required" value="">
                        </div> -->
						<p style="font-size:20px">لیست گروه های قابل عضویت جهت دریافت اخبار مربوطه</p>
						<br/>
						{$chbs}
                        <div class="nt_form_row">
                            {$inseroredit}
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
	echo $nwlhtml;
	include_once('./inc/sidebar.php');
	include_once('./inc/footer.php');
	include_once('./inc/last.php');
?>