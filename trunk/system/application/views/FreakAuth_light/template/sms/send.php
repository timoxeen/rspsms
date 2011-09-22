
<?php echo form_open($this->uri->uri_string(), array('id' => 'send_sms_form'))?>

<?php if(!empty($contacts_list)) :?>
<div data-role="fieldcontain">
		<label for="select-choice-10" class="select">Choose contact(s):</label>
		<select name="mobileno_list[]" id="select-choice-10" multiple="multiple">
		<option>Choose contacts</option>
		<?php foreach ($contacts_list as $contact) :?>
		<option value="<?=$contact->mobileno?>" selected="selected"><?=$contact->name?></option>
		<?php endforeach;?>
		</select>
</div>
<?php endif;?>
<?php if(empty($contacts_list)) :?>
<div data-role="fieldcontain">
    <label for="mobileno"><?=$this->lang->line('SMS_mobileno_label')?>:</label>
    <?=form_input(array('name'=>'mobileno', 
				                       'id'=>'mobileno',
				                     //  'maxlength'=>'15', 
				                   //    'size'=>'10',
    								   'type'=>'tel',
				                       'value'=>(isset($this->fal_validation) ? $this->fal_validation->{'mobileno'} : '')))?>
    <?=(isset($this->fal_validation) ? $this->fal_validation->{'mobileno'.'_error'} : '')?>
</div>	
<?php endif;?>
<div data-role="fieldcontain">
	<label for="textarea"><?=$this->lang->line('SMS_message_label')?>:</label>
	<textarea cols="40" rows="8" name="message" id="textarea"><?=(isset($this->fal_validation) ? $this->fal_validation->{'message'} : '') ?></textarea>
	<?=(isset($this->fal_validation) ? $this->fal_validation->{'message'.'_error'} : '')?>
</div>

<div data-role="fieldcontain">
	
	<input type="submit" name="submit" value="Send" /> 
</div>
<?php echo form_close(); ?>