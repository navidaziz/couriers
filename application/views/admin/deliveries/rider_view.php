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
					<a href="<?php echo site_url(ADMIN_DIR.$this->session->userdata("role_homepage_uri")); ?>"><?php echo $this->lang->line('Home'); ?></a>
				</li><li>
				<i class="fa fa-table"></i>
				<a href="<?php echo site_url(ADMIN_DIR."deliveries/view/riders"); ?>"><?php echo $this->lang->line('Deliveries'); ?></a>
			</li><li><?php echo $title; ?></li>
			</ul>
			<!-- /BREADCRUMBS -->
            <div class="row">
                        
                <div class="col-md-6">
                    <div class="clearfix">
					  <h3 class="content-title pull-left"><?php echo $title; ?></h3>
					</div>
					<div class="description"><?php echo $title; ?></div>
                </div>
                
                <div class="col-md-6">
                    <div class="pull-right">
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
                <h4><i class="fa fa-motorcycle"></i> Rider Dashboard </h4>
            </div>
            <div class="box-body">
			<div class="header-tabs">

                    <ul class="nav nav-tabs">
                         <li <?php if($tab=='Cancelled'){ ?> class="active" <?php } ?> >
                            <a href="<?php echo site_url(ADMIN_DIR.'deliveries/rider_view/'.$rider->user_id.'/Cancelled') ?>" contenteditable="false">Rider Cancelled</a>
                        </li>
                        <li <?php if($tab=='Delivered'){ ?> class="active" <?php } ?> >
                            <a href="<?php echo site_url(ADMIN_DIR.'deliveries/rider_view/'.$rider->user_id.'/Delivered') ?>" contenteditable="false">Rider Delivered</a>
                        </li>
                        <li <?php if($tab=='Shipped'){ ?> class="active" <?php } ?> >
                            <a href="<?php echo site_url(ADMIN_DIR.'deliveries/rider_view/'.$rider->user_id.'/Shipped') ?>" contenteditable="false">Package Assigned</a>
                        </li>
                        
                    </ul>
                    <div class="tab-content" style="margin-top: -35px;">
                        <?php if($tab=='Shipped'){ ?>
                            <?php $this->load->view(ADMIN_DIR."deliveries/rider_assigned"); ?>
                        <?php } ?>
                        <?php if($tab=='Delivered'){ ?>
                            <?php $this->load->view(ADMIN_DIR."deliveries/rider_delivered_list"); ?>
                        <?php } ?>
                        <?php if($tab=='Cancelled'){ ?>
                            <?php $this->load->view(ADMIN_DIR."deliveries/rider_cancelled_list"); ?>
                        <?php } ?>
                    </div>
                </div>
                

            </div>
        </div>
	</div>
	<!-- /MESSENGER -->
</div>
