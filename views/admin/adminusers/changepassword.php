<script>
    $(document).ready(function () {
        $("#sumbit").on('click', function () {
            $flag = true;
            if ($("#password").val() == '') {
                $flag = false;
                $("#password").removeClass('inp-form');
                $("#password").addClass('inp-form-error');
                $("#passworderror").css('display', 'block');
            } else {
                $("#passworderror").css('display', 'none');
            }
            if ($("#conpassword").val() == '') {
                $flag = false;
                $("#conpassword").removeClass('inp-form');
                $("#conpassword").addClass('inp-form-error');
                $("#cpassworderror").css('display', 'block');
            } else {
                $("#cpassworderror").css('display', 'none');
            }
            if ($("#password").val() != $("#conpassword").val()) {
                $flag = false;
                $("#conpassword").removeClass('inp-form');
                $("#conpassword").addClass('inp-form-error');
                $("#cpassworderror").css('display', 'block');
            } else {
                $("#cpassworderror").css('display', 'none');
            }

            if ($flag)
                $("#addadminfrm").submit();
        });
    });

</script>
<!-- BEGIN CONTENT-->
<div id="content">
    <section>
        <div class="section-body contain-lg">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="text-primary">Change Admin Login Password</h1>
                </div>
                <div class="col-lg-12">
                    <?php echo $add_error; ?>
                    <?php echo $add_warning; ?>
                    <?php echo $add_info; ?>
                    <?php echo $add_success; ?>
                </div>
                <div class="col-lg-8">
                    <?php echo form_open('admin/user/changepassword/', 'id=addadminfrm class="form"', $hidden = array('mid' => $mid)); ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="password" name="password" id="password" class="form-control mini" />
                                        <label for="password">Password : <label>*</label></label>
                                        <div id="passworderror" style="display:none"><div class="error-left"></div><div class="error-inner">This field is required.</div></div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="password" name="conpassword" id="conpassword" class="form-control mini" />
                                        <label for="conpassword">Conform Password : <label>*</label></label>
                                        <div id="cpassworderror" style="display:none"><div class="error-left"></div><div class="error-inner">This field is required.</div></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-actionbar">
                            <div class="card-actionbar-row">
                                <input type="reset" value="reset" class="form-reset btn btn-info"  />
                                <input type="button" id="sumbit" value="submit" class="form-submit btn btn-danger ink-reaction" />
                            </div>
                        </div>
                    </div><!--end .card -->
                    <?php echo form_close(); ?>
                </div><!--end .col -->
            </div><!--end .row -->
        </div><!--end .section-body -->
    </section>
</div><!--end #content-->