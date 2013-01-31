<div style='display:none'>
<?php $user = $this->Session->read('Auth.User'); ?>
<?php if(empty($user)) { ?>
<div id='inline_example1'>
    <div class="signup-sec">
	<div class="signup-logo">
		<?php echo $this->Html->image('sign-logo.jpg', array('alt' => 'Retirement Pulse','width' => '460','height' => '71')); ?>	
	</div>
	<?php $videourl = $this->requestAction('/contents/getVideoUrl/'); ?>
	<div class="signup-video">What is Retirement Pulse?<br />
		<a href="<?php echo $videourl['Content']['video'];?>" target="_blank">
			<?php echo $this->Html->image('video-img.png', array('alt' => 'Retirement Pulse')); ?>
		</a>
	  <br />	
	</div>
<div class="signup-leftsec">
  <h2>Free Sign Up - no cost ever!</h2>
<p>Your free account gets you-</p>
<ul>
	<li>Unlimited access to everything on the site</li>
	<li>Ability to participate in our competition</li>
	<li>Newsletter updates</li>
	<li>Special invitations and offers</li>
	<li>...and it is TOTALLY FREE.</li>
</ul>
<div class="signup-form">
<?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'add'),'type' => 'file')); ?>
<table width="100%" border="0">
  <tr>
    <td width="60%" align="left" valign="top">
		<table width="94%" border="0" cellpadding="1">
		  <tr>
			<td>Email*</td>
		  </tr>
		  <tr>
			<td><?php echo $this->Form->input('User.email',array('class' =>'input-signup','label'=>false));?></td>
		  </tr>	 
		  <tr>
			<td>User Name*</td>
		  </tr> 
		  <tr>
			<td><?php echo $this->Form->input('User.username',array('class' =>'input-signup','label'=>false));?></td>
		  </tr>
		   <tr>
			<td>Password*</td>
		  </tr>
		  <tr>
			<td><?php echo $this->Form->input('User.password',array('class' =>'input-signup','label'=>false));?></td>
		  </tr>
		  <tr>
			<td><span class="col-blue">*Must be completed</span></td>
		  </tr>
		</table>	
	</td>
	<td width="40%" align="right" valign="top">
		<table width="100%" border="0">
		  <tr>
			<td>Profile Image</td>
		  </tr><input type="hidden" value="" name="data[User][uid]" id="uid"/>
		  <tr>
			<td><?php  echo $this->Form->input('User.image', array('type' => 'file','label'=>''));	?>
			<?php echo $this->Html->image('profile-img.jpg', array('alt' => 'Retirement Pulse','width' => '120','height' => '117','onClick'=>'javascript:clickbrowes()','class'=>'profile-img')); ?></td>
		  </tr>	
		  
		  <tr>
			<td><button id="submit" class="sign-btn" style="float:left" type="submit"> &nbsp;</button></td>
		  </tr>
		</table>
    </td>
  </tr>
</table>
<?php echo $this->Form->end(); ?>
</div>

</div>
<div class="sign-divider"><?php echo $this->Html->image('sign-divider.jpg'); ?></div>
<div class="signup-rightsec">
<h2>Sign In</h2>
<div class="sign-in-sec">
<?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'login'),'id' => 'loginformId')); ?>
<table width="100%" border="0">
  <tr>
    <td>User Name</td>
  </tr>
  <tr>
    <td><?php echo $this->Form->input('User.username',array('class' =>'input-signin','label'=>false));?></td>
  </tr>
  <tr>
    <td>Password</td>
  </tr>
  <tr>
    <td><?php echo $this->Form->input('User.password',array('class' =>'input-signin','label'=>false));?></td>
  </tr>
  <tr>
    <td>
		<button id="submit1" class="sign-in-btn" style="float:left" type="submit"> &nbsp;</button>
	</td>
  </tr>
  <tr>
    <td ><!--<a href="#" title="Forgot Password">Forgot Password</a>-->
    <?php echo $this->Html->link('Forgot Password', array('controller' => 'Users',
													 'action' => 'forgotpassword')); ?>
</td>
  </tr>
</table>

<?php echo $this->Form->end(); ?>
</div>
</div>
</div>
<script>
function clickbrowes(){
document.getElementById('UserImage').click();
}
</script>
<script type="text/javascript">
$(document).ready(function(){

	var formId		= '#loginformId';	// id of your form <form id=""
	var button		= '#submit1';	// id of your submit <input id="" type="submit"
	var validate	= ajaxValidation();

	$(formId).submit(function(){
		var	url		= $(formId).attr('action');
		var element	= $(formId);		
		validate.doPost({
			url: url,
			element: element,
			callback: function(message) {
				alert(message);
				if(message == true){
					window.location.href = '/';
				}
			}
		});		
		return false; // prevent the browser from submitting the form the normal way
	});

});
/*$("#UserImage").change(function (ev){
  var data = window.URL.createObjectURL(ev.target.files[0]);

  $(".profile-img").attr("src", data);
});*/
</script>
<script type="text/javascript">

/*$(document).ready(function(){

	var formId		= '#UserIndexForm';	// id of your form <form id=""
	var button		= '#submit';	// id of your submit <input id="" type="submit"
	var validate	= ajaxValidation();
	var shouldSubmit = false;
	$(formId).submit(function(){
		var	url		= $(formId).attr('action');
		var element	= $(formId);		
		validate.doPost({
			url: url,
			element: element,
			callback: function(message) {
				if(message != 0){
					shouldSubmit = true;
					$('#uid').val(message);
					$("#submit").click();
					return shouldSubmit;
				}
			}
		});		
		return shouldSubmit; // prevent the browser from submitting the form the normal way
	});

});*/
</script>
</div>
<?php }else{ ?>
<script>
	$(".example5").colorbox({inline:true, href:"#inline_example1"});
</script>
<div id='inline_example1'>
	<div class="details-sec">
	<h1>My Details</h1>
	<div class="details-logo"><?php echo $this->Html->image('detail-logo.jpg', array('alt' => 'Retirement Pulse','width' => '243','height' => '26')); ?></div>
	<div class="detail-divider"></div>
	<p>Line of information describing information.....</p>
<?php $edituser = $this->requestAction('/users/edit/'.$user['id']); ?>
<?php echo $this->Form->create('User',array('url' => array('controller' => 'users', 'action' => 'edit',$user['id']), 'id' => 'edituserform','enctype' => 'multipart/form-data')); ?>
	<div class="login-detail">
	<p><strong>Login Details</strong></p>

	<table width="100%" border="0">
	  <tr>
		<td width="23%" align="right">Username*</td>
		<td width="77%"><?php echo $this->Form->input('username',array('value'=>$edituser['User']['username'],'div' => 'input_label','class' =>'detail-input','label'=>false));?></td>
		<td >&nbsp;</td>
	  </tr>
	  <tr>
		<td align="right">Password*</td>
		<td>
			<?php echo $this->Form->input('password1',array('div' => 'input_label','type'=> 'password','class' =>'detail-input','label'=>false));?>
		</td>
		<td>&nbsp;</td>
	  </tr>
	</table>	
	<p>&nbsp;</p>
	<p><strong>Personal Details</strong></p>	
	<table width="100%" border="0">
	  <tr>
		<td width="22%" align="right"><p style="font-size:14px; color:#181818;">Email*</p></td>
		<td width="75%"><?php echo $this->Form->input('email',array('value'=>$edituser['User']['email'],'div' => 'input_label','class' =>'detail-input','label'=>false));?></td>
		<td width="3%">&nbsp;</td>
	  </tr>
	  <tr>
		<td>First Name</td>
		<td><?php echo $this->Form->input('firstname',array('value'=>$edituser['User']['firstname'],'div' => 'input_label','class' =>'detail-input','label'=>false));?></td>
		<td>&nbsp;</td>
	  </tr>
	  <tr>
		<td>Last Name</td><input type="hidden" value="" name="data[User][uid]" id="uid"/>
		<td><?php echo $this->Form->input('lastname',array('value'=>$edituser['User']['lastname'],'div' => 'input_label','class' =>'detail-input','label'=>false));?></td>
		<td>&nbsp;</td>
	  </tr>
	  <tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	  </tr>
	  <tr>
		<td>&nbsp;</td>
		<td><span class="col-blue">*Must be completed</span></td>
		<td>&nbsp;</td>
	  </tr>
	</table>
	</div>
	<div class="profile-sec">
	<div class="profile-image">
	<p><strong>Profile Image</strong></p>		
	<?php if(!empty($edituser['User']['image'])){ ?>
	<?php 	 echo $this->Html->image('uploads/users/small/'.$edituser['User']['image'], array('width' => '150', 'height' => '150')); ?>
	<?php 	 echo $this->Form->input('User.oldaddimage', array('type' => 'hidden', 'value' => $edituser['User']['image']));?>
	<?php } ?>
	<?php echo $this->Form->input('image', array('type' => 'file','label'=>''));?>
	<br /><br />
	</div>
	<div class="return-btn">
		<button class="btn-u-update" id="subedit" style="float:left" type="submit"> &nbsp;</button> 
	</div>
	
	</div>
<?php echo $this->Form->end();?>	
</div>
</div>
<script type="text/javascript">

$(document).ready(function(){

	var formId		= '#edituserform';	// id of your form <form id=""
	var button		= '#subedit';	// id of your submit <input id="" type="submit"
	var validate	= ajaxValidation();
 var shouldSubmit = false;
	$(formId).submit(function(){	
		var	url		= $(formId).attr('action');
		var element	= $(formId);		
		validate.doPost({
			url: url,
			element: element,
			callback: function(message) {				
				if(message != 0){			
					 shouldSubmit = true;
					$('#uid').val(message);
					 $("#subedit").click();
					  return shouldSubmit;
				}
			}
		});		
		
	
		return shouldSubmit; // prevent the browser from submitting the form the normal way
	});

});
</script>
<?php } ?>
</div>