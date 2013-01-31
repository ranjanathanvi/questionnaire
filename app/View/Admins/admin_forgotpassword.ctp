
<div class="login-sec">
<div class="login-sec-title">Admin Forgot Password</div>
<?php echo $this->Form->create(NULL,array('action'=>'forgotpassword/','method'=>'POST','name'=>'frmLogin'));?>

<table width="100%" border="0">
  <tr><td colspan="2" class="minimise_msz"><?php if($this->Session->check('message')){
		echo "<div class='ActionMsgBox error' id='msgID' style='margin:0 25% 0 25%;'><ul><li>".$this->Session->read('message')."</li></ul></div><br>";
		$this->Session->delete('message');
	}?></td></tr>
	<tr>
    <td colspan="2" class="text-input">Enter Your Email:</td>
  </tr>
  <tr>
    <td colspan="2" class="remo"><?php echo $this->Form->text('Admin.email', array('label'=>'','div'=>false,'class'=>"input-login")); ?></td>
    </tr>
  
  <tr>
    <td width="59%"><br /> <?php echo $this->Html->link("Login",'/admin/admins/login',array('class'=>'custom_link'),null,false); ?></td>
    <td width="41%"><button class="btn-forgot" >&nbsp;</button></td>
  </tr>
</table>
<?php echo $this->Form->end(); ?>
</div>

<div class="cleardiv"></div>




