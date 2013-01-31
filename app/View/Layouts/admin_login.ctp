<?php
/**
 *
 * This template is used to set layOut for admin login page.
 */

$cakeDescription = __d('cake_dev', '');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	<?php
		echo $this->Html->meta('icon');
		//echo $this->Html->css('cake.generic');
		/* **
		 *
		 * 
		 *custom CSS inclded for retirement pulse */
		echo $this->Html->css('bootstrap');	
		echo $this->Html->css('bootstrap.min');	
		echo $this->Html->css('bootstrap-responsive');	
		echo $this->Html->css('bootstrap-responsive.min');	
		
		echo $this->Html->script(array('jquery.min.js','bootstrap.min','jquery-latest'));
			
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>	
</head>
<body >
	<div class="container">
	<?php echo $this->element('header_login'); ?>
	

	<?php echo $this->fetch('content'); ?>	
		
	<?php echo $this->element('footer_login'); ?>
	
	<?php echo $this->element('sql_dump'); ?>
	</div>
</body>
</html>
