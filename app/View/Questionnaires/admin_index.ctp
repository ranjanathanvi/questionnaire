<?php echo $javascript->link('listing.js');?>
<table width="100%" border="0" cellspacing="0" cellpadding="5">
	<tr>
		<td width="80%" valign="top">
			<div id="bluebox">
				<div class="top-left"><span>Administrator &gt; List Users</span></div>
				<div class="top-right"></div>
				<div id="inside" style="padding:10px;">
					<div id="listingJS" style="display: none;" ></div>
					<div id="loaderID" style="display:none;position:absolute;margin-left:300px;margin-top:50px"><?php echo $html->image("loader_large_blue.gif"); ?></div>
					<?php if($session->check('message')){
						echo "<div class='SuccessMsgBox success' id='msgID'><ul><li>".$session->read('message')."</li></ul></div>";
						$this->Session->delete('message');
					}?>
					<?php
					echo $form->create(NULL,array("action"=>"index","method"=>"Post"));
					?>
					<table width="100%" border="0" cellspacing="5" cellpadding="2">
                              <tr>
                                <td>Find Someone by typing their name </td>
                              </tr>
                              <tr>
                                <td><?php echo $form->text('Customer.last_name', array('size'=>'50','label'=>'','id'=>'title','div'=>false))?></td>
                              </tr>
                              <tr>
                                <td><!-- <a href="#" onclick="javascript:enable_disable('advance_search', 'simple_search');">or search by city, state, country, zip or email.</a> --></td>
                              </tr>
                            </table>
					<?php echo $form->end();?>
					<?php echo $this->element("admin/users/index"); ?>
				</div>
				<!-- Legend Start -->
				<table align="center" width="70%" border="0">
					<tr>
						<td align="center" width="65%"></td>
					</tr>
				</table>
				<!-- Legend End -->
				<div class="bottom"></div>
			</div>
		</td>
  </tr>
</table>