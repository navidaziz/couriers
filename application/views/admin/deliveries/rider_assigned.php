<div class="table-responsive">
    <table class="table">
        <tr>
            <td>Please enter Tracking No to assign package to rider: <br />
                <input class="form-control" type="text" id="tracking_no" placeholder="Scan barcode here" autofocus>
                <div id="tracking_no_response"></div>    
            </td>
        </tr>
    </table>
    <div id="rider_assigned_packages"></div>           
</div>
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
                            url: '<?php echo site_url(ADMIN_DIR . "deliveries/seacrch_by_tracking_no"); ?>', // URL to submit form data
                            data: {
                                tracking_no:tracking_no,
                                rider_id: '<?php echo $rider->user_id; ?>'
                            },
                            success: function(response) {
                                
                                if(response=='success'){
                                    get_rider_assigned_packages();
                                }else{
                                    $('#tracking_no_response').fadeOut(200, function() {
                                    $(this).html(response).fadeIn(200);
                                    });
                                }
                                    

                            }
                        });
                    }
            });

        function get_rider_assigned_packages(){
                $.ajax({
                        type: 'POST',
                        url: '<?php echo site_url(ADMIN_DIR . "deliveries/get_rider_assigned_packages"); ?>', // URL to submit form data
                        data: {
                            rider_id: '<?php echo $rider->user_id; ?>'
                        },
                        success: function(response) {
                                $('#rider_assigned_packages').fadeOut(200, function() {
                                $(this).html(response).fadeIn(200);
                                });
                                

                        }
                    });
        }
        get_rider_assigned_packages();
</script>
