<form id="consumer_monthly_bills" class="form-horizontal" enctype="multipart/form-data" method="post">
    <input type="hidden" name="consumer_monthly_bill_id" value="<?php echo $input->consumer_monthly_bill_id; ?>" />
    <input type="hidden" required id="billing_month_id" name="billing_month_id"
        value="<?php echo $input->billing_month_id; ?>" class="form-control">
    <input type="hidden" required id="consumer_id" name="consumer_id" value="<?php echo $input->consumer_id; ?>"
        class="form-control">
    <div>
<table class="table">
    <tr><td> Consumer Info<br />
        Consumer Name: <?php echo $consumer->consumer_name; ?><br />
        Father Name: <?php echo $consumer->consumer_father_name; ?><br />
        Consumer CNIC: <?php echo $consumer->consumer_cnic; ?><br />
        Contact No: <?php echo $consumer->consumer_contact_no; ?><br />
        Meter No: <?php echo $consumer->consumer_meter_no; ?>
</td>
<td>
Billing Month:<br />
<?php echo $billing_month->billing_month; ?>
</td>
</tr>
</table>
    </div>

    <div class="form-group row">
        <label for="reading_date" class="col-sm-4 col-form-label">Reading Date</label>
        <div class="col-sm-8">
            <input type="date" required id="reading_date" name="reading_date"
                value="<?php echo $input->reading_date; ?>" class="form-control">
        </div>
    </div>
    <?php if ($input->last_reading == 0) { ?>
    <div class="form-group row">
        <label for="last_reading" class="col-sm-4 col-form-label">Last Reading</label>
        <div class="col-sm-8">
            <input type="number" required id="last_reading" name="last_reading"
                value="<?php echo $input->last_reading; ?>" class="form-control">
        </div>
    </div>
    <?php } ?>

    <div class="form-group row">
        <label for="current_reading" class="col-sm-4 col-form-label">Current Reading</label>
        <div class="col-sm-8">
            <input min="<?php echo $input->last_reading; ?>" type="number" required id="current_reading"
                name="current_reading" value="<?php echo $input->current_reading; ?>" class="form-control">
        </div>
    </div>
    <?php if ($input->last_reading == 0) { ?>
    <div class="form-group row">
        <label for="last_month_arrears" class="col-sm-4 col-form-label">Last Month Arrears</label>
        <div class="col-sm-8">
            <input type="number" required id="last_month_arrears" name="last_month_arrears"
                value="<?php echo $input->last_month_arrears; ?>" class="form-control">
        </div>
    </div>
    <?php } ?>


    <div class="form-group row" style="text-align:center">
        <div id="result_response"></div>
        <?php if ($input->consumer_monthly_bill_id == 0) { ?>
        <button type="submit" class="btn btn-primary">Add Meter Reading</button>
        <?php } else { ?>
        <button type="submit" class="btn btn-primary">Update Meter Reading</button>
        <?php } ?>
    </div>
</form>
</div>

<script>
$('#consumer_monthly_bills').submit(function(e) {
    e.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
        type: 'POST',
        url: '<?php echo site_url(ADMIN_DIR . "consumer_monthly_bills/add_comsumer_monthly_bill"); ?>', // URL to submit form data
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