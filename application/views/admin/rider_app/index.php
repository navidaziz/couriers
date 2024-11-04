
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
            <div class="table-responsive">
                        <table class="table table-strip" id="deliveries">
                            <thead>
                                <tr>
                                <th>#</th>
                                <th>Packages</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php  $query = "SELECT * FROM `deliveries` where rider_id = ?";
                                $deliveries = $this->db->query($query, $rider->user_id)->result();
                                $count=1;
                                foreach ($deliveries as $delivery) { ?>
                                    <tr>
                                        <td><?php echo $count++ ?></td>
                                        <td stylet="text-align:center">
                                            <strong>Tracking No</strong>
                                            <h4><?php echo $delivery->tracking_number; ?></h4>
                                            <?php if($delivery->delivery_status=='Shipped'){ ?>
                                                <button onclick="get_delivery_detail('<?php echo $delivery->delivery_id; ?>')" class="btn btn-primary btn-sm">Process ></button>
                                            <?php }else{ ?>

                                                <?php echo delivery_status($delivery->delivery_status); ?>
                                            
                                            <?php } ?>
                                        </td>
                                        <td>
                                            
                                        Recipaint Name:<?php echo $delivery->recipient_name; ?><br />
                                        Recipaint Contact No.: <a href="tel:<?php echo $delivery->recipient_contact; ?>">
                                                               <?php echo $delivery->recipient_contact; ?></a><br />
                                        Recipaint Address: <?php echo $delivery->recipient_address; ?><br />
                                        Expected Delivery Date: <?php echo $delivery->expected_delivery_date; ?><br />
                                        Delivery Cost: <?php echo $delivery->delivery_cost; ?><br />
                                        Courier Notes: <?php echo $delivery->courier_notes; ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
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
        </script>
