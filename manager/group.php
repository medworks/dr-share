<?php
    include_once("./inc/header.php")
?>
    <!--Page main section start-->
    <section id="min-wrapper">
        <div id="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!--Top header start-->
                        <h3 class="ls-top-header">دسته بندی گروه ها</h3>
                        <!--Top header end -->
                        <!--Top breadcrumb start -->
                        <ol class="breadcrumb">
                            <li><a href="admin.php"><i class="fa fa-home"></i></a></li>
                            <li class="active">تعریف گروه</li>
                        </ol>
                        <!--Top breadcrumb start -->
                    </div>
                </div>
                <!-- Main Content Element  Start-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">تعریف گروه</h3>
                            </div>
                            <div class="panel-body">
                                <form class="form-inline ls_form" role="form">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="اسم گروه" />
                                    </div>
                                    <button type="submit" class="btn btn-default">ثبت</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">ویرایش گروه ها</h3>
                            </div>
                            <div class="panel-body">
                                <!--Table Wrapper Start-->
                                <div class="table-responsive ls-table">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>ردیف</th>
                                                <th>نام گروه</th>
                                                <th>عملیات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Mark</td>
                                                <td>
                                                    <ul class="ls-glyphicons-list">
                                                        <li>
                                                            <a href="#" title="پاک کردن" style="margin-left:5px"><span class="glyphicon glyphicon-remove"></span></a>
                                                            <a href="#" title="ویرایش"><span class="glyphicon glyphicon-edit"></span></a>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Mark</td>
                                                <td>
                                                    <ul class="ls-glyphicons-list">
                                                        <li>
                                                            <a href="#" title="پاک کردن" style="margin-left:5px"><span class="glyphicon glyphicon-remove"></span></a>
                                                            <a href="#" title="ویرایش"><span class="glyphicon glyphicon-edit"></span></a>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
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
<?php
    include_once("./inc/footer.php")
?>