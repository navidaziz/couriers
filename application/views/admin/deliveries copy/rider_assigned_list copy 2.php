<table class="table table-bordered table_small" id="deliveries">
                            <thead>
                                <th>#</th>
                                <th>Batch No</th>
                                <th>Tracking No.</th>
                                <th>Recipient Name</th>
                                <th>Recipient Address</th>
                                <th>Recipient Contact</th>
                                <th>Courier Service</th>
                                <th>Shipment Date</th>
                                <th>Expected Delivery Date</th>
                                <th>Delivery Status</th>
                                <th>Delivery Type</th>
                                <th>Package Weight</th>
                                <th>Package Dimensions</th>
                                <th>Amount</th>
                                <th>Payment Status</th>
                                <th>Courier Notes</th>
                            </thead>
                            <tbody>
                                <?php
                                $count=1;
                                $query = "SELECT d.*, cs.courier_service_name, cs.short_name   FROM deliveries as d 
                                INNER JOIN courier_services as cs ON(cs.courier_service_id = d.courier_service_id)
                                WHERE d.rider_id = ?
                                ";
                                $rows = $this->db->query($query, [$rider_id])->result();
                                foreach ($rows as $row) { ?>
                                   <tr>
                                        <td><?php echo $count++ ?></td>
                                        <td><?php echo $row->batch_no; ?></td>
                                        <td><?php echo $row->tracking_number; ?></td>
                                        <td><?php echo $row->recipient_name; ?></td>
                                        <td><?php echo $row->recipient_address; ?></td>
                                        <td><?php echo $row->recipient_contact; ?></td>
                                        <td><?php echo $row->short_name; ?></td>
                                        <td><?php echo $row->shipment_date; ?></td>
                                        <td><?php echo $row->expected_delivery_date; ?></td>
                                        <td><?php echo $row->delivery_status; ?></td>
                                        <td><?php echo $row->delivery_type; ?></td>
                                        <td><?php echo $row->package_weight; ?></td>
                                        <td><?php echo $row->package_dimensions; ?></td>
                                        <td><?php echo $row->amount; ?></td>
                                        <td><?php echo $row->payment_status; ?></td>
                                        <td><?php echo $row->courier_notes; ?></td>
                                    </tr>
                            <?php } ?>
                         </tbody>
                    </table>


<script>
    title = "<?php echo 'Rider ' . $rider->name . ' List ' . date('Y-m-d H:i:s'); ?>";
    $('#deliveries').DataTable({
        paging: false,
        title: title,
        order: [],
        searching: true,
        dom: 'Bfrtip', // This enables the button options
        buttons: [
            { extend: 'copy', title: title },
            { extend: 'csv', title: title },
            { extend: 'excel', title: title },
            {
    extend: 'pdf',
    title: title,
    orientation: 'landscape',
    pageSize: 'A4',
    customize: function(doc) {
        // Set page margins (small margins around the PDF content)
        doc.pageMargins = [1, 1, 1, 1];

        // Set font size for the entire document
        doc.defaultStyle.fontSize = 9;

        // Customize table styling to resemble Bootstrap's 'table-bordered' style
        doc.styles.tableHeader = {
            alignment: 'center',
            bold: true,
            fontSize: 9,
            margin: [1, 1, 1, 1], // Simulated padding with margin
            fillColor: '#f2f2f2', // Light gray background for header
            color: 'black',       // Black text color
            border: [true, true, true, true] // Apply borders to all sides
        };

        // Body cell styling
        doc.styles.tableBodyEven = {
            alignment: 'center',
            fontSize: 9,
            margin: [1, 1, 1, 1], // Simulated padding
            color: 'black',        // Black text color
            border: [true, true, true, true] // Borders on all sides
        };
        doc.styles.tableBodyOdd = {
            alignment: 'center',
            fontSize: 9,
            margin: [1, 1, 1, 1], // Simulated padding
            color: 'black',        // Black text color
            border: [true, true, true, true] // Borders on all sides
        };

        // Set table width to fit the page width
        doc.content[1].table.widths = Array(doc.content[1].table.body[0].length).fill('*');

        // Custom function to add borders to each cell
        doc.content[1].table.body.forEach(function(row) {
            row.forEach(function(cell) {
                cell.border = [true, true, true, true]; // Borders on all sides
            });
        });
    }
},

            { extend: 'print', title: title }
        ]
    });
</script>
