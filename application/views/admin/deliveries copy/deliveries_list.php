
        <div class="table-responsive">
        
        <table id="datatable" class="table  table_small table-bordered">
        <thead>
            <tr>
                 <th></th>
            <th>#</th>
            <th>Tracking No.</th>
                    <th>Sender Name</th>
                    <th>Sender Address</th>
                    <th>Sender Contact</th>
                    <th>Recipient Name</th>
                    <th>Recipient Address</th>
                    <th>Recipient Contact</th>
                    <th>Courier</th>
                    <th>Shipment Date</th>
                    <th>Expected Delivery Date</th>
                    <th>Delivery Status</th>
                    <th>Delivery Type</th>
                    <th>Package Weight</th>
                    <th>Package Dimensions</th>
                    <th>Amount</th>
                    <th>Payment Status</th>
                    <th>Courier Notes</th>
                    
        <th></th>
        <th></th>
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
                        "url": "<?php echo base_url(ADMIN_DIR."deliveries/deliveries"); ?>",
                        "type": "POST",
                        "data": {
                        delivery_status: '<?php echo $tab; ?>'
                    }
                    },
                    "columns": [
                        {
            
            "render": function(data, type, row) {
                return '<a class="llink llink-view" href="<?php echo site_url(ADMIN_DIR . "deliveries/trash/"); ?>' + row.delivery_id + '/' + '" onclick="return confirm("Are you sure? you want to delete the record.")"><i class="fa fa-trash-o"></i></a><span style="margin-left: 10px;"></span>';
                    }
        },
                        {
                            "data": null,
                            "render": function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1; // Start index from 1
                            }
                        },
                        
                        
                { "data": "tracking_number" },
                
                { "data": "sender_name" },
                
                { "data": "sender_address" },
                
                { "data": "sender_contact" },
                
                { "data": "recipient_name" },
                
                { "data": "recipient_address" },
                
                { "data": "recipient_contact" },
                
                { "data": "short_name" },
                
                { "data": "shipment_date" },
                
                { "data": "expected_delivery_date" },
                
                { "data": "delivery_status" },
                
                { "data": "delivery_type" },
                
                { "data": "package_weight" },
                
                { "data": "package_dimensions" },
                
                { "data": "amount" },
                
                { "data": "payment_status" },
                
                { "data": "courier_notes" },
                

        {
            "data": null,
            "render": function(data, type, row) {
                return '<a  href="<?php echo site_url(ADMIN_DIR . "deliveries/view_delivery/"); ?>' + row.delivery_id+ '">View</a><span style="margin-left: 10px;"></span>';
            }
        },
        {
            "data": null,
            "render": function(data, type, row) {
                return '<button   onclick="get_delivery_form(\'' + row.delivery_id  + '\')">Edit</button>';
            }
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
        