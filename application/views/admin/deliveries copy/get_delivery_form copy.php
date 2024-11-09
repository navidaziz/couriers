<form id="deliveries" class="form-horizontal" enctype="multipart/form-data" method="post">
    <input type="hidden" name="delivery_id" value="<?php echo $input->delivery_id; ?>" />
    <div class="form-group row">
        <label for="tracking_number" class="col-sm-4 col-form-label">Tracking No.</label>
        <div class="col-sm-8">
            <input type="text" required id="tracking_number" name="tracking_number"
                value="<?php echo $input->tracking_number; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="sender_name" class="col-sm-4 col-form-label">Sender Name</label>
        <div class="col-sm-8">
            <input type="text" required id="sender_name" name="sender_name" value="<?php echo $input->sender_name; ?>"
                class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="sender_address" class="col-sm-4 col-form-label">Sender Address</label>
        <div class="col-sm-8">
            <input type="text" required id="sender_address" name="sender_address"
                value="<?php echo $input->sender_address; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="sender_contact" class="col-sm-4 col-form-label">Sender Contact</label>
        <div class="col-sm-8">
            <input type="text" required id="sender_contact" name="sender_contact"
                value="<?php echo $input->sender_contact; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="recipient_name" class="col-sm-4 col-form-label">Recipient Name</label>
        <div class="col-sm-8">
            <input type="text" required id="recipient_name" name="recipient_name"
                value="<?php echo $input->recipient_name; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="recipient_address" class="col-sm-4 col-form-label">Recipient Address</label>
        <div class="col-sm-8">
            <input type="text" required id="recipient_address" name="recipient_address"
                value="<?php echo $input->recipient_address; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="recipient_contact" class="col-sm-4 col-form-label">Recipient Contact</label>
        <div class="col-sm-8">
            <input type="text" required id="recipient_contact" name="recipient_contact"
                value="<?php echo $input->recipient_contact; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="courier_service_id" class="col-sm-4 col-form-label">Courier Service</label>
        <div class="col-sm-8">
            <?php
                    echo form_dropdown("courier_service_id", array("" => "Select Courier Service")+$courier_services, $input->courier_service_id, "class=\"form-control\" required style=\"\"");
                    ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="shipment_date" class="col-sm-4 col-form-label">Shipment Date</label>
        <div class="col-sm-8">
            <input type="date" required id="shipment_date" name="shipment_date"
                value="<?php echo $input->shipment_date; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="expected_delivery_date" class="col-sm-4 col-form-label">Expected Delivery Date</label>
        <div class="col-sm-8">
            <input type="date" required id="expected_delivery_date" name="expected_delivery_date"
                value="<?php echo $input->expected_delivery_date; ?>" class="form-control">
        </div>
    </div>
    
    <div class="form-group row">
    <label for="delivery_type" class="col-sm-4 col-form-label">Delivery Type</label>
    <div class="col-sm-8">
        <select required id="delivery_type" name="delivery_type" class="form-control">
            <option value="">Select Delivery Type</option>
            <option value="standard" <?php echo ($input->delivery_type == 'standard') ? 'selected' : ''; ?>>Standard Delivery</option>
            <option value="express" <?php echo ($input->delivery_type == 'express') ? 'selected' : ''; ?>>Express Delivery</option>
            <option value="same_day" <?php echo ($input->delivery_type == 'same_day') ? 'selected' : ''; ?>>Same-day Delivery</option>
            <option value="overnight" <?php echo ($input->delivery_type == 'overnight') ? 'selected' : ''; ?>>Overnight Delivery</option>
            <option value="international" <?php echo ($input->delivery_type == 'international') ? 'selected' : ''; ?>>International Delivery</option>
            <option value="scheduled" <?php echo ($input->delivery_type == 'scheduled') ? 'selected' : ''; ?>>Scheduled Delivery</option>
            <option value="pickup_point" <?php echo ($input->delivery_type == 'pickup_point') ? 'selected' : ''; ?>>Pickup Point</option>
        </select>
    </div>
</div>

    <div class="form-group row">
        <label for="package_weight" class="col-sm-4 col-form-label">Package Weight</label>
        <div class="col-sm-8">
            <input type="text" required id="package_weight" name="package_weight"
                value="<?php echo $input->package_weight; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="package_dimensions" class="col-sm-4 col-form-label">Package Dimensions</label>
        <div class="col-sm-8">
            <input type="text" required id="package_dimensions" name="package_dimensions"
                value="<?php echo $input->package_dimensions; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="amount" class="col-sm-4 col-form-label">Amount</label>
        <div class="col-sm-8">
            <input type="text" required id="amount" name="amount"
                value="<?php echo $input->amount; ?>" class="form-control">
        </div>
    </div>
    
    <div class="form-group row">
        <label for="courier_notes" class="col-sm-4 col-form-label">Courier Notes</label>
        <div class="col-sm-8">
            <input type="text" required id="courier_notes" name="courier_notes"
                value="<?php echo $input->courier_notes; ?>" class="form-control">
        </div>
    </div>

    <div class="form-group row" style="text-align:center">
        <div id="result_response"></div>
        <?php if ($input->delivery_id == 0) { ?>
        <button type="submit" class="btn btn-primary">Add Data</button>
        <?php }else{ ?>
        <button type="submit" class="btn btn-primary">Update Data</button>
        <?php } ?>
    </div>
</form>
</div>

<script>
$('#deliveries').submit(function(e) {
    e.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
        type: 'POST',
        url: '<?php echo site_url(ADMIN_DIR . "deliveries/add_delivery"); ?>', // URL to submit form data
        data: formData,
        success: function(response) {
            // Display response
            if (response == 'success') {
                location.reload();
            } else {
                $('#result_response').html(response);
            }

        }
    });
});
</script>