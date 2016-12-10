<?php if ($this->session->userdata(SITE_NAME . '_user_data')) { ?>
    <div id="menubar" class="menubar-inverse ">
        <div class="menubar-fixed-panel">
            <div>
                <a class="btn btn-icon-toggle btn-default menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
                    <i class="fa fa-bars"></i>
                </a>
            </div>
            <div class="expanded">
                <a href="<?= base_url() ?>">
                    <span class="text-lg text-bold text-primary ">Company</span>
                </a>
            </div>
        </div>
        <div class="menubar-scroll-panel">

            <!-- BEGIN MAIN MENU -->
            <ul id="main-menu" class="gui-controls">
                <li>                               
                    <a href="<?php echo base_url('/dashboard') ?>" class="<?php echo isset($menuaction) && $menuaction == 'dashboard' ? "active" : "" ?>">
                        <div class="gui-icon"><i class="md md-home"></i></div>
                        <span class="title">Dashboard</span>
                    </a>
                </li>

                <li>                               
                    <a href="<?php echo base_url('/location') ?>" class="<?php echo isset($menuaction) && $menuaction == 'location' ? "active" : "" ?>">
                        <div class="gui-icon"><i class="md md-place"></i></div>
                        <span class="title">Location</span>
                    </a>
                </li>
                <li>                               
                    <a href="<?php echo base_url('/designation') ?>" class="<?php echo isset($menuaction) && $menuaction == 'designation' ? "active" : "" ?>">
                        <div class="gui-icon"><i class="md md-nature-people"></i></div>
                        <span class="title">Designation</span>
                    </a>
                </li>
                <li>                               
                    <a href="<?php echo base_url('/provider') ?>" class="<?php echo isset($menuaction) && $menuaction == 'provider' ? "active" : "" ?>">
                        <div class="gui-icon"><i class="md md-directions-walk"></i></div>
                        <span class="title">Service Provider</span>
                    </a>
                </li>
                <li>                               
                    <a href="<?php echo base_url('/employee') ?>" class="<?php echo isset($menuaction) && $menuaction == 'employee' ? "active" : "" ?>">
                        <div class="gui-icon"><i class="md md-timer-auto"></i></div>
                        <span class="title">Employee</span>
                    </a>
                </li>
                <li>                               
                    <a href="<?php echo base_url('/machine') ?>" class="<?php echo isset($menuaction) && $menuaction == 'machine' ? "active" : "" ?>">
                        <div class="gui-icon"><i class="md md-adb"></i></div>
                        <span class="title">Machine</span>
                    </a>
                </li>
                <li class="gui-folder expanded">
                    <a>
                        <div class="gui-icon"><i class="md md-event-note"></i></div>
                        <span class="title">Report</span>
                    </a>
                    <ul>
                        <li><a href="<?=base_url("report/expense")?>" class="<?=isset($menuaction) && $menuaction == 'expense' ? "active" : ""?>"><span class="title">Expense</span></a></li>
                        <li><a href="<?=base_url("report")?>" class="<?=isset($menuaction) && $menuaction == 'report' ? "active" : ""?>"><span class="title">Assigned </span></a></li>
                        <li><a href="<?=base_url("report")?>" class="<?=isset($menuaction) && $menuaction == 'report' ? "active" : ""?>"><span class="title">Completed </span></a></li>
                        <li><a href="<?=base_url("report")?>" class="<?=isset($menuaction) && $menuaction == 'report' ? "active" : ""?>"><span class="title">Canceled </span></a></li>
                    </ul>
                </li>
            </ul><!--end .main-menu -->
            <!-- END MAIN MENU -->
            <div class="menubar-foot-panel">
                <small class="no-linebreak hidden-folded">
                    <span class="opacity-75">Copyright &copy; <?= date('Y') ?></span> <strong>Diamond Store</strong>
                </small>
            </div>
        </div><!--end .menubar-scroll-panel-->
    </div><!--end .menubar-scroll-panel-->
<?php } ?>
<!-- END MENUBAR -->
</div><!--end #base-->
<!-- END BASE -->
<script>
    function toggleChecks(obj) {

        $('.case').prop('checked', obj.checked);
    }

    function toggleChecksgroup(obj) {
        $('.casegroup').prop('checked', obj.checked);
    }

    function checkValid() {
        if ($(".case:checked").length > 0) {
            document.getElementById('frmDelete').submit();
        } else {
            alert("You didn't select any row");
        }
    }

</script>
<?php if (isset($menuaction) && $menuaction != 'dashboard') { ?>
    <script>
        $(document).ready(function () {
            setTimeout(function () {
                $('.alert').alert('close');
            }, 3000);
        });
    </script>
<?php } ?>

<script src="<?= base_url(); ?>assets/js/bootbox.min.js"></script>
<script>
        $(document).on("click", ".alertme", function (e) {
            e.preventDefault();
            var href_link = $(this).attr('href');
            bootbox.confirm("Are you sure?", function (result) {
                if (result)
                {
                    window.location.href = href_link;
                }
                $(".gradeX").removeClass("selected");
            });
        });
</script>
</body>
</html>