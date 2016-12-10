<?php
?>
<!-- BEGIN CONTENT-->
<div id="content">
    <section class="style-default-bright" style="background-color: transparent;">
        <div class="section-header">
            <h2 class="text-primary">Expense Report</h2>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <?php echo $add_error; ?>
                    <?php echo $add_warning; ?>
                    <?php echo $add_info; ?>
                    <?php echo $add_success; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <?php
                    echo form_open("", 'id="addadminfrm" class="form"');
                    ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select class="form-control select2-list" name="provider[]" id="provider" data-placeholder="Select Provider" multiple="">
                                            <?php
                                            if (!empty($provider)) {
                                                foreach ($provider as $key => $value) {
                                                    $sel = '';
                                                    if (isset($report) && in_array($value->SerProvID, $report->provider)) {
                                                        $sel = 'selected=""';
                                                    }
                                                    echo '<option value="' . $value->SerProvID . '" ' . $sel . '>' . $value->Name . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                        <label>Service Provider:</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-daterange input-group" id="demo-date-range">
                                            <div class="input-group-content">
                                                <input type="text" class="form-control" name="start_dt" readonly="" value="<?= isset($report) && $report->start_dt != '' ? $report->start_dt : '' ?>"/>
                                                <label>Date range</label>
                                            </div>
                                            <span class="input-group-addon">to</span>
                                            <div class="input-group-content">
                                                <input type="text" class="form-control" name="end_dt" readonly="" value="<?= isset($report) && $report->end_dt != '' ? $report->end_dt : '' ?>"/>
                                                <div class="form-control-line"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select class="form-control select2-list" name="exp_type" id="exp_type" data-placeholder="--Select Expense Type--">
                                            <option value="">--Select Expense Type--</option>
                                            <option value="Purchase" <?= isset($report) && $report->exp_type == 'Purchase' ? 'selected=""' : '' ?> >Purchase</option>
                                            <option value="Maintenance" <?= isset($report) && $report->exp_type == 'Maintenance' ? 'selected=""' : '' ?> >Maintenance</option>
                                        </select>
                                        <label>Expense Type:</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select class="form-control select2-list" name="status_type" id="status_type" data-placeholder="--Select Status Type--">
                                            <option value="">--Select Status Type--</option>
                                            <option value="Pending" <?= isset($report) && $report->status_type == 'Pending' ? 'selected=""' : '' ?>>Pending</option>
                                            <option value="Done" <?= isset($report) && $report->status_type == 'Canceled' ? 'selected=""' : '' ?> >Done</option>
                                        </select>
                                        <label>Status Type:</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select class="form-control select2-list" name="report_type" id="report_type" data-placeholder="--Select Report Type--">
                                            <option value="">--Select Report Type--</option>
                                            <option value="Detail" <?= isset($report) && $report->report_type == 'Detail' ? 'selected=""' : '' ?> >Detail</option>
                                            <option value="Summary" <?= isset($report) && $report->report_type == 'Summary' ? 'selected=""' : '' ?> >Summary</option>
                                        </select>
                                        <label>Report Type:</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-actionbar">
                            <div class="card-actionbar-row">
                                <input type="submit" name="submit" value="Search" class="btn btn-primary-dark" />
                                <?php
                                if(isset($report)){ ?>
                                <a href="" class="btn btn-default-dark" >Clear</a>
                                <?php }
                                ?>
                            </div>
                        </div>
                    </div><!--end .card -->
                    <?php echo form_close(); ?>

                    <?php if (isset($reportData) && !empty($reportData)) { ?>
                        <div class="card">
                            <div class="card-head">
                                Result :
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <table id="datatable1" class="table table-striped table-hover" width="100%">
                                        <thead>
                                            <tr>
                                                <th style="width: 105px">Dt&Time<br/>Job ID</th>
                                                <th>Type</th>
                                                <th style="width: 90px">State <br/>City / Village</th>
                                                <th style="width: 80px">Req. By<br/>Contact No</th>
                                                <th style="width: 300px">Request Desc</th>
                                                <th style="width: 120px">Assigned To<br/>Dt&Time</th>
                                                <th>Status</th>
                                                <th>Completed Remarks</th>
                                                <th>Canceled Remarks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($reportData as $user) { ?>
                                                <tr class="odd gradeX">
                                                    <td class=""><?php echo date('d-m-Y H:i', strtotime($user->InsDateTime)); ?><br/><?php echo $user->ticketid; ?></td>
                                                    <td><?php echo $user->request_type; ?></td>
                                                    <td><?php echo $user->state_name . '<br/>' . $user->city_name; ?></td>
                                                    <td><?php echo $user->Name . '<br/>' . $user->request_contactno; ?></td>
                                                    <td><?php echo $user->request_desc ?></td>
                                                    <td>
                                                        <?php
                                                        echo $user->EngName . '<br/>' . date('d-m-Y H:i', strtotime($user->assigned_DateTime));
                                                        ?>
                                                    </td>
                                                    <td><?= $user->status ?>
                                                    </td>
                                                    <td><?php
                                                        echo $user->completed_remark;
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        echo $user->canceled_remark;
                                                        ?></td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php }
                    ?>
                </div>
            </div><!--end .row -->
        </div><!--end .section-body -->
    </section>
</div><!--end #content-->
<!-- END CONTENT -->