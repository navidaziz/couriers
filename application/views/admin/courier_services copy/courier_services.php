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
                <li><?php echo $title; ?></li>
            </ul>
            <!-- /BREADCRUMBS -->
            <div class="row">

                <div class="col-md-6">
                    <div class="clearfix">
                        <h3 class="content-title pull-left"><?php echo $title; ?></h3>
                    </div>
                    <div class="description"><?php echo $title; ?> Dashboard</div>
                </div>

                <div class="col-md-6">
                    <div class="pull-right">
                        <a class="btn btn-primary btn-sm" href="<?php echo site_url(ADMIN_DIR . "courier_services/add"); ?>"><i class="fa fa-plus"></i> <?php echo $this->lang->line('New'); ?></a>
                        <a class="btn btn-danger btn-sm" href="<?php echo site_url(ADMIN_DIR . "courier_services/trashed"); ?>"><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('Trash'); ?></a>
                    </div>
                </div>

            </div>


        </div>
    </div>
</div>
<!-- /PAGE HEADER -->

<!-- PAGE MAIN CONTENT -->
<div class="row">
    <?php foreach ($courier_services as $courier_service) { ?>
        <div class="col-md-3">
            <div class="box border blue" id="messenger">
                <div class="box-body">

                    <div class="table-responsive">

                        <table class="table">
                            <tbody>

                                <tr>

                                    <td>
                                        <img style="width:100%; height:100px" src="<?php echo base_url("assets/uploads/" . $courier_service->logo) ?>" />

                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php echo $courier_service->courier_service_name; ?>
                                        (<?php echo $courier_service->short_name; ?>)
                                    </td>
                                </tr>


                                <tr>
                                    <td style="text-align:center">
                                        <?php echo status($courier_service->status); ?>
                                        <?php

                                        //set uri segment
                                        if (!$this->uri->segment(4)) {
                                            $page = 0;
                                        } else {
                                            $page = $this->uri->segment(4);
                                        }

                                        if ($courier_service->status == 0) {
                                            echo "<a href='" . site_url(ADMIN_DIR . "courier_services/publish/" . $courier_service->courier_service_id . "/" . $page) . "'> &nbsp;" . $this->lang->line('Publish') . "</a>";
                                        } elseif ($courier_service->status == 1) {
                                            echo "<a href='" . site_url(ADMIN_DIR . "courier_services/draft/" . $courier_service->courier_service_id . "/" . $page) . "'> &nbsp;" . $this->lang->line('Draft') . "</a>";
                                        }
                                        ?>

                                    </td>
                                </tr>
                                <tr>
                                    <td stylet="text-align:center !important">
                                        <a class="btn btn-danger" href="<?php echo site_url(ADMIN_DIR . "courier_services/trash/" . $courier_service->courier_service_id . "/" . $this->uri->segment(4)); ?>"><i class="fa fa-trash-o"></i></a>
                                        <span style='margin-left:20px'><span>
                                                <a class="btn btn-primary" href="<?php echo site_url(ADMIN_DIR . "courier_services/edit/" . $courier_service->courier_service_id . "/" . $this->uri->segment(4)); ?>"><i class="fa fa-pencil-square-o"></i></a>

                                                <span style='margin-left:20px'><span>
                                                        <a class="btn btn-success" href="<?php echo site_url(ADMIN_DIR . "courier_services/view_courier_service/" . $courier_service->courier_service_id . "/" . $this->uri->segment(4)); ?>"><i class="fa fa-eye"></i> </a>

                                    </td>
                                </tr>

                            </tbody>
                        </table>




                    </div>


                </div>

            </div>
        </div>
    <?php } ?>

</div>