<div style="background-color: white;">
    <div class="row" style="background-color:white">
        <div class="col-sm-12">
            <ul class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a
                        href="<?php echo site_url($this->session->userdata("role_homepage_uri")); ?>"><?php echo $this->lang->line('Home'); ?></a>
                </li>
                <li><?php echo $title; ?></li>
            </ul>
        </div>
    </div>

    <div style="text-align: center;">
        <div class="btn-group" role="group" aria-label="Basic example">
            <a href="<?php echo site_url(ADMIN_DIR . 'rider_app/index/Shipped'); ?>" style="margin-right: 5px;" type="button" class="btn 
            <?php if ($tab == 'Shipped') { ?>
           btn-warning  active
            <?php } ?>
            ">Pending List</a>
            <a href="<?php echo site_url(ADMIN_DIR . 'rider_app/index/Delivered'); ?>" style="margin-right: 5px;" type="button" class="btn   <?php if ($tab == 'Delivered') { ?>
            btn-success active
            <?php } ?>">Delivered List</a>
            <a href="<?php echo site_url(ADMIN_DIR . 'rider_app/index/Cancelled'); ?>" class="btn  <?php if ($tab == 'Cancelled') { ?>
             btn-danger active
            <?php } ?>">Cancelled List</a>
        </div>
    </div>


    <?php if ($tab == 'Shipped') {
        echo '<h4 class="alert alert-warning" style="margin-left:5px; margin-right:5px">Pending Delivery Packages list</h4>';
    }
    if ($tab == 'Delivered') {
        echo '<h4 class="alert alert-success" style="margin-left:5px; margin-right:5px">Delivered Delivery Packages list</h4>';
    }
    if ($tab == 'Cancelled') {
        echo '<h4 class="alert alert-danger" style="margin-left:5px; margin-right:5px">Cancelled Delivery Packages list</h4>';
    } ?>


    <div class="table-responsive" style="height: 650px; overflow-y: auto;">
        <table class="table table-strip" id="deliveries">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Packages</th>
                    <th>Recipaint</th>
                    <th>Address</th>
                </tr>
            </thead>
            <tbody>
                <?php $query = "SELECT * FROM `deliveries` where rider_id = ? ";
                if ($tab == 'Shipped') {
                    $query .= "AND delivery_status IN ('Shipped','Onhold')";
                }
                if ($tab == 'Delivered') {
                    $query .= "AND delivery_status IN ('Delivered')";
                }
                if ($tab == 'Cancelled') {
                    $query .= "AND delivery_status IN ('Cancelled')";
                }
                $deliveries = $this->db->query($query, $rider->user_id)->result();
                $count = 1;
                foreach ($deliveries as $delivery) { ?>
                    <tr style="border-radius: 20px; overflow: hidden;">
                        <td><?php echo $count++ ?></td>
                        <td stylet="text-align:center">
                            <div style="text-align: center !important;">
                                <strong>Tracking No</strong>
                                <h5><?php echo $delivery->tracking_number; ?></h5>

                                <h4>
                                    <?php echo delivery_status($delivery->delivery_status); ?>
                                </h4>
                                <?php if ($delivery->delivery_status == 'Shipped' or $delivery->delivery_status == 'Onhold') { ?>
                                    <button onclick="get_delivery_detail('<?php echo $delivery->delivery_id; ?>')" class="btn btn-primary btn-sm">Process ></button>
                                <?php } else { ?>
                                    <button style="border: 1px solid red; color:red; padding:2px" onclick="get_delivery_detail('<?php echo $delivery->delivery_id; ?>')" class="btn btn-danger btn-link btn-sm">Change Status</button>
                                <?php } ?>
                            </div>
                        </td>
                        <td>

                            Name:<?php echo $delivery->recipient_name; ?><br />
                            Contact No.: <a href="tel:<?php echo $delivery->recipient_contact; ?>">
                                <?php echo $delivery->recipient_contact; ?></a><br />
                            <!-- <strong style="color: green;">Address: <?php echo $delivery->recipient_address; ?></strong><br /> -->
                            Expected Delivery Date: <?php echo $delivery->expected_delivery_date; ?><br />
                            <strong style="color: red;">Amount: <?php echo $delivery->amount; ?></strong><br />
                            Courier Notes: <?php echo $delivery->courier_notes; ?>
                        </td>
                        <td><?php echo $delivery->recipient_address; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    function get_delivery_detail(delivery_id) {
        $.ajax({
                method: "POST",
                url: "<?php echo site_url(ADMIN_DIR . 'rider_app/get_delivery_detail'); ?>",
                data: {
                    delivery_id: delivery_id
                },
            })

            .done(function(respose) {
                $('#modal').modal('show');

                $('#modal_title').html('Delivery Package Detail');
                $('#modal_body').html(respose);


            });
    }
    $('#deliveries').DataTable({
        paging: false, // Disable pagination
        searching: true, // Enable searching
        info: true, // Show "Showing X to Y of Z entries"
        dom: '<"top"f i>rt<"bottom"lp><"clear">', // Arrange search and info at the top

    });
</script>