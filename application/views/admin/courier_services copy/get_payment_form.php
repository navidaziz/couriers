<form id="payments" class="form-horizontal" enctype="multipart/form-data" method="post">
    <input type="hidden" name="payment_id" value="<?php echo $input->payment_id; ?>" />
    <div class="form-group row">
        <label for="courier_service_id" class="col-sm-4 col-form-label">Courier Service</label>
        <div class="col-sm-8">
            <strong>
                <?php
                $query = "SELECT courier_service_name FROM courier_services WHERE courier_service_id = ?";
                $courier_service = $this->db->query($query, [$input->courier_service_id])->row();
                echo $courier_service->courier_service_name;
                ?>
            </strong>

            <input type="hidden" required id="courier_service_id" name="courier_service_id" value="<?php echo $input->courier_service_id; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="batch_id" class="col-sm-4 col-form-label">Batch</label>
        <div class="col-sm-8">
            <strong>
                <?php
                $query = "SELECT batch_no FROM batches WHERE batch_id = ?";
                $batch = $this->db->query($query, [$input->batch_id])->row();
                echo $batch->batch_no;
                ?>
            </strong>
            <input type="hidden" required id="batch_id" name="batch_id" value="<?php echo $input->batch_id; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="payee_name" class="col-sm-4 col-form-label">Payee Name</label>
        <div class="col-sm-8">
            <input type="text" required id="payee_name" name="payee_name" value="<?php echo $input->payee_name; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="payment_date" class="col-sm-4 col-form-label">Payment Date</label>
        <div class="col-sm-8">
            <input type="date" required id="payment_date" name="payment_date" value="<?php echo $input->payment_date; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="paid_amount" class="col-sm-4 col-form-label">Paid Amount</label>
        <div class="col-sm-8">
            <input type="number" required id="paid_amount" name="paid_amount" value="<?php echo $input->paid_amount; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="payment_detail" class="col-sm-4 col-form-label">Payment Detail</label>
        <div class="col-sm-8">
            <input type="text" required id="payment_detail" name="payment_detail" value="<?php echo $input->payment_detail; ?>" class="form-control">
        </div>
    </div>

    <div class="form-group row" style="text-align:center">
        <div id="result_response"></div>
        <?php if ($input->payment_id == 0) { ?>
            <button type="submit" class="btn btn-primary">Add Data</button>
        <?php } else { ?>
            <button type="submit" class="btn btn-primary">Update Data</button>
        <?php } ?>
    </div>
</form>
</div>

<script>
    $('#payments').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url(ADMIN_DIR . "courier_services/add_payment"); ?>', // URL to submit form data
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