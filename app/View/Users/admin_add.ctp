<?php /* Template for adding user from admin. */ ?>
<h1>Add User</h1>
<?php echo $this->Form->create('User',array('action' => 'admin_add','enctype'=>'multipart/form-data')); ?>
<?php echo $this->Form->input('email',array('div' => 'input_label','class' =>'input-admin-large'));?>
<?php echo $this->Form->input('username',array('div' => 'input_label','class' =>'input-admin-large'));?>	
<?php echo $this->Form->input('password',array('div' => 'input_label','class' =>'input-admin-large'));	
	  echo $this->Form->input('image', array('type' => 'file','label'=>''));
	  $options1 = array('1' => 'Yes', '0' => 'No');
	  $attributes1 = array('legend' => 'Status','separator' => '&nbsp;&nbsp;&nbsp;');
	  echo $this->Form->radio('status', $options1, $attributes1); ?>
	  <button class="btn-forgot" style="float:left"> &nbsp;</button> 
<?php echo $this->Form->end();?>