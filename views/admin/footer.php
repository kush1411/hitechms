<!-- BEGIN MENUBAR-->
<div id="menubar" class="menubar-inverse ">
    <div class="menubar-fixed-panel">
        <div>
            <a class="btn btn-icon-toggle btn-default menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
                <i class="fa fa-bars"></i>
            </a>
        </div>
        <div class="expanded">
            <a href="<?= base_url('admin') ?>">
                <span class="text-lg text-bold text-primary ">ADMIN</span>
            </a>
        </div>
    </div>
    <div id="menubar" class="menubar-inverse ">
        <div class="menubar-fixed-panel">
            <div>
                <a class="btn btn-icon-toggle btn-default menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
                    <i class="fa fa-bars"></i>
                </a>
            </div>
            <div class="expanded">
                <a href="<?= base_url('admin') ?>">
                    <span class="text-lg text-bold text-primary ">ADMIN</span>
                </a>
            </div>
        </div>
        <div class="menubar-scroll-panel">

            <!-- BEGIN MAIN MENU -->
            <ul id="main-menu" class="gui-controls">
                <?php
                if ($menus = $this->session->userdata(SITE_NAME . '_menus')) {
                    $ModulesRights = $this->session->userdata(SITE_NAME . '_userRights');
                    $icons = iconarray();
                    foreach ($menus as $mk => $mv) {
                        if ($mk !== MYACCOUNT) {
                            ?>
                            <li>                               
                                <a href="<?php echo base_url('admin/' . strtolower($mv) . '/list') ?>" class="<?= isset($menuaction) && $menuaction == strtolower($mv) ? "active" : "" ?>">
                                    <div class="gui-icon"><i class="md <?= $icons[$mv] ?>"></i></div>
                                    <span class="title"><?php echo $mv; ?></span>
                                </a>
                            </li>
                            <?php
                        }
                    }
                }
                ?>
            </ul><!--end .main-menu -->
            <!-- END MAIN MENU -->
            <div class="menubar-foot-panel">
                <small class="no-linebreak hidden-folded">
                    <span class="opacity-75">Copyright &copy; <?= date('Y') ?></span> <strong>Diamond Store</strong>
                </small>
            </div>
        </div><!--end .menubar-scroll-panel-->
    </div><!--end .menubar-scroll-panel-->
</div><!--end #menubar-->
<!-- END MENUBAR -->
</div><!--end #base-->
<!-- END BASE -->
<script src="<?=base_url();?>assets/js/bootbox.min.js"></script>
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
    
    $(document).on("click", ".alertpdf", function (e) {
        e.preventDefault();
        var href_link = $(this).attr('href');
        bootbox.confirm("Are you sure? you want to download PDF?", function (result) {
            if (result)
            {
                var win = window.open(href_link, '_blank');
                win.focus();
            }
            $(".gradeX").removeClass("selected");
        });
    });
</script>
<script>
    $(document).ready(function () {
        setTimeout(function () {
            $('.alert').alert('close');
        }, 3000);
    });
</script>
</body>
</html>