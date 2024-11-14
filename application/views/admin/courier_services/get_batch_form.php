<form id="batches" class="form-horizontal" enctype="multipart/form-data" method="post">
    <input type="hidden" name="batch_id" value="<?php echo $input->batch_id; ?>" />
    <input type="hidden" required id="courier_service_id" name="courier_service_id" value="<?php echo $input->courier_service_id; ?>" class="form-control">

    <div class="form-group row">
        <label for="batch_no" class="col-sm-4 col-form-label">Batch No</label>
        <div class="col-sm-8">
            <input type="text" required id="batch_no" name="batch_no" value="<?php echo $input->batch_no; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="batch_date" class="col-sm-4 col-form-label">Batch Date</label>
        <div class="col-sm-8">
            <input type="date" required id="batch_date" name="batch_date" value="<?php echo $input->batch_date; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="batch_detail" class="col-sm-4 col-form-label">Batch Detail</label>
        <div class="col-sm-8">
            <input type="text" required id="batch_detail" name="batch_detail" value="<?php echo $input->batch_detail; ?>" class="form-control">
        </div>
    </div>

    <div class="form-group row">
        <label for="csv_file" class="col-sm-4 col-form-label">CSV File

            <br />
            <?php if ($input->csv_file) { ?>
                <a target="_blank" href="<?php echo base_url("assets/uploads/" . $input->csv_file) ?>">Download</a>
            <?php } ?>
        </label>
        <div class="col-sm-8">
            <input type="file" required id="csv_file" name="csv_file" accept=".csv" class="form-control">
        </div>
    </div>

    <div class="form-group row" style="text-align:center">
        <div id="result_response"></div>
        <?php if ($input->batch_id == 0) { ?>
            <button type="submit" class="btn btn-primary">Add Data</button>
        <?php } else { ?>
            <button type="submit" class="btn btn-primary">Update Data</button>
        <?php } ?>
    </div>
</form>

<script>
    $('#batches').submit(function(e) {
        e.preventDefault();

        // Create a FormData object to handle both files and other data
        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: '<?php echo site_url(ADMIN_DIR . "courier_services/add_batch"); ?>', // URL to submit form data
            data: formData,
            processData: false, // Required for file upload
            contentType: false, // Required for file upload
            success: function(response) {
                // Display response
                if (response === 'success') {
                    location.reload();
                } else {
                    $('#result_response').html(response);
                }
            },
            error: function(xhr, status, error) {
                $('#result_response').html('<div class="alert alert-danger">Error: ' + error + '</div>');
            }
        });
    });
</script>