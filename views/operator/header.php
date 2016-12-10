<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title><?php echo SITE_NAME; ?> | <?php echo $add_title; ?></title>
        <?php
        echo $add_css;
        echo $add_js;
        ?>
        <script type="text/javascript" src="<?=base_url()?>assets/admin/js/libs/validation/jquery.validate.min.js"></script>
		<script type="text/javascript" src="<?=base_url()?>assets/admin/js/libs/validation/additional-methods.min.js"></script>
		
    </head>
		<body class="menubar-hoverable header-fixed ">
<?php if($this->session->userdata(SITE_NAME . '_operator_data')){ ?>
		<!-- BEGIN HEADER-->
		<header id="header" >
			<div class="headerbar">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="headerbar-left">
					<ul class="header-nav header-nav-options">
						<li class="header-nav-brand" >
							<div class="brand-holder">
								<a href="<?=base_url()?>">
									<span class="text-lg text-bold text-primary logo_text"><img src="http://hitechms.in/assets/frontend/img/logoadmin.png"  /></span>
								</a>
							</div>
						</li>
						<li>
							<a class="btn btn-icon-toggle menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
								<i class="fa fa-bars"></i>
							</a>
						</li>
					</ul>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="headerbar-right">
					<ul class="header-nav header-nav-profile">
						<li class="dropdown">
							<a href="javascript:void(0);" class="dropdown-toggle ink-reaction" data-toggle="dropdown">
							<?php
//                            if ($this->session->userdata[SITE_NAME . '_operator_data']['image'] && $this->session->userdata[SITE_NAME . '_operator_data']['image_name']) {
//                                $path = base_url($this->session->userdata[SITE_NAME . '_operator_data']['image'] . '/thumb/' . $this->session->userdata[SITE_NAME . '_operator_data']['image_name']);
//                            } else {
                                $path = base_url('assets/admin/img/avatar1.jpg');
//                            }
                            ?>
								<img src="<?=$path?>" alt="Profile Pic" />
								<span class="profile-info">
									<?php echo $this->session->userdata[SITE_NAME . '_operator_data']['firstname'] ? ucfirst($this->session->userdata[SITE_NAME . '_operator_data']['firstname']) : ''; ?>
									<small>Operator</small>
								</span>
							</a>
							<ul class="dropdown-menu animation-dock">
								<li class="dropdown-header">Config</li>
								<li><a href="<?php echo base_url("operator/myaccount") ?>"> My Account</a></li>
								<li class="divider"></li>
								<li><a href="<?php echo base_url('operator/logout'); ?>"><i class="fa fa-fw fa-power-off text-danger"></i> Logout</a></li>
							</ul><!--end .dropdown-menu -->
						</li><!--end .dropdown -->
					</ul><!--end .header-nav-profile -->
				</div><!--end #header-navbar-collapse -->
			</div>
		</header>
		<!-- END HEADER-->
<?php } ?>
	<!-- BEGIN BASE-->
		<div id="base">

			<!-- BEGIN OFFCANVAS LEFT -->
			<div class="offcanvas">
			</div><!--end .offcanvas-->
			<!-- END OFFCANVAS LEFT -->