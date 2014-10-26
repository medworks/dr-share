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
                        <h3 class="ls-top-header">دسته بندی منوها</h3>
                        <!--Top header end -->
                        <!--Top breadcrumb start -->
                        <ol class="breadcrumb">
                            <li><a href="admin.php"><i class="fa fa-home"></i></a></li>
                            <li class="active">تعریف زیر منو</li>
                        </ol>
                        <!--Top breadcrumb start -->
                    </div>
                </div>
                <!-- Main Content Element  Start-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">تعریف زیر منو</h3>
                            </div>
                            <div class="panel-body">
                                <form class="form-inline ls_form" role="form">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="اسم زیر منو" />
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="ترتیب" />
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
                                <h3 class="panel-title">ویرایش زیر منو</h3>
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
                                            <th>نام زیرمنو</th>
                                            <th>منو و زیر منو</th>
                                            <th class="text-center">عملیات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>PSD Design</td>
                                            <td>
                                                <span class="label label-success">خانواده</span>
                                                <span class="label label-info">ازدواج</span>
                                                <span class="label label-warning">مشکلات ازدواج</span>
                                                <span class="label label-danger">مشکلات...</span>
                                            </td>
                                            <td class="text-center">
                                                <button class="btn btn-xs btn-warning" title="ویرایش"><i class="fa fa-pencil-square-o"></i></button>
                                                <button class="btn btn-xs btn-danger" title="پاک کردن"><i class="fa fa-minus"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>PSD</td>
                                            <td>
                                                <span class="label label-success">خانواده</span>
                                                <span class="label label-info">ازدواج</span>
                                                <span class="label label-warning">مشکلات ازدواج</span>
                                                <span class="label label-danger">مشکلات...</span>
                                            </td>
                                            <td class="text-center">
                                                <button class="btn btn-xs btn-warning" title="ویرایش"><i class="fa fa-pencil-square-o"></i></button>
                                                <button class="btn btn-xs btn-danger" title="پاک کردن"><i class="fa fa-minus"></i></button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!--Table Wrapper Finish-->
                                <div class="dataTables_paginate paging_full_numbers" id="ls-editable-table_paginate">
                                    <a class="paginate_button first disabled" aria-controls="ls-editable-table" tabindex="0" id="ls-editable-table_first">اولین</a>
                                    <a class="paginate_button previous disabled" aria-controls="ls-editable-table" tabindex="0" id="ls-editable-table_previous">قبلی</a>
                                    <span>
                                        <a class="paginate_button current" aria-controls="ls-editable-table" tabindex="0">1</a>
                                        <a class="paginate_button " aria-controls="ls-editable-table" tabindex="0">2</a>
                                        <a class="paginate_button " aria-controls="ls-editable-table" tabindex="0">3</a>
                                        <a class="paginate_button " aria-controls="ls-editable-table" tabindex="0">4</a>
                                        <a class="paginate_button " aria-controls="ls-editable-table" tabindex="0">5</a>
                                        <a class="paginate_button " aria-controls="ls-editable-table" tabindex="0">6</a>
                                    </span>
                                    <a class="paginate_button next" aria-controls="ls-editable-table" tabindex="0" id="ls-editable-table_next">بعدی</a>
                                    <a class="paginate_button last" aria-controls="ls-editable-table" tabindex="0" id="ls-editable-table_last">آخرین</a>
                                </div>
                                <div class="dataTables_info" id="ls-editable-table_info" role="alert" aria-live="polite" aria-relevant="all">نمایش 1 تا 10 از 577 فیلد</div>
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