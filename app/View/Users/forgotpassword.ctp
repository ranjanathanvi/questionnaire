<?php /* Template for forgot password page. */ ?>
<?php echo $this->Session->flash(); ?>
<div class="editorial-sec" style="height:200px;">
<h1>Forgot Your Password?</h1>
<?php echo $this->Form->create('User', array('action' => 'forgotpassword')); ?>
<?php echo __('Please enter your Email Address : '); ?>
		<?php echo $this->Form->input('email',array('class' => 'input-admin-large','label' => false));	?>
		<button class="btn-forgot" style=" text-align:right; margin-right:120px"> &nbsp;</button>
<?php echo $this->Form->end(); ?>
</div>