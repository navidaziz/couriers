<div class="row">
    <div class="col-sm-12">
        <div class="page-header">
            <ul class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="<?php echo site_url($this->session->userdata("role_homepage_uri")); ?>"><?php echo $this->lang->line('Home'); ?></a>
                </li>
                <li><?php echo $title; ?></li>
            </ul>
            <!-- /BREADCRUMBS -->
            <div class="row">

                <div class="col-md-6">
                    <div class="clearfix">
                        <h3 class="content-title pull-left"><?php echo $title; ?></h3>
                    </div>
                    <div class="description"><?php echo $title; ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="pull-right">
                        <button onclick="get_delivery_form('0')" class="btn btn-primary">Add Record</button>

                        <script>
                            function get_delivery_form(delivery_id) {
                                $.ajax({
                                        method: "POST",
                                        url: "<?php echo site_url(ADMIN_DIR . 'deliveries/get_delivery_form'); ?>",
                                        data: {
                                            delivery_id: delivery_id
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
                    </div>
                </div>

            </div>


        </div>
    </div>
</div>
<!-- /PAGE HEADER -->

<!-- PAGE MAIN CONTENT -->
<div class="row">
    <!-- MESSENGER -->
    <div class="col-md-12">
        <div class="box border blue" id="messenger">
            <div class="box-title">
                <h4><i class="fa fa-bell"></i> <?php echo $title; ?></h4>

            </div>
            <div class="box-body">


                <div class="header-tabs">

                    <ul class="nav nav-tabs">

                        <?php
                        $query = "SELECT delivery_status, COUNT(delivery_status) as total FROM deliveries ";
                        $query .= " GROUP BY delivery_status";
                        $delivery_status = $this->db->query($query)->result();
                        foreach ($delivery_status as $deliverystatus) { ?>

                            <li <?php if ($deliverystatus->delivery_status == $tab) { ?> class="active" <?php } ?>>

                                <a href="<?php echo site_url(ADMIN_DIR . "deliveries/view/"); ?>/<?php echo $deliverystatus->delivery_status; ?>"
                                    contenteditable="false" style="cursor: pointer; padding: 7px 8px;">

                                    <?php echo $deliverystatus->delivery_status; ?> ( <?php echo $deliverystatus->total; ?>
                                    )</a>
                            </li>
                        <?php } ?>
                        <li <?php if ('riders' == $tab) { ?> class="active" <?php } ?>>
                            <a href="<?php echo site_url(ADMIN_DIR . "deliveries/view/riders"); ?>"
                                contenteditable="false" style="cursor: pointer; padding: 7px 8px;">Riders Dashboard</a>
                        </li>


                    </ul>
                    <div class="tab-content" style="margin-top: -35px;">
                        <?php if ('riders' == $tab) { ?>
                            <?php $this->load->view(ADMIN_DIR . "deliveries/riders_dashboard"); ?>
                        <?php } else { ?>
                            <?php $this->load->view(ADMIN_DIR . "deliveries/deliveries_list"); ?>
                        <?php } ?>
                    </div>
                </div>






            </div>
        </div>
        <!-- /MESSENGER -->
    </div>