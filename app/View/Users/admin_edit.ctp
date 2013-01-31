<?php /* Template for edit user from admin. */ ?>
<h1>Edit User</h1>
<?php echo $this->Form->create('User',array('action' => 'admin_edit','enctype'=>'multipart/form-data')); ?>
<?php echo $this->Form->input('email',array('div' => 'input_label','class' =>'input-admin-large'));?>
<?php echo $this->Form->input('username',array('div' => 'input_label','class' =>'input-admin-large','readonly' =>true));?>	
<?php echo $this->Form->input('password1',array('div' => 'input_label','type'=> 'password','class' =>'input-admin-large','label'=>'Change Password'));?>
<?php echo $this->Form->input('image', array('type' => 'file','label'=>''));?>
<?php if(!empty($this->data['User']['image'])){ ?>
<?php 	 echo $this->Html->image('uploads/users/small/'.$this->data['User']['image'], array('width' => '80', 'height' => '70')); ?>
<?php 	 echo $this->Form->input('User.oldaddimage', array('type' => 'hidden', 'value' => $this->data['User']['image']));?>
<?php } ?> <br /><br />  
<?php $options1 = array('1' => 'Yes', '0' => 'No');
	  $attributes1 = array('legend' => 'Status','separator' => '&nbsp;&nbsp;&nbsp;');
	  echo $this->Form->radio('status', $options1, $attributes1); ?>
	<button class="btn-forgot" style="float:left"> &nbsp;</button> 
<?php echo $this->Form->end();?>