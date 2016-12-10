<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<table id="datatable_tabletoolszk" class="table table-striped table-bordered table-hover" width="100%">
    <thead>
        <tr>
            <th class="hasinput">
                <input type="text" class="form-control" placeholder="Module Name" />
            </th>
            <th class="hasinput">
                <input type="text" class="form-control" placeholder="Pattern" />
            </th>
            <th class="hasinput">

            </th>
        </tr>
        <tr>
            <th data-class="expand">Module Name</th>
            <th data-hide="phone">Pattern</th>
            <th class="cus-width"></th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($masterData)) {
            $cnt = 0;
            foreach ($masterData as $key => $val) {
                $cnt++;
                ?>
                <tr>
                    <td><?= $val->ModuleName ?></td>
                    <td><?php
        if ($val->F1SrMode == 'manual') {
            echo $val->F1SrValue;
        }
        if ($val->F1SrMode == 'auto') {
            if ($val->F1SrType == 'Number') {
                $num_length = strlen((string) ($val->F1SrValue));
                if ($num_length == $val->F1SrValLength) {
                    $f1str = $val->F1SrValue;
                } else {
                    $numdata = (int) $val->F1SrValLength - (int) $num_length;
                    $str = '';
                    if ($numdata > 0) {
                        for ($i = 0; $i < $numdata; $i++) {
                            $str .='0';
                        }
                    }
                    echo $str . $val->F1SrValue;
                }
            }
            if ($val->F1SrType == 'Date') {
                if ($val->F1SrTypeMode == 'ddmmyy') {
                    echo date('dmY');
                }
                if ($val->F1SrTypeMode == 'mmddyy') {
                    echo date('mdY');
                }
            }
            if ($val->F1SrType == 'Month') {
                if ($val->F1SrTypeMode == 'mm') {
                    echo date('m');
                }
                if ($val->F1SrTypeMode == 'M') {
                    echo strtoupper(date('F'));
                }
            }
            if ($val->F1SrType == 'Year') {
                if ($val->F1SrTypeMode == 'yy') {
                    echo date('y');
                }
                if ($val->F1SrTypeMode == 'Y') {
                    echo date('Y');
                }
            }
        }

        if ($val->F2SrMode == 'manual') {
            echo $val->F2SrValue;
        }
        if ($val->F2SrMode == 'auto') {
            if ($val->F2SrType == 'Number') {
                $num_length = strlen((string) ($val->F2SrValue));
                if ($num_length == $val->F2SrValLength) {
                    $f1str = $val->F2SrValue;
                } else {
                    $numdata = (int) $val->F2SrValLength - (int) $num_length;
                    $str = '';
                    if ($numdata > 0) {
                        for ($i = 0; $i < $numdata; $i++) {
                            $str .='0';
                        }
                    }
                    echo $str . $val->F2SrValue;
                }
            }
            if ($val->F2SrType == 'Date') {
                if ($val->F2SrTypeMode == 'ddmmyy') {
                    echo date('dmY');
                }
                if ($val->F2SrTypeMode == 'mmddyy') {
                    echo date('mdY');
                }
            }
            if ($val->F2SrType == 'Month') {
                if ($val->F2SrTypeMode == 'mm') {
                    echo date('m');
                }
                if ($val->F2SrTypeMode == 'M') {
                    echo strtoupper(date('F'));
                }
            }
            if ($val->F2SrType == 'Year') {
                if ($val->F2SrTypeMode == 'yy') {
                    echo date('y');
                }
                if ($val->F2SrTypeMode == 'Y') {
                    echo date('Y');
                }
            }
        }

        if ($val->F3SrMode == 'manual') {
            echo $val->F3SrValue;
        }
        if ($val->F3SrMode == 'auto') {
            if ($val->F3SrType == 'Number') {
                $num_length = strlen((string) ($val->F3SrValue));
                if ($num_length == $val->F3SrValLength) {
                    echo $val->F3SrValue;
                } else {
                    $numdata = (int) $val->F3SrValLength - (int) $num_length;
                    $str = '';
                    if ($numdata > 0) {
                        for ($i = 0; $i < $numdata; $i++) {
                            $str .='0';
                        }
                    }
                    echo $str . $val->F3SrValue;
                }
            }
            if ($val->F3SrType == 'Date') {
                if ($val->F3SrTypeMode == 'ddmmyy') {
                    echo date('dmY');
                }
                if ($val->F3SrTypeMode == 'mmddyy') {
                    echo date('mdY');
                }
            }
            if ($val->F3SrType == 'Month') {
                if ($val->F3SrTypeMode == 'mm') {
                    echo date('m');
                }
                if ($val->F3SrTypeMode == 'M') {
                    echo strtoupper(date('F'));
                }
            }
            if ($val->F3SrType == 'Year') {
                if ($val->F3SrTypeMode == 'yy') {
                    echo date('y');
                }
                if ($val->F3SrTypeMode == 'Y') {
                    echo date('Y');
                }
            }
        }

        if ($val->F4SrMode == 'manual') {
            echo $val->F4SrValue;
        }
        if ($val->F4SrMode == 'auto') {
            if ($val->F4SrType == 'Number') {
                $num_length = strlen((string) ($val->F4SrValue));
                if ($num_length == $val->F4SrValLength) {
                    echo $val->F4SrValue;
                } else {
                    $numdata = (int) $val->F4SrValLength - (int) $num_length;
                    $str = '';
                    if ($numdata > 0) {
                        for ($i = 0; $i < $numdata; $i++) {
                            $str .='0';
                        }
                    }
                    echo $str . $val->F4SrValue;
                }
            }
            if ($val->F4SrType == 'Date') {
                if ($val->F4SrTypeMode == 'ddmmyy') {
                    echo date('dmY');
                }
                if ($val->F4SrTypeMode == 'mmddyy') {
                    echo date('mdY');
                }
            }
            if ($val->F4SrType == 'Month') {
                if ($val->F4SrTypeMode == 'mm') {
                    echo date('m');
                }
                if ($val->F4SrTypeMode == 'M') {
                    echo strtoupper(date('F'));
                }
            }
            if ($val->F4SrType == 'Year') {
                if ($val->F4SrTypeMode == 'yy') {
                    echo date('y');
                }
                if ($val->F4SrTypeMode == 'Y') {
                    echo date('Y');
                }
            }
        }

        if ($val->F5SrMode == 'manual') {
            echo $val->F5SrValue;
        }
        if ($val->F5SrMode == 'auto') {
            if ($val->F5SrType == 'Number') {
//                echo $val->F5SrValue;
                $num_length = strlen((string) ($val->F5SrValue));
                if ($num_length == $val->F5SrValLength) {
                    echo $val->F5SrValue;
                } else {
                    $numdata = (int) $val->F5SrValLength - (int) $num_length;
                    $str = '';
                    if ($numdata > 0) {
                        for ($i = 0; $i < $numdata; $i++) {
                            $str .='0';
                        }
                    }
                    echo $str . $val->F5SrValue;
                }
            }
            if ($val->F5SrType == 'Date') {
                if ($val->F5SrTypeMode == 'ddmmyy') {
                    echo date('dmY');
                }
                if ($val->F5SrTypeMode == 'mmddyy') {
                    echo date('mdY');
                }
            }
            if ($val->F5SrType == 'Month') {
                if ($val->F5SrTypeMode == 'mm') {
                    echo date('m');
                }
                if ($val->F5SrTypeMode == 'M') {
                    echo strtoupper(date('F'));
                }
            }
            if ($val->F5SrType == 'Year') {
                if ($val->F5SrTypeMode == 'yy') {
                    echo date('y');
                }
                if ($val->F5SrTypeMode == 'Y') {
                    echo date('Y');
                }
            }
        }

        if ($val->F6SrMode == 'manual') {
            echo $val->F6SrValue;
        }
        if ($val->F6SrMode == 'auto') {
            if ($val->F6SrType == 'Number') {
//                echo $val->F6SrValue;
                $num_length = strlen((string) ($val->F6SrValue));
                if ($num_length == $val->F6SrValLength) {
                    echo $val->F6SrValue;
                } else {
                    $numdata = (int) $val->F6SrValLength - (int) $num_length;
                    $str = '';
                    if ($numdata > 0) {
                        for ($i = 0; $i < $numdata; $i++) {
                            $str .='0';
                        }
                    }
                    echo $str . $val->F6SrValue;
                }
            }
            if ($val->F6SrType == 'Date') {
                if ($val->F6SrTypeMode == 'ddmmyy') {
                    echo date('dmY');
                }
                if ($val->F6SrTypeMode == 'mmddyy') {
                    echo date('mdY');
                }
            }
            if ($val->F6SrType == 'Month') {
                if ($val->F6SrTypeMode == 'mm') {
                    echo date('m');
                }
                if ($val->F6SrTypeMode == 'M') {
                    echo strtoupper(date('F'));
                }
            }
            if ($val->F6SrType == 'Year') {
                if ($val->F6SrTypeMode == 'yy') {
                    echo date('y');
                }
                if ($val->F6SrTypeMode == 'Y') {
                    echo date('Y');
                }
            }
        }

        if ($val->F7SrMode == 'manual') {
            echo $val->F7SrValue;
        }
        if ($val->F7SrMode == 'auto') {
            if ($val->F7SrType == 'Number') {
                $num_length = strlen((string) ($val->F7SrValue));
                if ($num_length == $val->F7SrValLength) {
                    echo $val->F7SrValue;
                } else {
                    $numdata = (int) $val->F7SrValLength - (int) $num_length;
                    $str = '';
                    if ($numdata > 0) {
                        for ($i = 0; $i < $numdata; $i++) {
                            $str .='0';
                        }
                    }
                    echo $str . $val->F7SrValue;
                }
            }
            if ($val->F7SrType == 'Date') {
                if ($val->F7SrTypeMode == 'ddmmyy') {
                    echo date('dmY');
                }
                if ($val->F7SrTypeMode == 'mmddyy') {
                    echo date('mdY');
                }
            }
            if ($val->F7SrType == 'Month') {
                if ($val->F7SrTypeMode == 'mm') {
                    echo date('m');
                }
                if ($val->F7SrTypeMode == 'M') {
                    echo strtoupper(date('F'));
                }
            }
            if ($val->F7SrType == 'Year') {
                if ($val->F7SrTypeMode == 'yy') {
                    echo date('y');
                }
                if ($val->F7SrTypeMode == 'Y') {
                    echo date('Y');
                }
            }
        }
                ?>
                    </td>
                    <td style="text-align: center">
                        <a data-original-title="Edit" data-placement="top" rel="tooltip" href="<?= base_url("asset/edit/" . $menuaction) . '/' . $this->encryptionk->encodeData($val->ErpSrnID) ?>" class="accatedit" ><i class="fa flaticon-edit"></i></a>
                        <!--<a data-original-title="Delete" data-placement="top" rel="tooltip" href="<?= base_url("asset/delete/" . $menuaction) . '/' . $this->encryptionk->encodeData($val->ErpSrnID) ?>" class="margin-left-10 mdelete" ><i class="fa flaticon-delete"></i></a>-->
                    </td>
                </tr>
        <?php
    }
}
?>
    </tbody>
</table>
<script>
    var breakpointDefinitionzk = {
            tablet: 1024,
            phone: 480
        };
    var responsiveHelper_datatable_tabletoolszk = undefined;
    var otablezk = $('#datatable_tabletoolszk').dataTable({
        // Tabletools options: 
        //   https://datatables.net/extensions/tabletools/button_options
        "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'><'col-sm-6 col-xs-6 hidden-xs'T>r>" +
                "t" +
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
        "oTableTools": {
            "aButtons": [
                "copy",
                "csv",
                {
                    "sExtends": "xls",
                    "sTitle": "ERP_XLS",
                },
                {
                    "sExtends": "pdf",
                    "sTitle": "ERP_PDF",
                    "sPdfMessage": "ERP PDF Export",
                    "sPdfSize": "letter"
                },
                {
                    "sExtends": "print",
                    "sMessage": "Generated by ERP <i>(press Esc to close)</i>"
                }
            ],
            "sSwfPath": "<?= base_url() . JAVASCRIPT_FRONT ?>plugin/datatables/swf/copy_csv_xls_pdf.swf"
        },
        "autoWidth": true,
        "preDrawCallback": function () {
            // Initialize the responsive datatables helper once.
            if (!responsiveHelper_datatable_tabletoolszk) {
                responsiveHelper_datatable_tabletoolszk = new ResponsiveDatatablesHelper($('#datatable_tabletoolszk'), breakpointDefinitionzk);
            }
        },
        "rowCallback": function (nRow) {
            responsiveHelper_datatable_tabletoolszk.createExpandIcon(nRow);
        },
        "drawCallback": function (oSettings) {
            responsiveHelper_datatable_tabletoolszk.respond();
        },
        "columnDefs": [{
                "targets": -1,
                "orderable": false
            }],
        "pageLength": 20,
//            "order": [[1, "asc"]]
    });
    // Apply the filter
    $("#datatable_tabletoolszk thead th input[type=text]").on('keyup change', function () {

        otablezk.api().column($(this).parent().index() + ':visible').search(this.value).draw();

    });
</script>