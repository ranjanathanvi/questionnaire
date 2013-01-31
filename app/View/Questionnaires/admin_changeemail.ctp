<?php if($this->Session->check('Message')){ echo "<font color='red'>".$this->Session->flash()."</font>"; }  ?>
 <div class="admin-box">
<?php echo $this->Form->create(NULL,array('action'=>'changeemail/','method'=>'POST','enctype'=>'multipart/form-data')); ?>			  
<table width="100%" border="0">
  <tr> 
	  <td width="10%">&nbsp;</td>
	  <td  colspan="3"><h1>Change Your Email</h1></td>
  </tr>  
  <tr>
  	  <td>&nbsp;</td>
      <td class="admin-input-txt">Email:<font color="red">*</font></td>
      <td width="200" class="remo"><?php echo $this->Form->text('Admin.email', array('label'=>'','div'=>false,'class'=>"input-admin"))?></td>
	   <td>&nbsp;</td>
    </tr>
  <tr>
  	  <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td ><?php  $loggedAdminId = $this->Session->read("adminid");?>
    	   <?php echo $this->Form->input('Admin.id', array('type'=>'hidden','value'=>$loggedAdminId));?>
			<button class="btn-forgot" style="float:left">&nbsp;</button></td>
	 <td>&nbsp;</td>
    </tr>  
</table>			  
<?php echo $this->Form->end(); ?>
  
</div>
			