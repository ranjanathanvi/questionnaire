<?php /* Template for listing users in admin panel. */ ?>
<h1>Users</h1>
<?php echo $this->Session->flash();  ?>
<table class="gridtable" cellpadding="5" cellspacing="0">
<thead>
<tr >
   <td width="10%" ><strong>&nbsp;S.No.</strong></td>
   <td width="30%"><strong>User Name</strong></td>
   <td width="30%" ><strong>Email</strong></td>
   <td width="10%" style="text-align:center;"><strong>Enabled?</strong></td>
   <td width="20%" style="text-align:right;" colspan="2">&nbsp;</td></tr>
</thead>
<?php $class="even";$i=1; ?>
<?php foreach ($users as $user): ?>
	<tr class=<?php echo $class; ?>>
		<td width="10%"><?php echo $i; ?></td>
		<td width="30%">
		<?php echo $user['User']['username']; ?>
		</td>
		<td width="30%"><?php echo $user['User']['email']; ?></td>
		<td width="10%"  style="text-align:center;"><?php $chk_status = $user['User']['status'];
			if($chk_status == 1){		
				echo $status =  $this->Html->image("tick16.png",array('url' => array('action'=>'deactivate', $user['User']['id']))); 
				
			}else{
				echo $status =  $this->Html->image("cross16.png",array('url' => array('action'=>'activate', $user['User']['id']))); 
			} ?>
		</td>
		<td width="7%">
			<?php echo $this->Html->image("edit-img.png",array('url' => array('action'=>'edit', $user['User']['id']))); ?>
		</td>
		
		<td width="6%">
			<?php echo $this->Html->link($this->Html->image('delete-img.png', array('alt' => 'Delete')
														   ), array('action' => 'delete',$user['User']['id']), array('escape' => false,'confirm' => 'Remove User?')); ?>
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