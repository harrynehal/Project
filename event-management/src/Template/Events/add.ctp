<?php
$this->assign('title', 'Add Event');
echo $this->Html->css('bootstrap-datetimepicker.min');
?>
<div class="pageheader">
    <h2>
        <i class="fa fa-user"></i> Event <span>Add</span>
    </h2>
    <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
            <li><?php echo $this->Html->link('Event', array('controller' => 'events', 'action' => 'index')); ?></li>
            <li class="active">Add</li>
        </ol>
    </div>
</div>
<div class='panel-body'><?php 
echo $this->Flash->render();
?></div>
<div class="contentpanel">
    <!-- content goes here... -->
    <div class="panel panel-default">

        <div class="panel-heading">
            <div class="panel-btns">
                <!-- a href="" class="panel-close">&times;</a -->
                <a href="" class="minimize">&minus;</a>
            </div>
            <h4 class="panel-title">Add Event</h4>
        </div>
        <?php echo $this->Form->create('Event', array('class' => 'form-horizontal form-bordered', 'novalidate', 'id'=>'addEvent' ,  'enctype'=>'multipart/form-data')); ?>

        <div class="panel-body panel-body-nopadding">
            <div class="form-group">
                <label class="col-sm-3 control-label">Event Name<span class="asterisk">*</span></label>
                <div class="col-sm-6">
                    <?= $this->Form->control('name', array('placeholder' => 'Event Name', 'label' => false, 'class' => 'form-control')); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Event Date<span class="asterisk">*</span></label>
                <div class="col-sm-3">
                    <?= $this->Form->control('date', array('placeholder' => 'Select date', 'label' => false, 'class' => 'form-control date-picker', 'id'=>'datepicker')); ?>                                        
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-3 control-label">Image</label>
                <div class="col-sm-3">
                    <img src="<?php echo $this->request->webroot.'images/defaultpic.jpeg'; ?>" id="userImage"  alt="Event Profile Pic" style="width: 100%; max-width: 150px">
                    <input type="file" name="image" class="form-control" id="UserVcImage" style="display:none">                    
                </div>
                <div class="col-sm-3">
                    <button class="btn btn-primary" id="uploadUserImage" type="button" style="margin-top: 30px;">Upload Image</button>
                </div>
            </div>
            <div class="form-group">

                <label class="col-sm-3 control-label">Description<span class="asterisk">*</span></label>
                <div class="col-sm-9">
                    <?= $this->Form->textarea('description', array('placeholder' => 'Enter description here...', 'label' => false, 'class' => 'form-control', 'rows' => '6', 'cols' => '30')); ?> 

                </div>
            </div>
            
        </div><!-- panel-body -->
        <div class="panel-footer">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <?= $this->Form->button('Add', array('class'=>'btn btn-primary', 'id'=>'addPageBtn', 'data-loading-text'=>"Please Wait...")); ?>
                    &nbsp;
                    <?php echo $this->Html->link('Cancel', array('action'=>'index'), array('class'=>'btn btn-default')); ?>
                   
                </div>
            </div>
        </div><!-- panel-footer -->
        <?php echo $this->Form->end(); ?>
    </div>
</div><!-- contentpanel -->
<?php
echo $this->Html->script(array('bootstrap-datetimepicker.min', 'event'), array('block' => 'scriptBottom', 'inline' => false));
?>
<script>
	
$('#uploadUserImage').on('click', function(){
    $('#UserVcImage').trigger('click');
});	
	$('#UserVcImage').change(function () {
    readURL(this);
});
function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            var fileTypes = ['jpg', 'jpeg', 'png'];
            var extension = input.files[0].name.split('.').pop().toLowerCase();
            
            if(fileTypes.indexOf(extension) > -1) {
            reader.onload = function (e) {
                $('#userImage').attr('src', e.target.result);
                    /*var image = new Image();
                    image.src = e.target.result;
                    
                    image.onload = function() {
                        if (this.width > 1000 || this.height > 800) {console.log(input.files[0]);
                            var aa = new File();
                            console.log(aa);
                            $('#userImage').attr('src', ajax_url+'/images/defaultpic.jpeg');                            
                        } else {
                            $('#userImage').attr('src', e.target.result);
                        }
                    }*/                    
                } 
                reader.readAsDataURL(input.files[0]);
            } else {
                bootbox.dialog({
                    closeButton: true,
                    message: 'Please upload valid image',
                    title: "Alert",
                    buttons: {
                        main: {
                            label: "Ok",
                            className: "btn-danger",
                            callback: function () {
            
        }
    }
                    }
                });
            }
        }
    }
</script>
