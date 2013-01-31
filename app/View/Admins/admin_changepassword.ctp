 <?php if($this->Session->check('Message')){ 
					echo "<font color='red'>".$this->Session->flash()."</font>"; }				 
                 ?>
<div class="admin-box">	
	 <table width="100%" border="0" cellspacing="0" cellpadding="5">
		<tr>
			<td width="80%" valign="top">
			
			<?php echo $this->Form->create('Admin',array('action'=>'changepassword/','method'=>'POST','name'=>'frmCreateUser','enctype'=>'multipart/form-data')); ?>
					  <table width="100%" border="0" cellspacing="3" cellpadding="3">
						
						
						<tr>
						  <td width="10%">&nbsp;</td>
						  <td  colspan="3"><h1>Change Your Password</h1></td>
						  
						</tr>
	
						<tr>
							<td>&nbsp;</td>
							<td class="admin-input-txt">Old Password<font color="red">*</font></td>
							<td width="200"><?php echo $this->Form->password('Admin.old_password', array('maxlength'=>'40','size'=>'30','label'=>'','div'=>false,'class'=>'input-admin'))?></td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td class="admin-input-txt">New Password<font color="red">*</font></td>
							<td><?php echo $this->Form->password('Admin.password', array('maxlength'=>'40','size'=>'30','label'=>'','div'=>false,'class'=>'input-admin'))?></td>
							<td>&nbsp;</td>
						</tr>
	
						<tr>
						  <td>&nbsp;</td>
						  <td class="admin-input-txt"  width="200">Confirm Password: <font color="red">*</font></td>
						  <td><?php echo $this->Form->password('Admin.confirm_password', array('maxlength'=>'40','size'=>'30','label'=>'','div'=>false,'class'=>'input-admin'))?> <?php echo $this->Form->error('User.user_name');?></td>
						  <td>&nbsp;</td>
					   </tr>
					  <tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td align="left">&nbsp;</td>
						</tr>
	
					<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td><?php echo $this->Form->input('Admin.id', array('type'=>'hidden','value'=>'1'));?><button class="btn-forgot" style="float:left"> &nbsp;</button></td>
						  <td align="left">&nbsp;</td>
					</tr>
					<tr>
						  <td colspan="4" align="center">&nbsp;</td>
					</tr>
					</table>
			<?php echo $this->Form->end(); ?>
						
			</td>
		</tr>
	 </table>
</div>