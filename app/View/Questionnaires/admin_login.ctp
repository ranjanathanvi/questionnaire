<div class="page-header">
				<h3>Questionnaire Login</h3>
			</div>
<div class="login-sec">
<h5 style="width:90%">Please Login to Your Account</h5>
<?php echo $this->Form->create(NULL,array('action'=>'login','method'=>'POST','name'=>'frmLogin','onsubmit' => 'return validateadminlogin();'));?>

<table width="80%" border="0">
  <tr><td colspan="2" class="minimise_msz"><?php if($this->Session->check('Message')){ echo $this->Session->flash(); } ?></td></tr>
  <tr>
    <td colspan="2"  class="text-input" >Username:</td>
  </tr>
  <tr>
    <td colspan="2" class="remo"><?php echo $this->Form->input('Admin.username', array('label'=>'','div'=>false,'class'=>"input-login")); ?></td>
  </tr>
  <tr>
    <td colspan="2" class="text-input">Password:</td>
  </tr>
  <tr>
    <td colspan="2"><?php echo $this->Form->password('Admin.password', array('label'=>'','div'=>false,'class'=>"input-login"));?></td>
    </tr>
  <tr>
    <td width="59%" style="display:none"><br /><?php echo $this->Html->link("Forgot Password",'/admin/admins/forgotpassword',array('class'=>'custom_link'),null,false); ?></td>
    <td width="41%"><input type="submit" class="btn btn-info" name="submit" value="Login" id="submit" /></td>
  </tr>
</table>
<?php echo $this->Form->end(); ?>
</div>
<div class="cleardiv"></div>
