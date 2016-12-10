
<!-- BEGIN CONTENT-->
<div id="content">
    <section class="style-default-bright">
        <div class="section-header">
            <h2 class="text-primary">View Inward Jobs</h2>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12 margin-bottom-10">
                    <?php
                    if ($userRights['add']) {
                        ?>
                        <a href = "<?php echo base_url() ?>operator/inmst/add" class="btn btn-info btn-xs btn-raised pull-right">Add Inward</a>
                    <?php } ?>
                </div>
                <div class="col-lg-12">
                    <?php echo $add_error; ?>
                    <?php echo $add_warning; ?>
                    <?php echo $add_info; ?>
                    <?php echo $add_success; ?>
                </div>
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <?php if (isset($allins) && !empty($allins)) { ?>
                            <table id="datatable1" class="table table-striped table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th>Machine</th>
                                        <th>Part</th>
                                        <th>Mfg</th>
                                        <th>Provider</th>
                                        <th>Engineer Name</th>
                                        <th>Engineer Contact</th>
                                        <th>Engineer Drop Date</th>
                                        <th class="sort">Created Date</th>
                                        <?php if ($userRights['edit'] || $userRights['delete']) { ?> <th class="sort">Action</th><?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($allins as $user) { ?>
                                        <tr class="odd gradeX">
                                            <td class=""><?php echo $user->MachCode.' | '.$user->MachName; ?></td>
                                            <td class="sorting_1"><?php echo $user->SubPartName == NULL ? $user->PartName : $user->SubPartName; ?></td>
                                            <td class=""><?php echo $user->MfgName; ?></td>
                                            <td class=""><?php echo $user->ProviderName; ?></td>
                                            <td class="sorting_1"><?php echo $user->EngineerName; ?></td>
                                            <td class=""><?php echo $user->EngineerContact; ?></td>
                                            <td class=""><?php echo date("d-m-Y", strtotime($user->EngineerDropTime)); ?></td>
                                            <td class="center"><?php echo date("d-m-Y", strtotime($user->InsDateTime)); ?></td>
                                            <td class="center">
                                                <?php
                                                if($user->Status == 'In'){
                                                if ($userRights['edit']) {
                                                    ?>
                                                    <a href="<?php echo base_url() ?>operator/inmst/edit/<?php echo $user->InID; ?>" title="Edit" class="btn-edit"><i class="md md-edit btn btn-success btn-xs btn-raised "></i></a>
                                                <?php } if ($userRights['delete']) { ?>
                                                    <a href="<?php echo base_url() ?>operator/inmst/delete/<?php echo $user->InID ?>"  title="Delete" class="btn-cross alertme"><i class="md md-delete btn btn-danger btn-xs btn-raised "></i></a>        
                                                        <?php
                                                    }
                                                }
                                                    ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <?php
                        } else {
                            echo "There is no data to display";
                        }
                        ?>
                    </div>
                </div>
            </div><!--end .row -->
        </div><!--end .section-body -->
    </section>
</div><!--end #content-->
<!-- END CONTENT -->