<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<!-- MAIN PANEL -->
<div id="content">
    <section class="style-default-bright">
        <div class="section-header">
            <h2 class="text-primary">View Barcode List</h2>
        </div>
        <div class="section-body">
            <div class="row">
				<div class="col-lg-12">
                    <?php echo $add_error; ?>
                    <?php echo $add_warning; ?>
                    <?php echo $add_info; ?>
                    <?php echo $add_success; ?>
                </div>
				<div class="col-lg-12">
                    <div class="table-responsive">

                                <?php if (isset($allbarcode) && !empty($allbarcode)) { ?>
                            <table id="datatable1" class="table table-striped table-hover" width="100%">
                                <thead>
                                        <tr>
											<th>#</th>
                                            <th data-class="expand">Client Name</th>
                                            <th data-hide="phone">Pattern</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($allbarcode)) {
                                            $cnt = 0;
                                            foreach ($allbarcode as $key => $val) {
                                                $cnt++;
                                                ?>
                                                <tr>
													<td><?=$cnt?></td>
                                                    <td><?= ucfirst($val->firstname).''.ucfirst($val->lastname) ?></td>
                                                    <td><?php 
                                                    if($val->F1SrMode == 'manual'){
                                                        echo $val->F1SrValue;
                                                    }
                                                    if($val->F1SrMode == 'auto'){
                                                        if($val->F1SrType == 'Number'){
                                                            $num_length = strlen((string)($val->F1SrValue));
                                                            if($num_length == $val->F1SrValLength) {
                                                               $f1str = $val->F1SrValue;
                                                            } else {
                                                                $numdata = (int)$val->F1SrValLength - (int)$num_length;
                                                                $str = '';
                                                                if($numdata > 0){
                                                                    for($i = 0; $i < $numdata; $i++){
                                                                        $str .='0';
                                                                    }
                                                                }
                                                                echo $str.$val->F1SrValue;
                                                            }
                                                        }
                                                        if($val->F1SrType == 'Date'){
                                                            if($val->F1SrTypeMode == 'ddmmyy'){
                                                               echo date('dmY');
                                                            }
                                                            if($val->F1SrTypeMode == 'mmddyy'){
                                                                echo date('mdY');
                                                            }
                                                        }
                                                        if($val->F1SrType == 'Month'){
                                                            if($val->F1SrTypeMode == 'mm'){
                                                                echo date('m');
                                                            }
                                                            if($val->F1SrTypeMode == 'M'){
                                                                echo strtoupper(date('F'));
                                                            }
                                                        }
                                                        if($val->F1SrType == 'Year'){
                                                            if($val->F1SrTypeMode == 'yy'){
                                                                echo date('y');
                                                            }
                                                            if($val->F1SrTypeMode == 'Y'){
                                                                echo date('Y');
                                                            }
                                                        }
                                                    } 
                                                    
                                                    if($val->F2SrMode == 'manual'){
                                                        echo $val->F2SrValue;
                                                    }
                                                    if($val->F2SrMode == 'auto'){
                                                        if($val->F2SrType == 'Number'){
                                                            $num_length = strlen((string)($val->F2SrValue));
                                                            if($num_length == $val->F2SrValLength) {
                                                               $f1str = $val->F2SrValue;
                                                            } else {
                                                                $numdata = (int)$val->F2SrValLength - (int)$num_length;
                                                                $str = '';
                                                                if($numdata > 0){
                                                                    for($i = 0; $i < $numdata; $i++){
                                                                        $str .='0';
                                                                    }
                                                                }
                                                                echo $str.$val->F2SrValue;
                                                            }
                                                        }
                                                        if($val->F2SrType == 'Date'){
                                                            if($val->F2SrTypeMode == 'ddmmyy'){
                                                               echo date('dmY');
                                                            }
                                                            if($val->F2SrTypeMode == 'mmddyy'){
                                                                echo date('mdY');
                                                            }
                                                        }
                                                        if($val->F2SrType == 'Month'){
                                                            if($val->F2SrTypeMode == 'mm'){
                                                                echo date('m');
                                                            }
                                                            if($val->F2SrTypeMode == 'M'){
                                                                echo strtoupper(date('F'));
                                                            }
                                                        }
                                                        if($val->F2SrType == 'Year'){
                                                            if($val->F2SrTypeMode == 'yy'){
                                                                echo date('y');
                                                            }
                                                            if($val->F2SrTypeMode == 'Y'){
                                                                echo date('Y');
                                                            }
                                                        }
                                                    } 
                                                    
                                                    if($val->F3SrMode == 'manual'){
                                                        echo $val->F3SrValue;
                                                    }
                                                    if($val->F3SrMode == 'auto'){
                                                        if($val->F3SrType == 'Number'){
                                                            $num_length = strlen((string)($val->F3SrValue));
                                                            if($num_length == $val->F3SrValLength) {
                                                               echo $val->F3SrValue;
                                                            } else {
                                                                $numdata = (int)$val->F3SrValLength - (int)$num_length;
                                                                $str = '';
                                                                if($numdata > 0){
                                                                    for($i = 0; $i < $numdata; $i++){
                                                                        $str .='0';
                                                                    }
                                                                }
                                                                echo $str.$val->F3SrValue;
                                                            }
                                                        }
                                                        if($val->F3SrType == 'Date'){
                                                            if($val->F3SrTypeMode == 'ddmmyy'){
                                                               echo date('dmY');
                                                            }
                                                            if($val->F3SrTypeMode == 'mmddyy'){
                                                                echo date('mdY');
                                                            }
                                                        }
                                                        if($val->F3SrType == 'Month'){
                                                            if($val->F3SrTypeMode == 'mm'){
                                                                echo date('m');
                                                            }
                                                            if($val->F3SrTypeMode == 'M'){
                                                                echo strtoupper(date('F'));
                                                            }
                                                        }
                                                        if($val->F3SrType == 'Year'){
                                                            if($val->F3SrTypeMode == 'yy'){
                                                                echo date('y');
                                                            }
                                                            if($val->F3SrTypeMode == 'Y'){
                                                                echo date('Y');
                                                            }
                                                        }
                                                    } 
                                                    
                                                    if($val->F4SrMode == 'manual'){
                                                        echo $val->F4SrValue;
                                                    }
                                                    if($val->F4SrMode == 'auto'){
                                                        if($val->F4SrType == 'Number'){
                                                            $num_length = strlen((string)($val->F4SrValue));
                                                            if($num_length == $val->F4SrValLength) {
                                                               echo $val->F4SrValue;
                                                            } else {
                                                                $numdata = (int)$val->F4SrValLength - (int)$num_length;
                                                                $str = '';
                                                                if($numdata > 0){
                                                                    for($i = 0; $i < $numdata; $i++){
                                                                        $str .='0';
                                                                    }
                                                                }
                                                                echo $str.$val->F4SrValue;
                                                            }
                                                        }
                                                        if($val->F4SrType == 'Date'){
                                                            if($val->F4SrTypeMode == 'ddmmyy'){
                                                               echo date('dmY');
                                                            }
                                                            if($val->F4SrTypeMode == 'mmddyy'){
                                                                echo date('mdY');
                                                            }
                                                        }
                                                        if($val->F4SrType == 'Month'){
                                                            if($val->F4SrTypeMode == 'mm'){
                                                                echo date('m');
                                                            }
                                                            if($val->F4SrTypeMode == 'M'){
                                                                echo strtoupper(date('F'));
                                                            }
                                                        }
                                                        if($val->F4SrType == 'Year'){
                                                            if($val->F4SrTypeMode == 'yy'){
                                                                echo date('y');
                                                            }
                                                            if($val->F4SrTypeMode == 'Y'){
                                                                echo date('Y');
                                                            }
                                                        }
                                                    } 
                                                    
                                                    if($val->F5SrMode == 'manual'){
                                                        echo $val->F5SrValue;
                                                    }
                                                    if($val->F5SrMode == 'auto'){
                                                        if($val->F5SrType == 'Number'){
//                                                            echo $val->F5SrValue;
                                                            $num_length = strlen((string)($val->F5SrValue));
                                                            if($num_length == $val->F5SrValLength) {
                                                               echo $val->F5SrValue;
                                                            } else {
                                                                $numdata = (int)$val->F5SrValLength - (int)$num_length;
                                                                $str = '';
                                                                if($numdata > 0){
                                                                    for($i = 0; $i < $numdata; $i++){
                                                                        $str .='0';
                                                                    }
                                                                }
                                                                echo $str.$val->F5SrValue;
                                                            }
                                                        }
                                                        if($val->F5SrType == 'Date'){
                                                            if($val->F5SrTypeMode == 'ddmmyy'){
                                                               echo date('dmY');
                                                            }
                                                            if($val->F5SrTypeMode == 'mmddyy'){
                                                                echo date('mdY');
                                                            }
                                                        }
                                                        if($val->F5SrType == 'Month'){
                                                            if($val->F5SrTypeMode == 'mm'){
                                                                echo date('m');
                                                            }
                                                            if($val->F5SrTypeMode == 'M'){
                                                                echo strtoupper(date('F'));
                                                            }
                                                        }
                                                        if($val->F5SrType == 'Year'){
                                                            if($val->F5SrTypeMode == 'yy'){
                                                                echo date('y');
                                                            }
                                                            if($val->F5SrTypeMode == 'Y'){
                                                                echo date('Y');
                                                            }
                                                        }
                                                    } 
                                                    
                                                    if($val->F6SrMode == 'manual'){
                                                        echo $val->F6SrValue;
                                                    }
                                                    if($val->F6SrMode == 'auto'){
                                                        if($val->F6SrType == 'Number'){
//                                                            echo $val->F6SrValue;
                                                            $num_length = strlen((string)($val->F6SrValue));
                                                            if($num_length == $val->F6SrValLength) {
                                                               echo $val->F6SrValue;
                                                            } else {
                                                                $numdata = (int)$val->F6SrValLength - (int)$num_length;
                                                                $str = '';
                                                                if($numdata > 0){
                                                                    for($i = 0; $i < $numdata; $i++){
                                                                        $str .='0';
                                                                    }
                                                                }
                                                                echo $str.$val->F6SrValue;
                                                            }
                                                        }
                                                        if($val->F6SrType == 'Date'){
                                                            if($val->F6SrTypeMode == 'ddmmyy'){
                                                               echo date('dmY');
                                                            }
                                                            if($val->F6SrTypeMode == 'mmddyy'){
                                                                echo date('mdY');
                                                            }
                                                        }
                                                        if($val->F6SrType == 'Month'){
                                                            if($val->F6SrTypeMode == 'mm'){
                                                                echo date('m');
                                                            }
                                                            if($val->F6SrTypeMode == 'M'){
                                                                echo strtoupper(date('F'));
                                                            }
                                                        }
                                                        if($val->F6SrType == 'Year'){
                                                            if($val->F6SrTypeMode == 'yy'){
                                                                echo date('y');
                                                            }
                                                            if($val->F6SrTypeMode == 'Y'){
                                                                echo date('Y');
                                                            }
                                                        }
                                                    } 
                                                    
                                                    if($val->F7SrMode == 'manual'){
                                                        echo $val->F7SrValue;
                                                    }
                                                    if($val->F7SrMode == 'auto'){
                                                        if($val->F7SrType == 'Number'){
                                                            $num_length = strlen((string)($val->F7SrValue));
                                                            if($num_length == $val->F7SrValLength) {
                                                               echo $val->F7SrValue;
                                                            } else {
                                                                $numdata = (int)$val->F7SrValLength - (int)$num_length;
                                                                $str = '';
                                                                if($numdata > 0){
                                                                    for($i = 0; $i < $numdata; $i++){
                                                                        $str .='0';
                                                                    }
                                                                }
                                                                echo $str.$val->F7SrValue;
                                                            }
                                                        }
                                                        if($val->F7SrType == 'Date'){
                                                            if($val->F7SrTypeMode == 'ddmmyy'){
                                                               echo date('dmY');
                                                            }
                                                            if($val->F7SrTypeMode == 'mmddyy'){
                                                                echo date('mdY');
                                                            }
                                                        }
                                                        if($val->F7SrType == 'Month'){
                                                            if($val->F7SrTypeMode == 'mm'){
                                                                echo date('m');
                                                            }
                                                            if($val->F7SrTypeMode == 'M'){
                                                                echo strtoupper(date('F'));
                                                            }
                                                        }
                                                        if($val->F7SrType == 'Year'){
                                                            if($val->F7SrTypeMode == 'yy'){
                                                                echo date('y');
                                                            }
                                                            if($val->F7SrTypeMode == 'Y'){
                                                                echo date('Y');
                                                            }
                                                        }
                                                    } 
                                                    
                                                    
                                                    ?>
                                                    </td>
                                                    <td style="text-align: center">
													<?php
                                                    if ($userRights['edit']) {
                                                        ?>
                                                        <a href="<?php echo base_url() ?>admin/barcode/edit/<?php echo $val->ErpSrnID; ?>" title="Edit" class="btn-edit"><i class="md md-edit btn btn-success btn-xs btn-raised "></i></a>
                                                    <?php } ?>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
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
                <?php
                    if ($userRights['delete']) {
                        echo form_close();
                    }?>
            </div><!--end .row -->
        </div><!--end .section-body -->
    </section>
</div><!--end #content-->
<!-- END CONTENT -->