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
                        <h3 class="ls-top-header">گالری تصاویر</h3>
                        <!--Top header end -->
                        <!--Top breadcrumb start -->
                        <ol class="breadcrumb">
                            <li><a href="admin.php"><i class="fa fa-home"></i></a></li>
                            <li class="active">گالری تصاویر</li>
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
                                    <h3 class="panel-title">انتخاب عکس</h3>
                                </div>
                                <div class="panel-body">
                                    <!-- <div class="row ls_divider">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">انتخاب عکس</label>
                                            <div class="col-md-10 ls-group-input">
                                                <input type="file" name="filename" value="Browse">
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="row ls_divider last">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">انتخاب عکس</label>
                                            <div class="col-md-10 ls-group-input">
                                                <div class="file-input file-input-new">
                                                    <input type="hidden" />
                                                    <div class="file-preview ">
                                                       <div class="file-preview-status text-center text-success"></div>
                                                       <div class="close fileinput-remove text-right">×</div>
                                                       <div class="file-preview-thumbnails"></div>
                                                       <div class="clearfix"></div>
                                                    </div>
                                                    <button type="button" class="btn btn-default fileinput-remove fileinput-remove-button"><i class="glyphicon glyphicon-ban-circle"></i> Remove</button>
                                                    <div class="btn btn-ls btn-file"><i class="glyphicon glyphicon-folder-open"></i> &nbsp;انتخاب فایل … <input id="file-3" type="file" multiple="true"></div>
                                                </div>
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