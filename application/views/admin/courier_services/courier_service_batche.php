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
                    <a href="<?php echo site_url(ADMIN_DIR . "courier_services/view/"); ?>"><?php echo $this->lang->line('Courier Services'); ?></a>
                <li><a href="<?php echo site_url(ADMIN_DIR . "courier_services/view_courier_service/" . $courier_service->courier_service_id); ?>"><?php echo $courier_service->courier_service_name; ?></a> </li>
                </li>
                <li><?php echo $title; ?></li>
            </ul>
            <!-- /BREADCRUMBS -->
            <div class="row">

                <div class="col-md-6">
                    <div class="clearfix">
                        <h3 class="content-title pull-left"><?php echo $title; ?></h3>
                    </div>
                    <div class="description"><?php echo $description; ?></div>
                </div>

                <div class="col-md-6">
                    <div class="pull-right">
                        <?php if ($batch->payment_status == 'Unpaid') { ?>
                            <button onclick="get_delivery_form('0')" class="btn btn-primary">Add Delivery Package</button>

                            <script>
                                function get_delivery_form(delivery_id) {
                                    $.ajax({
                                            method: "POST",
                                            url: "<?php echo site_url(ADMIN_DIR . 'courier_services/get_delivery_form'); ?>",
                                            data: {
                                                delivery_id: delivery_id,
                                                courier_service_id: <?php echo $courier_service->courier_service_id; ?>,
                                                batch_id: <?php echo $batch->batch_id; ?>
                                            },
                                        })
                                        .done(function(respose) {
                                            $('#modal').modal('show');
                                            $('.modal-dialog').css({
                                                'width': '80%'
                                            });
                                            if (delivery_id > 0) {
                                                $('#modal_title').html('Update Delivery');
                                            } else {
                                                $('#modal_title').html('Add New Delivery');
                                            }
                                            $('#modal_body').html(respose);

                                        });
                                }
                            </script>
                        <?php } ?>
                    </div>
                </div>

            </div>


        </div>
    </div>
</div>
<!-- /PAGE HEADER -->

<!-- PAGE MAIN CONTENT -->
<div class="row">
    <!-- MESSENGER -->
    <div class="col-md-3">
        <div class="box border blue" id="messenger">
            <div class="box-body">

                <div class="table-responsive">

                    <table class="table">
                        <thead>

                        </thead>
                        <tbody>

                            <tr>

                                <td>
                                    <img style="width:100%" src="<?php echo base_url("assets/uploads/" . $courier_service->logo) ?>" />

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php echo $courier_service->courier_service_name; ?>
                                    (<?php echo $courier_service->short_name; ?>)
                                </td>
                            </tr>


                            <tr>
                                <td>
                                    <?php echo status($courier_service->status); ?>
                                </td>
                            </tr>

                        </tbody>
                    </table>




                </div>


            </div>

        </div>
    </div>

    <div class="col-md-9">
        <div class="box border blue" id="messenger">
            <div class="box-body">

                <div class="table-responsive">
                    <table class="table table-bordered table_" id="batches">
                        <thead>
                            <tr>
                                <th>Courier Service</th>
                                <th>Batch No</th>
                                <th>Batch Date</th>
                                <th>Batch Detail</th>
                                <th>Payment Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $batch->courier_service_name; ?></td>
                                <td><?php echo $batch->batch_no; ?></td>
                                <td><?php echo $batch->batch_date; ?></td>
                                <td><?php echo $batch->batch_detail; ?></td>
                                <td><?php echo $batch->payment_status; ?></td>
                            </tr>

                        </tbody>
                    </table>


                    <div class="table-responsive">
                        <h4>Packages List</h4>
                        <?php
                        $query = "SELECT d.delivery_status FROM deliveries as d 
                        WHERE batch_id = '" . $batch->batch_id . "'
                        GROUP BY d.delivery_status ";
                        $statuses = $this->db->query($query)->result();
                        //var_dump($statuses);
                        foreach ($statuses as $status) { ?>
                            <strong><?php echo $status->delivery_status; ?></strong>
                            <table class="table table-bordered table_medium" id="deliveries">
                                <thead>
                                    <th>#</th>
                                    <th>Tracking No.</th>
                                    <th>Recipient Name</th>
                                    <th>Recipient Address</th>
                                    <th>Recipient Contact</th>
                                    <th>Delivery Status</th>
                                    <th>Amount</th>
                                    <?php if ($status->delivery_status == 'Pending' or $status->delivery_status == 'Cancelled') { ?>
                                        <th>Action</th>
                                    <?php } ?>
                                </thead>
                                <tbody>
                                    <?php
                                    $total_amount = 0;
                                    $count = 1;
                                    $query = "SELECT d.*, cs.courier_service_name, cs.short_name, b.batch_no   FROM deliveries as d 
                                INNER JOIN courier_services as cs ON(cs.courier_service_id = d.courier_service_id)
                                INNER JOIN batches as b ON(b.batch_id = d.batch_id)
                                WHERE d.delivery_status = '" . $status->delivery_status . "'
                                AND d.batch_id = '" . $batch->batch_id . "' ";
                                    $rows = $this->db->query($query)->result();
                                    foreach ($rows as $row) { ?>
                                        <tr>
                                            <td><?php echo $count++ ?></td>
                                            <td><?php echo $row->tracking_number; ?></td>
                                            <td><?php echo $row->recipient_name; ?></td>
                                            <td><?php echo $row->recipient_address; ?></td>
                                            <td><?php echo $row->recipient_contact; ?></td>
                                            <td><?php echo $row->delivery_status; ?></td>
                                            <td><?php echo $row->amount;
                                                $total_amount += $row->amount;
                                                ?></td>
                                            <?php if ($status->delivery_status == 'Pending') { ?>
                                                <td><button onclick="get_delivery_form('<?php echo $row->delivery_id; ?>')">Edit<botton>
                                                </td>
                                            <?php } ?>
                                            <?php if ($status->delivery_status == 'Cancelled') { ?>
                                                <td>
                                                    <form method="post" action="<?php echo site_url(ADMIN_DIR . "courier_services/return_item"); ?>"
                                                        onsubmit="return confirm('Are you sure you want to return the item?');">
                                                        <input type="hidden" value="<?php echo $row->delivery_id; ?>" name="delivery_id" />
                                                        <input type="hidden" value="<?php echo $row->batch_id; ?>" name="batch_id" />
                                                        <input type="hidden" value="<?php echo $row->courier_service_id; ?>" name="courier_service_id" />
                                                        <button>Return</button>
                                                    </form>
                                                </td>
                                            <?php } ?>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th>Total Packages: <?php echo ($count - 1); ?></th>
                                        <th style="text-align: right;">Total: </th>
                                        <th><?php echo $total_amount; ?></th>
                                    </tr>
                                    <?php if ($status->delivery_status == 'Completed') {
                                        $query = "SELECT SUM(p.paid_amount) as total
                                        FROM payments AS p
                                        WHERE p.batch_id = '" . $batch->batch_id . "' 
                                        AND p.courier_service_id = '" . $courier_service->courier_service_id . "'";
                                        $paid = $this->db->query($query)->row();
                                    ?>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th style="text-align: right;">Paid: </th>
                                            <th><?php echo $paid->total; ?></th>
                                        </tr>
                                    <?php } ?>
                                </tfoot>
                            </table>
                            <?php if ($status->delivery_status == 'Completed') { ?>
                                <strong>Payments</strong>
                                <table class="table table-bordered table_medium" id="payments">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Payee Name</th>
                                            <th>Payment Date</th>
                                            <th>Paid Amount</th>
                                            <th>Payment Detail</th>
                                            <th></th>
                                            <?php if ($batch->payment_status == 'Unpaid') { ?>
                                                <th>Action</th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 1;
                                        $query = "SELECT p.*, 
                                        u.name AS created_by_user, 
                                        updated_by.name AS last_update_by 
                                        FROM payments AS p
                                        INNER JOIN users AS u ON (u.user_id = p.created_by)
                                        LEFT JOIN users AS updated_by ON (updated_by.user_id = p.updated_by)
                                        WHERE p.batch_id = '" . $batch->batch_id . "' 
                                        AND p.courier_service_id = '" . $courier_service->courier_service_id . "'";

                                        $rows = $this->db->query($query)->result();
                                        foreach ($rows as $row) { ?>
                                            <tr>
                                                <td><?php echo $count++ ?></td>
                                                <td><?php echo $row->payee_name; ?></td>
                                                <td><?php echo $row->payment_date; ?></td>
                                                <td><?php echo $row->paid_amount; ?></td>
                                                <td><?php echo $row->payment_detail; ?></td>
                                                <td>
                                                    <small>Created By: <?php echo $row->created_by_user ?> on date
                                                        <?php echo date('Y-m-d', strtotime($row->created_date)); ?></small><br />
                                                    <?php if ($row->last_updated) { ?>
                                                        <small>last Updated : <?php echo date('Y-m-d', strtotime($row->last_updated)); ?>
                                                            by <?php echo $row->last_update_by ?>
                                                        </small>
                                                    <?php } ?>

                                                </td>
                                                <?php if ($batch->payment_status == 'Unpaid') { ?>
                                                    <td><button onclick="get_payment_form('<?php echo $row->payment_id; ?>')">Edit<botton>
                                                            <?php } ?>
                                                    </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <?php if ($batch->payment_status == 'Unpaid') { ?>
                                    <div style="text-align: center;">
                                        <button onclick="get_payment_form('0')" class="btn btn-danger">Add Payment</button>
                                    </div>
                                <?php } ?>

                                <script>
                                    function get_payment_form(payment_id) {
                                        $.ajax({
                                                method: "POST",
                                                url: "<?php echo site_url(ADMIN_DIR . 'courier_services/get_payment_form'); ?>",
                                                data: {
                                                    payment_id: payment_id,
                                                    batch_id: <?php echo $batch->batch_id ?>,
                                                    courier_service_id: <?php echo $courier_service->courier_service_id; ?>
                                                },
                                            })
                                            .done(function(respose) {
                                                $('#modal').modal('show');
                                                $('#modal_title').html('Payments');
                                                $('#modal_body').html(respose);
                                            });
                                    }
                                </script>
                            <?php } ?>

                        <?php } ?>
                    </div>
                    <script>
                        title = "<?php echo 'Rider ' . $rider->name . ' List ' . date('Y-m-d H:i:s'); ?>";
                        $('#deliveries').DataTable({
                            paging: false,
                            title: title,
                            order: [],
                            searching: true,
                            dom: 'Bfrtip', // This enables the button options
                            buttons: [{
                                    extend: 'copy',
                                    title: title,
                                    footer: true,
                                },
                                {
                                    extend: 'csv',
                                    title: title,
                                    footer: true,
                                },
                                {
                                    extend: 'excel',
                                    title: title,
                                    footer: true,
                                },
                                {
                                    extend: 'pdf',
                                    footer: true,
                                    title: title,
                                    orientation: 'landscape', // Landscape orientation
                                    pageSize: 'legal', // Standard A4 size
                                    customize: function(doc) {
                                        doc.pageMargins = [1, 1, 1, 1];
                                        // Customize table header styles
                                        doc.styles.tableHeader = {
                                            alignment: 'left',
                                            bold: true,
                                            fontSize: 8,
                                            fillColor: '#f2f2f2', // Light gray background for headers
                                            margin: [0, 5, 0, 5] // Top and bottom padding
                                        };
                                        doc.styles.tableFooter = {
                                            alignment: 'left',
                                            bold: true,
                                            fontSize: 15,
                                            fillColor: '#f2f2f2', // Light gray background for headers
                                            margin: [0, 5, 0, 5] // Top and bottom padding
                                        };

                                        // Customize table body cell styles
                                        doc.styles.tableBodyEven = {
                                            alignment: 'left',
                                            fontSize: 7,
                                            margin: [0, 3, 0, 3]
                                        };
                                        doc.styles.tableBodyOdd = {
                                            alignment: 'left',
                                            fontSize: 7,
                                            margin: [0, 3, 0, 3]
                                        };

                                        // Set table width to fit the page width
                                        doc.content[1].table.widths = Array(doc.content[1].table.body[0].length).fill('*');

                                        // Optional: Center the entire table
                                        doc.content[1].alignment = 'center';
                                    }
                                },

                                {
                                    extend: 'print',
                                    title: title,
                                    footer: true,
                                }
                            ]
                        });
                    </script>

                    <?php
                    $query = "SELECT 
                        COUNT(*) as total_packages,
                        SUM(amount) as total_amount,
                        SUM(IF(delivery_status = 'Completed', 1, 0)) as total_delivered,
                        SUM(IF(delivery_status = 'Completed', amount, 0)) as total_delivered_amount,
                        SUM(IF(delivery_status = 'Returned', 1, 0)) as total_cancelled,
                        SUM(IF(delivery_status = 'Returned', amount, 0)) as total_cancelled_amount,
                        (SELECT SUM(paid_amount) FROM payments WHERE batch_id = ?) as paid_amount
                    FROM deliveries 
                    WHERE batch_id = ?";
                    $batch_status = $this->db->query($query, [$batch->batch_id, $batch->batch_id])->row();

                    ?>
                    <strong>Summary</strong>
                    <table class="table table-bordered">
                        <tr>
                            <th></th>
                            <th>Received</th>
                            <th>Returned</th>
                            <th>Delivered</th>
                            <th>Payable / Paid</th>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <th><?php echo $batch_status->total_packages; ?></th>
                            <th><?php echo $batch_status->total_cancelled; ?></th>
                            <th><?php echo $batch_status->total_delivered; ?></th>
                            <th><?php echo $batch_status->total_delivered_amount; ?></th>
                        </tr>
                        <tr>
                            <th>Amount</th>
                            <th><?php echo $batch_status->total_amount; ?></th>
                            <th><?php echo $batch_status->total_cancelled_amount; ?></th>
                            <th><?php echo $batch_status->total_delivered_amount; ?></th>
                            <th><?php echo $batch_status->paid_amount; ?></th>
                        </tr>
                    </table>

                    <?php

                    if (($batch_status->total_packages == ($batch_status->total_cancelled + $batch_status->total_delivered)) and
                        $batch_status->paid_amount == $batch_status->total_delivered_amount
                    ) { ?>
                        <?php if ($batch->payment_status == 'Unpaid') { ?>
                            Do you want to mark this batch as Paid and Completed?
                            <input onclick="$('#paid_and_complete').show()" type="radio" name="complete_batch" value="Yes" /> Yes
                            <span style="margin-left: 10px;"></span>
                            <input onclick="$('#paid_and_complete').hide()" type="radio" name="complete_batch" value="No" /> No
                            <div id="paid_and_complete" style="border:1px solid gray; border-radius:5px; margin:5px; padding:5px; display:none; ">
                                <form method="post" action="<?php echo site_url(ADMIN_DIR . "courier_services/complete_batch"); ?>"
                                    onsubmit="return confirm('Are you sure you want to complete this batch?');">
                                    <input type="hidden" value="<?php echo $row->delivery_id; ?>" name="delivery_id" />
                                    <input type="hidden" value="<?php echo $row->batch_id; ?>" name="batch_id" />
                                    <input type="hidden" value="<?php echo $row->courier_service_id; ?>" name="courier_service_id" />
                                    <input type="hidden" name="total_packages_received" value="<?php echo $batch_status->total_packages; ?>" />
                                    <input type="hidden" name="total_amount" value="<?php echo $batch_status->total_amount; ?>" />
                                    <input type="hidden" name="total_delivered" value="<?php echo $batch_status->total_delivered; ?>" />
                                    <input type="hidden" name="total_delivered_amount" value="<?php echo $batch_status->total_delivered_amount; ?>" />
                                    <input type="hidden" name="total_returned" value="<?php echo $batch_status->total_cancelled; ?>" />
                                    <input type="hidden" name="total_returned_amount" value="<?php echo $batch_status->total_cancelled_amount; ?>" />
                                    <input type="hidden" name="paid_amount" value="<?php echo $batch_status->paid_amount; ?>" />

                                    <table style=" margin: 0 auto;">
                                        <tr>
                                            <td colspan="3"><strong>Note</strong> <br />
                                                <textarea style="width: 100%;" name="note"></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Return Packages and Amount Handover to:</th>
                                            <td><input required type="text" name="hand_over_to" /></td>
                                        </tr>
                                        <tr>
                                            <th>Date:</th>
                                            <td><input required type="date" name="completed_date" /></td>
                                        </tr>
                                    </table>
                                    <div style="text-align: center; padding:5px">
                                        <button class="btn btn-success">Mark as Paid and Completed</button>
                                    </div>
                                </form>
                            </div>
                        <?php } else { ?>
                            <div id="paid_and_complete" style="border:1px solid gray; border-radius:5px; margin:5px; padding:5px;">
                                <table style=" margin: 0 auto;">
                                    <tr>
                                        <td colspan="3"><strong>Note</strong> <br />
                                            <?php echo $batch->note; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Return Packages and Amount Handover to:</th>
                                        <td><?php echo $batch->hand_over_to; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Date:</th>
                                        <td><?php echo $batch->completed_date; ?></td>
                                    </tr>
                                </table>
                            </div>
                        <?php } ?>
                    <?php } ?>

                </div>

            </div>
        </div>
        <!-- /MESSENGER -->
    </div>