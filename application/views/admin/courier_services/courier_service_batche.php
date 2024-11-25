<!-- PAGE HEADER-->
<div class="row">
    <div class="col-sm-12">
        <div class="page-header">
            <!-- STYLER -->

            <!-- /STYLER -->
            <!-- BREADCRUMBS -->
            <ul class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="<?php echo site_url($this->session->userdata("role_homepage_uri")); ?>"><?php echo $this->lang->line('Home'); ?></a>
                </li>
                <li>
                    <i class="fa fa-table"></i>
                    <a href="<?php echo site_url(ADMIN_DIR . "courier_services/view/"); ?>"><?php echo $this->lang->line('Courier Services'); ?></a>
                <li><a href="<?php echo site_url(ADMIN_DIR . "courier_services/view_courier_service/" . $courier_service->courier_service_id); ?>"><?php echo $courier_service->courier_service_name; ?></a> </li>
                </li>
                <li><?php echo $title; ?></li>
            </ul>
            <!-- /BREADCRUMBS -->
            <div class="row">

                <div class="col-md-2">
                    <img style="width:100%; height:50px" src="<?php echo base_url("assets/uploads/" . $courier_service->logo) ?>" />

                </div>
                <div class="col-md-4">
                    <div class="clearfix">
                        <h3 class="content-title pull-left"><?php echo $title; ?></h3>
                    </div>
                    <div class="description"><?php echo $courier_service->short_name; ?></div>
                </div>

                <div class="col-md-6">
                    <div class="pull-right">
                        <?php if ($batch->payment_status == 'Unpaid' and 1 == 2) { ?>
                            <button onclick="get_delivery_form('0')" class="btn btn-primary">Add Delivery Package</button>

                            <script>
                                function get_delivery_form(delivery_id) {
                                    $.ajax({
                                            method: "POST",
                                            url: "<?php echo site_url(ADMIN_DIR . 'courier_services/get_delivery_form'); ?>",
                                            data: {
                                                delivery_id: delivery_id,
                                                courier_service_id: <?php echo $courier_service->courier_service_id; ?>,
                                                batch_id: <?php echo $batch->batch_id; ?>
                                            },
                                        })
                                        .done(function(respose) {
                                            $('#modal').modal('show');
                                            $('.modal-dialog').css({
                                                'width': '80%'
                                            });
                                            if (delivery_id > 0) {
                                                $('#modal_title').html('Update Delivery');
                                            } else {
                                                $('#modal_title').html('Add New Delivery');
                                            }
                                            $('#modal_body').html(respose);

                                        });
                                }
                            </script>
                        <?php } ?>
                    </div>
                </div>

            </div>


        </div>
    </div>
</div>
<!-- /PAGE HEADER -->

<!-- PAGE MAIN CONTENT -->
<div class="row">


    <div class="col-md-12">
        <div class="box border blue" id="messenger">
            <div class="box-title">
                <h4><i class="fa fa-bell"></i></h4>

            </div>
            <div class="box-body">


                <div class="header-tabs">

                    <ul class="nav nav-tabs">

                        <?php
                        //$delivery_status  = array("Pending", "Shipped", "Onhold", "Delivered", "Cancelled", "Completed");

                        $delivery_status  = array("Completed", "Returned", "Cancelled", "Delivered", "Onhold", "Shipped", "Pending");
                        foreach ($delivery_status as $d_status) { ?>

                            <?php $query = "SELECT delivery_status, COUNT(delivery_status) as total 
                            FROM deliveries WHERE delivery_status =  '" . $d_status . "'
                            AND batch_id = '" . $batch->batch_id . "'";
                            $deliverystatus = $this->db->query($query)->row();
                            ?>

                            <li style="" <?php if ($d_status == $tab) { ?> class="active" <?php } ?>>

                                <a href="<?php echo site_url(ADMIN_DIR . "courier_services/courier_service_batche/" . $courier_service->courier_service_id . "/" . $batch->batch_id . '/' . $d_status); ?>"
                                    contenteditable="false" style="cursor: pointer; padding: 7px 8px;">

                                    <?php echo $d_status; ?> ( <?php echo $deliverystatus->total; ?>
                                    )</a>
                            </li>
                        <?php } ?>
                        <li <?php if ('Summary' == $tab) { ?> class="active" <?php } ?>>
                            <a href="<?php echo site_url(ADMIN_DIR . "courier_services/courier_service_batche/" . $courier_service->courier_service_id . "/" . $batch->batch_id . '/Summary'); ?>"
                                contenteditable="false" style="cursor: pointer; padding: 7px 8px;">Batch Summary</a>
                        </li>


                    </ul>
                    <div class="tab-content" style="margin-top: -35px;">
                        <?php if ('Summary' == $tab) { ?>
                            <?php $this->load->view(ADMIN_DIR . "courier_services/batch/batch_summary"); ?>
                        <?php } else { ?>
                            <?php $this->load->view(ADMIN_DIR . "courier_services/batch/batch_deliveries"); ?>
                        <?php } ?>
                    </div>
                </div>






            </div>
        </div>
        <!-- /MESSENGER -->
    </div>