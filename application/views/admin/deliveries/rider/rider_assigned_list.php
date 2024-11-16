<style>
    #riderassignedlist_filter input {
        width: 130px;
    }
</style>

<h4>New assigned packages</h4>
<?php
$query = "SELECT COUNT(*) as total_packages, SUM(amount) as total_amount   
FROM deliveries WHERE rider_id = ? and delivery_status='Shipped'";
$rider_delivery = $this->db->query($query, [$rider_id])->row();
?>
<strong>Packages: <?php echo $rider_delivery->total_packages  ?></strong> -
<strong>Amount: <?php echo $rider_delivery->total_amount  ?> </strong> Rs.
<table class="table table-bordered table_small" id="riderassignedlist">
    <thead>
        <th>#</th>
        <th>Tracking No.</th>
        <th>Recipient Detail</th>
        <th>Amount</th>
    </thead>
    <tbody>
        <?php
        $count = 1;
        $total_amount = 0;
        $query = "SELECT d.*, cs.courier_service_name, cs.short_name, b.batch_no   FROM deliveries as d 
                                INNER JOIN courier_services as cs ON(cs.courier_service_id = d.courier_service_id)
                                INNER JOIN batches as b ON(b.batch_id = d.batch_id)
                                WHERE d.rider_id = ? and d.delivery_status='Shipped'
                                ORDER BY last_updated DESC
                                                ";
        $rows = $this->db->query($query, [$rider_id])->result();
        foreach ($rows as $row) { ?>
            <tr>
                <td><?php echo $count++ ?></td>
                <td style="vertical-align: middle;"><strong><?php echo $row->tracking_number; ?></strong>
                    <form method="post" action="<?php echo site_url(ADMIN_DIR . "deliveries/remove_rider_assigned_package"); ?>"
                        onsubmit="return confirm('Are you sure you want to remove this assigned package?');">
                        <input type="hidden" value="<?php echo $row->rider_id; ?>" name="rider_id" />
                        <input type="hidden" value="<?php echo $row->delivery_id; ?>" name="delivery_id" />
                        <button class="btn btn-link btn-sm">Remove</button>
                    </form>
                </td>
                <td><?php echo $row->recipient_name; ?><br />
                    <?php echo $row->recipient_address; ?><br />
                    <?php echo $row->recipient_contact; ?></td>
                <th><?php
                    $total_amount += $row->amount;
                    echo $row->amount; ?></th>

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