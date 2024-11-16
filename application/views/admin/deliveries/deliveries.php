<div class="row">
    <div class="col-sm-12">
        <div class="page-header" style="min-height: 20px;">
            <ul class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="<?php echo site_url($this->session->userdata("role_homepage_uri")); ?>"><?php echo $this->lang->line('Home'); ?></a>
                </li>
                <li><?php echo $title; ?></li>
            </ul>
        </div>
    </div>
</div>
<!-- /PAGE HEADER -->
<style>
    .box .header-tabs .nav-tabs>li.active a,
    .box .header-tabs .nav-tabs>li.active a:after,
    .box .header-tabs .nav-tabs>li.active a:before {
        background: orange;
        z-index: 3;
        font-weight: bold;
    }
</style>

<!-- PAGE MAIN CONTENT -->
<div class="row">
    <!-- MESSENGER -->
    <div class="col-md-12">
        <div class="box border blue" id="messenger">
            <div class="box-title">
                <h4><i class="fa fa-bell"></i> <?php echo $title; ?> Dashboard</h4>

            </div>
            <div class="box-body">


                <div class="header-tabs">

                    <ul class="nav nav-tabs">

                        <?php
                        //$delivery_status  = array("Pending", "Shipped", "Onhold", "Delivered", "Cancelled", "Completed");
                        $delivery_status  = array("Completed", "Cancelled", "Delivered", "Onhold", "Shipped", "Pending");
                        foreach ($delivery_status as $d_status) { ?>

                            <?php $query = "SELECT delivery_status, COUNT(delivery_status) as total 
                            FROM deliveries WHERE delivery_status =  '" . $d_status . "'";
                            $deliverystatus = $this->db->query($query)->row();
                            ?>

                            <li style="" <?php if ($deliverystatus->delivery_status == $tab) { ?> class="active" <?php } ?>>

                                <a href="<?php echo site_url(ADMIN_DIR . "deliveries/view/"); ?><?php echo $deliverystatus->delivery_status; ?>"
                                    contenteditable="false" style="cursor: pointer; padding: 7px 8px;">

                                    <?php echo $deliverystatus->delivery_status; ?> ( <?php echo $deliverystatus->total; ?>
                                    )</a>
                            </li>
                        <?php } ?>
                        <li <?php if ('riders' == $tab) { ?> class="active" <?php } ?> sty>
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