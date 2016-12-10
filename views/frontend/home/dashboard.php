<!-- BEGIN CONTENT-->
<style>
    
.alert-callout.alert-default::before {
    background: #353132 none repeat scroll 0 0;
}
</style>
<div id="content">
    <section>
        <div class="section-body" style="margin-top: 20px">
            <div class="row">
                <!-- BEGIN ALERT - TIME ON SITE -->
                <div class="col-md-2 col-sm-6">
                    <div class="card">
                        <div class="card-body no-padding">
                            <div class="alert alert-callout alert-info no-margin">
                                <h1 class="pull-right text-info"><i class="md md-place"></i></h1>
                                <strong class="text-xl"><?=$loc->cnt?></strong><br/>
                                <span class="opacity-50">Location</span>
                            </div>
                        </div><!--end .card-body -->
                    </div><!--end .card -->
                </div><!--end .col -->
                <!-- END ALERT - TIME ON SITE -->
                
                <!-- BEGIN ALERT - TIME ON SITE -->
                <div class="col-md-2 col-sm-6">
                    <div class="card">
                        <div class="card-body no-padding">
                            <div class="alert alert-callout alert-warning no-margin">
                                <h1 class="pull-right text-warning"><i class="md md-nature-people"></i></h1>
                                <strong class="text-xl"><?=$desg->cnt?></strong><br/>
                                <span class="opacity-50">Designation</span>
                            </div>
                        </div><!--end .card-body -->
                    </div><!--end .card -->
                </div><!--end .col -->
                <!-- END ALERT - TIME ON SITE -->
                
                
                <!-- BEGIN ALERT - TIME ON SITE -->
                <div class="col-md-3 col-sm-6">
                    <div class="card">
                        <div class="card-body no-padding">
                            <div class="alert alert-callout alert-danger no-margin">
                                <h1 class="pull-right text-danger"><i class="md md-directions-walk"></i></h1>
                                <strong class="text-xl"><?=$provider->cnt?></strong><br/>
                                <span class="opacity-50">Service Provider</span>
                            </div>
                        </div><!--end .card-body -->
                    </div><!--end .card -->
                </div><!--end .col -->
                <!-- END ALERT - TIME ON SITE -->
                
                <!-- BEGIN ALERT - TIME ON SITE -->
                <div class="col-md-2 col-sm-6">
                    <div class="card">
                        <div class="card-body no-padding">
                            <div class="alert alert-callout alert-success no-margin">
                                <h1 class="pull-right text-success"><i class="md md-timer-auto"></i></h1>
                                <strong class="text-xl"><?=$emp->cnt?></strong><br/>
                                <span class="opacity-50">Employee</span>
                            </div>
                        </div><!--end .card-body -->
                    </div><!--end .card -->
                </div><!--end .col -->
                <!-- END ALERT - TIME ON SITE -->
                
                <!-- BEGIN ALERT - TIME ON SITE -->
                <div class="col-md-2 col-sm-6">
                    <div class="card">
                        <div class="card-body no-padding">
                            <div class="alert alert-callout alert-default no-margin">
                                <h1 class="pull-right text-default"><i class="md md-adb"></i></h1>
                                <strong class="text-xl"><?=$mach->cnt?></strong><br/>
                                <span class="opacity-50">Machine</span>
                            </div>
                        </div><!--end .card-body -->
                    </div><!--end .card -->
                </div><!--end .col -->
                <!-- END ALERT - TIME ON SITE -->
                
                
            </div><!--end .row -->
			
			<div class="row">
							<div class="col-md-12">
								<div class="col-lg-12">
									<h2 class="text-primary">Payment Status</h2>
								</div><!--end .col -->
								<div class="col-sm-3">
									<div class="card">
										<div class="card-body text-center">
											<div class="knob knob-primary knob-default-track size-2"><input type="text" class="dial" data-min="0" data-max="100" data-thickness=.1 value="80" data-readOnly=true></div>
										</div><!--end .card-body -->
									</div><!--end .card -->
									<em class="text-caption">HiTech Laser</em>
								</div>
								<div class="col-sm-3">
									<div class="card">
										<div class="card-body text-center">
											<div class="knob knob-accent knob-default-track size-2"><input type="text" class="dial" data-min="0" data-max="100" data-thickness=.1 value="60" data-readOnly=true></div>
										</div><!--end .card-body -->
									</div><!--end .card -->
									<em class="text-caption">Sahjanand - Ahmedabad</em>
								</div><!--end .col -->
								<div class="col-sm-3">
									<div class="card">
										<div class="card-body text-center">
											<div class="knob knob-warning knob-default-track size-2"><input type="text" class="dial" data-min="0" data-max="100" data-thickness=.1 value="75" data-readOnly=true></div>
										</div><!--end .card-body -->
									</div><!--end .card -->
									<em class="text-caption">Sahjanand - Surat</em>
								</div>
								<div class="col-sm-3">
									<div class="card">
										<div class="card-body text-center">
											<div class="knob knob-info knob-default-track size-2"><input type="text" class="dial" data-min="0" data-max="100" data-thickness=.1 value="85" data-readOnly=true></div>
										</div><!--end .card-body -->
									</div><!--end .card -->
									<em class="text-caption">sarin</em>
								</div><!--end .col -->
							</div><!--end .row -->
						</div>
						<!-- BEGIN FLOT -->
						<div class="row">
							<div class="col-md-8">
								<div class="col-lg-12">
									<h2 class="text-primary">Expenses In 2015</h2>
								</div><!--end .col -->
								<div class="col-md-12">
									<div class="card">
										<div class="card-body">
											<div id="visitor-chart" class="flot height-6" data-title="Expenses" data-color="#eb0038"></div>
										</div><!--end .card-body -->
									</div><!--end .card -->
									<em class="text-caption">Expenses In 2015</em>
								</div><!--end .col -->
							</div><!--end .row -->
						<!-- END FLOT -->
						
						<!-- BEGIN MORRIS - STACKED BAR CHART -->
						<div class="col-md-4">
							<div class="col-md-12">
								<h2 class="text-primary">Performance</h2>
							</div><!--end .col -->
							<div class="col-md-12">
								<div class="card">
									<div class="card-body">
										<div id="morris-donut-graph" class="height-6" data-colors="#9C27B0,#2196F3,#0aa89e,#FF9800"></div>
									</div><!--end .card-body -->
								</div><!--end .card -->
								<em class="text-caption">Work Analysis</em>
							</div><!--end .col -->
						</div><!--end .row -->
						<!-- END MORRIS - STACKED BAR CHART -->
						
					</div>
						<!-- END KNOB -->

						<!-- BEGIN MORRIS - AREA CHART -->
						<div class="row">
							<div class="col-lg-12">
								<h2 class="text-primary">Work Given To Service Provider</h2>
							</div><!--end .col -->
							<div class="col-md-12">
								<div class="card">
									<div class="card-body">
										<div id="morris-bar-graph" class="height-7" data-colors="#9C27B0,#2196F3,#FF9800,#8bc34a"></div>
									</div><!--end .card-body -->
								</div><!--end .card -->
								<em class="text-caption">Grouped By Quarterly</em>
							</div><!--end .col -->
						</div><!--end .row -->
						<!-- END MORRIS - GROUPED BAR CHART -->
			
            <!--end .row -->
        </div><!--end .section-body -->
    </section>
</div><!--end #content-->
<!-- END CONTENT -->

<link type="text/css" rel="stylesheet" href="<?=base_url('assets/admin/');?>/css/libs/morris/morris.core.css" />
<script src="<?=base_url('assets/admin/');?>/js/libs/moment/moment.min.js"></script>
<script src="<?=base_url('assets/admin/');?>/js/libs/flot/jquery.flot.min.js"></script>
<script src="<?=base_url('assets/admin/');?>/js/libs/flot/jquery.flot.time.min.js"></script>
<script src="<?=base_url('assets/admin/');?>/js/libs/flot/jquery.flot.resize.min.js"></script>
<script src="<?=base_url('assets/admin/');?>/js/libs/flot/jquery.flot.orderBars.js"></script>
<script src="<?=base_url('assets/admin/');?>/js/libs/flot/jquery.flot.pie.js"></script>
<script src="<?=base_url('assets/admin/');?>/js/libs/jquery-knob/jquery.knob.min.js"></script>
<script src="<?=base_url('assets/admin/');?>/js/libs/raphael/raphael-min.js"></script>
<script src="<?=base_url('assets/admin/');?>/js/libs/morris.js/morris.min.js"></script>
<script src="<?=base_url('assets/admin/');?>/js/core/demo/DemoCharts.js"></script>


