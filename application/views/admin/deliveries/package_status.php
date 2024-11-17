<table class="table table-bordered table_ small" id="riderassignedlist">
    <thead>
        <th>Tracking No.</th>
        <th>Batch No. / Courier Service</th>
        <th>Recipient Detail</th>
        <th>Rider</th>
        <th>Status</th>
        <th>Amount</th>
    </thead>
    <tbody>
        <tr>
            <th style="vertical-align: middle;"><strong><?php echo $delivery->tracking_number; ?></strong></th>
            <th style="vertical-align: middle;"><strong><?php echo $delivery->batch_no; ?></strong><br />
                <strong><?php echo $delivery->cs_name; ?>
            </th>

            <td><?php echo $delivery->recipient_name; ?><br />
                <?php echo $delivery->recipient_address; ?><br />
                <?php echo $delivery->recipient_contact; ?></td>
            <th>
                <?php
                if ($delivery->rider_id) {
                    $query = "SELECT users.name, roles.role_title FROM users
                INNER JOIN roles ON (roles.role_id = users.role_id)
                WHERE user_id = $delivery->rider_id";
                    $rider = $this->db->query($query)->row();
                    echo  '<strong> ' . $rider->name . ' (' . $rider->role_title . ') </strong>';
                }
                ?>

            </th>
            <td style="text-align: center;"><?php echo $delivery->delivery_status; ?>

                </th>
            <th><?php echo $delivery->amount; ?></th>

        </tr>

    </tbody>

</table>