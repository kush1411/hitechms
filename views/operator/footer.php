<?php if ($this->session->userdata(SITE_NAME . '_operator_data')) { ?>
    <div id="menubar" class="menubar-inverse ">
        <div class="menubar-fixed-panel">
            <div>
                <a class="btn btn-icon-toggle btn-default menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
                    <i class="fa fa-bars"></i>
                </a>
            </div>
            <div class="expanded">
                <a href="<?= base_url('operator/dashboard') ?>">
                    <span class="text-lg text-bold text-primary ">Operator</span>
                </a>
            </div>
        </div>
        <div class="menubar-scroll-panel">

            <!-- BEGIN MAIN MENU -->
            <ul id="main-menu" class="gui-controls">
                <li>                               
                    <a href="<?php echo base_url('operator/dashboard') ?>" class="<?php echo isset($menuaction) && $menuaction == 'dashboard' ? "active" : "" ?>">
                        <div class="gui-icon"><i class="md md-home"></i></div>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <li>                               
                    <a href="<?php echo base_url('operator/machine') ?>" class="<?php echo isset($menuaction) && $menuaction == 'machine' ? "active" : "" ?>">
                        <div class="gui-icon"><i class="md md-adb"></i></div>
                        <span class="title">Machine</span>
                    </a>
                </li>
                <li>                               
                    <a href="<?php echo base_url('operator/jobmst') ?>" class="<?php echo isset($menuaction) && $menuaction == 'jobmst' ? "active" : "" ?>">
                        <div class="gui-icon"><i class="md md-assignment"></i></div>
                        <span class="title">Job</span>
                    </a>
                </li>
                <li>                               
                    <a href="<?php echo base_url('operator/outmst') ?>" class="<?php echo isset($menuaction) && $menuaction == 'outmst' ? "active" : "" ?>">
                        <div class="gui-icon"><i class="md md-file-upload"></i></div>
                        <span class="title">Out</span>
                    </a>
                </li>
                <li>                               
                    <a href="<?php echo base_url('operator/inmst') ?>" class="<?php echo isset($menuaction) && $menuaction == 'inmst' ? "active" : "" ?>">
                        <div class="gui-icon"><i class="md md-file-download"></i></div>
                        <span class="title">In</span>
                    </a>
                </li>
                <li>                               
                    <a href="<?php echo base_url('operator/purchasejob') ?>" class="<?php echo isset($menuaction) && $menuaction == 'purchasejob' ? "active" : "" ?>">
                        <div class="gui-icon"><i class="md md-add-shopping-cart"></i></div>
                        <span class="title">Purchase Job</span>
                    </a>
                </li>
                <li>                               
                    <a href="<?php echo base_url('operator/purchasemst') ?>" class="<?php echo isset($menuaction) && $menuaction == 'purchasemst' ? "active" : "" ?>">
                        <div class="gui-icon"><i class="md md-add-shopping-cart"></i></div>
                        <span class="title">Purchase</span>
                    </a>
                </li>
                <li>
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
<script>
    $(document).ready(function () {
        setTimeout(function () {
            $('.alert').alert('close');
        }, 3000);
        $('.date-format').datepicker({autoclose: true, todayHighlight: true, format: "dd/mm/yyyy", endDate: "<?=date('d/m/Y')?>"});
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