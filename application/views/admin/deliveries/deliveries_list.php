 <div class="table-responsive">
     <table id="datatable" class="table  table_small table-bordered">
         <thead>
             <tr>
                 <th>#</th>
                 <th>Courier Service</th>
                 <th>Batch No.</th>
                 <th>Tracking Number</th>
                 <th>Verified</th>
                 <th>Delivery Type</th>
                 <th>Recipient Address</th>
                 <th>Recipient Contact</th>
                 <th>Recipient Name</th>
                 <th>Expected Delivery Date</th>
                 <th>Amount</th>
                 <th>Payment Status</th>
                 <th>Courier Notes</th>
                 <th>Rider</th>
                 <th>Assigned Date</th>
                 <th>Delivery Status</th>
                 <th>Delivered Date</th>
                 <th>Delivered To</th>
                 <th>Delivered To Mobile No</th>
                 <th>Cancelled Date</th>
                 <th>Cancelled Reason</th>
                 <th>Onhold Date</th>
                 <th>Onhold Reason</th>
                 <th>Sender Name</th>
                 <th>Sender Address</th>
                 <th>Sender Contact</th>
                 <th>Shipment Date</th>
                 <th>Package Weight</th>
                 <th>Package Dimensions</th>
             </tr>
         </thead>
         <tbody></tbody>
     </table>

     <script type="text/javascript">
         $(document).ready(function() {
             document.title = "deliveries (Date:<?php echo date('d-m-Y h:m:s') ?>)";
             $("#datatable").DataTable({
                 "processing": true,
                 "serverSide": true,
                 "ajax": {
                     "url": "<?php echo base_url(ADMIN_DIR . "deliveries/deliveries"); ?>",
                     "type": "POST",
                     "data": {
                         delivery_status: '<?php echo $tab; ?>'
                     },
                 },
                 "columns": [{
                         "data": null,
                         "render": function(data, type, row, meta) {
                             return meta.row + meta.settings._iDisplayStart + 1; // Start index from 1
                         }
                     },
 
                     {
                         "data": "courier_service_name"
                     },

                     {
                         "data": "batch_no"
                     },

                     {
                         "data": "tracking_number"
                     },

                     {
                         "data": "verified"
                     },

                     {
                         "data": "delivery_type"
                     },

                     {
                         "data": "recipient_address"
                     },

                     {
                         "data": "recipient_contact"
                     },

                     {
                         "data": "recipient_name"
                     },

                     {
                         "data": "expected_delivery_date"
                     },

                     {
                         "data": "amount"
                     },

                     {
                         "data": "payment_status"
                     },

                     {
                         "data": "courier_notes"
                     },

                     {
                         "data": "rider_name"
                     },

                     {
                         "data": "assigned_date"
                     },

                     {
                         "data": "delivery_status"
                     },

                     {
                         "data": "delivered_date"
                     },

                     {
                         "data": "delivered_to"
                     },

                     {
                         "data": "delivered_to_mobile_no"
                     },

                     {
                         "data": "cancelled_date"
                     },

                     {
                         "data": "cancelled_reason"
                     },

                     {
                         "data": "onhold_date"
                     },

                     {
                         "data": "onhold_reason"
                     },

                     {
                         "data": "sender_name"
                     },

                     {
                         "data": "sender_address"
                     },

                     {
                         "data": "sender_contact"
                     },

                     {
                         "data": "shipment_date"
                     },

                     {
                         "data": "package_weight"
                     },

                     {
                         "data": "package_dimensions"
                     }

                 ],
                 "lengthMenu": [
                     [15, 25, 50, -1],
                     [15, 25, 50, "All"]
                 ],
                 "order": [
                     [0, "asc"]
                 ],
                 "searching": true,
                 "paging": true,
                 "info": true,
                 dom: "Bfrtip",

                 buttons: ["excel", "pageLength"]
             });
         });
     </script>


 </div>