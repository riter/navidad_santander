<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php echo $this->Html->charset(); ?>

    <?php echo $this->Html->meta('icon'); ?>
    <?php
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>

<!-- Viewport metatags -->
<meta name="HandheldFriendly" content="true" />
<meta name="MobileOptimized" content="320" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

<!-- iOS webapp metatags -->
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />

<!-- iOS webapp icons -->
<link rel="apple-touch-icon-precomposed" href="/images/touch-icon-iphone.png" />
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="/images/touch-icon-ipad.png" />
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/images/touch-icon-retina.png" />

<!-- CSS Reset -->
<?php echo $this->Html->css('reset.css');?>
<!--  Fluid Grid System -->
<?php echo $this->Html->css('fluid.css');?>
<!-- Login Stylesheet -->
<?php echo $this->Html->css('login.css');?>

<!-- Required JavaScript Files -->
<script type="text/javascript" src="/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="/js/jquery.placeholder.js"></script>
<script type="text/javascript" src="/plugins/validate/jquery.validate.min.js"></script>



<!-- Core JavaScript Files -->
<script type="text/javascript" src="/js/user/login.js"></script>

    <title>
		<?php echo $title_page; ?>
	</title>
</head>
<body>
<div id="da-login">
	<div id="da-login-box-wrapper">
    	<div id="da-login-top-shadow"></div>
    	<div id="da-login-box">
        	<div id="da-login-box-header">
            	<h1>Login</h1>
                <?php echo $this->Session->flash(); ?>
            </div>
            <div id="da-login-box-content">
                <?php echo $this->Form->create('User', array('id'=>'da-login-form','url' => array('controller' => 'users', 'action' => 'login')));
                ?>
                	<div id="da-login-input-wrapper">
                    	<div class="da-login-input">
                            <? echo $this->Form->input('username', array('id'=>'da-login-username','placeholder'=>'Username','type'=>'text','label' => false, 'div' => false,'maxlength'=>'500')); ?>
                        </div>
                    	<div class="da-login-input">
                            <? echo $this->Form->input('password', array('id'=>'da-login-password','placeholder'=>'Password','type'=>'password','label' => false, 'div' => false,'maxlength'=>'500')); ?>
                        </div>
                    </div>
                    <div id="da-login-button">
                    	<input type="submit" value="Login" id="da-login-submit" />
                    </div>
                </form>
            </div>
            <div id="da-login-box-footer">
            	<!--<a href="#">forgot your password?</a>-->
                <div id="da-login-tape"></div>
            </div>
        </div>
    	<div id="da-login-bottom-shadow"></div>
    </div>
</div>
</body>
</html>
