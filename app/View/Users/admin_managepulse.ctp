<?php /* Template lists all users in Manage Pulse section in admin.admin can login as any user from this page. */ ?>
<h1 style="width:300px; float:left;">Users</h1>
<h1 style="float:right; width:300px; text-align:right">
	<?php echo $this->Html->link("Remove All Pulses", array('action' => 'delete_all_pulses'), array('escape' => false,'confirm' => 'Are you sure you want to delete all pulse?')); ?>
</h1>
<?php echo $this->Session->flash();  ?>
<table style="clear:both" class="gridtable" cellpadding="5" cellspacing="0">
<thead>
<tr  >
  <td width="10%" ><strong>&nbsp;S.No.</strong></td>
  <td width="20%"><strong>User Name</strong></td>
  <td width="20%" ><strong>Email</strong></td>
  <td width="10%" style="text-align:center;"><strong>Enabled?</strong></td>
  <td width="20%" style="text-align:left;" >&nbsp;</td>
  <td width="10%" style="text-align:center;" >Remove</td></tr>
</thead>
<?php $class="even";$i=1; ?>
<?php foreach ($users as $user): ?>
	<tr class=<?php echo $class; ?>>
		<td width="10%"><?php echo $i; ?></td>
		<td width="20%">
			<?php echo $user['User']['username']; ?>
		</td>
		<td width="20%"><?php echo $user['User']['email']; ?></td>
		<td width="10%"  style="text-align:center;"><?php $chk_status = $user['User']['status'];
			if($chk_status == 1){		
				echo $status =  $this->Html->image("tick16.png",array('url' => array('action'=>'deactivate', $user['User']['id']))); 
				
			}else{
				echo $status =  $this->Html->image("cross16.png",array('url' => array('action'=>'activate', $user['User']['id']))); 
			} ?>
		</td>
		
		<td width="20%">
			<?php echo $this->Html->link("Login as ".ucfirst($user['User']['username']) , array('action' => 'loginas',$user['User']['id']));?>
		</td>
		
		<td width="10%" style="text-align:center;">
			<?php echo $this->Html->link($this->Html->image('delete-img.png', array('alt' => 'Delete')
														   ), array('action' => 'delete',$user['User']['id']), array('escape' => false,'confirm' => 'All user related data like pulses and comments will be deleted. Remove User?')); ?>
		</td>
	</tr>
<?php if($class=="even"){
		$class="odd";
		}else{
			$class="even";
		}$i++; ?>
<?php endforeach; ?>
</table>
<?php echo $this->Paginator->first(__('<< First'), array('class' => 'number-first'));
	  echo $this->Paginator->numbers(array('class' => 'numbers', 'first' => false, 'last' => false));
	  echo $this->Paginator->last(__('>> Last'), array('class' => 'number-last')); ?>