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