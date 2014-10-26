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
                        <h3 class="ls-top-header">اطلاعات تماس با ما</h3>
                        <!--Top header end -->
                        <!--Top breadcrumb start -->
                        <ol class="breadcrumb">
                            <li><a href="admin.php"><i class="fa fa-home"></i></a></li>
                            <li class="active">اطلاعات تماس با ما</li>
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
                                    <h3 class="panel-title">اطلاعات تماس با ما</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="row ls_divider">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">آدرس ایمیل</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="help_text" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row ls_divider">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">آدر RSS</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="help_text" />
                                                <span class="help_text">
                                                    آدرس خبرنامه را در این قسمت قرار دهید. به طور مثال: http://www.rahyabclinic.com/rss.xml
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row ls_divider">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">تلفن کلینیک</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="help_text" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row ls_divider">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">آدرس کلینیک</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="help_text" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row ls_divider">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">آدرس facebook</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="help_text" />
                                                <span class="help_text">
                                                    آدرس فیسبوک را در این قسمت قرار دهید. به طور مثال: https://www.facebook.com/rahyabclinic
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row ls_divider">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">آدرس twitter</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="help_text" />
                                                <span class="help_text">
                                                    آدرس تویتر را در این قسمت قرار دهید. به طور مثال: https://www.twitter.com/rahyabclinic
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row ls_divider">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">آدرس google plus</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="help_text" />
                                                <span class="help_text">
                                                    آدرس گوگل پلاس را در این قسمت قرار دهید. به طور مثال: https://plus.google.com/rahyabclinic
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