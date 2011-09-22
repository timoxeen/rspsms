<?=form_open('sms', array('id' => 'contacts_add'))?>
<div data-role="fieldcontain">
    
    <?php if(!empty($list)) : ?>
    <fieldset data-role="controlgroup">
    	<legend>Choose contacts:</legend>
    	 <?php foreach($list as $contact) :?>
         	<input type="checkbox" name="mobilenos[]" id="radio-choice-<?=$contact->id ?>" value="<?=$contact->id ?>" />
         	<label for="radio-choice-<?=$contact->id ?>"><?=$contact->name ?></label>
		 <?php endforeach;?>
         	
    </fieldset>
     
</div>
<div data-role="fieldcontain">
	<?=form_submit(array('name'=>'add', 
	                     'id'=>'submit-b', 
	                     'value'=>'Send Message',
						 'data-theme' => 'b',
						 'data-icon' => 'check',
	))?>
	</div>
	<?=form_close() ?>
	<?php else: ?>
	<div style="text-align:center;padding: 15px 0"> No Contacts Added yet</div>
	<?php endif; ?>