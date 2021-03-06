<?php
	include_once("../config.php");
	include_once("../classes/functions.php");
  	include_once("../classes/messages.php");
  	include_once("../classes/session.php");	
  	include_once("../classes/security.php");
  	include_once("../classes/database.php");	
	include_once("../classes/login.php");
    include_once("../lib/persiandate.php"); 
	include_once("../lib/Zebra_Pagination.php"); 
	
	
	$login = Login::GetLogin();
    if (!$login->IsLogged())
	{
		header("Location: ../index.php");
		die(); // solve a security bug
	} 
	$db = Database::GetDatabase(); 
	if ($_GET['act']=="del")
	{
		$db->Delete("gallerypics"," id ",$_GET["gid"]);	
		$db->Delete("gpics"," id ",$_GET["did"]);	
		header('location:editgallery.php?act=new');	
	}		
    
$html.=<<<cd
    <!--Page main section start-->
    <section id="min-wrapper">
        <div id="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!--Top header start-->
                        <h3 class="ls-top-header">ویرایش گالری تصاویر</h3>
                        <!--Top header end -->
                        <!--Top breadcrumb start -->
                        <ol class="breadcrumb">
                            <li><a href="javascript:void(0);"><i class="fa fa-home"></i></a></li>
                            <li class="active">ویرایش گالری تصاویر</li>
                        </ol>
                        <!--Top breadcrumb start -->
                    </div>
                </div>
                <!-- Main Content Element  Start-->
                <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">تصاویر آپلود شده</h3>
                                </div>
                                <div class="panel-body">
                                    <!--Table Wrapper Start-->
                                    <div class="table-responsive ls-table">
                                        <div id="ls-editable-table_filter" class="dataTables_filter">
                                            <label>جستجو:<input type="search" class="" aria-controls="ls-editable-table"></label>
                                        </div>
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
											<th>#</th>
												<th>گروه</th>
                                                <th>عنوان</th>
                                                <!-- <th>متن</th> -->
                                                <th>تصویر</th>
                                                <th class="text-center">عملیات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
cd;

	$records_per_page = 10;
	$pagination = new Zebra_Pagination();

	$pagination->navigation_position("right");

	$reccount = $db->CountAll("gpics");
	$pagination->records($reccount); 
	
    $pagination->records_per_page($records_per_page);	

$rows = $db->SelectAll(
				"gpics",
				"*",
				NULL,
				"id ASC",
				($pagination->get_page() - 1) * $records_per_page,
				$records_per_page);
				
for($i = 0; $i < Count($rows); $i++)
{
$rownumber = $i+1;
$prow = $db->Select("gallerypics","*","id='{$rows[$i][gid]}'");
$grow = $db->Select("gcategories","*","id='{$prow[gcid]}'",NULL);

$prow["subject"] =(mb_strlen($prow["subject"])>20)?mb_substr($prow["subject"],0,20,"UTF-8")."...":$prow["subject"];
$prow[$i]["text"] = strip_tags($prow[$i]["text"]);
$prow["text"] =(mb_strlen($prow["text"])>20)?mb_substr($prow["text"],0,20,"UTF-8")."...":$prow["text"];

$html.=<<<cd

                                                
                                            <tr>
                                                <td>{$rownumber}</td>
						<td>{$grow["name"]}</td>
                                                <td>{$prow["subject"]}</td>
                                                <!-- <td>{$prow["text"]}</td> -->
                                                <td>
                                                    <img src="img.php?did={$rows[$i]["id"]}&type=gall" width="50px" height="50px" /> 
                                                </td>
                                                <td class="text-center">
							<a href="?act=del&did={$rows[$i]['id']}&gid={$rows[$i]['gid']}"  >												
                                                    <button class="btn btn-xs btn-danger" title="پاک کردن"><i class="fa fa-minus"></i></button>
							</a>	
                                                </td>
                                            </tr>
cd;
}

	$pgcodes = $pagination->render(true);
	//var_dump($pagination);
$html.=<<<cd
                                            </tbody>
                                        </table>
                                    </div>
									{$pgcodes}
                                    <!--Table Wrapper Finish-->                                    
                                </div>
                            </div>
                        </div>
                    </div>           
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