<div>
    <div id="errorDiv" class="box border blue" id="messenger" style="background-color:white; padding:4px; text-align:right ">
        Search Package by Tracking No:
        <input class="form-control" style="width: 200px; display:inline" type="text" id="tracking_no" placeholder="Scan barcode here" autofocus>

    </div>
    <div style="margin-top: 5px;" id="tracking_no_response"></div>
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
                    url: '<?php echo site_url(ADMIN_DIR . "deliveries/seacrch_by_tracking_no_package_status"); ?>', // URL to submit form data
                    data: {
                        tracking_no: tracking_no
                    },
                    success: function(response) {

                        if (response != 'not_found') {
                            $('#tracking_no').val('');
                            $('#tracking_no_response').fadeOut(200, function() {
                                $(this).html(response).fadeIn(200);
                            });
                            //get_rider_assigned_list();
                            //location.reload();
                        } else {

                            $('#tracking_no_response').fadeOut(200, function() {
                                $(this).html('<div class="alert alert-danger">Tracking No: <strong>' + tracking_no + '</strong> Not Found. Try Again</div>').fadeIn(200);
                            });
                            triggerBuzz('errorDiv');
                        }


                    }
                });
            }
        });
    </script>
</div>
<h4>Rider Delivery Tracking Dashboard</h4>
<table id="datatable" class="table  table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Rider Name</th>
            <th>Father Name</th>
            <th>Contact No.</th>
            <?php
            $delivery_status  = array("Pending", "Shipped", "Onhold", "Delivered", "Cancelled", "Completed");

            foreach ($delivery_status as $deliverystatus) { ?>
                <th><?php echo $deliverystatus; ?></th>
            <?php } ?>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $count = 1;
        $query = 'SELECT * FROM users WHERE role_id = 3 and status=1';
        $riders = $this->db->query($query)->result();
        foreach ($riders as $rider) { ?>
            <tr>
                <td><?php echo $count++; ?></td>
                <td><?php echo $rider->user_name; ?></td>
                <td><?php echo $rider->father_name; ?></td>
                <td><?php echo $rider->user_mobile_number; ?></td>
                <?php
                $delivery_status  = array("Pending", "Shipped", "Onhold", "Delivered", "Cancelled", "Completed");

                foreach ($delivery_status as $deliverystatus) { ?>
                    <th>
                        <?php
                        $query = "SELECT COUNT(delivery_status) as total FROM deliveries 
                            WHERE rider_id  = '" . $rider->user_id . "' 
                            AND delivery_status = '" . $deliverystatus . "'";
                        $query .= " GROUP BY delivery_status";
                        $delivery_status = $this->db->query($query)->row();
                        if ($delivery_status) {
                            echo $delivery_status->total;
                        } else {
                            echo 0;
                        }
                        ?>
                    </th>
                <?php } ?>
                <td><a href="<?php echo site_url(ADMIN_DIR . 'deliveries/rider_view/' . $rider->user_id); ?>">View Detail</a></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<script>
    title = 'Rider Delivery Tracking <?php echo date('Y-m-d h:m:s') ?>';
    $(document).ready(function() {
        $('#datatable').DataTable({
            dom: 'Bfrtip', // Add 'f' for the search filter.
            paging: false,
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
                    title: title
                },
                {
                    extend: 'print',
                    title: title
                }
            ],
            searching: true // Optional, enabled by default.
        });
    });
</script>