<!-- PAGE HEADER-->
<div class="row">
    <div class="col-sm-12">
        <div class="page-header">
            <!-- STYLER -->

            <!-- /STYLER -->
            <!-- BREADCRUMBS -->
            <ul class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="<?php echo site_url(ADMIN_DIR . $this->session->userdata("role_homepage_uri")); ?>"><?php echo $this->lang->line('Home'); ?></a>
                </li>
                <li>
                    <i class="fa fa-table"></i>
                    <a href="<?php echo site_url(ADMIN_DIR . "deliveries/view/riders"); ?>">Riders Dashboard</a>
                </li>
                <li><?php echo $title; ?></li>
            </ul>
            <!-- /BREADCRUMBS -->
            <div class="row">

                <div class="col-md-6">
                    <div class="clearfix">
                        <h3 class="content-title pull-left"><?php echo $title; ?></h3>
                    </div>
                    <div class="description"><?php echo $title; ?></div>
                </div>

                <div class="col-md-6">
                    <div class="pull-right">
                    </div>
                </div>

            </div>


        </div>
    </div>
</div>
<!-- /PAGE HEADER -->

<!-- PAGE MAIN CONTENT -->
<div class="row">
    <div class="col-sm-3">
        <div class="box border blue" id="messenger" style="background-color:white; padding:4px; ">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <td>Search by Tracking No: <br />
                            <input class="form-control" type="text" id="tracking_no" placeholder="Scan barcode here" autofocus>
                            <div id="tracking_no_response"></div>
                        </td>
                    </tr>
                </table>
                <div id="rider_assigned_packages"></div>
            </div>

            <script>
                // Function to handle the barcode data
                function handleBarcode(barcode) {
                    alert("Barcode Scanned: " + barcode);
                    // Additional processing can be added here
                }

                // Add event listener for the input field
                const barcodeInput = document.getElementById('tracking_no');
                barcodeInput.addEventListener('keyup', function(event) {
                    $('#tracking_no_response').html('');
                    if (event.key === 'Enter') {
                        var tracking_no = $('#tracking_no').val();
                        $.ajax({
                            type: 'POST',
                            url: '<?php echo site_url(ADMIN_DIR . "deliveries/seacrch_by_tracking_no"); ?>', // URL to submit form data
                            data: {
                                tracking_no: tracking_no,
                                rider_id: '<?php echo $rider->user_id; ?>'
                            },
                            success: function(response) {

                                if (response == 'success') {
                                    $('#tracking_no').val('');
                                    get_rider_assigned_list();
                                    //location.reload();
                                } else {
                                    $('#tracking_no_response').fadeOut(200, function() {
                                        $(this).html(response).fadeIn(200);
                                    });
                                }


                            }
                        });
                    }
                });
            </script>
        </div>
        <style>
            #rider_assigned_list {
                background-color: white;
                padding: 4px;
                height: 405px
            }
        </style>

        <div class="box border blue" id="rider_assigned_list">

        </div>

        <script>
            function get_rider_assigned_list() {

                $.ajax({
                    type: 'POST',
                    url: '<?php echo site_url(ADMIN_DIR . "deliveries/get_rider_assigned_list"); ?>', // URL to submit form data
                    data: {
                        rider_id: '<?php echo $rider->user_id; ?>'
                    },
                    success: function(response) {
                        //alert(response);
                        $('#rider_assigned_list').html(response);
                        // $('#rider_assigned_list').fadeOut(200, function() {
                        //     $(this).html(response).fadeIn(200);

                        // });
                    }
                });
            }
            get_rider_assigned_list();
        </script>

    </div>

    <?php $deliverys_status = array("Delivered", "Cancelled", "Onhold");
    foreach ($deliverys_status as $deliverys_status) { ?>
        <div class="col-sm-3">
            <div class="box border blue" id="messenger" style="background-color:white; padding:4px; height:530px">
                <div class="table-responsive">
                    <h4><?php echo $deliverys_status; ?> packages list</h4>
                    <table class="table table-bordered table_small" id="<?php echo $deliverys_status ?>">
                        <thead>
                            <th>#</th>
                            <th>Tracking No.</th>
                            <th>Recipient Detail</th>
                            <th>Amount</th>
                        </thead>
                        <tbody>
                            <?php
                            $total_amount = 0;
                            $count = 1;
                            $delivery_ids = array();
                            $query = "SELECT d.*, cs.courier_service_name, cs.short_name, b.batch_no   FROM deliveries as d 
                                        INNER JOIN courier_services as cs ON(cs.courier_service_id = d.courier_service_id)
                                        INNER JOIN batches as b ON(b.batch_id = d.batch_id)
                                        WHERE d.rider_id = ? and delivery_status = '" . $deliverys_status . "'";
                            $rows = $this->db->query($query, [$rider->user_id])->result();
                            foreach ($rows as $row) {
                                $delivery_ids[] = $row->delivery_id;
                            ?>
                                <tr>
                                    <td><?php echo $count++ ?></td>
                                    <td><?php echo $row->tracking_number; ?>
                                        <?php if ($deliverys_status == 'Cancelled') { ?>
                                            <form method="post" action="<?php echo site_url(ADMIN_DIR . "deliveries/remove_from_rider"); ?>"
                                                onsubmit="return confirm('Are you sure you want to remove this assigned package?');">
                                                <input type="hidden" value="<?php echo $row->rider_id ?>" name="rider_id" />
                                                <input type="hidden" value="<?php echo $row->delivery_id ?>" name="delivery_id" />
                                                <button>Remove</button>
                                            </form>
                                        <?php } ?>
                                    </td>
                                    <td><?php echo $row->recipient_name; ?><br />
                                        <?php echo $row->recipient_address; ?><br />
                                        <?php echo $row->recipient_contact; ?></td>
                                    <td><?php echo $row->amount;
                                        $total_amount += $row->amount;
                                        ?></td>

                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <th></th>
                            <th></th>
                            <th>Total:</th>
                            <th><?php echo $total_amount; ?></th>


                        </tfoot>
                    </table>
                    <?php if ($deliverys_status == 'Delivered' and $total_amount > 0) { ?>

                        <p style="border: 1px solid gray; border-radius:5px; padding:3px; margin:2px;text-align:center">
                            <span style="color: green;">Complete delivery pakages</span><br />
                            <strong>Do you received <span style="color: red;"><?php echo $total_amount ?></span> Rs. from rider <?php echo $rider->name; ?>
                                <br />
                                <input type="radio" name="delivery_payment" value="Yes" onclick="$('#complete_payment').show()" /> Yes
                                <span style="margin-left: 10px;"></span>
                                <input type="radio" name="delivery_payment" value="No" onclick="$('#complete_payment').hide()" /> No
                                <div id="complete_payment" style="display: none; text-align:center">
                                    <form method="post" action="<?php echo site_url(ADMIN_DIR . "deliveries/complete_rider_payments"); ?>"
                                        onsubmit="return confirm('Are you sure you want to remove this assigned package?');">
                                        <input type="hidden" value="<?php echo $row->rider_id ?>" name="rider_id" />
                                        <input type="hidden" value="<?php echo implode(',', $delivery_ids) ?>" name="delivery_ids" />
                                        <button>Complete Payment</button>
                                    </form>
                                </div>
                            </strong>
                        </p>
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php } ?>

</div>