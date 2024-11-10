<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Delivery Patch Print</title>
    <link rel="stylesheet" href="style.css">
    <link rel="license" href="http://www.opensource.org/licenses/mit-license/">
    <script src="script.js"></script>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>CCML</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" type="text/css" href="<?php echo site_url("assets/" . ADMIN_DIR); ?>/css/cloud-admin.css" media="screen,print" />
    <link rel="stylesheet" type="text/css" href="<?php echo site_url("assets/" . ADMIN_DIR); ?>/css/themes/default.css" media="screen,print" id="skin-switcher" />
    <link rel="stylesheet" type="text/css" href="<?php echo site_url("assets/" . ADMIN_DIR); ?>/css/responsive.css" media="screen,print" />
    <link rel="stylesheet" type="text/css" href="<?php echo site_url("assets/" . ADMIN_DIR); ?>/css/custom.css" media="screen,print" />


    <style>
        body {
            background: rgb(204, 204, 204);

            font-family: "Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif;

        }



        element.style {
            color: black;
            font-weight: bold;
        }


        page {
            background: white;
            display: block;
            margin: 0 auto;
            margin-bottom: 0.5cm;
            box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);

        }



        page[size="A4"] {
            width: 21cm;
            /* height: 29.7cm; */
            height: auto;
        }

        page[size="A4"][layout="landscape"] {
            width: 29.7cm;
            height: 21cm;
        }

        page[size="A3"] {
            width: 29.7cm;
            height: 42cm;
        }

        page[size="A3"][layout="landscape"] {
            width: 42cm;
            height: 29.7cm;
        }

        page[size="A5"] {
            width: 14.8cm;
            height: 21cm;
        }

        page[size="A5"][layout="landscape"] {
            width: 21cm;
            height: 14.8cm;
        }

        @media print {

            body,
            page {
                margin: 0;
                box-shadow: 0;
                color: black;

            }



        }


        .table>thead>tr>th,
        .table>tbody>tr>th,
        .table>tfoot>tr>th,
        .table>thead>tr>td,
        .table>tbody>tr>td,
        .table>tfoot>tr>td {
            padding: 4px;
            line-height: 1;
            vertical-align: top;
            border-top: 1px solid #ddd;
            font-size: 12px !important;
            color: black;
        }

        /* Styles go here */
        @media screen {
            .print-page-header {
                height: auto;
                display: none;
            }
        }




        @media screen {
            .page-footer {
                height: 50px;
                display: none;
            }
        }



        @media print {
            .page-footer {
                position: fixed;
                bottom: 0;
                width: 100%;
                border-top: 1px solid gray;
                /* for demo */
                content: counter(page) " of " counter(pages);
                /* for demo */
            }

            .page-footer-space {
                height: 80px;

            }
        }

        @media screen {
            .page-footer {
                position: relative;

                width: 100%;
                border-top: 1px solid gray;
                /* for demo */
                display: block;
                /* for demo */
            }

            .page-footer-space {
                height: 80px;
                display: none;
            }
        }

        @media print {
            .print-page-header {
                position: fixed;
                top: 0mm;
                width: 100%;
                background: yellow;
                /* for demo */
                /* for demo */
            }

            .print-page-header-space {
                height: 100px;
            }
        }

        @media screen {
            .print-page-header {
                position: relative;
                top: 0mm;
                width: 100%;
                display: block;
                /* for demo */
                /* for demo */
            }

            .print-page-header-space {
                height: 0px;
                display: none;
            }
        }




        .page {
            page-break-after: always;
        }



        @page {
            margin: 20mm
        }

        @media print {
            thead {
                display: table-header-group;
            }

            tfoot {
                display: table-footer-group;
            }

            button {
                display: none;
            }

            body {
                margin: 0;
                background-color: white !important;
            }

            page {
                background: white;
                display: block;
                margin: 0 auto;
                margin-bottom: 0.5cm;
                box-shadow: none !important;

            }
        }
    </style>
</head>

<body>
    <page size='A4'>

        <div class="print-page-header" style="background-color: rgb(229, 228, 226) !important;">
            <table style="width:100%">
                <tr>
                    <td style="padding-top: 10px; width: 90px !important;">
                        <img src="<?php echo site_url("assets/uploads/" . $system_global_settings[0]->sytem_admin_logo); ?>" alt="<?php echo $system_global_settings[0]->system_title ?>" title="<?php echo $system_global_settings[0]->system_title ?>" style="width:80px !important" />
                    </td>
                    <td style="vertical-align: top; text-align:center; margin-right:10px; ">
                        <h4 style="color:black; font-weight: bold"><?php echo $system_global_settings[0]->system_title ?> </h4>
                        <small><strong><?php echo $system_global_settings[0]->phone_number; ?> - <?php echo $system_global_settings[0]->mobile_number; ?> </strong></small>
                        <h5 style="color:black; font-weight: bold; margin-left:10px;"><?php echo $courier_service->courier_service_name; ?></h5>

                    </td>
                    <td style="padding-top: 10px; width: 90px !important;">
                        <img src="<?php echo base_url("assets/uploads/" . $courier_service->logo); ?>" style="width:80px !important" />

                    </td>
                </tr>

            </table>
        </div>


        <div style="padding-left: 40px; padding-right: 40px; padding-top:0px !important;" contenteditable="true">
            <table style="width: 100%;" style="color:black">
                <thead>
                    <tr>
                        <th style="text-align: center;">
                            <div class="print-page-header-space"></div>

                            <hr style="margin: 2px;" />
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <div class="table-responsive" id="printableDiv">
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
                                <strong>Payments</strong>
                                <table class="table table-bordered table_medium" id="payments">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Payee Name</th>
                                            <th>Payment Date</th>
                                            <th>Paid Amount</th>
                                            <th>Payment Detail</th>

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

                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>

                        </div>



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



                    </div>

                </tbody>
                <tfoot>
                    <tr>
                        <td>
                            <div class="page-footer-space"></div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="page-footer" style="background-color: rgb(229, 228, 226) !important; border:1px solid rgb(229, 228, 226); text-align:center">

            <small>
                <strong><?php echo $system_global_settings[0]->address ?></strong>

                <br />
                Print @ <?php echo date("d M, Y h:m:s A"); ?>
                by
                <?php
                $query = "SELECT
                `roles`.`role_title`,
                `users`.`name`  
            FROM `roles`,
            `users` 
            WHERE `roles`.`role_id` = `users`.`role_id`
            AND `users`.`user_id`='" . $this->session->userdata("userId") . "'";
                $user_data = $this->db->query($query)->row();

                ?>
                <?php echo $user_data->name; ?> (<?php echo $user_data->role_title; ?>)
            </small>


        </div>
    </page>
</body>



</html>