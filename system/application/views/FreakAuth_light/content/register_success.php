<?=$this->lang->line('FAL_register_success_message');?>
<br />
<br />
<?=form_open('/auth/activation/'.$userid, array('id' => 'register_form'))?>
<div data-role="fieldcontain">
    <label for="activationcode">Activation Code:</label>
    <input type="text" name="activationcode" id="activationcode" value="" size="5"  />
</div>

<div class="ui-body ui-body-b">
				
						<div class="ui-block-b">	
					<?=form_submit(array('name'=>'submit',
							   			 'class'=>'submit',  
				                         'value'=>'Activate'))?>
					</div>
			    </div>
<?php echo form_close(); ?>
<?=anchor($this->config->item('FAL_register_continue_action'), $this->lang->line('FAL_continue_label'))?>
