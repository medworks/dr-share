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
	include_once("../lib/Zebra_Pagination.php"); 
		
	$login = Login::GetLogin();
    if (!$login->IsLogged())
	{
		header("Location: ../index.php");
		die(); // solve a security bug
	}
	
	$db = Database::GetDatabase();
	
	if (isset($_GET["act"]) and $_GET["act"]=="send")
	{
		$News_Email = GetSettingValue('News_Email',0);
		$Email_Sender_Name = GetSettingValue('Email_Sender_Name',0);
		
		$row = $db->Select("submenues","*","id={$rows[$i]['smid']}","id ASC");
		
		$db->cmd = "SELECT * FROM (".
				   "( SELECT *,1 As 'type' FROM news ) ".
	               " UNION ALL ".
			       "(SELECT *,2 As 'type' FROM topics ) ".
				   " ) AS tb WHERE id={$_GET['did']} AND type={$_GET['type']} "; 
		  
		$res = $db->RunSQL();
		$sndrow = mysqli_fetch_row($res);	
		
		$issend=SendEmail($News_Email,$Email_Sender_Name, array($email), $sndrow["subject"],$sndrow["text"]);
	}	
	
$html.=<<<cd
    <!--Page main section start-->
    <section id="min-wrapper">
        <div id="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!--Top header start-->
                        <h3 class="ls-top-header">ارسال خبر به اعضاء</h3>
                        <!--Top header end -->
                        <!--Top breadcrumb start -->
                        <ol class="breadcrumb">
                            <li><a href="admin.php"><i class="fa fa-home"></i></a></li>
                            <li class="active">ارسال خبر به اعضاء</li>
                        </ol>
                        <!--Top breadcrumb start -->
                    </div>
                </div>
                <!-- Main Content Element  Start-->
                <form class="form-inline ls_form" role="form">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">انتخاب منو و زیر منو</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="radio-inline">
                                        <label class="radio-inline">
                                            <input type="radio" name="optionsRadios2" id="optionsRadios3" value="option3" checked="" />
                                            انتخاب بر اساس منو
                                        </label>
                                    </div>
                                    <select class="form-control">
                                        <option value="">منو</option>
                                        <option value="">Default select</option>
                                        <option value="">Default select</option>
                                    </select>
                                    <select class="form-control">
                                        <option value="">زیر منو</option>
                                        <option value="">Default select</option>
                                        <option value="">Default select</option>
                                    </select>
                                    <select class="form-control">
                                        <option value="">زیر منو</option>
                                        <option value="">Default select</option>
                                        <option value="">Default select</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">انتخاب گروه</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="radio-inline">
                                        <label class="radio-inline">
                                            <input type="radio" name="optionsRadios2" id="optionsRadios3" value="option3" />
                                            انتخاب بر اساس گروه
                                        </label>
                                    </div>
                                    <select class="form-control">
                                        <option value="">گروه</option>
                                        <option value="">Default select</option>
                                        <option value="">Default select</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">جدول اخبار فیلتر شده</h3>
                                </div>
                                <div class="panel-body">
                                    <!--Table Wrapper Start-->
                                    <div class="table-responsive ls-table">
                                       <!--  <div id="ls-editable-table_filter" class="dataTables_filter">
                                            <label>جستجو:<input type="search" class="" aria-controls="ls-editable-table"></label>
                                        </div> -->
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>#</th>
												<th>نوع</th>
                                                <th>عنوان</th>
                                                <th>متن</th>
                                                <th>منو و زیر منو</th>
                                                <th>گروه</th>
                                                <th class="text-center">عملیات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
cd;
	$records_per_page = 10;
	$pagination = new Zebra_Pagination();

	$pagination->navigation_position("right");

	$pagination->records_per_page($records_per_page);	

	$db->cmd = "( SELECT *,1 As 'type' FROM news )".
	           " UNION ALL ".
			   " (SELECT *,2 As 'type' FROM topics ) ".
			   " LIMIT ".($pagination->get_page() - 1) * $records_per_page.",".$records_per_page ;			
	$res = $db->RunSQL();			
	$rows = array();
    if ($res)
    {
        while($row = mysqli_fetch_array($res)) $rows[] = $row;
    }
	
	$db->cmd = " SELECT Count(*) FROM ".
			   " ( SELECT *,1 As 'type' FROM news  ".
	           " UNION ALL ".
			   " SELECT *,2 As 'type' FROM topics ) AS tb";
	$res = $db->RunSQL();
	$row = mysqli_fetch_row($res);	
			   
	$reccount =  $row[0];
	$pagination->records($reccount); 	
	$vals = array();
for($i = 0; $i < Count($rows); $i++)
{
$rownumber = $i+1;
$rows[$i]["subject"] =(mb_strlen($rows[$i]["subject"])>20)?mb_substr($rows[$i]["subject"],0,20,"UTF-8")."...":$rows[$i]["subject"];
$rows[$i]["text"] =(mb_strlen($rows[$i]["text"])>20)?mb_substr($rows[$i]["text"],0,20,"UTF-8")."...":$rows[$i]["text"];
$type = ($rows[$i]["type"]==1) ? "خبر" : "مقاله";
$vals = "";
if ($rows[$i]['smid']!=0)
{
	$row = $db->Select("submenues","*","id={$rows[$i]['smid']}","id ASC");	
	$vals[] = $row["name"];
		
	while($row["pid"]!=0)
	{
		$row = $db->Select("submenues","*","id={$row['pid']}","id ASC");
		$vals[] = $row["name"];
	}
    
	$row = $db->Select("menues","*","id={$row['mid']}","id ASC");	
	$vals[] = $row["name"];
	$group = "";
}
else
{
		$row = $db->Select("categories","*","id={$rows[$i]['gid']}","id ASC");	
		$vals[] = "";
		$vals[] = "";
		$vals[] = "";//$row["name"];
		$group = $row["name"];
}	
$html.=<<<cd
                                            <tr>
                                                <td>{$rownumber}</td>
												<td>{$type}</td>
                                                <td>{$rows[$i]["subject"]}</td>
                                                <td>{$rows[$i]["text"]}</td>
                                                <td>
                                                    <span class="label label-success">{$vals[2]}</span>
                                                    <span class="label label-info">{$vals[1]}</span>
                                                    <span class="label label-warning">{$vals[0]}</span>                        
                                                </td>
                                                <td>
                                                    <span class="label label-success">{$group}</span>
                                                </td>
                                                <td class="text-center">
												  <a href="sendnews.php?act=send&did={$rows[$i]["id"]}&type={$rows[$i]["type"]}"  >
                                                    <button class="btn btn-xs btn-success" title="ارسال"><i class="fa fa-send-o"></i></button>
												  </a>	
                                                </td>
                                            </tr>
cd;
}
$pgcodes = $pagination->render(true);
$html.=<<<cd
                                            </tbody>
                                        </table>
                                    </div>
									{$pgcodes}                                   
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