<div class="logopanel">
    <h1>Event</h1>
</div><!-- logopanel -->

<div class="leftpanelinner">

    <!-- This is only visible to small devices -->
    <div class="visible-xs hidden-sm hidden-md hidden-lg">   
        <div class="media userlogged">
            
            <img alt="profile" src="images/loggeduser.png" class="media-object">
            <div class="media-body">
                <h4>Test</h4>
            </div>
        </div>

        <h5 class="sidebartitle actitle">Account</h5>
        <ul class="nav nav-pills nav-stacked nav-bracket mb30">
            <li><a href="<?php echo $this->Url->build(array('controller' => 'users', 'action' => 'logout')); ?>"><i class="fa fa-sign-out"></i> <span>Sign Out</span></a></li>
        </ul>
    </div>

    <h5 class="sidebartitle">Navigation</h5>
    <ul class="nav nav-pills nav-stacked nav-bracket">        
        <li <?php echo ($this->request->params['controller'] == 'Users' && $this->request->action == 'index') || ($this->request->params['controller'] == 'Users' && $this->request->action == 'add') ? 'class=active' : ''; ?>>
            <a href="<?php echo $this->Url->build(array('controller' => 'users', 'action' => 'index')); ?>"><i class="fa fa-briefcase"></i> <span>Users</span></a>
        </li>
            <li <?php echo ($this->request->params['controller'] == 'Events' && $this->request->action == 'index') || ($this->request->params['controller'] == 'Events' && $this->request->action == 'add') ? 'class=active' : ''; ?>>
                <a href="<?php echo $this->Url->build(array('controller' => 'events', 'action' => 'index')); ?>"><i class="fa fa-building-o"></i> <span>Events</span></a>
            </li>
            
    </ul>
</div>

<script>
	$(document).ajaxError(function( event, request, settings ) {
		bootbox.dialog({
					closeButton: true,
					message: request.responseText,
					title: "Alert",
					buttons: {
						main: {
							label: "Ok",
							className: "btn-danger",
							callback: function () {
								location.reload();
							}
						}
					}
				});
	});
</script>
