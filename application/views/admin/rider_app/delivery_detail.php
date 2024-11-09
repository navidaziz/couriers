 <div style="text-align:center">
     <h4>Tracking No.: <strong><?php echo $delivery->tracking_number; ?></strong> <br />
         <div style="margin:10px">
             <img src="<?php echo base_url("assets/uploads/" . $delivery->logo) ?>" height="20">
             <?php echo $delivery->courier_service_name; ?>
             <div>
     </h4>
     <h4>
         <?php echo delivery_status($delivery->delivery_status); ?>
     </h4>

 </div>
 <table class="table table_small">
     <tr>
         <th><?php echo $this->lang->line('sender_name'); ?></th>
         <th><?php echo $this->lang->line('sender_address'); ?></th>
         <th><?php echo $this->lang->line('sender_contact'); ?></th>
     </tr>
     <tr>
         <td><?php echo $delivery->sender_name; ?></td>
         <td><?php echo $delivery->sender_address; ?></td>
         <td><?php echo $delivery->sender_contact; ?></td>
     </tr>
 </table>

 <table class="table table_small">
     <thead>

     </thead>
     <tbody>
         <tr>
             <th><?php echo $this->lang->line('shipment_date'); ?></th>
             <td>
                 <?php echo $delivery->shipment_date; ?>
             </td>
         </tr>
         <tr>
             <th><?php echo $this->lang->line('expected_delivery_date'); ?></th>
             <td>
                 <?php echo $delivery->expected_delivery_date; ?>
             </td>
         </tr>
         <tr>
             <th><?php echo $this->lang->line('delivery_status'); ?></th>
             <td>
                 <?php echo $delivery->delivery_status; ?>
             </td>
         </tr>
         <tr>
             <th><?php echo $this->lang->line('delivery_type'); ?></th>
             <td>
                 <?php echo $delivery->delivery_type; ?>
             </td>
         </tr>
         <tr>
             <th><?php echo $this->lang->line('package_weight'); ?></th>
             <td>
                 <?php echo $delivery->package_weight; ?>
             </td>
         </tr>
         <tr>
             <th><?php echo $this->lang->line('package_dimensions'); ?></th>
             <td>
                 <?php echo $delivery->package_dimensions; ?>
             </td>
         </tr>

         <tr>
             <th><?php echo $this->lang->line('payment_status'); ?></th>
             <td>
                 <?php echo $delivery->payment_status; ?>
             </td>
         </tr>
         <tr>
             <th><?php echo $this->lang->line('courier_notes'); ?></th>
             <td>
                 <?php echo $delivery->courier_notes; ?>
             </td>
         </tr>


     </tbody>
 </table>


 <table class="table">
     <tr>
         <th><?php echo $this->lang->line('recipient_name'); ?></th>
         <td><?php echo $delivery->recipient_name; ?></td>
     </tr>
     <tr>
         <th><?php echo $this->lang->line('recipient_address'); ?></th>
         <td><?php echo $delivery->recipient_address; ?></td>
     </tr>
     <tr>
         <th><?php echo $this->lang->line('recipient_contact'); ?></th>
         <td><?php echo $delivery->recipient_contact; ?></td>

     <tr>
     <tr>
         <th><?php echo $this->lang->line('amount'); ?></th>
         <td>
             <?php echo $delivery->amount; ?>
         </td>
     </tr>

 </table>

 <div>
     Do youn want to deliver the package ?
     <input type="radio" name="delivery" value="Yes" onclick="$('#delivered_div').show();$('#cancel_div').hide();" /> Yes
     <span style="margin-left:20px;"></span>
     <input type="radio" name="delivery" value="No" onclick="$('#delivered_div').hide();$('#cancel_div').show();" /> No
 </div>

 <div id="delivered_div" style="padding:15px !important; border:1px solid gray; border-radius:5px; display:none">
     <form id="deliver" class="form-horizontal" enctype="multipart/form-data" method="post">
         <input type="hidden" name="delivery_id" value="<?php echo $delivery->delivery_id; ?>" />
         <table style="width:100%">
             <tr>
                 <th>Deliver to</th>
                 <th><input required name="delivered_to" id="delivered_to" value="" /></td>
             </tr>
             <tr>
                 <th>Mobile No:</th>
                 <td> <input required type="number" name="delivered_to_mobile_no" id="delivered_to_mobile_no" value="" /> </td>
             </tr>
             <tr>
                 <td colspan="2" style="text-align:center">
                     <div id="result_response"></div>
                     <button class="btn btn-success">Deliver >></button>
                 </td>
             </tr>
         </table>
     </form>
     <script>
         $('#deliver').submit(function(e) {

             e.preventDefault();
             var formData = $(this).serialize();
             $.ajax({
                 type: 'POST',
                 url: '<?php echo site_url(ADMIN_DIR . "rider_app/deliver"); ?>', // URL to submit form data
                 data: formData,
                 success: function(response) {
                     // Display response
                     console.log(response);
                     if (response == 'success') {
                         location.reload();
                     } else {
                         $('#result_response').fadeOut('fast', function() {
                             $(this).html(response).fadeIn('fast');
                         });
                     }

                 }
             });
         });
     </script>
 </div>

 <div id="cancel_div" style="padding:15px !important; border:1px solid gray; border-radius:5px; display:none">
     <div>
         What do you want?
         <input type="radio" name="cancelled_or_hold" value="Cancelled" onclick="$('#package_cancelled').show();$('#package_onhold').hide();" /> Cancelled
         <span style="margin-left:20px;"></span>
         <input type="radio" name="cancelled_or_hold" value="Onhold" onclick="$('#package_cancelled').hide();$('#package_onhold').show();" /> Onhold
     </div>
     <div id="package_cancelled" style="display: none;">
         <form id="cancel" class="form-horizontal" enctype="multipart/form-data" method="post">
             <input type="hidden" name="delivery_id" value="<?php echo $delivery->delivery_id; ?>" />
             <table style="width:100%">
                 <tr>
                     <td>Write Cancel Reason.<br />
                         <textarea required style="width:100%" required name="cancelled_reason" id="cancelled_reason"><?php echo $delivery->cancelled_reason; ?></textarea>
                     </td>
                 </tr>
                 <tr>
                     <td colspan="2" style="text-align:center">
                         <div id="cancelled_response"></div>
                         <button class="btn btn-danger">Cancel x</button>
                     </td>
                 </tr>
             </table>
         </form>
         <script>
             $('#cancel').submit(function(e) {
                 e.preventDefault();
                 var formData = $(this).serialize();
                 $.ajax({
                     type: 'POST',
                     url: '<?php echo site_url(ADMIN_DIR . "rider_app/cancel"); ?>', // URL to submit form data
                     data: formData,
                     success: function(response) {
                         // Display response
                         console.log(response);
                         if (response == 'success') {
                             location.reload();
                         } else {
                             $('#cancelled_response').fadeOut('fast', function() {
                                 $(this).html(response).fadeIn('fast');
                             });
                         }

                     }
                 });
             });
         </script>
     </div>
     <div id="package_onhold" style="display: none;">
         <form id="onhold" class="form-horizontal" enctype="multipart/form-data" method="post">
             <input type="hidden" name="delivery_id" value="<?php echo $delivery->delivery_id; ?>" />
             <table style="width:100%">
                 <tr>
                     <td>Write Onhold Reason.<br />
                         <textarea required style="width:100%" required name="onhold_reason" id="onhold_reason"><?php echo $delivery->onhold_reason; ?></textarea>
                     </td>
                 </tr>
                 <tr>
                     <td colspan="2" style="text-align:center">
                         <div id="cancelled_response"></div>
                         <button class="btn btn-warning">On Hold</button>
                     </td>
                 </tr>
             </table>
         </form>
         <script>
             $('#onhold').submit(function(e) {
                 e.preventDefault();
                 var formData = $(this).serialize();
                 $.ajax({
                     type: 'POST',
                     url: '<?php echo site_url(ADMIN_DIR . "rider_app/onhold"); ?>', // URL to submit form data
                     data: formData,
                     success: function(response) {
                         // Display response
                         console.log(response);
                         if (response == 'success') {
                             location.reload();
                         } else {
                             $('#cancelled_response').fadeOut('fast', function() {
                                 $(this).html(response).fadeIn('fast');
                             });
                         }

                     }
                 });
             });
         </script>
     </div>
 </div>