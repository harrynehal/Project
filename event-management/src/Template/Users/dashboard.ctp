<div class="pageheader">
    <h2><i class="fa fa-home"></i>Dashboard <span></span></h2>
    <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
            <li class="active">Dashboard</li>
        </ol>
		<?php //echo $this->Html->link('Contact Registers', array('controller' => 'users', 'action' => 'contact_register') , array('class' => 'btn btn-success')); ?>
    </div>
</div>
	
<div class="contentpanel">   
    
    <div class="row">
        <div class="col-sm-6 col-md-3">
            <div class="panel panel-success panel-stat">
                <div class="panel-heading">

                    <div class="stat">
                        <div class="row">
                            <div class="col-xs-4">
                                <img src="<?= $this->request->webroot; ?>images/is-user.png" alt="" />
                            </div>
                            <div class="col-xs-8">
                                <small class="stat-label">Users Count</small>
                                <h1><?php echo $userCount; ?></h1>
                            </div>
                        </div><!-- row -->

                        <div class="mb15"></div>

                    </div><!-- stat -->

                </div><!-- panel-heading -->
            </div><!-- panel -->
        </div><!-- col-sm-6 -->

        <div class="col-sm-6 col-md-3">
            <div class="panel panel-danger panel-stat">
                <div class="panel-heading">

                    <div class="stat">
                        <div class="row">
                            <div class="col-xs-4">
                                <img src="<?= $this->request->webroot; ?>images/is-document.png" alt="" />
                            </div>
                            <div class="col-xs-8">
                                <small class="stat-label">Events Count</small>
                                <h1><?php echo $eventCount; ?></h1>
                            </div>
                        </div><!-- row -->

                        <div class="mb15"></div>

                    </div><!-- stat -->

                </div><!-- panel-heading -->
            </div><!-- panel -->
        </div><!-- col-sm-6 -->

		
	
</div>

