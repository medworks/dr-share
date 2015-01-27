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
		$db->Delete("defhamayesh"," id",$_GET["did"]);		
		header('location:editconference.php?act=new');	
	}
	else
	if ($_GET['act']=="expire")
	{
		$values = array("`expire`"=>"'1'");
		$db->UpdateQuery("defhamayesh",$values,array("id='{$_GET[did]}'"));
		header('location:editconference.php?act=new');	
	}	
	else
	if ($_GET['act']=="valid")
	{
		$values = array("`expire`"=>"'0'");
		$db->UpdateQuery("defhamayesh",$values,array("id='{$_GET[did]}'"));
		header('location:editconference.php?act=new');	
	}			
    
$html.=<<<cd
    <!--Page main section start-->
    <section id="min-wrapper">
        <div id="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!--Top header start-->
                        <h3 class="ls-top-header">ویرایش همایش ها</h3>
                        <!--Top header end -->
                        <!--Top breadcrumb start -->
                        <ol class="breadcrumb">
                            <li><a href="javascript:void(0);"><i class="fa fa-home"></i></a></li>
                            <li class="active">ویرایش همایش ها</li>
                        </ol>
                        <!--Top breadcrumb start -->
                    </div>
                </div>
                <!-- Main Content Element  Start-->
                <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">لیست همایش ها</h3>
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
                                                <th>عنوان</th>
                                                <th>زمان و ساعات همایش</th>
												<th>اعتبار</th>
                                                <th class="text-center">عملیات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
cd;

	$records_per_page = 10;
	$pagination = new Zebra_Pagination();

	$pagination->navigation_position("right");

	$reccount = $db->CountAll("defhamayesh");
	$pagination->records($reccount); 
	
    $pagination->records_per_page($records_per_page);	

$rows = $db->SelectAll(
				"defhamayesh",
				"*",
				NULL,
				"id ASC",
				($pagination->get_page() - 1) * $records_per_page,
				$records_per_page);
				
	
$vals = array();
for($i = 0; $i < Count($rows); $i++)
{
$rownumber = $i+1;
$rows[$i]["expire"] = ($rows[$i]["expire"]==0)?" دارد ":" خیر ";

$html.=<<<cd

                                                
                                            <tr>
                                                <td>{$rownumber}</td>
                                                <td>{$rows[$i]["title"]}</td>
                                                <td>{$rows[$i]["txtdate"]}</td>
												<td>{$rows[$i]["expire"]}</td>
                                                
                                                <td class="text-center">
												<a href="?act=expire&did={$rows[$i]["id"]}"  >												
                                                    <button class="btn btn-xs btn-danger" title="منقضی"><i class="fa fa-minus"></i></button>
												</a>	
												<a href="?act=valid&did={$rows[$i]["id"]}"  >					
                                                    <button class="btn btn-xs btn-danger" title="معتبر"><i class="fa fa-times"></i></button>
												</a>
												<a href="addconference.php?act=edit&did={$rows[$i]["id"]}"  >					
                                                    <button class="btn btn-xs btn-warning" title="ویرایش"><i class="fa fa-pencil-square-o"></i></button>
												</a>
												<a href="?act=del&did={$rows[$i]["id"]}"  >												
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