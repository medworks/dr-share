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
		$db->Delete("ask"," id",$_GET["did"]);		
		header('location:regfaq.php?act=new');	
	}	
	    
$html.=<<<cd
    <!--Page main section start-->
    <section id="min-wrapper">
        <div id="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!--Top header start-->
                        <h3 class="ls-top-header">پرسش و پاسخ</h3>
                        <!--Top header end -->
                        <!--Top breadcrumb start -->
                        <ol class="breadcrumb">
                            <li><a href="javascript:void(0);"><i class="fa fa-home"></i></a></li>
                            <li class="active">پرسش و پاسخ</li>
                        </ol>
                        <!--Top breadcrumb start -->
                    </div>
                </div>
                <!-- Main Content Element  Start-->
                <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">لیست سوالات</h3>
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
                                                <th>نام و نام خانوادگی</th>
                                                <th>ایمیل</th>
                                                <th>تلفن</th>
						<th>پاسخ داده شده؟</th>
                                                <th class="text-center">عملیات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
cd;

	$records_per_page = 10;
	$pagination = new Zebra_Pagination();

	$pagination->navigation_position("right");

	$reccount = $db->CountAll("ask");
	$pagination->records($reccount); 
	
    $pagination->records_per_page($records_per_page);	

$rows = $db->SelectAll("ask",
			"*",
			NULL,
			"regdate DESC,answer ASC",
			($pagination->get_page() - 1) * $records_per_page,
			$records_per_page);
				
	
//echo $db->cmd;
for($i = 0; $i < Count($rows); $i++)
{
$rownumber = $i+1;
$rows[$i]["answer"] = ($rows[$i]["answer"]==0)?"خیر":"بله";
$html.=<<<cd

                                                
                                            <tr>
                                                <td>{$rownumber}</td>
                                                <td>{$rows[$i]["name"]}</td>
                                                <td>{$rows[$i]["mobile"]}</td>
                                                <td>{$rows[$i]["tel"]}</td>
						<td>{$rows[$i]["answer"]}</td>
                                                <td class="text-center">
							<a href="regfaqdetail.php?act=rep&did={$rows[$i]["id"]}"  >					
								<button class="btn btn-xs btn-warning" title="پاسخ"><i class="fa fa-eye"></i></button>
							</a>	
							<a href="?act=del&did={$rows[$i]["id"]}"  >                   
							    <button class="btn btn-xs btn-danger" title="حذف"><i class="fa fa-minus"></i></button>
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