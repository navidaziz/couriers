 <div class="col-md-12">
     <div class="box border blue" id="messenger">
         <div class="box-body">
             <table class="table table-bordered table_" id="batches">
                 <thead>
                     <tr>
                         <th>Courier Service</th>
                         <th>Batch No</th>
                         <th>Batch Date</th>
                         <th>Batch Detail</th>
                         <th>Payment Status</th>
                     </tr>
                 </thead>
                 <tbody>
                     <tr>
                         <td><?php echo $batch->courier_service_name; ?></td>
                         <td><?php echo $batch->batch_no; ?></td>
                         <td><?php echo $batch->batch_date; ?></td>
                         <td><?php echo $batch->batch_detail; ?></td>

                         <td><?php echo $batch->payment_status; ?></td>
                     </tr>

                 </tbody>
             </table>
             <div style="text-align: center;">
                 <strong>Verify Batch Packages</strong>
                 <table class="table">
                     <tr>
                         <td>Search by Tracking No: <br />
                             <input class="form-control" type="text" id="tracking_no" placeholder="Scan barcode here" autofocus>
                             <div style="margin-top: 5px;" id="tracking_no_response"></div>
                         </td>
                     </tr>
                 </table>
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
                                 url: '<?php echo site_url(ADMIN_DIR . "courier_services/seacrch_by_tracking_no"); ?>', // URL to submit form data
                                 data: {
                                     tracking_no: tracking_no,
                                     batch_id: <?php echo $batch->batch_id ?>,
                                     courier_service_id: <?php echo $courier_service->courier_service_id; ?>
                                 },
                                 success: function(response) {
                                     $('#tracking_no_response').html(response).fadeIn(200);
                                     var tracking_no = $('#tracking_no').val("");
                                 }
                             });
                         }
                     });
                 </script>
             </div>
         </div>

     </div>


     <br />
     <br />
     <?php

        $delivery_status  = array("Pending", "Shipped", "Onhold", "Delivered", "Cancelled", "Returned",  "Completed");

        $query = "SELECT 
                        COUNT(*) as total_packages,
                        SUM(amount) as total_amount FROM deliveries 
                        WHERE batch_id = ?";
        $batch_status = $this->db->query($query, [$batch->batch_id])->row();

        ?>
     <strong>Summary</strong>
     <table class="table table-bordered">
         <tr>
             <th></th>
             <th>Received</th>
             <?php foreach ($delivery_status as $d_status) { ?>
                 <th><?php echo $d_status; ?></th>
             <?php } ?>
         </tr>
         <tr>
             <th>Total</th>
             <th><?php echo $batch_status->total_packages; ?></th>
             <?php foreach ($delivery_status as $d_status) {
                    $query = "SELECT 
                                    COUNT(*) as total
                                FROM deliveries 
                                WHERE batch_id = ?
                                AND delivery_status = '" . $d_status . "'";
                    $packages = $this->db->query($query, [$batch->batch_id])->row();
                ?>
                 <th><?php echo $packages->total; ?></th>
             <?php } ?>
         </tr>
         <tr>
             <th>Amount</th>
             <th><?php echo $batch_status->total_amount; ?></th>
             <?php foreach ($delivery_status as $d_status) {
                    $query = "SELECT 
                                    SUM(amount) as total
                                FROM deliveries 
                                WHERE batch_id = ?
                                AND delivery_status = '" . $d_status . "'";
                    $amount = $this->db->query($query, [$batch->batch_id])->row();
                ?>
                 <th><?php echo $amount->total; ?></th>
             <?php } ?>
         </tr>
         <tr>

             <th></th>
             <th></th>
             <th></th>
             <th></th>
             <th></th>
             <th></th>
             <th></th>
             <th>Paid</th>
             <th><?php
                    $query = "SELECT SUM(p.paid_amount) as total
                                        FROM payments AS p
                                        WHERE p.batch_id = '" . $batch->batch_id . "' 
                                        AND p.courier_service_id = '" . $courier_service->courier_service_id . "'";
                    $paid = $this->db->query($query)->row();
                    echo $paid->total; ?></th>

         </tr>
         <tr>

             <th></th>
             <th></th>
             <th></th>
             <th></th>
             <th></th>
             <th></th>
             <th></th>
             <th>Remaining</th>
             <th><?php
                    $query = "SELECT 
                                    SUM(amount) as total
                                FROM deliveries 
                                WHERE batch_id = ?
                                AND delivery_status = 'Completed'";
                    $completed_amount = $this->db->query($query, [$batch->batch_id])->row();
                    echo $amount->total - $paid->total; ?>
             </th>

         </tr>
     </table>

     <?php
        $query = "SELECT 
                                    COUNT(amount) as total
                                FROM deliveries 
                                WHERE batch_id = ?
                                AND delivery_status IN('Completed', 'Returned')";
        $completed_and_returned = $this->db->query($query, [$batch->batch_id])->row();
        // echo " if (($batch_status->total_packages == $completed_and_returned->total) and
        //     $paid->total == $completed_amount->total
        //     and $batch_status->total_packages > 0
        // ) {";
        if (($batch_status->total_packages == $completed_and_returned->total) and
            $paid->total == $completed_amount->total
            and $batch_status->total_packages > 0
        ) { ?>
         <?php if ($batch->payment_status == 'Unpaid') {

                $query = "SELECT 
                COUNT(*) as total_packages,
                                    SUM(amount) as total
                                FROM deliveries 
                                WHERE batch_id = ?
                                AND delivery_status = 'Returned'";
                $returend = $this->db->query($query, [$batch->batch_id])->row();

                $query = "SELECT 
                COUNT(*) as total_packages,
                                    SUM(amount) as total
                                FROM deliveries 
                                WHERE batch_id = ?
                                AND delivery_status = 'Completed'";
                $completed = $this->db->query($query, [$batch->batch_id])->row();

            ?>
             Do you want to mark this batch as Paid and Completed ?
             <input onclick="$('#paid_and_complete').show()" type="radio" name="complete_batch" value="Yes" /> Yes
             <span style="margin-left: 10px;"></span>
             <input onclick="$('#paid_and_complete').hide()" type="radio" name="complete_batch" value="No" /> No
             <div id="paid_and_complete" style="border:1px solid gray; border-radius:5px; margin:5px; padding:5px; display:none; ">
                 <form method="post" action="<?php echo site_url(ADMIN_DIR . "courier_services/complete_batch"); ?>"
                     onsubmit="return confirm('Are you sure you want to complete this batch?');">
                     <input type="hidden" value="<?php echo $batch->batch_id; ?>" name="batch_id" />
                     <input type="hidden" value="<?php echo $courier_service->courier_service_id; ?>" name="courier_service_id" />
                     <input type="hidden" name="total_packages_received" value="<?php echo $batch_status->total_packages; ?>" />
                     <input type="hidden" name="total_amount" value="<?php echo $batch_status->total_amount; ?>" />
                     <input type="hidden" name="total_delivered" value="<?php echo $completed->total_packages; ?>" />
                     <input type="hidden" name="total_delivered_amount" value="<?php echo $completed->total; ?>" />
                     <input type="hidden" name="total_returned" value="<?php echo $returend->total_packages; ?>" />
                     <input type="hidden" name="total_returned_amount" value="<?php echo $returend->total; ?>" />
                     <input type="hidden" name="paid_amount" value="<?php echo $paid->total; ?>" />

                     <table style=" margin: 0 auto;">
                         <tr>
                             <td colspan="3"><strong>Note</strong> <br />
                                 <textarea style="width: 100%;" name="note"></textarea>
                             </td>
                         </tr>
                         <tr>
                             <th>Return Packages and Amount Handover to:</th>
                             <td><input required type="text" name="hand_over_to" /></td>
                         </tr>
                         <tr>
                             <th>Date:</th>
                             <td><input required type="date" name="completed_date" /></td>
                         </tr>
                     </table>
                     <div style="text-align: center; padding:5px">
                         <button class="btn btn-success">Mark as Paid and Completed</button>
                     </div>
                 </form>
             </div>
         <?php } else { ?>
             <div id="paid_and_complete" style="border:1px solid gray; border-radius:5px; margin:5px; padding:5px;">
                 <table style=" margin: 0 auto;">
                     <tr>
                         <td colspan="3"><strong>Note</strong> <br />
                             <?php echo $batch->note; ?>
                         </td>
                     </tr>
                     <tr>
                         <th>Return Packages and Amount Handover to:</th>
                         <td><?php echo $batch->hand_over_to; ?></td>
                     </tr>
                     <tr>
                         <th>Date:</th>
                         <td><?php echo $batch->completed_date; ?></td>
                     </tr>
                 </table>
             </div>
         <?php } ?>
     <?php } ?>

     <div style="text-align: center;">
         <a target="_blank" class="btn btn-warning btn-sm" href="<?php echo site_url(ADMIN_DIR . 'courier_services/courier_service_batche_print/' . $courier_service->courier_service_id . '/' . $batch->batch_id . '/'); ?>"><i class="fa fa-print" aria-hidden="true"></i> Print</a>
     </div>
 </div>