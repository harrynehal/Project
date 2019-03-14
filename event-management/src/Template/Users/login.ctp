<div class="col-md-5">
    <?= $this->Flash->render() ?>
    <?php
    echo $this->Form->create('User', array('id' => 'UserLoginForm', 'novalidate' => 'novalidate'));    
    ?>
    <h4 class="nomargin">Sign In</h4>
    <p class="mt5 mb20">Login to access your account.</p>

    <?= $this->Form->control('username', ['id' => 'UserName', 'label' => false, 'placeholder' => 'Username', 'class' => 'form-control uname', 'value' => '']); ?>
    <?= $this->Form->control('password', ['id' => 'UserPassword', 'label' => false, 'placeholder' => 'Password', 'class' => 'form-control pword', 'value' => '']); ?>
    

    <?php echo $this->Form->button('Submit', array('value' => 'Submit', 'class' => 'btn btn-success btn-block'));
    ?>
    <?php echo $this->Form->end(); ?>
</div>
<?php echo $this->Html->script(array('timezone', 'cookies'), array('inline'=>false));
$this->Html->scriptStart(['block' => true]);
    echo "var tz = jstz.determine();"
    . "var usertimezone = tz.name();"
    . "setCookie('client_timezone', usertimezone, 365);";
$this->Html->scriptEnd();
