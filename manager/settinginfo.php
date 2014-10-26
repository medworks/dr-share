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
                        <h3 class="ls-top-header">اطلاعات سایت</h3>
                        <!--Top header end -->
                        <!--Top breadcrumb start -->
                        <ol class="breadcrumb">
                            <li><a href="admin.php"><i class="fa fa-home"></i></a></li>
                            <li class="active">اطلاعات سایت</li>
                        </ol>
                        <!--Top breadcrumb start -->
                    </div>
                </div>
                <!-- Main Content Element  Start-->
                <form class="form-horizontal ls_form" role="form">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">اطلاعات تکمیلی</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="row ls_divider">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">عنوان سایت</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="help_text">
                                                <span class="help_text">
                                                    عنوانی که بالای تب های مرورگر ها نمایش داده خواهد شد.
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row ls_divider">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">کلمات کلیدی</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="help_text">
                                                <span class="help_text">
                                                    این کلمات برای جستجوگر ها مفید می باشند. برای جدا نمودن هر کلمه از علامت , استفاده نمایید.
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row ls_divider">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">توضیحات سایت</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="help_text">
                                                <span class="help_text">
                                                    توضیحاتی که در هنگام جستجو در گوگل زیر لینک جستجو به نمایش گذاشته می شود.
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">ثبت اطلاعات</h3>
                                </div>
                                <div class="panel-body">
                                    <button type="submit" class="btn btn-default">ثبت</button>
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
<?php
    include_once("./inc/footer.php")
?>