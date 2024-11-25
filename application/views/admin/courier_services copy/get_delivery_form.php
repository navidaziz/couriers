<style>
    .required::after {
        content: " *";
        color: red;
        font-weight: bold;
    }
</style>
<form id="deliveries" class="form-horizontal" enctype="multipart/form-data" method="post">
    <input type="hidden" name="delivery_id" value="<?php echo $input->delivery_id; ?>" />
    <input type="hidden" name="batch_id" value="<?php echo $input->batch_id; ?>" />
    <input type="hidden" name="courier_service_id" value="<?php echo $input->courier_service_id; ?>" />
    <div class="row">
        <div class="col-md-6">
            <div class="box border blue" style="padding:5px;" id="messenger">
                <div class="form-group row">
                    <label for="tracking_number" class="col-sm-5 col-form-label required">Tracking No. </label>
                    <div class="col-sm-7">
                        <input type="text" required id="tracking_number" name="tracking_number"
                            value="<?php echo $input->tracking_number; ?>" class="form-control">
                    </div>
                </div>


                <div class="form-group row">
                    <label for="recipient_name" class="col-sm-5 col-form-label required">Recipient Name</label>
                    <div class="col-sm-7">
                        <input type="text" required id="recipient_name" name="recipient_name"
                            value="<?php echo $input->recipient_name; ?>" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="recipient_contact" class="col-sm-5 col-form-label required">Recipient Contact</label>
                    <div class="col-sm-7">
                        <input type="text" required id="recipient_contact" name="recipient_contact"
                            value="<?php echo $input->recipient_contact; ?>" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="recipient_address" class="col-sm-4 col-form-label required">Recipient Address</label>
                    <div class="col-sm-8">
                        <input type="text" required id="recipient_address" name="recipient_address"
                            value="<?php echo $input->recipient_address; ?>" class="form-control">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="delivery_type" class="col-sm-12 col-form-label required">Delivery Type</label>
                    <div class="col-sm-12">
                        <?php
                        $delivery_types = [
                            "standard" => "Standard",
                            "express" => "Express",
                            "same_day" => "Same-day",
                            "overnight" => "Overnight",
                            "international" => "International",
                            "scheduled" => "Scheduled",
                            "pickup_point" => "Pickup"
                        ];
                        ?>

                        <?php foreach ($delivery_types as $value => $label): ?>
                            <small>
                                <input type="radio" name="delivery_type" value="<?php echo $value; ?>" required
                                    <?php echo ($input->delivery_type == $value) ? 'checked' : ''; ?>>
                                <?php echo $label; ?>
                            </small>
                        <?php endforeach; ?>


                    </div>
                </div>
                <div class="form-group row">
                    <label for="amount" class="col-sm-5 col-form-label required">Amount</label>
                    <div class="col-sm-7">
                        <input type="number" required id="amount" name="amount"
                            value="<?php echo $input->amount; ?>" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="expected_delivery_date" class="col-sm-5 col-form-label required">Expected Delivery Date</label>
                    <div class="col-sm-7">
                        <input type="date" required id="expected_delivery_date" name="expected_delivery_date"
                            value="<?php echo $input->expected_delivery_date; ?>" class="form-control">
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-6">


            <div class="form-group row">
                <label for="sender_name" class="col-sm-5 col-form-label">Sender Name</label>
                <div class="col-sm-7">
                    <input type="text" id="sender_name" name="sender_name" value="<?php echo $input->sender_name; ?>"
                        class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="sender_address" class="col-sm-12 col-form-label">Sender Address</label>
                <div class="col-sm-12">
                    <input type="text" id="sender_address" name="sender_address"
                        value="<?php echo $input->sender_address; ?>" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="sender_contact" class="col-sm-5 col-form-label">Sender Contact</label>
                <div class="col-sm-7">
                    <input type="text" id="sender_contact" name="sender_contact"
                        value="<?php echo $input->sender_contact; ?>" class="form-control">
                </div>
            </div>

            <div class="form-group row">
                <label for="shipment_date" class="col-sm-5 col-form-label">Shipment Date</label>
                <div class="col-sm-7">
                    <input type="date" id="shipment_date" name="shipment_date"
                        value="<?php echo $input->shipment_date; ?>" class="form-control">
                </div>
            </div>



            <div class="form-group row">
                <label for="package_weight" class="col-sm-5 col-form-label">Package Weight</label>
                <div class="col-sm-7">
                    <input type="text" id="package_weight" name="package_weight"
                        value="<?php echo $input->package_weight; ?>" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="package_dimensions" class="col-sm-5 col-form-label">Package Dimensions</label>
                <div class="col-sm-7">
                    <input type="text" id="package_dimensions" name="package_dimensions"
                        value="<?php echo $input->package_dimensions; ?>" class="form-control">
                </div>
            </div>


            <div class="form-group row">
                <label for="courier_notes" class="col-sm-5 col-form-label">Courier Notes</label>
                <div class="col-sm-7">
                    <input type="text" id="courier_notes" name="courier_notes"
                        value="<?php echo $input->courier_notes; ?>" class="form-control">
                </div>
            </div>
        </div>
    </div>


    </div>



    <div class="form-group row" style="text-align:center">
        <div id="result_response"></div>
        <?php if ($input->delivery_id == 0) { ?>
            <button type="submit" class="btn btn-primary">Add New Delivery</button>
        <?php } else { ?>
            <button type="submit" class="btn btn-primary">Update Delivery Detail</button>
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
            url: '<?php echo site_url(ADMIN_DIR . "courier_services/add_delivery"); ?>', // URL to submit form data
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