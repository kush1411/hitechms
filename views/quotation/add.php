<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title><?php echo SITE_NAME; ?> | <?php echo $add_title; ?></title>
        <link type="text/css" rel="stylesheet" href="<?= base_url() ?>assets/admin/css/bootstrap.css" />
        <link type="text/css" rel="stylesheet" href="<?= base_url() ?>assets/admin/css/style.css" />
        <link type="text/css" rel="stylesheet" href="<?= base_url() ?>assets/admin/css/font-awesome.min.css" />
        <link type="text/css" rel="stylesheet" href="<?= base_url() ?>assets/admin/css/material-design-iconic-font.min.css" />
        <script type="text/javascript" src="<?= base_url() ?>assets/admin/js/libs/jquery/jquery-1.11.2.min.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/admin/js/libs/jquery/jquery-migrate-1.2.1.min.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/admin/js/libs/bootstrap/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/admin/js/libs/spin.js/spin.min.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/admin/js/libs/autosize/jquery.autosize.min.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/admin/js/libs/nanoscroller/jquery.nanoscroller.min.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/admin/js/core/source/App.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/admin/js/core/source/AppNavigation.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/admin/js/core/source/AppOffcanvas.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/admin/js/core/source/AppCard.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/admin/js/core/source/AppForm.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/admin/js/core/source/AppNavSearch.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/admin/js/core/source/AppVendor.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/admin/js/libs/validation/jquery.validate.min.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/admin/js/libs/validation/additional-methods.min.js"></script>
    </head>
    <body class="menubar-hoverable header-fixed ">
        <!-- BEGIN HEADER-->
        <header id="header" >
            <div class="headerbar">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="headerbar-left">
                    <ul class="header-nav header-nav-options">
                        <li class="header-nav-brand" >
                            <div class="brand-holder">
                                <a href="javascript:void(0);">
                                    <span class="text-lg text-bold text-primary logo_text"><img src="http://hitechms.in/assets/frontend/img/logoadmin.png"  /></span>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="headerbar-right">
                </div><!--end #header-navbar-collapse -->
            </div>
        </header>
        <!-- END HEADER-->
        <!-- BEGIN BASE-->
        <div id="base" style="padding-left: 0;">
            <!-- BEGIN OFFCANVAS LEFT -->
            <div class="offcanvas">
            </div><!--end .offcanvas-->
            <!-- END OFFCANVAS LEFT -->
            <!-- BEGIN CONTENT-->
            <div id="content">
                <section>
                    <div class="section-body contain-lg">
                        <div class="row">
                            <div class="col-lg-12">
                                <h2 class="text-primary">Send Quotation</h2>
                            </div>
                            <div class="col-lg-12">
                                <?php echo $add_error; ?>
                                <?php echo $add_warning; ?>
                                <?php echo $add_info; ?>
                                <?php echo $add_success; ?>
                            </div>
                            <div class="col-lg-12">
                                <?php echo form_open_multipart('', 'id="addadminfrm" class="form"'); ?>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <input type="text" name="quotation" id="quotation" value="" class="form-control numbersonly" maxlength="10" min="1" required=""/>
                                                    <?php echo form_label('<span style="color: red">*</span>Quotation : ', 'quotation', array('class' => 'required')); ?>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="">
                                                    <?php echo form_label('Quotation File: ', 'file', array('class' => 'required')); ?>
                                                    <input type="file" name="file" id="file" value="" class="" accept=""/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <textarea name="remarks" id="remarks" rows="2" class="form-control" maxlength="400" ></textarea>
                                                    <?php echo form_label('Remarks : ', 'remarks'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-actionbar">
                                            <div class="card-actionbar-row">
                                                <?php
                                                echo form_submit(array('name' => 'submit',
                                                    'id' => 'submit',
                                                    'value' => 'Submit',
                                                    'class' => 'btn btn-danger'
                                                ));
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div><!--end .card -->
                                <?php echo form_close(); ?>
                            </div><!--end .col -->
                        </div><!--end .row -->
                    </div><!--end .section-body -->
                </section>
            </div><!--end #content-->
            <!-- END MENUBAR -->
        </div><!--end #base-->
        <!-- END BASE -->
        <script>
            $(document).ready(function () {
                setTimeout(function () {
                    $('.alert').alert('close');
                }, 3000);
                $("#addadminfrm").validate();
            });
            $(document).on('keydown', '.numbersonly', function (e) {
                var key = e.keyCode ? e.keyCode : e.which;
                if (!([8, 9, 13, 27, 46, 110, 190].indexOf(key) !== -1 ||
                        (key == 65 && (e.ctrlKey || e.metaKey)) ||
                        (key >= 35 && key <= 40) ||
                        (key >= 48 && key <= 57 && !(e.shiftKey || e.altKey)) ||
                        (key >= 96 && key <= 105)
                        ))
                    e.preventDefault();
            });
        </script>
    </body>
</html>

