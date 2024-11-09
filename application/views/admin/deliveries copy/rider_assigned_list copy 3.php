<div class="col-sm-3">
    <table class="table table-bordered table_small" id="deliveries">
        <thead>
            <th>#</th>
            <th>Batch No</th>
            <th>Tracking No.</th>
            <th>Recipient Name</th>
            <th>Recipient Address</th>
            <th>Recipient Contact</th>
            <th>Courier Service</th>
            <th>Shipment Date</th>
            <th>Delivery Status</th>
            <th>Amount</th>
            <th>Courier Notes</th>
            <th></th>
        </thead>
        <tbody>
            <?php
            $count = 1;
            $query = "SELECT d.*, cs.courier_service_name, cs.short_name, b.batch_no   FROM deliveries as d 
                  INNER JOIN courier_services as cs ON(cs.courier_service_id = d.courier_service_id)
                  INNER JOIN batches as b ON(b.batch_id = d.batch_id)
                WHERE d.rider_id = ? and d.delivery_status='Shipped'
                                ";
            $rows = $this->db->query($query, [$rider_id])->result();
            foreach ($rows as $row) { ?>
                <tr>
                    <td><?php echo $count++ ?></td>
                    <td><?php echo $row->batch_no; ?></td>
                    <td><?php echo $row->tracking_number; ?></td>
                    <td><?php echo $row->recipient_name; ?></td>
                    <td><?php echo $row->recipient_address; ?></td>
                    <td><?php echo $row->recipient_contact; ?></td>
                    <td><?php echo $row->short_name; ?></td>
                    <td><?php echo $row->expected_delivery_date; ?></td>
                    <td><?php echo $row->delivery_status; ?></td>
                    <td><?php echo $row->amount; ?></td>
                    <td><?php echo $row->courier_notes; ?></td>
                    <td>
                        <form method="post" action="<?php echo site_url(ADMIN_DIR . "deliveries/remove_rider_assigned_package"); ?>"
                            onsubmit="return confirm('Are you sure you want to remove this assigned package?');">
                            <input type="hidden" value="<?php echo $rider_id ?>" name="rider_id" />
                            <input type="hidden" value="<?php echo $row->delivery_id ?>" name="delivery_id" />
                            <button>Remove</button>
                        </form>

                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
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
                    title: title
                },
                {
                    extend: 'csv',
                    title: title
                },
                {
                    extend: 'excel',
                    title: title
                },
                {
                    extend: 'pdf',
                    title: title,
                    orientation: 'landscape', // Landscape orientation
                    pageSize: 'legal', // Standard A4 size
                    customize: function(doc) {
                        doc.pageMargins = [1, 1, 1, 1];
                        // Customize table header styles
                        doc.styles.tableHeader = {
                            alignment: 'center',
                            bold: true,
                            fontSize: 8,
                            fillColor: '#f2f2f2', // Light gray background for headers
                            margin: [0, 5, 0, 5] // Top and bottom padding
                        };

                        // Customize table body cell styles
                        doc.styles.tableBodyEven = {
                            alignment: 'center',
                            fontSize: 7,
                            margin: [0, 3, 0, 3]
                        };
                        doc.styles.tableBodyOdd = {
                            alignment: 'center',
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
                    title: title
                }
            ]
        });
    </script>
</div>

<?php $deliverys_status = array("Delivered", "Cancelled", "Onhold");
foreach ($deliverys_status as $deliverys_status) { ?>
    <div class="col-sm-3">

        <div class="table-responsive">
            <h4><?php echo $deliverys_status; ?> packages list</h4>
            <table class="table table-bordered table_small" id="<?php echo $deliverys_status ?>">
                <thead>
                    <th>#</th>
                    <th>Tracking No.</th>
                    <th>Recipient Name</th>
                    <th>Recipient Address</th>
                    <th>Recipient Contact</th>
                    <th>Courier Service</th>
                    <th>Amount</th>
                    <th>Courier Notes</th>
                    <th>Assigned Date</th>
                    <th>Delivered Date</th>
                    <th>Delivered To</th>
                    <th>Contact No.</th>
                </thead>
                <tbody>
                    <?php
                    $total_amount = 0;
                    $count = 1;
                    $query = "SELECT d.*, cs.courier_service_name, cs.short_name, b.batch_no   FROM deliveries as d 
                  INNER JOIN courier_services as cs ON(cs.courier_service_id = d.courier_service_id)
                  INNER JOIN batches as b ON(b.batch_id = d.batch_id)
                  WHERE d.rider_id = ? and delivery_status = '" . $deliverys_status . "'";
                    $rows = $this->db->query($query, [$rider->user_id])->result();
                    foreach ($rows as $row) { ?>
                        <tr>
                            <td><?php echo $count++ ?></td>
                            <td><?php echo $row->tracking_number; ?></td>
                            <td><?php echo $row->recipient_name; ?></td>
                            <td><?php echo $row->recipient_address; ?></td>
                            <td><?php echo $row->recipient_contact; ?></td>
                            <td><?php echo $row->short_name; ?></td>
                            <td><?php echo $row->amount;
                                $total_amount += $row->amount;
                                ?></td>
                            <td><?php echo $row->courier_notes; ?></td>
                            <td><?php echo date('d M, Y', strtotime($row->assigned_date)); ?></td>
                            <td><?php
                                if ($row->delivered_date) {
                                    echo date('d M, Y', strtotime($row->delivered_date));
                                } ?></td>
                            <td><?php echo $row->delivered_to; ?></td>
                            <td><?php echo $row->delivered_to_mobile_no; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>Total:</th>
                    <th><?php echo $total_amount; ?></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>

                </tfoot>
            </table>

        </div>
    </div>
    <script>
        title = "<?php echo 'Rider ' . $rider->name . ' List ' . date('Y-m-d H:i:s'); ?>";
        $('#<?php echo $deliverys_status ?>').DataTable({
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

<?php } ?>