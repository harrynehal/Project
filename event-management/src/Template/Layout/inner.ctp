<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0" name="viewport">
        <?php echo $this->Html->charset(); ?>
        <title>
            <?php echo 'Event Management' ?> | <?php echo $this->fetch('title'); ?>
        </title>
        <?php
        echo $this->Html->meta('icon');

        echo $this->Html->css(array('style.default', 'jquery.datatables', 'developer.css'));

        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->Html->script('jquery-3.3.1.min');
        ?>
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>

        <!-- Preloader -->
        <div id="preloader">
            <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
        </div>

        <section>

            <div class="leftpanel">
                <?php echo $this->element('sidebar'); ?>
            </div>

            <div class="mainpanel">

                <div class="headerbar">

                    <a class="menutoggle"><i class="fa fa-bars"></i></a>
                    <div class="header-right">


                        <ul class="headermenu">
                                
                            <li>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                        <img src="<?php echo $this->request->webroot.'images/loggeduser.png'; ?>" alt="profile" />
                                        
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                                       <li><a href="<?php echo $this->Url->build(array('controller' => 'users', 'action' => 'logout')); ?>"><i class="glyphicon glyphicon-log-out"></i> Log Out</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div><!-- header-right -->
                </div><!-- headerbar -->
<?php echo $this->fetch('content'); ?>
            </div><!-- mainpanel -->
        </section>
<?php
$this->Html->scriptStart(['block' => true]);
    echo "$('#messageDropdown').on('show.bs.dropdown', function () {"
            . "var that = this;"
            . "if($(that).find('.msgCounter').length > 0){"
           // . "$.post('".Router::url(array('controller'=>'messages', 'action'=>'mark_read'))."',function(data){ if(data.response.status == 'success'){ $(that).find('.msgCounter').remove();  } }, 'json');"
            . "}"
            . "});";
    echo "$('#notiDropdown').on('show.bs.dropdown', function () {"
    . "var that = this;"
            . "if($(that).find('.notiCount').length > 0){"
           // . "$.post('".Router::url(array('controller'=>'users', 'action'=>'mark_read'))."',function(data){ if(data.response.status == 'success'){ $(that).find('.notiCount').remove();  } }, 'json');"
            . "}"
            . "})";
$this->Html->scriptEnd();

//echo $this->Html->script(array('chosen.jquery.min', 'jquery.dataTables.min', 'jquery.validate.min', 'customFormValidators', 'common', 'custom', 'jquery.cookies', 'toggles.min', 'retina.min', 'jquery.sparkline.min', 'modernizr.min', 'bootbox.min', 'bootstrap.min', 'jquery-migrate-1.2.1.min'));
echo $this->Html->script(array('jquery.dataTables.min', 'custom', 'bootstrap.min', 'toggles.min', 'jquery.sparkline.min', 'jquery.cookies', 'jquery.validate.min', 'common', 'bootbox.min'));
echo $this->fetch('script');
echo $this->fetch('scriptBottom');
?>

    </body>
</html>
